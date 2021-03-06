<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Support\Facades\Redirect;
use DB;
use UUID;
use App\Models\Product_type;
use App\Models\Product_pictures;
use App\Models\Brand;
use App\Models\Brand_product;
use App\Models\Brand_type;
use App\Models\Product_file;
use App\Models\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Product::get();
        return view('admin.product.index',['data'=>$list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $type = Type::where('is_hidden',0)->orderBy('tree', 'asc')->get(['id', 'name', 'level','pid']);
        $brand = Brand::where('is_hidden','0')->select('id','name')->orderby('updated_at','desc')->get();
        $root = [];
        foreach ($type as $val){
            if($val->level == 0){
//                $val->child = [];
                array_push($root,$val);
            }
        }
        foreach ($root as $r){
            $child = [];
            foreach ($type as $val){
                if($r->id == $val->pid){
                    array_push($child,$val);
                }
            }
            array_add($r,'child',$child);
        }
//        return $root;
        $data['brand'] = $brand;
        $data['pid'] = $root;
        return view('admin.product.create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'version' => 'required',
//            'brand_id' => 'required|integer',
            'pid' => 'required'
        ]);
//        return $request->all();
        if($request->input('brand_id') == "0"){
            return Redirect::back()->withInput()->withErrors('请选择产品所属品牌');
        }
        $data = $request->all();

        $product = Product::where('name',$data['name'])->where('intro',$data['intro'])->first();
        if(!$product){
            $product = new Product();
            $id = (string)UUID::generate();
            $product->id = $id;
            $product->name = $data['name'];
            $product->intro = $data['intro'];
            $product->version = $data['version'];
            if($request->has('editorValue')){
                $product->description = $data['editorValue'];
            }

            if($request->has('is_store')){
                $product->is_store = $data['is_store'];
            }

            if($request->has('is_hidden')){
                $product->is_hidden = $data['is_hidden'];
            }

            if($request->has('is_sale')){
                $product->is_sale = $data['is_sale'];
            }

            if($request->has('is_discounts')){
                $product->is_discounts = $data['is_discounts'];
            }


//            $product->is_hidden = $data['is_hidden'];
//            $product->is_sale = $data['is_hidden'];
//            $product->is_discounts = $data['is_discounts'];

            $product->save();

            $b_pro = new Brand_product();
            $b_pro->id = UUID::generate();
            $b_pro->brand_id = $data['brand_id'];
            $b_pro->product_id = $id;
            $b_pro->save();

            //存储产品类型
            if(!empty($data['pid'])){
                $pid = [];
                foreach ($data['pid'] as $p){
                    array_push($pid,['id'=>UUID::generate(),'product_id'=>$id,'type_id'=>$p]);
                }
                $brandtype = DB::table('tb_product_type')->insert($pid);
            }

            //存储产品图片
            if(!empty($data['cover'])){
                $pic = explode(',',$data['cover']);
                $pictures = [];
                $product_pic = [];
                foreach ($pic as $p){
                    if(!empty($p)){
                        $pid = (string)UUID::generate();
                        array_push($pictures,['id'=>(string)$pid,'name' =>'','path' => $p]);
                        array_push($product_pic,['id'=>(string)$pid,'product_id'=>$id,'pictures_id'=>$pid]);
                    }
                }
                //tb_product_pictures

                if(!empty($pictures)){
                    $result = DB::table('tb_pictures')->insert($pictures);
                    DB::table('tb_product_pictures')->insert($product_pic);
                }
            }

            //存储产品资料
            if(!empty($data['product_file'])){
                $file = new File();
                $file_id = (string)UUID::generate();
                $file->id = $file_id;
                $file->name = $data['product_file_name'];
                $file->path = $data['product_file_path'];
                if($file->save()){
                    $p_file = new Product_file();
                    $p_file->id = UUID::generate();
                    $p_file->product_id = $id;
                    $p_file->file_id = $file_id;
                }


            }
            return Redirect::back();
        }else{
            return Redirect::back()->withInput()->withErrors('该记录已存在');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $data = [];
        $data['product'] = Product::find($id);
        $type = Type::where('is_hidden',0)->orderBy('tree', 'asc')->get(['id', 'name', 'level','pid']);
        $ptype = Product_type::where('product_id',$id)->select('type_id')->get();
        $logo = Product_pictures::join('tb_pictures','tb_product_pictures.pictures_id','=','tb_pictures.id')->where('tb_product_pictures.product_id',$id)->select('tb_pictures.path')->get();
        $plogo =[];
        foreach ($logo as $l){
            array_push($plogo,$l->path);
        }
        $data['logo'] = $plogo;
        $root = [];
        foreach ($type as $val){
            if($val->level == 0){
                $val->is_choose = false;
                foreach ($ptype as $pt){
                    if($val->id == $pt->type_id){
                        $val->is_choose = true;
                    }
                }
                array_push($root,$val);
            }
        }
        foreach ($root as $r){
            $child = [];
            foreach ($type as $val){
                if($r->id == $val->pid){
                    $val->is_choose = false;
                    foreach ($ptype as $pt){
                        if($val->id == $pt->type_id){
                            $val->is_choose = true;
                        }
                    }
                    array_push($child,$val);
                }
            }
            array_add($r,'child',$child);
        }
//        return $root;
        $data['pid'] = $root;
        return view('admin.product.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
//        return $data;
        $product = Product::find($data['id']);
        if($product){
//            $product = new Product();
//            $id = (string)UUID::generate();
//            $product->id = $id;
            $product->name = $data['name'];
            $product->intro = $data['intro'];
            $product->version = $data['version'];
            $product->description = $data['editorValue'];
//            $product->parameters = $data['parameters'];
            $product->is_store = 0;
            $product->is_hidden = 0;
            $product->is_sale = 0;
            $product->is_discounts = 0;
            if($request->has('is_store')){
                $product->is_store = $data['is_store'];
            }
            if($request->has('is_hidden')){
                $product->is_hidden = $data['is_hidden'];
            }

            if($request->has('is_sale')){
                $product->is_sale = $data['is_sale'];
            }

            if($request->has('is_discounts')){
                $product->is_discounts = $data['is_discounts'];
            }

//            $product->is_hidden = $data['is_hidden'];
//            $product->is_sale = $data['is_sale'];
//            $product->is_discounts = $data['is_discounts'];


            $product->save();
            DB::table('tb_product_type')->where('product_id',$product->id)->delete();
            if(!empty($data['pid'])){
                $pid = [];
                foreach ($data['pid'] as $p){
                    array_push($pid,['id'=>UUID::generate(),'product_id'=>$product->id,'type_id'=>$p]);
                }
                $brandtype = DB::table('tb_product_type')->insert($pid);
            }


            DB::table('tb_product_pictures')->where('product_id',$product->id)->delete();
            if(!empty($data['cover'])){
                $pic = explode(',',$data['cover']);
                $pictures = [];
                $product_pic = [];
                foreach ($pic as $p){
                    if(!empty($p)){
                        $pid = (string)UUID::generate();
                        array_push($pictures,['id'=>(string)$pid,'name' =>'','path' => $p]);
                        array_push($product_pic,['id'=>(string)$pid,'product_id'=>$product->id,'pictures_id'=>$pid]);
                    }
                }
                //tb_product_pictures

                if(!empty($pictures)){
                    $result = DB::table('tb_pictures')->insert($pictures);
                    DB::table('tb_product_pictures')->insert($product_pic);
                }
            }
            return Redirect::back();
        }else{
            return Redirect::back()->withInput()->withErrors('该记录不存在');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destory(Request $request){
        $model = Product::find($request->input('id'));
        if(!empty($model)){
            if($model->delete()){
                return response()->json(['code' => 200, 'msg' => '删除成功']);
            }
            return response()->json(['code' => 400, 'msg' => '删除失败']);
        }
        return response()->json(['code' => 204, 'msg' => '信息不存在']);
    }

    /**
     * 操作新闻，启用禁用，审核类
     */
    public function handle(Request $request){
        $model = Product::find($request->input('id'));
        if(!empty($model)){
            $model->is_hidden = $request->input('is_hidden');
            if($model->save()){
                // return Redirect::back();
                return response()->json(['code' => 200, 'msg' => '保存失败']);
            }else{
                return response()->json(['code' => 400, 'msg' => '操作失败']);
            }
        }else{
            return response()->json(['code' => 204, 'msg' => '该新闻记录不存在']);
        }
    }
}
