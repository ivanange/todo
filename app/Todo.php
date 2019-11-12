<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Todo extends Model
{
    use SoftDeletes;

    protected $table = 'actions';
    protected $hidden = [ 'updated_at', 'deleted_at'];
    protected $guarded = ['id','created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['deleted_at'];
}
