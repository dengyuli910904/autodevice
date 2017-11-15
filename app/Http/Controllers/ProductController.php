<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Support\Facades\Redirect;
use DB;
use UUID;


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
        $data = $request->all();

        $product = Product::where('name',$data['name'])->where('intro',$data['intro'])->first();
        if(!$product){
            $product = new Product();
            $id = (string)UUID::generate();
            $product->id = $id;
            $product->name = $data['name'];
            $product->intro = $data['intro'];
            $product->version = $data['version'];
            $product->description = $data['editorValue'];
//            $product->parameters = $data['parameters'];
            $product->is_store = $data['is_store'];
            $product->is_hidden = $data['is_hidden'];
            $product->is_sale = $data['is_sale'];
            $product->is_discounts = $data['is_discounts'];


            $product->save();
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
        $data['pid'] = $root;
        return view('admin.product.create',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

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
            $product->is_store = $data['is_store'];
            $product->is_hidden = $data['is_hidden'];
            $product->is_sale = $data['is_sale'];
            $product->is_discounts = $data['is_discounts'];


            $product->save();
            DB::table('tb_product_pictures')->where('product_id',$product->id)->delete();
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
    public function destroy(Request $request){
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
            $model->is_hidden = $request->input('is_hidden') == 0?1:0;
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
