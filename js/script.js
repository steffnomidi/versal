jQuery(document).ready(function($) {

	// кнопка мобильного меню
	
	$('.navbar-toggle').click( function() {
		console.log($('.wrap').css('left') );
		if  ( $('.wrap').css('left') == '0px' ) {
			$('.wrap').css('left', '80%');
		}else{
			$('.wrap').css('left', '0px');
		}
	});

	// слайдер на главной
	var owl = $('.owl-front-page');
	owl.owlCarousel( {
		animateOut: 'fadeOut',
		items: 1,
		loop: 1,
		autoplay: true,
		dots: true,
		});
		
	// портфолио	
	var owl = $('#owlgallery');
		owl.owlCarousel({
			items: 1,
			nav: true,
			loop: true,

		});
		$('.thumb').click( function() {
			owl.trigger( 'to.owl.carousel', [ $(this).data('owlid') ] );
		} );
		
		// Listen to owl events:
		owl.on('changed.owl.carousel', function(event) {
			item = event['item'];
			index = item['index']-2;
			$('.thumb').removeClass('active');
			$('.thumb[data-owlid='+index+']').addClass('active');
		})	
	});