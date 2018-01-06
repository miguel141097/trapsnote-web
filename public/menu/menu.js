$(document).ready(main);

var contador = 1;

function main(){
	$('.icon-menu').click(function(){

		if(contador == 1){

			$('nav').animate({
				left: '0'
			});
			 $('#tipoDeContenido :input').attr('disabled', true);

			contador = 0;

		} else {

			$('nav').animate({
				left: '-100%'
			});
			$('#tipoDeContenido :input').attr('disabled', false);



			contador = 1;
		}

	});

	$('.contenido').click(function(){
		if(contador == 0){
			$('nav').animate({
				left: '-100%'
			});
			$('#tipoDeContenido :input').attr('disabled', false);

			contador = 1;
		}
	});

};
