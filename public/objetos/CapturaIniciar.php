<?php

	include 'objetos/Validaciones.php';

	class CapturaIniciar{

		public function __construct(){}

		public function CapturaValidarFormulario(){

			$arregloDeCapturas = array('name' => $_POST['name'], 'password' => $_POST['password']);

			$NumErr;
			$ErroresTotales = 0;

			$name = $arregloDeCapturas['name'];
			$NumErr = $this->ValidarNombre($name, "Name");
			$ErroresTotales = $ErroresTotales + $NumErr;

			$password = $arregloDeCapturas['password'];
			$NumErr = $this->validarContraseña($password);
			$ErroresTotales = $ErroresTotales + $NumErr;

			if($ErroresTotales == 0){
				return $arregloDeCapturas;
			}

      		return "Error";
		}

		private function ValidarNombre($nombre, $Parametro){
			
			/*Cuenta Los Errores*/
			$cont = 0;

			$Error = '';
			$Error = Validaciones::ValidarTamaño($nombre, maxLengthNames);

			/*Encontro un Error*/
			if ($Error != ''){
				$cont++;
			}

			$Error = Validaciones::ValidarLetrasyEspacios($nombre, $Parametro);

			if ($Error != ''){
				$cont++;
			}

			/*NO Presentó Errores*/
			return $cont++;

		}


		private function ValidarContraseña($contraseña){

			$cont = 0;

			$Error = '';
			$Error = Validaciones::ValidarTamaño($contraseña, maxLengthPassword);

			if ($Error != ''){
				$cont++;
			}

			$Error = Validaciones::ValidarSinEspacios($contraseña, "Password");
			
			if ($Error != ''){
				$cont++;
			}

			return $cont;
		}

	}


?>
