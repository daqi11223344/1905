<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deng extends Model
{
    public $primaryKey = 'admin_id';

    protected $table = 'user';

    public $timestamps = false;

    // 白名单 表设计不允许为空的
    protected $filladle = [];
    // 黑名单 表设计允许为空的
    protected $guarded = [];
}
