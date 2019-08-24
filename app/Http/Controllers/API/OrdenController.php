<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Orden;
use App\Pedidos;

use Carbon\Carbon;

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

   public function list_order(){

     $fecha_hoy = Carbon::now()->format("Y-m-d");

     $orden = Orden::whereDate("ord_fecha",$fecha_hoy)->get();

     foreach ($orden as  $value) {
       // code...
       // adicionar nueva variable para mostrar o ocutar
       $value['show'] = false;
       // adicionar variable para detalles pedido
       $value['pedidos'] = Pedidos::join('productos', 'productos.prod_id', '=', 'pedidos.ped_producto')
       ->where("ped_ordern",$value->ord_id)->get();

     }

     return $orden;
   }




}
