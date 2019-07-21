<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// import model
use App\Categorias;

class CategoriaController extends Controller
{
    //

    // create category
    public function add(Request $request){

      $name = $request->input("name");

      Categorias::insert([
        'cat_nombre' => $name,
        'cat_active' => 1,
        'cat_delete' => 0
      ]);

      $response['message'] = "Guardo exitosamente $name";
      $response['success'] = true;
      return $response;

    }

    // load data category
    public function list(){

      $data = Categorias::where("cat_delete",0)
      ->get();
      return $data;
    }

    // load data category avalaible cat_active = 1 for public in POS
    public function avalaible(){
      $data = Categorias::where("cat_delete",0)->where("cat_active",1)->get();
      return $data;
    }

    // update status category
    public function change_status(Request $request){

      // id de categoria
      $idcat = $request->input("idcat");
      // el estado de categoria
      $status = $request->input("status");

      Categorias::where("cat_id",$idcat)->update([
        'cat_active' => $status
      ]);

      $response['message'] = "Actualizo exitosamente";
      $response['success'] = true;
      return $response;

    }

}
