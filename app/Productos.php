<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    //
    //
    protected $table = "productos";

    protected $fillable = [
      'prod_id',
      'prod_name',
      'prod_price',
      'prod_categoria',
      'prod_description',
      'prod_visible',
      'prod_delete',
      'prod_image'
    ];

    public $timestamps = false;

}
