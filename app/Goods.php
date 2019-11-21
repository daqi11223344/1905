<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public $primaryKey = 'goods_id';

    protected $table = 'goods';

    public $timestamps = false;

    // 白名单
    protected $filladle = ['goods_name','goods_price','goods_desc','goods_photo','goods_num'];

    // 黑名单
    protected $guarded = [''];
}
