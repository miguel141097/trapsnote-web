<?php

namespace trapsnoteWeb\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use trapsnoteWeb\Rules\ValidarLetrasyEspacios;
use trapsnoteWeb\Rules\ValidarSinEspacios;

class EditarUsuario extends FormRequest
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
          'name' => ['required' , 'max:50' , new ValidarLetrasyEspacios],
          'last_name' => ['required' , 'max:50' , new ValidarLetrasyEspacios],
          'password' => ['required' , 'min:8', 'contraseña:password_repeat', new ValidarSinEspacios],
          'password_repeat' => ['required' , 'min:8', new ValidarSinEspacios],
        ];
    }
}
