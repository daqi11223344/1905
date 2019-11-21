<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Goods;
use App\Cate;

class IndexController extends Controller
{
    public function index(){
        $data = Goods::get();
        $cate = Cate::get();
        return view('index.index.index',['cate'=>$cate,'data'=>$data]);
    }
}
