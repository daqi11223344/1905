<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>货物管理添加页面</title>
</head>
<body>
<h1 style="color:darkorange">货物管理添加页面</h1>
    <form action="{{url('/adds/store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <table>
            <tr>
                <td>货物名称</td>
                <td>
                    <input type="name" name="h_name" placeholder="请输入货物名称......">
                </td>
            </tr>
            <tr>
                <td>货物图</td>
                <td>
                    <input type="file" name="h_img">
                </td>
            </tr>
            <tr>
                <td>当前库存</td>
                <td>
                    <input type="text" name="h_num" pladeholder="请输入当前库存......">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="添加">
                </td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>