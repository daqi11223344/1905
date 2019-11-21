<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adds extends Model
{
    public $primaryKey = 'h_id';

    protected $table = 'huowu';

    public $timestamps = false;

    // 白名单 表设计不允许为空的
    protected $filladle = ['id'];
    // 黑名单 表设计允许为空的
    protected $guarded = [];
}
