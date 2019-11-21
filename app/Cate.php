<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table="category";

    public $primarykey='cate_id';

    public $timestamps=false;

    protected $fillable = ['cate_name','parent_id','is_show','is_nav_show','keywords','desc'];

    protected $guaRded=[''];
}
