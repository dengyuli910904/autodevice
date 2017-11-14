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

//            if(!empty($data['cover'])){
//                $pic = explode(',',$data['cover']);
//                $pictures = [];
////                $product_pic = [];
//                foreach ($pic as $p){
//                    array_push($pictures,['id'=>UUID::generate(),'name' =>'','path' => $p]);
//                }
//                if(!empty($pictures)){
//                    $result = DB::table('tb_pictures')->insertGetId($pictures);
//                    var_dump($result);
//                }
//            }

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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
