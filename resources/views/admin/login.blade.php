

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
    </head>
</head>

<body>
    <div class="container-fluid content">
        <div class="row">
            <div id="content" class="col-sm-12 full">
                <div class="row">
                    <div class="login-box">
                    
                        <div class="header">
                        HNS后台管理
                        </div>
                        <form class="form-horizontal login" action="index.php/bannerlist" method="post">
                        
                            <fieldset class="col-sm-12">
                                <div class="form-group">
                                    <div class="controls row">
                                        <div class="input-group col-sm-12"> 
                                            <input type="text" class="form-control" id="username" placeholder="登录名或者邮箱"/>
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        </div>  
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <div class="controls row">
                                        <div class="input-group col-sm-12"> 
                                            <input type="password" class="form-control" id="password" placeholder="密码"/>
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        </div>  
                                    </div>
                                </div>

                                <div class="row">
                            
                                    <button type="submit" class="btn btn-lg btn-primary col-xs-12">登录</button>
                            
                                </div>
                                
                            </fieldset> 

                        </form>
                    
                      <!--   <a class="pull-left" href="page-login.html#">Forgot Password?</a>
                        <a class="pull-right" href="page-register.html">Sign Up!</a> -->
                    
                        <div class="clearfix"></div>                
                        
                    </div>
                </div><!--/row-->
        
            </div>  
            
        </div><!--/row-->       
    
        
    </div><!--/container-->
    <script type="text/javascript" src="{{ asset('admin/lib/jquery/1.9.1/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/static/h-ui/js/H-ui.js') }}"></script>
    
</body>
</html>