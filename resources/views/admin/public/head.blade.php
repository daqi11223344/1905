<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.min.js"></script>
	<script src="/static/admin/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('/public/index')}}">首页</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        管理员<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                        <li><a href="{{url('/admin/create')}}">管理员添加</a></li>
                        <li class="divider"></li>
                        <li><a href="{{url('/admin/index')}}">管理员列表</a></li>
                    </ul>
            </li>
            <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        品牌<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                        <li><a href="{{url('/brand/create')}}">品牌添加</a></li>
                        <li class="divider"></li>
                        <li><a href="{{url('/brand/index')}}">品牌列表</a></li>
                    </ul>
            </li>
            <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        商品<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                        <li><a href="{{url('/goods/create')}}">商品添加</a></li>
                        <li class="divider"></li>
                        <li><a href="{{url('/goods/index')}}">商品列表</a></li>
                    </ul>
            </li>
            <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        商品分类<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                        <li><a href="{{url('/cate/create')}}">商品分类添加</a></li>
                        <li class="divider"></li>
                        <li><a href="{{url('/cate/index')}}">商品分类列表</a></li>
                    </ul>
            </li>
            <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    文章<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                        <li><a href="{{url('/word/create')}}">文章分类添加</a></li>
                        <li class="divider"></li>
                        <li><a href="{{url('/word/index')}}">文章分类列表</a></li>
                    </ul>
            </li>
            </ul>
        </div>
        </div>
    </nav>
</body>
</html>