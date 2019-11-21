<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $primaryKey = 'region_id';

    protected $table = 'area';

    public $timestamps = false;

    // 白名单 表设计不允许为空的
    protected $filladle = [];
    // 黑名单 表设计允许为空的
    protected $guarded = [];
}
