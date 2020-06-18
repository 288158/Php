<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $table = "home";
    public $timestamps = false;
    protected $fillable = ['name','work','status','share'];
}
