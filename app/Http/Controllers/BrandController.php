<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Type;
//use App\Models\Bra
use Illuminate\Support\Facades\Redirect;
use UUID;
use DB;
use App\Models\Brand_type;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Brand::get();
        return view('admin.brand.index',['data'=>$list]);
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
        return view('admin.brand.create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request;
        $data = $request->all();
        $this->validate($request, [
//            'pid' => 'required|integer',
            'name' => 'required|string',
            'cover' =>'required|string',
//            'pid' => 'required|in:0,1,2,3'
        ]);
        $brand = Brand::where('name',$data['name'])->first();
        if(!$brand) {
            $brand = new Brand();
            $id = (string)UUID::generate();
            $brand->id =$id;// UUID::generate();
            $brand->name = $data['name'];
            $brand->description = $data['editorValue'];
            $brand->logo = $data['cover'];
            $result = $brand->save();
            //TODO::此处应改成用事务处理
            if(!empty($data['pid'])){
                $pid = [];
                foreach ($data['pid'] as $p){
                    array_push($pid,['id'=>UUID::generate(),'brand_id'=>$id,'type_id'=>$p]);
                }
                $brandtype = DB::table('tb_brand_type')->insert($pid);
            }
            return Redirect::back();//->withErrors('该品牌已经存在');
        }else{
            return Redirect::back()->withInput()->withErrors('该品牌已经存在');

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
        $brand = Brand::find($id);
        if($brand){
            $data = [];
            $data['brand'] = $brand;
            $type = Type::where('is_hidden',0)->orderBy('tree', 'asc')->get(['id', 'name', 'level','pid']);
            $brandtype = Brand_type::where('brand_id',$id)->get();
            $root = [];
            foreach ($type as $val){
                if($val->level == 0){
                    $val->is_choose = false;
                    foreach ($brandtype as $bt){
                        if($bt->type_id == $val->id){
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
                        foreach ($brandtype as $bt){
                            if($bt->type_id == $val->id){
                                $val->is_choose = true;
                            }
                        }
                        array_push($child,$val);
                    }
                }
                array_add($r,'child',$child);
            }
            $data['pid'] = $root;
            return view('admin.brand.edit',['data'=>$data]);
        }else{
            return Redirect::back()->withInput()->withErrors('该记录不存在');
        }

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
        $brand = Brand::find($data['id']);
        if($brand){
            $brand->name = $data['name'];
            $brand->description = $data['editorValue'];
            $brand->logo = $data['cover'];
            $result = $brand->save();
            //TODO::此处应改成用事务处理
            if(!empty($data['pid'])){
                $pid = [];
                foreach ($data['pid'] as $p){
                    array_push($pid,['id'=>UUID::generate(),'brand_id'=>$id,'type_id'=>$p]);
                }
                $brandtype = DB::table('tb_brand_type')->insert($pid);
            }
            return Redirect::back();//->withErrors('该品牌已经存在');
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
        $model = Brand::find($request->input('id'));
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
        $model = Brand::find($request->input('id'));
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
