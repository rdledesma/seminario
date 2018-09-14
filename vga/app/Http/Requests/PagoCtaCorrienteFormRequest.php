<?php

namespace vga\Http\Requests;

use vga\Http\Requests\Request;

class PagoCtaCorrienteFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idventa'=>'required',
            'importe'=>'required',
            'paga_con'=>'required',
            'vuelto'=>'required'
        ];
    }
}
