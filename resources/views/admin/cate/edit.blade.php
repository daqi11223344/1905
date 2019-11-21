<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <title>商品分类编辑</title>
</head>
<body>
@include('admin/public/head')
    <h1>商品分类编辑</h1>
<form action="{{url('cate/update/'.$data->cate_id)}}" method="post" >
@csrf
<div class="form-group has-warning">
                <label class="col-sm-2 control-label" for="lastname">分类名称</label>
                <div class="col-sm-10">
                    <input type="text" name="cate_name" value="{{$data->cate_name}}" class="form-control" id="firstname" placeholder="请输入分类名称">
                    <b style="color:red">@php echo $errors->first('cate_name');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">顶级分类</label>
                <select name="parent_id" id="">
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
                <label for="lastname" class="col-sm-2 control-label">是否显示分类</label>
                    @if ($data->is_show==1)
                        <label class="radio-inline">
                                <input type="radio" name="is_show"  value="1" checked/>是
                        </label>
                        <label class="radio-inline">
                                <input type="radio" name="is_show"  value="0" />否
                        </label>
                    @else
                        <label class="radio-inline">
                                <input type="radio" name="is_show"  value="1" />是
                        </label>
                        <label class="radio-inline">
                                <input type="radio" name="is_show"  value="0" checked/>否
                        </label>
                    @endif
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">导航分类</label>
                @if($data->is_nav_show==1)   
                    <label class="radio-inline">
                                <input type="radio" name="is_nav_show"  value="1" checked/>是
                    </label>
                    <label class="radio-inline">
                                <input type="radio" name="is_nav_show"  value="0" />否
                    </label>
                @else
                    <label class="radio-inline">
                                <input type="radio" name="is_nav_show"  value="1" checked/>是
                    </label>
                    <label class="radio-inline">
                                <input type="radio" name="is_nav_show"  value="0" />否
                    </label>
                @endif
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">关键词</label>
                <div class="col-sm-10">
                    <input type="text" name="keywords" value="{{$data->keywords}}" class="form-control" id="lastname" placeholder="请输入关键词">
                    <b style="color:red">@php echo $errors->first('keywords');@endphp</b>
                </div>
            </div>
            <div class="form-group has-error">
                <label for="lastname" class="col-sm-2 control-label">描述</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="desc" rows="3" placeholder="请进行分类描述"> {{$data->desc}} </textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">编辑</button>
                </div>
            </div>
		</form>
</body>
</html>