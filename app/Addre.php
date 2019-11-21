<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addre extends Model
{
    public $primaryKey = 'o_id';

    protected $table = 'order_addres';

    public $timestamps = false;

    // 白名单 表设计不允许为空的
    protected $filladle = [];
    // 黑名单 表设计允许为空的
    protected $guarded = [];
}
