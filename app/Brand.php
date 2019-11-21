<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $primaryKey = 'brand_id';

    protected $table = 'brand';

    public $timestamps = false;

    // 白名单 表设计不允许为空的
    protected $filladle = ['brand_name','brand_url','brand_desc','brand_LOGO'];
    // 黑名单 表设计允许为空的
    protected $guarded = [];
}
