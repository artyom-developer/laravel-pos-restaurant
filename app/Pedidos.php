<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    //
    protected $table = "pedidos";

    protected $fillable = [
      'ped_id',
      'ped_ordern',
      'ped_producto',
      'ped_cantidad',
      'ped_valor'
    ];

    public $timestamps = false;
}
