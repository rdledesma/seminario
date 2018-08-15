<?php

namespace vga\Http\Requests;

use vga\Http\Requests\Request;

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
            'idproveedor'=>'required',
            'fecha_ingreso' => 'required',
            'nro_factura' => 'required',
            'total'=>'required',
    ];
    }
}
