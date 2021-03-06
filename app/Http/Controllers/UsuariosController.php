<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UsuariosController extends Controller{
	
	public function index(){
		//SELECT * FROM usuarios;
		$usuarios = DB::table("usuarios")->get();
		return view("paginas.social.usuarios")->with([
			"usuarios" => $usuarios
		]);
	}

	public function buscar(Request $request){
		//$request->filled() comprueba que un parametro exista dentro del request y tenga valor 
		if ($request->filled("nombre")) {
			
			$nombre = $request->nombre;
			$usuario = DB::table("usuarios")
						->where("nombre",$nombre)
						->get();
			return view("paginas.social.busqueda",[
				"usuario" => $usuario
			]);

		}else{
			return redirect("/usuarios");
		}
	}

	public function usuario($id){
		$usuario = DB::table("usuarios")
					->where("id",$id)
					->first();
		return view("paginas.social.usuario",compact("usuario"));
	}
}
