<?php

	class CapturaCrear{

		public function __construct(){}

		public function CapturaValidarFormulario(){

			$arregloDeCapturas = array('nombre' => $_POST['name'], 'last_name' => $_POST['last_name'],'email' => $_POST['email'], 'password' => $_POST['password'],'psw_repeat' => $_POST['psw_repeat']);

			$NumErr;
			$ErroresTotales = 0;

			$name = $arregloDeCapturas['nombre'];
			$NumErr = $this->ValidarNombre($name, "Name");
			$ErroresTotales = $ErroresTotales + $NumErr;

			$last_name = $arregloDeCapturas['last_name'];
			$NumErr = $this->ValidarNombre($last_name, "Last name");
			$ErroresTotales = $ErroresTotales + $NumErr;

			$password = $arregloDeCapturas['password'];
			$psw_repeat = $arregloDeCapturas['psw_repeat'];
			$NumErr = $this->validarContraseña($password, $psw_repeat);
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


		private function ValidarContraseña($contraseña, $contraseña_repeat){
			
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

       		$Error = Validaciones::ValidarIgualdad($contraseña, $contraseña_repeat, 'password', 'repeat password');
			 
			if ($Error != ''){
				$cont++;
			}

			return $cont;
		}

	}


?>
