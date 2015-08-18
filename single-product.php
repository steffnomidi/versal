	<?php get_header(); ?>
  
	<?php get_sidebar('top-menu'); ?>
	
	
	<section>
		<div class="container">
			<?php
			
					$product_ID = $post->ID;
					
					if( have_rows('sort') ):
					?>
					<div class="row products">
						<?php
						while ( have_rows('sort') ) : the_row();
						?>

						<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 product">
							<div class="well subcat" data-id="">
							<div class="thumb">
								<?php
								if ( get_sub_field('image') ) {
									$image = get_bloginfo('template_url').'/images/thumbs/tt.php?w=512&h=512&cr=3&src='. get_sub_field('image');
									
									echo '<img src="'.$image.'" />';
								} else {
									echo '<img src="'.get_bloginfo('template_url').'/images/no_image.png" />';
								}
								?>
								<h4>
								<?php
								the_sub_field('first_name');
								if ( get_sub_field('last_name')) { echo '<br />' . get_sub_field('last_name'); }
								?>
								</h4>
							</div>
							
							
							
							<? // таблица под изображением			
							if( have_rows('param') ):
								 ?>
								 <table class="table">
								 <thead>
								 <tr>
									 <th><span>Розмiр</span></td>
									 <th><span>Цiна</span></td>
								 </tr>
								 </thead>
								 <?php 
								while ( have_rows('param') ) : the_row();
								 ?>
								 <tr>
									 <td><span><?php echo the_sub_field('razmir');?></span></td>
									 <td><span><?php echo the_sub_field('price');?> грн.</span></td>
								 </tr>
								 <?php
								endwhile;
								 ?>
								 </table>
								 <?php
									
							else :

								echo " <h4> Цена не назначена </h4> ";

							endif;
							?>	
							</div>
						</div>
				
						<?php
							


						endwhile;
?>

					</div>
					<?php
					else :

						echo " <h4> Ассортимент не определён </h4> ";

					endif;




			?>	

		</div>
	</section>








	
	<?php get_footer(); ?>