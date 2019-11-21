<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $primaryKey = 'admin_id';

    protected $table = 'admin';

    public $timestamps = false;

    // 白名单 表设计不允许为空的
    protected $filladle = ['admin_name','admin_mobile','admin_email','admin_pwd'];
    // 黑名单 表设计允许为空的
    protected $guarded = [];
}
