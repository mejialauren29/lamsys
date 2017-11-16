<?php

namespace lamsys;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
   protected $table='persona';
    
    protected $primaryKey='idpersona';

    public $timestamps=false;

    protected $fillable=[
    'direccion',
    'email',
    'nombre',
    'num_documento',
    'telefono',
    'tipo_documento',
    'tipo_persona'
    
    ];

    protected $guarded=[

    ];
}
