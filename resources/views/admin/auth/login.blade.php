<!-- <form method="post" action="/admin/login">
    <p>邮箱：<input type="email" name="email" /></p>
    <p>密码：<input type="password" name="password" /></p>
    <p><input type="submit" value="登录"></p>
</form> -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Proton - Admin Template</title>      
        <link href="{{ asset('admin/static/h-ui/css/H-ui.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/static/h-ui/css/H-ui.login.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/static/h-ui.admin/css/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css') }}" rel="stylesheet" type="text/css" />
        <style type="text/css">
        body {  margin: 0 auto; padding: 0; text-align: center; }
        form{ max-width: 500px; margin:0 auto; margin-top: 300px; border: 1px solid #eee; padding:30px 10px;background: #d6d5d5;}
        .header { font-weight: 800; font-size: 30px;}
        </style>
    </head>
</head>

<body>
    <div class="loginWraper">
	<div id="loginform" class="loginBox">
		<form class="form form-horizontal" action="/admin/login" method="post">
			<div class="header">
            	HNS后台管理
            </div>
			<div class="row cl">
				<label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
				<div class="formControls col-xs-8">
					<input id="" name="email" type="text" placeholder="账户" class="input-text size-L">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
				<div class="formControls col-xs-8">
					<input id="" name="password" type="password" placeholder="密码" class="input-text size-L">
				</div>
			</div>
			<!-- <div class="row cl">
				<div class="formControls col-xs-8 col-xs-offset-3">
					<input class="input-text size-L" type="text" placeholder="验证码" onblur="if(this.value==''){this.value='验证码:'}" onclick="if(this.value=='验证码:'){this.value='';}" value="验证码:" style="width:150px;">
					<img src="images/VerifyCode.aspx.png">
					<a id="kanbuq" href="javascript:;">看不清，换一张</a>
				</div>
			</div> -->
			<!-- <div class="row cl">
				<div class="formControls col-xs-8 col-xs-offset-3">
					<label for="online">
						<input type="checkbox" name="online" id="online" value="">
						使我保持登录状态</label>
				</div>
			</div> -->
			<div class="row cl">
				<div class="formControls col-xs-8 col-xs-offset-3">
					<input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
					<input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
				</div>
			</div>
		</form>
	</div>
</div>
    <script type="text/javascript" src="{{ asset('admin/lib/jquery/1.9.1/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/static/h-ui/js/H-ui.js') }}"></script>
    
</body>
</html>