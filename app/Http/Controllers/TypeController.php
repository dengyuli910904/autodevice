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
