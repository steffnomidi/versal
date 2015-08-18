	<?php get_header(); ?>
  
	<?php get_sidebar('top-menu'); ?>

	<section>
		<div class="container">
			<?php
				
				if ( have_posts() ) :
					echo '<div class="row">';
					while ( have_posts() ) :
						the_post(); 
					
						?>
						<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
							<div class="well subcat" data-id="<?php echo $post->ID; ?>">
								<div class="thumb">
									<a href="/product/<?php echo $post->post_name; ?>">
										<?php
										
										if ( get_the_post_thumbnail() ) {
											$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
											$turl = $thumb['0'];
											$image = get_bloginfo('template_url').'/images/thumbs/tt.php?w=512&h=512&cr=3&src='. $turl;
											echo '<img src="'.$image.'" />';
										} else {
											echo '<img src="'.get_bloginfo('template_url').'/images/no_image.png" />';
										}
										?>								
										<h4><?php the_title(); ?></h4>
									</a>
								</div>
							</div>
						</div>
						<?php
					endwhile;

					echo '</div>';
				else: 
				
					echo " <h4> Ассортимент не определён </h4> ";
					
				endif; // childs
			
			?>	

		</div>
	</section>
	
	<?php get_footer(); ?>