<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>仓库员工注册页面</title>
</head>
<body>
    <h1 style="color:darkmagenta">仓库员工注册页面</h1>
    <!-- <b style="color:indianred">{{session('msg')}}</b> -->
    <form action="{{url('add/reg')}}" method="post">
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
            <!-- <tr>
                <td>用户密码</td>
                <td>
                    <input type="password" name="repwd" placeholder="确认密码">
                </td>
            </tr> -->
            <tr>
                <td>用户身份</td>
                <td>
                    <select name="priv" id="">
                        <option value="null">请选择</option>
                        <option value="1">库管主管</option>
                        <option value="2">库管员</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="注册">
                </td>
                <td>
                    <input type="reset" value="重置">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>