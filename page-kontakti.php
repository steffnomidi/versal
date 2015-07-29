	<?php
	// подключаем api Яндекс.Карт
	wp_enqueue_script( 'map', '//api-maps.yandex.ru/2.1/?lang=ru_RU', array('jquery'), false );
	?>
	
	<?php get_header(); the_post();?>
	<div class="map">
		<div id="map"></div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="info col-sm-6 col-sm-offset-6 col-md-5 col-md-offset-7">
				<div class="frame">
					<h1><?php the_title();?></h1>
					
					<ul class="contacts">
						<li class="address"><?php echo get_field('address'); ?></li>
						<li class="email"><?php echo get_field('email'); ?></li>
						<li class="facebook"><?php echo get_field('facebook'); ?></li>
						<li class="phones"><?php echo get_field('phones'); ?></li>
					</ul>
					
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>  

	<?php get_footer(); ?>
	<script>
		var myMap;

		// Дождёмся загрузки API и готовности DOM.
		ymaps.ready(init);

		function init () {
			// Создание экземпляра карты и его привязка к контейнеру с
			// заданным id ("map").
			myMap = new ymaps.Map('map', {
				// При инициализации карты обязательно нужно указать
				// её центр и коэффициент масштабирования.
				center: [50.581363, 30.497481], // Вышгород
				zoom: 16
			}, {
				searchControlProvider: 'yandex#search'
			});
			// Создаем геообъект с типом геометрии "Точка".
			myGeoObject = new ymaps.GeoObject({
				// Описание геометрии.
				geometry: {
					type: "Point",
					coordinates: [50.581363, 30.497481]
				},
				// Свойства.
				properties: {
				}
			});
			 myMap.geoObjects.add(new ymaps.Placemark([50.581363, 30.497481], {
					balloonContent: 'Садово-ландшавтний центр «Версаль»'
				}, {
					preset: 'islands#circleDotIcon',
					iconColor: '#1faee9'
				}));
			}
	</script>