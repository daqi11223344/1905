<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;

class CartController extends Controller
{
    public function cart(){
        if(!Auth::user()){
           return redirect('login/login');
        }
        $id = Auth::id();
        $where = [
            ['id','=',$id],
            ['is_del','=',1]
        ];
        // dd($where);
        $data = Cart::
            join('goods','goods.goods_id','=','cart.goods_id')
            ->where($where)
            ->get();
            // dd($data);
        return view('index.login.cart',['data'=>$data]);
    }

    // 修改购物车数量
    public function changeNum(){
        $goods_id = request()->input('goods_id');
        $buy_number = request()->input('buy_number');
        // dd($goods_id);
        $this->changeNumDb($goods_id,$buy_number);
    }

    // 修改购物车数量
    public function changeNumDb($goods_id,$buy_number){
        $id = Auth::id();
        // dd($id);
        $where = [
            ['goods_id','=',$goods_id],
            ['id','=',$id],
            ['is_del','=',1]
        ];
        $arr = ['buy_number'=>$buy_number];
        $goods_num = Goods::where('goods_id','=',$goods_id)->value('goods_num');
        if($buy_number>$goods_num){
            $res = Cart::where($where)->update(['buy_number'=>$goods_num]);
        }else{
            $res = Cart::where($where)->update($arr);
        }
        if(!empty($res)){
            echo json_encode(['code'=>'1','data'=>'更改数量成功']);
        }
    }

    // 获取小计
    public function getTotal(){
        $goods_id = request()->input('goods_id');
        // dd($goods_id);
        // $where = [
        //     ['goods_id','=',$goods_id]
        // ];
        // $goods_price = Goods::where($where)->value("goods_price");
        $id = Auth::id();
        $cartWhere = [
            ['goods_id','=',$goods_id],
            ['id','=',$id],
            ['is_del','=',1]
        ];
        $data = Cart::where($cartWhere)->first();
        $res = $data['add_price']*$data['buy_number'];
        echo $res;
    }

    // 获取总价
    public function getCount(){
        $goods_id = request()->input('goods_id');
        $id = Auth::id();
        $goods_id=explode(',',$goods_id);
        // dd($goods_id);
        $where = [
            ['id','=',$id],
            ['is_del','=',1]
        ];
        $info = Cart::where($where)
                ->whereIn('goods_id',$goods_id)
              ->get();
        // dd($info);
        $money = 0;
        foreach($info as $k=>$v){
            $money+=$v['add_price']*$v['buy_number'];
        }
        return $money;
    }

    // 删除
    public function cartDel(){
        $goods_id = request()->input('goods_id');
        $id = Auth::id();
        $where = [
            ['id','=',$id],
            ['goods_id','=',$goods_id]
        ];
        // dd($where);
        $res = Cart::where($where)->update(['is_del'=>2]);
        // dd($res);
        if(!empty($res)){
            echo json_encode(['code'=>1,'data'=>'删除成功，由省了一笔巨资']);
        }else{
            echo json_encode(['code'=>2,'data'=>'删除失败']);
        }

    }

}
