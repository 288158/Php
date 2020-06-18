<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = "friend";
    public $timestamps = false;
    protected $fillable = ['id','name','friend'];
}
