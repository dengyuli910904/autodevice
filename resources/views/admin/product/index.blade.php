<!-- 素材管理-图片管理-列表 -->
@extends('admin.layouts.app')
@section('content')
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 新闻管理 <span class="c-gray en">&gt;</span> 文章新闻 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c"> 日期范围：
				<input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin" class="input-text Wdate" style="width:120px;">
				-
				<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax" class="input-text Wdate" style="width:120px;">
				<input type="text" name="" id="" placeholder=" 图片名称" style="width:250px" class="input-text">
				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜新闻</button>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20"> 
				<span class="l">
				<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius">
				<i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
				<a class="btn btn-primary radius" onclick="picture_add('新增','{{ url('admin/news/article/create')}}' )" href="javascript:;">
					<i class="Hui-iconfont">&#xe600;</i> 新增</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="40"><input name="" type="checkbox" value=""></th>
							<th width="50">序号</th>
							<th width="200">产品名称</th>
							<th>产品简介</th>
							<th width="150">是否有库存</th>
							<th width="150">是否优惠</th>
							<th width="150">是否特价</th>
							<th width="150">更新时间</th>
							<th width="60">发布状态</th>
							<th width="100">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $key=>$p)
						<tr class="text-c">
							<td><input name="" type="checkbox" value="{{ $p->id }}"></td>
							<td>{{ $key+1 }}</td>
							<td>{{ $p->name}}</td>
							<td>
								{{ $p->intro }}
							</td>
							<td class="text-l">
								@if(!$p->is_store )
									<span class="label label-success radius">否</span>
								@else
									<span class="label label-defaunt radius">是</span>
								@endif
							</td>
							<td class="text-l">
								@if(!$p->is_sale )
									<span class="label label-success radius">否</span>
								@else
									<span class="label label-defaunt radius">是</span>
								@endif
							</td>
							<td class="text-l">
								@if(!$p->is_discounts )
									<span class="label label-success radius">否</span>
								@else
									<span class="label label-defaunt radius">是</span>
								@endif
							</td>
							<td>{{ $p->updated_at }}</td>
							<td class="td-status">
								@if(!$p->is_hidden )
									<span class="label label-success radius">显示</span>
								@else
									<span class="label label-defaunt radius">隐藏</span>
								@endif
							</td>
							<td class="td-manage">
								
								@if(!$p->is_hidden )
									<a style="text-decoration:none" onClick="picture_stop(this,'{{ $p->id }}','0','{{$p->is_hidden}}')" href="javascript:;" title="隐藏">
									<i class="Hui-iconfont">&#xe6de;</i>
								@else
									<a style="text-decoration:none" onClick="picture_start(this,'{{ $p->id }}','0','{{$p->is_hidden}}')" href="javascript:;" title="显示">
									<i class="Hui-iconfont">&#xe6dc;</i>
									</a>
								@endif


								 

								<a style="text-decoration:none" class="ml-5" onClick="picture_edit('编辑','{{ url('admin/news/article/edit') }}','{{ $p->id }}')" href="javascript:;" title="编辑">
									<i class="Hui-iconfont">&#xe6df;</i>
								</a> 

								<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'{{ $p->id }}')" href="javascript:;" title="删除">
									<i class="Hui-iconfont">&#xe6e2;</i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</article>
	</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{ asset('admin/lib/My97DatePicker/4.8/WdatePicker.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/lib/datatables/1.10.0/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/lib/laypage/1.2/laypage.js') }}"></script>
	<script type="text/javascript">
	
	$('.table-sort').dataTable({
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,7]}// 制定列不参与排序
		]
	});
	/*图片-添加*/
	function picture_add(title,url){
		var index = layer.open({
			type: 2,
			title: title,
			content: url
		});
		layer.full(index);
	}
	/*图片-查看*/
	function picture_show(title,url,id){
		var index = layer.open({
			type: 2,
			title: title,
			content: url
		});
		layer.full(index);
	}
	/*图片-审核*/
	// function picture_shenhe(obj,id){
	// 	layer.confirm('审核文章？', {
	// 		btn: ['通过','不通过'], 
	// 		shade: false
	// 	},
	// 	function(){
	// 		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="picture_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
	// 		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
	// 		$(obj).remove();
	// 		layer.msg('已发布', {icon:6,time:1000});
	// 	},
	// 	function(){
	// 		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="picture_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
	// 		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
	// 		$(obj).remove();
	//     	layer.msg('未通过', {icon:5,time:1000});
	// 	});	
	// }
	/*图片-下架*/
	function picture_stop(obj,id){
		layer.confirm('确认要下架吗？',function(index){
			$.ajax({
	              url: "/admin/material/pictures/handle",
	              type:'post',
	              data:{
	                   _method: 'put',
	                   id: id,
	                   is_hidden: 1
	              },
	              dataType: 'json',
	              success: function(data){
	                  if(data['code'] == 200){
	                  	$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="picture_start(this,id)" href="javascript:;" title="显示"><i class="Hui-iconfont">&#xe603;</i></a>');
						$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">隐藏</span>');
						$(obj).remove();
						layer.msg('操作成功!',{icon: 5,time:1000});
	                  }else{
	                  	layer.msg('操作失败，请刷新之后重试!',{icon:1,time:1000});
	                  }
	              }
            });
			
		});
	}

	/*图片-发布*/
	function picture_start(obj,id){
		layer.confirm('确认要发布吗？',function(index){
			$.ajax({
	              url: "/admin/material/pictures/handle",
	              type:'post',
	              data:{
	                   _method: 'put',
	                   id: id,
	                   is_hidden: 0
	              },
	              dataType: 'json',
	              success: function(data){
	                  if(data['code'] == 200){
	                  	$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="picture_stop(this,id)" href="javascript:;" title="隐藏"><i class="Hui-iconfont">&#xe6de;</i></a>');
						$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">显示</span>');
						$(obj).remove();
						layer.msg('操作成功!',{icon: 6,time:1000});
	                  }else{
	                  	layer.msg('操作失败，请刷新之后重试!',{icon:1,time:1000});
	                  }
	              }
            });
			
		});
	}
	/*图片-申请上线*/
	// function picture_shenqing(obj,id){
	// 	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	// 	$(obj).parents("tr").find(".td-manage").html("");
	// 	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
	// }

	/*图片-编辑*/
	function picture_edit(title,url,id){
		var index = layer.open({
			type: 2,
			title: title,
			content: url+'?id='+id,
		});
		layer.full(index);
	}
	/*图片-删除*/
	function picture_del(obj,id){
		layer.confirm('确认要删除吗？',function(index){
			$.ajax({
	              url: "/admin/news/article/delete",
	              type:'post',
	              data:{
	                   _method: 'delete',
	                   id : id
	              },
	              dataType: 'json',
	              success: function(data){
	                  if(data['code'] == 200){
	                  	$(obj).parents("tr").remove();
						layer.msg('已删除!',{icon:1,time:1000});
	                  }else{
	                  	layer.msg('删除失败，请刷新之后重试!',{icon:1,time:1000});
	                  }
	              }
            });
		});
	}
</script>
@endsection