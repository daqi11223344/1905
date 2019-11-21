<?php
use App\Goods;
use App\Cate;
use App\Addres;
use App\Area;

// 公共函数文件

function getAll(){
    echo 123;
}

// 生成盐值

function createSalt(){
    $str = 'abcdefgherjklmnopqestuvwsyzABCDEFGHIJKLOMOPQSRTUVWXYZ';
    $str = substr(str_shuffle($str),0,6);
    return $str;
}


// 无限极分类
function goods($data,$parent_id=0,$level=0){
	static $array = [];
	if(!$data){
		return;
	}
	foreach ($data as $k=>$v){
		if($v['parent_id']==$parent_id){
			$v['level'] = $level;
			$array[] = $v;
			goods($data,$v['cate_id'],$level+1);
		}
	}
	return $array;
}

// 创建货号
function createGoodsSn()
{
	return 'DQ'.date('YmdHis').rand(100,999);
}

 // 检测库存
function checkGoodsNum($buy_number,$goods_id,$already_num=0){
	//根据商品id获取库存
	$goods_number=Goods::where('goods_id',$goods_id)->value("goods_num");
	// dd($goods_number);die;
	if(($buy_number+$already_num)>$goods_number){
		return false;
	}else{
		return true;
	}
}

function getNavInfo(){
	$where=[
		['parent_id','=',0],
		['is_nav_show','=',1]
	];
	$cateInfo=Cate::where($where)->select();
	$this->assign('cateInfo',$cateInfo);

	$cateWhere=[
		['is_show','=',1]
	];
	$cateInfo=Cate::field("cate_id,cate_name,parent_id")->where($cateWhere)->select()->toArray();
	$cateInfo=getCateInfo($cateInfo);
	$this->assign('cateInfo',$cateInfo);
}

function getAddressInfo(){
	$id = Auth::id();
	$where = [
		['id','=',$id]
	];
	$addressInfo = Addres::where($where)->select();
	// dd(addressInfo);
	foreach($addressInfo as $k=>$v){
		$addressInfo[$k]['country'] = Area::where('region_id',$v['country'])->value('region_name');
		$addressInfo[$k]['provincec'] = Area::where('region_id',$v['provincec'])->value('region_name');
		$addressInfo[$k]['city'] = Area::where('region_id',$v['city'])->value('region_name');
		$addressInfo[$k]['area'] = Area::where('region_id',$v['area'])->value('region_name');
	}
	return $addressInfo;
}

?>