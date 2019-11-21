<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Cart;
use App\Goods;
use App\Area;
use App\Addres;
use App\Addre;
use App\Order;
use App\OrderGoods;

class PayController extends Controller
{
    public function pay($goods_id){
        if(!Auth::user()){
            return redirect('login/login');
         }
        $id = Auth::id();
        $goods_id = explode(',',$goods_id);
        // dd($goods_id);
        $info = Cart::
            whereIn('goods.goods_id',$goods_id)
            ->where('id','=',$id)
            ->join('goods','goods.goods_id','=','cart.goods_id') 
            ->get();
            $money = 0;
        foreach($info as $k=>$v){
            $money+=$v['add_price']*$v['buy_number'];
        }
        $data = Addres::get();
        // dd($data);
        foreach($data as $k=>$v){
            $data[$k]['country'] = Area::where('region_id',$v['country'])->value('region_name');
            $data[$k]['provincec'] = Area::where('region_id',$v['provincec'])->value('region_name');
            $data[$k]['city'] = Area::where('region_id',$v['city'])->value('region_name');
            $data[$k]['area'] = Area::where('region_id',$v['area'])->value('region_name');
        }

        
            // dd($info);
        return view('index.login.pay',['info'=>$info,'money'=>$money,'data'=>$data]);
    }

    public function submitOrder(){
        if(!Auth::user()){
            return redirect('login/login');
         }
         $id = Auth::id();
         $goods_id = request()->input('goods_id');
         $addres_id = request()->input('addres_id');
         $pay_type = request()->input('pay_type');
         $order_talk = request()->input('order_talk');
        //  dd($goods_id);

             if(empty($goods_id)){
                 echo '亲至少选择以件商品';
                 return redirect('');
             }
             $goods_id = explode(',',$goods_id);
            //  $where = [
            //      ['id','=',$id]
            //  ];
             $goods = Goods::join('cart','goods.goods_id','=','cart.goods_id')->whereIn('goods.goods_id',$goods_id)->get();
            //  dd($goods);
            if(empty($goods[0])){
                echo '亲至少选择以件商品';
                 return redirect('');
            }
            // $order_model = new \App\Index\pay;
            $order_number = time().rand(1000,999);
            $order['order_number'] = $order_number;
            $order_amount = 0;
            foreach($goods as $k=>$v){
                $order_amount += $v['goods_price']*$v['buy_number'];
            }
            $order['order_amount'] = $order_amount;
            $order['pay_type'] = $pay_type;
            $order['order_talk'] = $order_talk;
            $order['pay_time'] = time();
            $order['id'] = $id;
            $order['create_time'] = time();
            
            // dd($where);
            $res1 = Order::where('id','=',$id)->insert($order);
            // dd($res1);
            if($res1!=true){
                echo('订单提交失败');
                return redirect();
            }

            $order_id = Order::value('order_id');
            if(empty($order_id)){
                echo '亲至少选择以件商品';
                 return redirect('');
            }
            // dd($order_id);
            $addres = Addres::where('addres_id','=',$addres_id)->first();
            if(empty($addres)){
                echo '亲至少选择以件商品';
                 return redirect('');
            }
            
            $addres = $addres->toArray();
            // dd($addres);
            $addres['order_id'] = $order_id;
            $addres2 = Addre::insert($addres);
            if(empty($addres2)){
                echo '亲至少选择以件商品';
                 return redirect('');
            }
            // dd($addres2);

            $goods = $goods->toArray();
            foreach($goods as $k=>$v){
                $goods[$k]['order_id'] = $order_id;
            }
            $goodsres = OrderGoods::insert($goods);
            // dd($goodsres);
            if(empty($goodsres)){
                echo '亲至少选择以件商品';
                 return redirect('');
            }
            // dd($goodsres);   
            $res4 = Cart::whereIn('goods_id',$goods_id)->update(['is_del'=>2]);
            if(empty($res4)){
                echo '清楚购物车失败';
            }
            foreach($goods as $k=>$v){
                $res5 = Goods::where('goods_id',$v['goods_id'])->decrement('goods_num',$v['buy_number']);
            }
            if(empty($res5)){
                echo('修改失败');
            }
                
                return redirect('/pay/success');
        
    }

    public function success(){
        $ress = Order::get();
        return view('index.login.success',['ress'=>$ress]);
    }

    public function payMoney($order_id){
        // dd($order_id);
        require_once app_path()."/libs/alipayPHP/wappay/service/AlipayTradeService.php";
        require_once app_path()."/libs/alipayPHP/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php";
          $config = Config::get('alipay');
        //   dd($config);
        if(empty($order_id)){
            echo('此订单不存在');exit;
        }else{
            $id = Auth::id();
            // dd($id);
            $where = [
                ['id','=',$id],
                ['order_id','=',$order_id]
            ];
            // dd($where);
            $orderInfo = Order::where($where)->first();
            if(empty($orderInfo)){
                echo('此订单不存在');exit;
            }
        }

         //商户订单号，商户网站订单系统中唯一订单号，必填
         $out_trade_no = $orderInfo['order_number'];

         //订单名称，必填
         $subject = '养猪商城';
 
         //付款金额，必填
         $total_amount = $orderInfo['order_amount'];
 
         //商品描述，可空
         $body = '';
 
         //构造参数
         $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
         $payRequestBuilder->setBody($body);
         $payRequestBuilder->setSubject($subject);
         $payRequestBuilder->setTotalAmount($total_amount);
         $payRequestBuilder->setOutTradeNo($out_trade_no);
 
         $aop = new \AlipayTradeService($config);
 
        
         $response = $aop->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);
 
         //输出表单
         var_dump($response);
    }

    public function addres(){
        if(!Auth::user()){
            return redirect('login/login');
         }
         $parent_id=0;
         $where = [
            ['parent_id','=',$parent_id]
        ];
        $areaInfo = Area::where($where)->get();
        return view('index.login.addres',['areaInfo'=>$areaInfo]);
    }

    public function getArea(){
        $parent_id = request()->input('parent_id');
        if(!$parent_id){
            return;
        }
        $data = Area::where(['parent_id'=>$parent_id])->get();
        // dd($data);
        echo json_encode(['code'=>'00000','data'=>$data]);
    }

    public function create(){
        if(!Auth::user()){
            return redirect('login/login');
         }
        $data = Addres::get();
        dd($data);
        return view('index.login.address',['data'=>$data]);

    }

    public function save(){
        $post = request()->except('_token');
        $id = Auth::id();
        if(!empty($post['is_default'])){
            $where = [
                ['id','=',$id]
            ];
             Addres::where($where)->update(['is_default'=>2]);
            // dd($add);
        }
        $post['id'] = Auth::id();
        $res = Addres::create($post);
        if($res->addres_id){
            return redirect('/address/address');
        }
    }

    public function edit($addres_id)
    {
        // echo($addres_id);
        if(!$addres_id){
            abort(404);
        }

        $countryInfo = $this->addres(0);
        dd($countryInfo);
        $id = Auth::id();
        $where = [
            ['id','=',$id],
            ['addres_id','=',$addres_id]
        ];
        
        $addressInfo = Addres::where($where)->first();
        $provinceInfo = $this->addres($addressInfo['country']);
        // 获取当前省份下的所有的市
        $cityInfo = $this->addres($addressInfo['provincec']);

        // 获取当前时下的所有的区/县
        $areaInfo = $this->addres($addressInfo['city']);
        return view('index.login.edit',['countryInfo'=>$countryInfo],['provinceInfo'=>$provinceInfo],['cityInfo'=>$cityInfo],['areaInfo'=>$areaInfo]);

    }

    
}
