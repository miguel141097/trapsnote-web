<?php

namespace trapsnoteWeb\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidarUsernameRepetido implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();

        foreach ($recurso->getListaUsername() as $correos) {

            if($correos === $value){
                return false;
            }

        }
       
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El campo :attribute ya se encuentra registrado';
    }
}
