<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepage;
use Illuminate\Support\Facades\Redirect;
use UUID;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Homepage::get();
        return view('admin.homepages.index',['data'=>$list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.homepages.create');
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
        if($data['type'] != 1){
            $page = Homepage::where('type',$data['type'])->where('ids',$data['id'])->first();
            if($page){
                return Redirect::back()->withInput()->withErrors('该记录已存在！');
            }
        }
        $page = new Homepage();
        $page->id = UUID::generate();
        $page->ids = $data['ids'];
        $page->type = $data['type'];
        $page->cover = $data['cover'];
        $page->url = $data['url'];
        $page->order = $data['order'];
        $result = $page->save();
        if($result){
            return Redirect::back();
        }else{
            return Redirect::back()->withInput()->withErrors('保存失败！');
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
        $data = $request->all();
        $page = Homepage::find($data['id']);
        if(!$page){
            return Redirect::back()->withInput()->withErrors('该记录不存在！');
        }else{
            return view('admin.homepages.edit',['data'=>$page]);
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
        $page = Homepage::find($data['id']);
        if(!$page){
            return Redirect::back()->withInput()->withErrors('该记录不存在！');
        }else{
            $page->ids = $data['ids'];
            $page->type = $data['type'];
            $page->cover = $data['cover'];
            $page->url = $data['url'];
            $page->order = $data['order'];
            $result = $page->save();
            if($result){
                return Redirect::back();
            }else{
                return Redirect::back()->withInput()->withErrors('修改失败！');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        $model = Homepage::find($request->input('id'));
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
        $new = Homepage::find($request->input('id'));
        if(!empty($new)){
            $new->is_hidden = $request->input('is_hidden') == 0?1:0;
            if($new->save()){
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
