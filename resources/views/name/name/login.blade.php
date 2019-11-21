<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登陆</title>
</head>
<body>
    <h1 style="color:darkgreen" align="center">欢迎使用hAdmin</h1>
    <form action="{{url('/name/create')}}" method="post">
    @csrf
        <table align="center">
            <tr>
            <p align="center" style="color:orangered">{{$links??''}}</p>
                <td>用户名</td>
                <td>
                    <input type="name" name="name" placeholder="请输入用户名">
                </td>
            </tr>
            <tr>
                <td>密码</td>
                <td>
                    <input type="password" name="password" placeholder="请输入密码">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="登陆">
                </td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>