<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>首页</title>
</head>
<body>
    @if (session('admin')->priv==2)
        <h1 style="color:darkseagreen">您是普通库管</h1>
        <a href="{{url('/adds/index')}}" style="color:darkslateblue">货物管理</a>
        <a href="" style="color:darkslateblue">出入库管理</a>
    @else
        <h1 style="color:darkseagreen">您是库管主管</h1>
        <a href="{{url('/adds/show')}}" style="color:darkslateblue">用户管理</a>
        <a href="{{url('/adds/index')}}" style="color:darkslateblue">货物管理</a>
        <a href="" style="color:darkslateblue">出入库管理</a>
    @endif
</body>
</html>