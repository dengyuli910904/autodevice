<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Type::get();
        return view('admin.category.index',['data'=>$list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['pid'] = Type::where('level', '<', 2)->orderBy('tree', 'asc')->get(['id', 'name', 'level']);
        return view('admin.category.create', ['data' => $data]);
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
        $this->validate($request, [
            'pid' => 'required|integer',
            'name' => 'required|string',
//            'ptype' => 'required|in:0,1,2,3'
        ]);
        $type = Type::where('name',$data['name'])->first();
        if(!$type){
            $level = 0;
            $tree = '';
            if ($data['pid'] > 0) {
                $pid = type::find($data['pid']);
                if ($pid) {
                    if(((integer)$pid['level']-1) > ENV('TYPE_LEVEL_LIMIT')){
                        return redirect()->back()->withInput()->withErrors('目前限制产品类型最大层级是'.ENV('TYPE_LEVEL_LIMIT').'级');
                    }
                    $level = $pid['level'] + 1;
                    $tree = $pid['tree'];
                }
            }
            $type = new Type();
            $type->pid = $data['pid'];
            $type->name = $data['name'];
            $type->description = !empty($data['description']) ? $data['description'] : '';
            $type->level = $level;
            $type->tree = $tree;
            $type->save();
            $type->tree = $data['pid'] > 0 ? $tree . '|[' . $type->id . ']' : '[' . $type->id . ']';
            $type->save();
            return redirect()->back();
        }
        return redirect()->back()->withInput()->withErrors('已存在');
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
        $type = Type::find($id);
        if($type)
        {
            $data = [];
            $data['type'] = $type;
            $data['pid'] = Type::where('level', '<', 2)->orderBy('tree', 'asc')->get(['id', 'name', 'level']);
            if($type->level != 0){
                foreach ($data['pid'] as $p){
                    if($type->pid == $p->id){

                    }
                }
            }
            return view('admin.category.edit',['data'=>$data]);
        }else{
            return redirect()->back()->withInput()->withErrors('记录不存在');
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
        $type = Type::find($data['id']);
        if($type)
        {
            $level = 0;
            $tree = '';
            if ($data['pid'] > 0) {
                $pid = type::find($data['pid']);
                if ($pid) {
                    $level = $pid['level'] + 1;
                    $tree = $pid['tree'];
                }
            }
//            $type = new Type();
            $type->pid = $data['pid'];
            $type->name = $data['name'];
            $type->description = !empty($data['description']) ? $data['description'] : '';
            $type->level = $level;
            $type->tree = $tree;
            $type->save();
            $type->tree = $data['pid'] > 0 ? $tree . '|[' . $type->id . ']' : '[' . $type->id . ']';
            $type->save();
        }else{
            return redirect()->back()->withInput()->withErrors('记录不存在');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destory(Request $request){
        $model = Type::find($request->input('id'));
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
        $model = Type::find($request->input('id'));
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
