<?php

namespace vga\Http\Requests;

use vga\Http\Requests\Request;

class VentaFormRequest extends Request
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
                'idcliente'=>'required',
                'descuento'=>'required',
                'tipo_pago' => 'required',
                'factura' => 'required',
                'forma_pago' => 'required',
                'totalventa'=>'required',
                'total'=>'required',
                'fecha' =>'required',
        ];
    }
}
