<?php

namespace lamsys\Http\Requests;

use lamsys\Http\Requests\Request;

class PersonaFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                        
                'direccion'=>'required|max:100',
                'email'=>'required|max:30',
                'nombre'=>'required|max:100',
                'num_documento'=>'required|max:15',
                'telefono'=>'required|max:15',
                'tipo_documento'=>'required|max:20'
                //'tipo_persona' no se toma en cuenta es campo de control
        ];
    }
}
