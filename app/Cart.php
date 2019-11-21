<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $primaryKey = 'cart_id';

    protected $table = 'cart';

    public $timestamps = false;

    // 白名单
    protected $filladle = ['buy_number','add_time','add_price','is_del'];

    // 黑名单
    protected $guarded = [''];
}
