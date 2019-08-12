<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    //
    protected $table = "orden";

    protected $fillable = [
      'ord_id',
      'ord_mesa',
      'ord_valor',
      'ord_estado',
      'ord_fecha'
    ];

    public $timestamps = false;
}
