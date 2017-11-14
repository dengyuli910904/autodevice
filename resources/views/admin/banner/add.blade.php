
@extends('layouts.master')

@section('title','banner管理')
@section('banner-title','banner管理')
@section('banner-tips','banner编辑')

@section('header')
    @parent
@endsection

@section('left-menu')
     @parent
@endsection


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h2><i class="fa fa-indent red"></i><strong>banner编辑</strong></h2>
    </div>
    <div class="col-lg-12">
       @if (count($errors) > 0)
        <div class="alert alert-danger">
          <strong>提示!</strong> 您的操作失败<br><br>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>
    <form action="{{ url('banner/doadd')}}" method="post" enctype="multipart/form-data" class="form-horizontal ">
    <div class="panel-body">
        
            <div class="form-group">
                <label class="col-md-3 control-label" for="text-input">标题</label>
                <div class="col-md-9">
                    <input type="text" id="bannertitle" name="bannertitle" class="form-control" placeholder="请输入banner标题">
                    <!-- <span class="help-block">This is a help text</span> -->
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="textarea-input">描述</label>
                <div class="col-md-9">
                    <textarea id="description" name="description" rows="9" class="form-control" placeholder="Content.."></textarea>
                </div>
            </div>
            <div class="form-group">

                <label class="col-md-3 control-label" for="textarea-input">图片</label>
                <div class="col-md-9">
                    <img src="" class="img-thumbnail">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-3 control-label">是否启用</label>
                <div class="col-md-9">
                    <label class="switch switch-success">
                      <input type="checkbox" class="switch-input" checked="">
                      <span class="switch-label" data-on="On" data-off="Off"></span>
                      <span class="switch-handle"></span>
                    </label>
                </div>
            </div>
            <input type="hidden" id="picturetitle" value="" name="picturetitle">
            <input type="hidden" id="pictureserver_id" value="" name="pictureserver_id">
            <input type="hidden" id="picturepath" value="" name="picturepath">
            <input type="hidden" id="isfalse" value="0" name="isfalse">
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-dot-circle-o"></i> 提交</button>
        <!-- <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> 重置</button> -->
    </div> 
    </form> 
</div>
@endsection
