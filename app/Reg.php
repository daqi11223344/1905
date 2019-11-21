<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reg extends Model
{
    public $primaryKey = 'reg_id';

    protected $table = 'reg';

    public $timestamps = false;

    // // 白名单
    protected $filladle = ['reg_email','reg_pwd','code','reg_mobile','reg_time'];

    // 黑名单
    protected $guarded = [];
}
