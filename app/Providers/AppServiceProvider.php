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



        Validator::extend('validarEdad', function($attribute, $year, $parameters, $validator) {
          /*La mayoria de edad apartir de 18 años  */

          //define las fechas actuales del servidor en un array
          $hoy=getdate();

          //separacion de las fechas actuales necesarias
          $hoyAño=$hoy['year'];
          $hoyMes=$hoy['mon'];
          $hoyDia=$hoy['mday'];

          // aca recogemos los datos pasados por parametro en la llamada 'validarEdad:month,day' osea month y day
          $data = $validator->getData();

          //recogemos en cadena de caracteres el nombre del atributo para buscarlo en el array de datos
          $stringMes = $parameters[0];
            $stringDia = $parameters[1];
          //buscamos en el array de datos el mes y el dia segun corresponde
          $mes=$data[$stringMes];
          $dia=$data[$stringDia];

          if(($hoyAño - $year) > 18)
                return true;
            //en caso de que tenga 18 puede ser un 18 falso ya que que el mes o el dia en que nacio aun no ha pasado
          if(($hoyAño- $year) ==18){
                if(($hoyMes-$mes) > 0)
                        return true;

                if(($hoyMes-$mes) == 0){
                  //validamos si ya paso el dia y efectivamente tiene 18 años
                      if($hoyDia- $dia >=0)
                            return true;
                }
          }

          //no hay problema
            return false;

        });

        Validator::replacer('validarEdad', function($message, $attribute, $rule, $parameters) {
            return str_replace(':field', $parameters[0], "Usted es menor de edad");
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
