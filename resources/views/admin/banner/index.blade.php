
@extends('layouts.master')

@section('title','banner管理')
@section('banner-title','banner管理')
@section('banner-tips','banner列表')

@section('header')
    @parent
@endsection

@section('left-menu')
     @parent
@endsection


@section('content')
            
            
            <div class="row">  
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-table red"></i><span class="break"></span><strong>banner管理</strong></h2>
                              <div class="panel-actions">
                                <!-- <a href="table.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                                <a href="table.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a> -->
                                <!-- <a href="{{ url('banner/add')}}"><i class="fa fa-times"></i></a> -->
                                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ url('banner/add')}}'">添加</button>
                              </div> 


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
                        <div class="panel-body">
                            <table class="table table-bordered table-striped table-condensed table-hover">
                                  <thead>
                                      <tr>
                                         <th width="20%">标题</th>
                                         <th width="30%">描述</th>
                                         <th width="20%">图片</th>
                                         <th width="10%">状态</th>
                                         <th width="20%">操作</th>                                          
                                      </tr>
                                  </thead>   
                                  <tbody>
                                    @foreach( $data as $val)
                                    <tr>
                                        <td>{{$val->bannertitle}}</td>
                                        <td>{{$val->description}}</td>
                                        <td>
                                        <!-- <img src="{{ URL::asset('img/banner/1.jpg')}}" class="img-thumbnail"> -->
                                        <img src="{{ $val->url.'/'.$val->picturepath.'/'.$val->picturetitle}}" class="img-thumbnail">
                                        </td>
                                        <td>{{$val->isfalse === 1?'启用':'禁用'}}</td>
                                        <td>
                                            <form action="{{ url('banner/handle')}}" method="post" style="display: inline;"> 
                                              <input type="hidden" name="id" value="{{$val->id}}"> 
                                              <input type="hidden" name="isfalse" value="{{$val->isfalse}}">
                                              @if($val->isfalse)
                                              <button type="submit" class="btn btn-default">禁用</button>
                                              @else
                                              <button type="submit" class="btn btn-success">启用</button>
                                              @endif
                                            </form>
                                            <button type="button" class="btn btn-primary" onclick="window.location.href='{{ url('banner/edit?id='.$val->id)}}'">编辑</button>
                                            <button type="button" class="btn btn-danger" onclick="window.location.href='{{ url('banner/delete?id='.$val->id)}}'">删除</button>
                                        </td>                                       
                                    </tr>
                                    @endforeach                                                    
                                  </tbody>
                             </table>
                             {{ $data->links() }}  
                             <!-- <ul class="pagination">
                                <li><a href="table.html#">上一页</a></li>
                                <li class="active">
                                  <a href="table.html#">1</a>
                                </li>
                                <li><a href="table.html#">2</a></li>
                                <li><a href="table.html#">3</a></li>
                                <li><a href="table.html#">4</a></li>
                                <li><a href="table.html#">5</a></li>
                                <li><a href="table.html#">下一页</a></li>
                              </ul>      -->
                        </div>
                    </div>
                </div><!--/col-->
            </div>    
                    
        </div>
      <script type="text/javascript">
          // $.ajax({
          //   url: "{{ url('banner/handle')}}",
          //   type:'Post',
          //   data:{
          //     id:1,
          //     isfalse:0
          //   },
          //   success: function(data){
          //       alert('dfdfd');
          //   }
          // });
      </script>
@endsection
