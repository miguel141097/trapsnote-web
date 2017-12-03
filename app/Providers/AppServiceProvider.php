<?php

namespace trapsnoteWeb\Providers;

use Illuminate\Support\ServiceProvider;

use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('contraseña', function($attribute, $value, $parameters, $validator) {
            $password_repeat_field = $parameters[0];
            $data = $validator->getData();
            $password_repeat = $data[$password_repeat_field];

            //Compara las dos contraseña
            return $value == $password_repeat;
        });   

        Validator::replacer('contraseña', function($message, $attribute, $rule, $parameters) {
            return str_replace(':field', $parameters[0], $message);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
