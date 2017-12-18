<?php

namespace trapsnoteWeb\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//Nuevas validaciones
use trapsnoteWeb\Rules\ValidarLetrasyEspacios;
use trapsnoteWeb\Rules\ValidarSinEspacios;
use trapsnoteWeb\Rules\ValidarCorreoRepetido;
use trapsnoteWeb\Rules\ValidarUsernameRepetido;


class UserCreateRequest extends FormRequest
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
            'username'=>['required', new ValidarSinEspacios, new ValidarUsernameRepetido],

            'name' => ['required', 'max:50' , new ValidarLetrasyEspacios],
            'last_name' => ['required', 'max:50' , new ValidarLetrasyEspacios],

            'email' => ['required', 'email', new ValidarCorreoRepetido],

            'password' => ['required','min:8', 'contraseña:password_repeat', new ValidarSinEspacios],
            'password_repeat' => ['required','min:8', new ValidarSinEspacios],

            'year'=> 'validarEdad:month,day',
        ];
    }
}
