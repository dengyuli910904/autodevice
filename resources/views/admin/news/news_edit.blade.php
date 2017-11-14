<!-- 素材管理-图片管理-列表 -->
@extends('admin.layouts.layer')
@section('styles')
@endsection
@section('content')
	<div class="page-container">
	<form class="form form-horizontal" id="form-article-add" action="{{ url('news/update') }}" method="POST">
        <input type="hidden" value="PUT" name="_method">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{ $data->title }}" placeholder="title" id="" name="title">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">摘要：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="intro" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！">{{ $data->intro}}</textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>新闻类型：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <select name="categories" class="input-text">
                    <option value="1" @if($data->categories == 1) check="checked"@endif>企业新闻</option>
                    <option value="2" @if($data->categories == 2) check="checked"@endif>常见问题</option>
                </select>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">详细内容：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script id="editor" value="{{ $data->editor}}" type="text/plain" style="width:100%;height:400px;"></script>
            </div>
        </div>

        <input type="hidden" name="id" id="id" value="{{ $data->id}}">
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<!-- <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button> -->
				<button class="btn btn-secondary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
 </div>
 <input type="hidden" id="content" value="{{$data->description}}">
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('admin/lib/ueditor/1.4.3/ueditor.config.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/lib/ueditor/1.4.3/ueditor.all.js') }}"> </script>
    <script type="text/javascript" src="{{ asset('admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js') }}"></script>
<script type="text/javascript">
$(function(){
    var ue = UE.getEditor('editor');
    ue.ready(function(){
        //因为Laravel有防csrf防伪造攻击的处理所以加上此行
        ue.execCommand('serverparam','_token','{{ csrf_token() }}');
        ue.setContent($('#content').val());
    });
});
</script>
@endsection