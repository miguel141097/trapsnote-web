<?php

namespace trapsnoteWeb\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidarCaracteresAlfaNumericosYEspacios implements Rule
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

        for($i = 0; $i < strlen($value); $i++) {

            /* /([a-zA-Z0-9\s])/ Se anulan los acentos*/
            if (! (preg_match('/([a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s])/', $value[$i])) ){
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
        return 'El campo :attribute solo puede contener caractesres alfa numericos y espacios';
    }
}
