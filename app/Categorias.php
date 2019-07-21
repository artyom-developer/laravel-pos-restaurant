<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    //
    protected $table = "categorias";

    protected $fillable = ['cat_id','cat_nombre', 'cat_active', 'cat_delete'];

    public $timestamps = false;

}
