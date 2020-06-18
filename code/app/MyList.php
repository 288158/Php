<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyList extends Model
{
    protected $table = "myList";
    public $timestamps = false;
    protected $fillable = ['id','item','status','home_id'];
}
