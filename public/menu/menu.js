$(document).ready(main);

var contador = 1;

function main(){
	$('.icon-menu').click(function(){

		if(contador == 1){

			$('nav').animate({
				left: '0'
			});
			
			contador = 0;

		} else {

			$('nav').animate({
				left: '-100%'
			});

			contador = 1;
		}

	});

};