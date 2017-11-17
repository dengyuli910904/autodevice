<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobs;
use Illuminate\Support\Facades\Redirect;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Jobs::get();
        return view('admin.jobs.index',['data'=>$list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobs.add');
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
        $job = Jobs::where('name',$data['name'])->first();
        if($job){
            return Redirect::back()->withInput()->withErrors('该职位已存在！');
        }
        $job = new Jobs();
        $job->name = $data['name'];
        $job->content = $data['editorValue'];
        $job->limit = $data['limit'];
        $result = $job->save();
        if($result){
            return Redirect::back();
        }else{
            return Redirect::back()->withInput()->withErrors('添加失败！');
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
        $job = Jobs::find($data['id']);
        if(!$job){
            return Redirect::back()->withInput()->withErrors('该记录不存在！');
        }
        return view('admin.jobs.edit',['data'=>$job]);
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
        $job = Jobs::find($data['id']);
        if(!$job){
            return Redirect::back()->withInput()->withErrors('该记录不存在！');
        }
        $job->name = $data['name'];
        $job->content = $data['editorValue'];
        $job->limit = $data['limit'];
        $result = $job->save();
        if($result){
            return Redirect::back();
        }else{
            return Redirect::back()->withInput()->withErrors('修改失败！');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destory(Request $request){
        $model = Jobs::find($request->input('id'));
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
        $job = Jobs::find($request->input('id'));
        if(!empty($job)){
            $job->is_hidden = $request->input('is_hidden') == 0?1:0;
            if($job->save()){
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
