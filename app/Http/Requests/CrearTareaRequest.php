<?php

namespace trapsnoteWeb\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use trapsnoteWeb\Rules\ValidarCaracteresAlfaNumericosYEspacios;

class CrearTareaRequest extends FormRequest
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
            'nombre' => ['required' , 'max:255' , new ValidarCaracteresAlfaNumericosYEspacios],
            'descripcion' => ['required' , 'max:255' , new ValidarCaracteresAlfaNumericosYEspacios],
        ];
    }
}
