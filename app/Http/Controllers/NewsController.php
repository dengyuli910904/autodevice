<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Redirect;
use UUID;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = News::get();
        return view('admin.news.news',['data'=>$list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.news_add');
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
        $news = News::where('title',$data['title'])->where('categories',$data['categories'])->first();
        if(!$news){
            $news = new News();
            $news->id = UUID::generate();
            $news->title = $data['title'];
            $news->intro = $data['intro'];
            $news->description = $data['editorValue'];
            $result = $news->save();
            if($result){
                return Redirect::back();
            }else{
                return Redirect::back()->withInput()->withErrors('添加失败！');
            }
        }else{
            return Redirect::back()->withInput()->withErrors('该新闻已经存在！');
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
        $news = News::find($data['id']);
        if(!$news){
            return Redirect::back()->withInput()->withErrors('该新闻记录不存在！');
        }else{
            return view('admin.news.news_edit',['data'=>$news]);
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
        $news = News::find($data['id']);
        if($news){
            $news->title = $data['title'];
            $news->intro = $data['intro'];
            $news->description = $data['editorValue'];
            $result = $news->save();
            if($result){
                return Redirect::back();
            }else{
                return Redirect::back()->withInput()->withErrors('修改失败！');
            }
        }else{
            return Redirect::back()->withInput()->withErrors('找不到该新闻记录！');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * 删除新闻
     */
    public function destroy(Request $request){
        $model = News::find($request->input('id'));
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
        $new = News::find($request->input('id'));
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
