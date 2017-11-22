<?php

namespace lamsys\Http\Requests;

use lamsys\Http\Requests\Request;

class IngresoFormRequest extends Request
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
            'idproveedor'=>'required'
            'tipo_comprobante'=>'required'
             'idproveedor'=>'required'
               'idproveedor'=>'required'
                'idproveedor'=>'required'
        ];
    }
}
