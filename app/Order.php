<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $primaryKey = 'order_id';

    protected $table = 'order';

    public $timestamps = false;

    // 白名单
    protected $filladle = [];

    // 黑名单
    protected $guarded = [''];
}
