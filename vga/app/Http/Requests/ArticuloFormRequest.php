<?php

namespace vga\Http\Requests;

use vga\Http\Requests\Request;

class ArticuloFormRequest extends Request
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
            'codigo' => 'required|max:25',
            'nombre'=> 'required|max:100',
            'perecedero' => 'required',
            'stock' => 'numeric',
            'descripcion'=>'max:512',
            'imagen'=>'mimes:jpeg,bmp,png',
            'precio_venta'=>'numeric',
            'idcategoria'=>'required',
            'idescala'=>'required',
        ];
    }
}
