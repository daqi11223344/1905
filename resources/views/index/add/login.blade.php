<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>仓库员工登陆页面</title>
</head>
<body>
    <h1 style="color:darkmagenta">仓库员工登陆页面</h1>
    {{session('msg')}}
    <form action="{{url('add/logi')}}" method="post">
    @csrf
        <table>
            <tr>
                <td>用户昵称</td>
                <td>
                    <input type="name" name="admin_name" placeholder="用户名">
                </td>
            </tr>
            <tr>
                <td>用户密码</td>
                <td>
                    <input type="password" name="pwd" placeholder="密码">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="登陆">
                </td>
                <td>
                    <input type="reset" value="重置">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>