<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     *
     *  Mucho cuidado con los errores de código en los form requests,
     *  a diferencia de en otras capas, si hay algun error de sintaxis
     *  en un form request, puede que nos diga que la clase no existe! 
     *
     *  En el peor de los casos borrarlo y volverlo a crear desde cero
     */
    
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
            'name'      =>  'required',
            'lastname'  =>  'required',
            'photo'     =>  'image|mimes:jpeg,bmp,png|max:512', 
            //No dejo subir imagenes de más de 1mb, algo que podria hacer si es un avatar es redimensionarlo despues de subirse
        ];
    }
}
