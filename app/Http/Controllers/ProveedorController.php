<?php

namespace lamsys\Http\Controllers;

use Illuminate\Http\Request;

use lamsys\Http\Requests;

use lamsys\Persona;
use Illuminate\Support\Facades\Redirect;
use lamsys\Http\Requests\PersonaFormRequest;
use DB;

class ProveedorController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request){

    	if($request)
    	{
    		$query=trim($request->get('buscaTexto'));
    		$personas=DB::table('persona')
    		->where('nombre','LIKE','%'.$query.'%')
    		->where('tipo_persona','=','Proveedor')
    		->orwhere('num_documento','LIKE','%'.$query.'%')
    		->where('tipo_persona','=','Proveedor')
    		->orderBy('idpersona','desc')
    		->paginate(7);
    		return view('compras.proveedor.index',["personas"=>$personas,"buscaTexto"=>$query]);
    	}

    }

    public function create(){

    	return view("compras.proveedor.create");


    }

    public function store(PersonaFormRequest $request){
    	$persona=new Persona;
    	$persona->direccion=$request->get('direccion');
    	$persona->email=$request->get('email');
    	$persona->nombre=$request->get('nombre');
    	$persona->num_documento=$request->get('num_documento');
    	$persona->telefono=$request->get('telefono');
    	$persona->tipo_documento=$request->get('tipo_documento');
    	$persona->tipo_persona='Proveedor';

    	
    	$persona->save();
    	return Redirect::to('compras/proveedor');


    }

    public function show($id){

    	return view("compras.proveedor.show",["persona"=>Persona::findOrFail($id)]);


    }

    public function edit($id){

    	return view("compras.proveedor.edit",["persona"=>Persona::findOrFail($id)]);


    }
	public function update (PersonaFormRequest $request,$id){

		$persona=Persona::findOrFail($id);
		$persona->direccion=$request->get('direccion');
    	$persona->email=$request->get('email');
    	$persona->nombre=$request->get('nombre');
    	$persona->num_documento=$request->get('num_documento');
    	$persona->telefono=$request->get('telefono');
    	$persona->tipo_documento=$request->get('tipo_documento');
    	//$persona->tipo_persona=$request->'Proveedor' no se se actualiza porque no deja de ser proveedor

		$persona->update();
		return Redirect::to('compras/proveedor');


	}
	public function destroy($id){

		$persona=Persona::findOrFail($id);
		$persona->tipo_persona='Inactivo'; //aqui deberia de actualizarse otro campo y no este, seria un mejora
		$persona->update();
		return Redirect::to('compras/proveedor');


	}
}
