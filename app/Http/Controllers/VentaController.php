<?php

namespace lamsys\Http\Controllers;

use Illuminate\Http\Request;

use lamsys\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use lamsys\Http\Requests\VentaFormRequest;
use lamsys\Venta;
use lamsys\DetalleVenta;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\collection;

class VentaController extends Controller
{
    public function __construct(){


    }

    public function index(Request $request){

    	if($request)
    	{
    		$query=trim($request->get('buscaTexto'));
    		$ventas=DB::table('venta as v')
    		->join('persona as p','v.idcliente','=','p.idpersona')
    		->join('detalle_venta as dv','v.idventa','=','dv.idventa')
    		->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado',DB::raw('sum(dv.cantidad*precio_venta) as total_venta'))
    		->where ('v.num_comprobante','LIKE','%'.$query.'%')
    		->orderBy('v.idventa','desc')
    		->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado')
    		->paginate(7);

    		return view('ventas.venta.index',["ventas"=>$ventas,"buscaTexto"=>$query]);
    	}

    }



}
