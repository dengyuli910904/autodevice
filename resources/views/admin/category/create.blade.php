<!-- 添加分类 -->
@extends('admin.layouts.layer')
@section('styles')
    <link href="{{ asset('admin/lib/webuploader/0.1.5/webuploader.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-container">
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

        <form class="form form-horizontal" id="form-article-add" action="{{ url('type/store') }}" method="POST">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">父类型：</label>
                <div class="formControls col-xs-4 col-sm-5">
                    <input type="text" class="input-text" value="" placeholder="分类关键字" id="permission_text" >
                </div>
                <div class="formControls col-xs-4 col-sm-4">
                    <select name="pid" class="select input-text" required="required" id="permission_list">
                        <option value="0">请选择</option>
                        @foreach($data['pid'] as $pid)
                            <option value="{{ $pid['id'] }}"
                                    @if(old('pid', '') == $pid['id'])
                                    selected="selected"
                                    @endif
                            >{{ str_repeat(' - ', $pid['level']) . $pid['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">类型名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="类型名称" name="name" id="name">
                </div>
            </div>


            {{--<div class="row cl">--}}
                {{--<label class="form-label col-xs-4 col-sm-2">排序：</label>--}}
                {{--<div class="formControls col-xs-8 col-sm-9">--}}
                    {{--<input type="text" class="input-text"  value="0" name="order" id="order">--}}
                {{--</div>--}}
            {{--</div>--}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                    <!-- <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button> -->
                    <button class="btn btn-secondary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                    <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    {{--<script type="text/javascript" src="{{ asset('admin/lib/webuploader/0.1.5/webuploader.min.js') }}"></script>--}}

    <script type="text/javascript">
        $(function(){
            $('#permission_text').change(function(){
                var searchStr = $(this).val();
                if (searchStr) {
                    var flag = 0;
                    var options = $('#permission_list').children();
                    for (var i = 0, len = options.length; i < len; i++) {
                        if (!flag && $(options[i]).text().indexOf(searchStr) >= 0) {
                            flag = 1;
                            $(options[i]).attr('selected', 'selected');
                            break;
                        }
                    }
                    if (!flag) {
                        $('#permission_list option:first').attr('selected', 'selected');
                    }
                }
            });

        });


    </script>
@endsection