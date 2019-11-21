<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户管理表单</title>
</head>
<body>
    <h1 style="color:firebrick">用户管理表单</h1>
    <table border="1px">
        <tr>
            <td>用户id</td>
            <td>用户名称</td>
            <td>用户身份</td>
            <td>操作</td>
        </tr>
    @foreach($show as $v)
        <tr>
            <td>{{$v->admin_id}}</td>
            <td>{{$v->admin_name}}</td>
            <td>@if ($v->priv==1)库管主管@endif @if ($v->priv==2)库管员@endif</td>
            <td>
                <a href="">禁用</a>||
                <a href="">升级为主管</a>
            </td>
        </tr>
    @endforeach
    </table>
</body>
</html>