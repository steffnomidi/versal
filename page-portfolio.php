	<?php get_header(); the_post(); 	?>

	<section>
		<div class="container"> 
			<div class="portfolio">
			<h1>Нашi рoботи</h1>
			<?php 
					// изменяем внешний вид вывода галереи
					add_filter('post_gallery','customFormatGallery',10,2);

					function customFormatGallery($string,$attr){

						$output = "<div id=\"owlgallery\">";
						$posts = get_posts(array('include' => $attr['ids'],'post_type' => 'attachment'));

						foreach($posts as $imagePost){
							$output .= '<div class="fullimage" ><div style="background-image: url('.wp_get_attachment_image_src($imagePost->ID, 'owlgallery-full')[0].')"></div></div>';
						}

						$output .= "</div>";
						$output .= "<div id=\"miniatures\">";
						$iter = 0;
						foreach($posts as $imagePost){
							$output .= '<img class="thumb" data-owlid="'.$iter++.'" src="'.wp_get_attachment_image_src($imagePost->ID, 'thumbnail')[0].'">';
						}

						$output .= "</div>";
						return $output;
					}

			the_content(); // Выводим всё это безобразие!
			
			?>
			</div>
		</div>
	</section>
	<script> 
		jQuery(document).ready( function($) {

			
		} );
		
		
	</script>
	<?php get_footer(); ?>