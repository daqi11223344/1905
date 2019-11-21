<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cate;
use App\Brand;


class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = config('app.pageSize');

         // 搜索商品名称
         $name = request()->name;
         $where = [];
         if($name){
             $where[] = ['goods_name','like',"%$name%"];
         }
         // 搜索商品价格
         $price = request()->price;
         if($price){
             $where[] = ['goods_price','like',$price];
         }
 
         $data = Goods::where($where)->paginate($pageSize);
         $query = request()->all();
        
        $data = Goods::where($where)
              ->leftjoin('category','goods.cate_id','=','category.cate_id')
              ->leftjoin('brand','goods.brand_id','=','brand.brand_id')
              ->paginate($pageSize);
        return view('admin.goods.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Cate::get();
        $cate = goods($cate);
        $brand = Brand::get();

        return view('admin.goods.create',['cate'=>$cate,'brand'=>$brand]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $validator = \Validator::make($data, [
            'goods_name' => 'required|unique:goods|max:20|alphaDash',
            'goods_price' => 'required',
        ],[
            'goods_name.required'=>'商品名称必填',
            'goods_name.unique'=>'商品名称已存在php',
            'goods_name.max'=>'商品名称最多不能超过20个字',
            'goods_name.alphaDash'=>'商品名称只能包含字母、数字、破折号和下划线',
            'goods_price.required'=>'商品价格必填',
        ]);
        if ($validator->fails()) {
            return redirect('goods/create')
            ->withErrors($validator)
            ->withInput();
        }

        // 货号
    	if(!$data['goods_sn']){
    		$data['goods_sn'] = createGoodsSn();
        }
        
        // 文件上传
        if($request->hasFile('goods_photo')){
            $data['goods_photo'] = $this->upload('goods_photo');
        }

        // 多文件上传
        $arr = request()->file('goods_imgs');
        foreach($arr as $k=>$v){
            $data['imgs'][] = $v->store('upload');
        }
        $data['goods_imgs'] = implode("|",$data['imgs']);
        unset($data['imgs']);
            // dd($data);

        $goods = Goods::create($data);
        if($goods->goods_id){
            return redirect('/goods/index');
        }

    }

    public function upload($filename){
        if(request()->file($filename)->isValid()){
            $photo = request()->file($filename);
            $store_result = $photo->store('photo');
            return $store_result;
        }
        exit('为获取到上传文件或过程出错');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$id){
            abort(404);
        }

        $data = Goods::where('goods_id',$id)->first();
        $cate = Cate::get();
        $cate = goods($cate);
        $brand = Brand::get();

        return view('admin.goods.edit',['data'=>$data,'brand'=>$brand,'cate'=>$cate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 验证
        // 接值
        $post = $request->except('_token');
        // 判断有无文件上传
        if($request->hasFile('goods_photo')){
            $post['goods_photo'] = $this->upload('goods_photo');
        }
        // 更新数据库
         Goods::where('goods_id',$id)->update($post);
        return redirect('/goods/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$id){
            abort(404);
        }

        $delete = Goods::where('goods_id',$id)->delete();

        if($delete){
            return redirect('/goods/index');
        }
    }

    // 唯一性验证
    public function checkOnly(){
        $goods_name = request()->goods_name;
        
        $count = Goods::where('goods_name',$goods_name)->count();
        echo $count;
        // if($count){
        //     return redirect('/goods/index');
        // }
    }
}
