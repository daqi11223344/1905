<?php

namespace App\Http\Controllers\Index;

//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Login;
use App\Goods;
use App\Cart;
use App\User;

class LoginController extends Controller
{
    public function login(){
        return view('index.login.login');
    }

    public function creat(){
        $post = request()->except('_token');
       // dd($post);
       $name = $post['email'];
       $password  =$post['password'];
       $where[] = ['email','=',$name];
       $where[] = ['password','=',$password];
       $link = User::where($where)->first();
        if (Auth::attempt(['email' => $name, 'password' => $password])) {
        //if(Hash::check($post['reg_pwd'],$link[0]['reg_pwd'])){
               
            return redirect('/');
        }else{
            $links = '你的用户名或密码不正确，请重试';
            return view('index.login.login',['links'=>$links]);
        }
    }
    // 详情页
    public function proinfo($id)
    {

        $data = Goods::where('goods_id','=',$id)->first();
        // dd($data);
        return view('index.login.proinfo',['data'=>$data]);
    }

    // public function getCartDb(){
    //     $id = request()->input('id');
    //     // $id = request()->getId();
    //     dd($id);
    // }

    //加入购物车
    public function addCart(){
        $goods_id = request()->input('goods_id');
        $buy_number = request()->input('buy_number');
        $goods_price = Goods::where('goods_id','=',$goods_id)->value('goods_price');
        // dump($goods_price);die;
        // $this->car($goods_id,$buy_number,$goods_price);

        if(Auth::user()){
            $this->car($goods_id,$buy_number,$goods_price);
        }else{
            echo json_encode(['code'=>'00000','data'=>'您还没有登录，是否登录']);
        }
    }
    // 加入购物车
    public function car($goods_id,$buy_number,$goods_price){
        // $id = request()->input('id');
        $id = Auth::id();
        $where = [
            ['goods_id','=',$goods_id],
            ['id','=',$id],
            ['is_del','=',1]
        ];
        // dd($where);
        $goods = Cart::where($where)->first();
        $goodsNum = checkGoodsNum($buy_number,$goods_id,$goods['buy_number']);
        // dd($data);
        if(empty($goods)){
            $goods = checkGoodsNum($buy_number,$goods_id);
            // dump($goods);die;
            if(empty($goods)){
                echo json_encode(['code'=>2,'data'=>'所添加的大于库存']);
            }else{
                $arr = ['goods_id'=>$goods_id,'buy_number'=>$buy_number,'id'=>$id,'add_time'=>time(),'add_price'=>$goods_price];
                $res = Cart::create($arr);
                echo json_encode(['code'=>1,'data'=>'添加成功，走起！']);
            }
        }else{
            if(empty($goodsNum)){
                echo json_encode(['code'=>2,'data'=>'所添加的大于库存']);
            }else{
                $buy_number = $buy_number+$goods['buy_number'];
                $res = Cart::where($where)->update(['buy_number'=>$buy_number,'add_time'=>time(),'add_price'=>$goods_price]);
                echo json_encode(['code'=>1,'data'=>'添加成功，走起！！']);
            }
        }
        
    }
}
