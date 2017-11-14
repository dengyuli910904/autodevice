<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
@include('admin.profile._meta')
@yield('styles')

</head>
<body>
<!--_header 作为公共模版分离出去-->
@include('admin.profile._header')
<!--/_header 作为公共模版分离出去-->

<!--_menu 作为公共模版分离出去-->
@include('admin.profile._menu')
<!--/_menu 作为公共模版分离出去-->

<section class="Hui-article-box">
    
        @yield('content')
        


</section>

<!--_footer 作为公共模版分离出去-->
@include('admin.profile._footer')

<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
@yield('scripts')
<!--/请在上方写此页面业务相关的脚本-->

<!--此乃百度统计代码，请自行删除-->
<script>
// var _hmt = _hmt || [];
// (function() {
//   var hm = document.createElement("script");
//   hm.src = "https://hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
//   var s = document.getElementsByTagName("script")[0]; 
//   s.parentNode.insertBefore(hm, s);
// })();
 </script>
<!--/此乃百度统计代码，请自行删除-->
</body>
</html>