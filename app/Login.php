<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $primaryKey = 'reg_id';

    protected $table = 'reg';

    public $timestamps = false;

    // // 白名单
    protected $filladle = ['reg_email','reg_pwd'];

    // 黑名单
    protected $guarded = [];
}
