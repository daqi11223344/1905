<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <title>添加商品列表</title>
</head>
<body>
@include('admin/public/head')
    <h1>添加商品</h1>
        <form action="{{url('/goods/update',$data->goods_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
            <!-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif -->
        @csrf
            <div class="form-group has-success">
                <label class="col-sm-2 control-label" for="inputSuccess">商品名称</label>
                <div class="col-sm-10">
                    <input type="text" name="goods_name" value="{{$data->goods_name}}" class="form-control" id="firstname" placeholder="请输入品牌名称">
                    <b style="color:red">@php echo $errors->first('goods_name');@endphp</b>
                </div>
            </div>
            <div class="form-group has-success">
                <label class="col-sm-2 control-label" for="inputSuccess">商品货号</label>
                <div class="col-sm-10">
                    <input type="text" name="goods_sn" value="{{$data->goods_sn}}" class="form-control" id="firstname">
                    <b style="color:red">@php echo $errors->first('goods_sn');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">所属分类</label>
                <select name="cate_id" id="">
							<option value="">请选择</option>
							@foreach ($cate as $k=>$v)
								<option value="{{$v->cate_id}}">@php 
                                    echo str_repeat('*',$v->level);
                                    @endphp
                                    {{$v->cate_name}}
                                </option>
							@endforeach
						</select>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">所属品牌</label>
                <select name="brand_id" id="">
							<option value="">请选择</option>
							@foreach ($cate as $k=>$v)
								<option value="{{$v->cate_id}}">@php 
                                    echo str_repeat('*',$v->level);
                                    @endphp
                                    {{$v->brand_name}}
                                </option>
							@endforeach
						</select>
            </div>
            <div class="form-group has-warning">
                @if($data->is_on_sale==1)
                    <label for="lastname" class="col-sm-2 control-label">是否上架</label>
                    <label class="radio-inline">
                                <input type="radio" name="is_on_sale"  value="1" checked/>是
                    </label>
                    <label class="radio-inline">
                                <input type="radio" name="is_on_sale"  value="0" />否
                    </label>
                @else
                    <label for="lastname" class="col-sm-2 control-label">是否上架</label>
                    <label class="radio-inline">
                                <input type="radio" name="is_on_sale"  value="1" />是
                    </label>
                    <label class="radio-inline">
                                <input type="radio" name="is_on_sale"  value="0" checked/>否
                    </label>
                @endif
            </div>
            <div class="form-group has-warning">
                @if($data->is_on_sale==1)
                    <label for="lastname" class="col-sm-2 control-label">是否热销</label>
                    <label class="radio-inline">
                                <input type="radio" name="is_hot"  value="1" checked/>是
                    </label>
                    <label class="radio-inline">
                                <input type="radio" name="is_hot"  value="0" />否
                    </label>
                @else
                <label for="lastname" class="col-sm-2 control-label">是否热销</label>
                    <label class="radio-inline">
                                <input type="radio" name="is_hot"  value="1" />是
                    </label>
                    <label class="radio-inline">
                                <input type="radio" name="is_hot"  value="0" checked/>否
                    </label>
                @endif
            </div>
            <div class="form-group has-warning">
                @if($data->is_on_sale==1)
                    <label for="lastname" class="col-sm-2 control-label">是否新品</label>
                    <label class="radio-inline">
                                <input type="radio" name="is_new"  value="1" checked/>是
                    </label>
                    <label class="radio-inline">
                                <input type="radio" name="is_new"  value="0" />否
                    </label>
                @else
                    <label for="lastname" class="col-sm-2 control-label">是否新品</label>
                    <label class="radio-inline">
                                <input type="radio" name="is_new"  value="1" />是
                    </label>
                    <label class="radio-inline">
                                <input type="radio" name="is_new"  value="0" checked/>否
                    </label>
                @endif
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">商品价格</label>
                <div class="col-sm-10">
                    <input type="text" name="goods_price" value="{{$data->goods_price}}" class="form-control" id="lastname" placeholder="请输入品牌网址">
                    <b style="color:red">@php echo $errors->first('goods_price');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">商品照片</label>
                <div class="col-sm-10">
                <img class="img-circle" src="{{env('UPLOAD_URL')}}{{$data->goods_photo}}" width="100">
                    <input type="file" name="goods_photo" class="form-control" id="lastname">
                </div>
            </div>
            <div class="form-group has-error">
                <label for="lastname" class="col-sm-2 control-label">商品描述</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="goods_desc" rows="3" placeholder="请进行商品描述">{{$data->goods_desc}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">修改</button>
                </div>
            </div>
    </form>
</body>
</html>