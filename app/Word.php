<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    public $primaryKey = 'word_id';

    protected $table = 'word';

    public $timestamps = false;

    // 白名单 表设计不允许为空的
    protected $filladle = ['word_name','cate_name','cate_id','word_yy','is_show','word_man','email','keyword','word_desc','word_file'];
    // 黑名单 表设计允许为空的
    protected $guarded = [];
}
