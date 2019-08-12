<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Orden;
use App\Pedidos;

class OrdenController extends Controller
{
    //
    public function create_order(Request $request){

       // obetner un array de pedidos
       $pedido = $request->input("pedidos");

       $orderdata['ord_estado'] = 1; // 1 es Pendiente
       $orderdata['ord_mesa']   = $request->input("mesa");
       $orderdata['ord_valor'] = $request->input("total");
       // guarda los datos del orden
       $order = Orden::create($orderdata);

       foreach (json_decode($pedido) as $item){

         // id de producto
         $itemped['ped_producto'] = $item->id;
         // id de orden de pedido
         $itemped['ped_ordern']   = $order->id;
         // cantidad
         $itemped['ped_cantidad'] = $item->cant;
         // precio de producto
         $itemped['ped_valor'] = $item->precio;
         // guarda la base de datos
         Pedidos::create($itemped);

       }

       $response['success'] = true;
       $response['message'] = "Guardo exitosamente";
   }
}
