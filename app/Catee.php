<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catee extends Model
{
    public $primaryKey = 'cate_id';

    protected $table = 'cate';

    public $timestamps = false;

    // 白名单 表设计不允许为空的
    protected $filladle = ['cate_name'];
    // 黑名单 表设计允许为空的
    protected $guarded = [];
}
