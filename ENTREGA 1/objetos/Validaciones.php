<?php

  class Validaciones{

    public static function ValidarTamaño($aValidar, $tamaño){

      if(strlen($aValidar) > $tamaño){
        echo "* Fields cannot exceed " . $tamaño . " characters <br/>";
        return '1';
      }
      return '';

    }

    public static function ValidarLetrasyEspacios($aValidar, $Parametro){

      /*preg_match: Es una función que se encarga de comparar un patrón (Primer Elemento)
      con una cadena (Segundo Elemento)*/
      if (preg_match('/[0-9]/', $aValidar)){
        echo "* " . $Parametro . " must contain letters and spaces only <br/>";
        return '1';
      }
      return '';

    }

    public static function ValidarSinEspacios($aValidar, $Parametro){

      if (preg_match('/\s/', $aValidar)){
        echo "* " . $Parametro . " cannot have spaces, only letters and numbers <br/>";
        return '1';
      }
      return '';

    }


    public static function ValidarIgualdad ($aValidar, $ConQue, $Parametro1, $Parametro2){

      if (!($aValidar == $ConQue)){
				echo "* Both the ". $Parametro1 . " and " . $Parametro2 . " fields must be equal <br/>";
        return '1';
			}

    }


  }

?>
