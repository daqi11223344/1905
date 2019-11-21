<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userr extends Model
{
    public $primaryKey = 'admin_id';

    protected $table = 'admin';

    public $timestamps = false;

    // // 白名单
    // protected $filladle = ['admin_name','admin_pwd'];

    // 黑名单
    protected $guarded = [];
}
