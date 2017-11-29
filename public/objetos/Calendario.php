<html>

	<head>
		<title></title>
	</head>

	<body>

		<?php   

		class Calendario{
			
			public function generarYear(){

				?> 

				<select name="year">

				<?php

				for ($year = 1988; $year <= date('o') ; $year++) { 
						
					?>

					<option value="<?php  echo $year; ?>"><?php  echo $year; ?></option>

					<?php

				}

				?>

				</select>

				<?php
				
			}


			public function generarMonth(){

				/*Areglo que contiene todos los meses del año*/
				$arregloDeMeses = array('ene', 'feb', 'mar','abr', 'may', 'jun','jul', 'ago', 'sep','oct', 'nov', 'dic');

				?> 

				<select name="month">

				<?php

				for ($month = 1; $month <= 12 ; $month++) { 
						
					?>

					<option value="<?php  echo $month; ?>"><?php  echo $arregloDeMeses[$month - 1]; ?></option>

					<?php

				}

				?>

				</select>

				<?php
				
			}


			public function generarDay(){

				?> 

				<select name="day">

				<?php

				for ($day = 1; $day <= 31 ; $day++) { 
						
					?>

					<option value="<?php  echo $day; ?>"><?php  echo $day; ?></option>

					<?php

				}

				?>

				</select>

				<?php
				
			}

		}

		?>

	</body>

</html>


