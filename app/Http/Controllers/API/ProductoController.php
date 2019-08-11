<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Productos;

class ProductoController extends Controller
{
    //
    public function create(Request $request){

      $input['prod_name'] = $request->input('name');
      $input['prod_description'] = $request->input('description');
      $input['prod_categoria'] = $request->input('categorie');
      $input['prod_price'] = $request->input('price');

      $input['prod_visible'] = 1;
      $input['prod_delete'] = 0;
      $input['prod_image'] = null;


      if ($request->file('prod_image')==null)
      {
        $input['prod_image'] = null;
      }
      else
      {
        $image = $request->file('prod_image');
        // almacena y captura el nombre del archivo
        $input['prod_image'] =  $image->store('producto','public');
      }

      $data = Productos::insert($input);

      $response['message'] = "Guardo exitosamente ";
      $response['success'] = true;
      return $response;

    }

    public function list(){

      $data = Productos::where("prod_delete",0)
      ->join('categorias', 'categorias.cat_id', '=', 'productos.prod_categoria')
      ->get();

      return $data;
    }

    public function change_status(Request $request){


      // id de producto
      $idprod = $request->input("idprod");
      // el estado de producto
      $status = $request->input("status");

      // Log::info("Actualizando status $idprod => $status");

      Productos::where("prod_id",$idprod)->update([
        'prod_visible' => $status
      ]);

      $response['message'] = "Actualizo exitosamente";
      $response['success'] = true;
      return $response;

    }

    public function visible(){

      $data = Productos::where("prod_delete",0)
      ->where("prod_visible",1)
      ->join('categorias', 'categorias.cat_id', '=', 'productos.prod_categoria')
      ->where("cat_active",1)
      ->get();

      foreach ($data as  $value) {
        $value['prod_image'] = asset('storage/'.$value->prod_image);
      }

      return $data;

    }


}
