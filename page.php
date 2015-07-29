	<?php get_header(); ?>
	<?
		// select subheader with menu
		
		// detect Praancestor slug
		$parent = array_reverse(get_post_ancestors($post->ID));
		if (count($parent) == 0 ) {$first_parent = get_page($parent); }
		else { $first_parent = get_page($parent[0]); }
		$praancestor_id = $first_parent->ID;
		
		if ($praancestor_id == '171') get_sidebar('ls-menu');
		if ($praancestor_id == '167') get_sidebar('gz-menu');
		
	?>
	
	<section>

	<div class="">
			<!--h1>It's page!</h1-->
			<?php the_content(); ?>
		

		
		<?php /* если прикреплены таблицы:*/ ?>
		<div class="tables">
				<?php 
					if ( get_field('tables') ) {
						$tables = get_field('tables');
						foreach ($tables as $table) {
							echo '
							<h2>' .do_shortcode('[table-info id='.$table['table'].' field="name" /]'). '</h2>
							<div class="post-table">
								<div class="container">
									' .do_shortcode('[table id='.$table['table'].' /]'). '
								</div>
							</div>'; 
						}
					}
				?>
		</div>

	</section>
	
	
	<?php get_footer(); ?>