<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
@include('admin.profile._meta')
@yield('styles')

</head>
<body>
@yield('content')

<!--_footer 作为公共模版分离出去-->
@include('admin.profile._footer')

<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
@yield('scripts')
<!--/请在上方写此页面业务相关的脚本-->
 
</body>
</html>