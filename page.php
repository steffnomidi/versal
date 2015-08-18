	<?php get_header(); the_post(); ?>
	<div class="hidden-xs hidden-sm">
	<?
		// select subheader with menu
		
		// detect Praancestor slug
		$parent = array_reverse(get_post_ancestors($post->ID));
		if (count($parent) == 0 ) {$first_parent = get_page($parent); }
		else { $first_parent = get_page($parent[0]); }
		$praancestor_id = $first_parent->ID;
		
		//load Submenu
		if ($praancestor_id == '171') get_sidebar('ls-menu');
		if ($praancestor_id == '167') get_sidebar('gz-menu');
		
	?>
	</div>
	<section>

	<div class="page">
			<!--h1>It's page!</h1-->
			<?php the_content(); ?>
		

		
		<?php /* если прикреплены таблицы:*/ ?>
				<?php 
					if( have_rows('tables') ):
					 ?>
						<div class="tables">
						<?php 
						

						while ( have_rows('tables') ) : the_row();
							
							echo '<h2>'.get_sub_field('title').'</h2>';
							echo "<div class=\"post-table\"><table class=\"container\">";
							echo "<thead>
								<tr>
									<th class=\"text-center vid\"><span class=\"vid\">Вид робiт</span></th>
									<th class=\"text-center ed\"><span class=\"ed\">Одиниця</span></th>
									<th class=\"text-center price\"><span class=\"price\">Цiна</span></th>
								</tr>
								</thead>";
							while ( have_rows('table') ) : 
								the_row();
								$sub = get_sub_field('sub');
								$vid = get_sub_field('vid');
								$span = get_sub_field('span');
								$ed = get_sub_field('ed');
								$price = get_sub_field('price');
								if ($price) { $price = $price . ' грн.'; }

								if ($sub) {$trclass = ' class="sub"';} else {$trclass = '';}
								
								if (!$span) {
									echo"
								<tr$trclass>
									<td><div><span class=\"vid\">$vid</span></div></td>
									<td class=\"text-center\"><div><span class=\"ed\">$ed</span></div></td>
									<td class=\"text-center\"><div><span class=\"price\">$price</span></div></td>
								</tr>
									";
								}else{
									echo"
								<tr$trclass>
									<td><div><span class=\"vid\">$vid</span></div></td><td colspan=\"2\" class=\"text-center\"><div><span>$ed</span></div></td>
								</tr>
									";
								}
			
							endwhile;							
							echo "</table>";
							if ($desc = get_sub_field('desc')) {echo "<div class=\"description container\">$desc</div>";}
							echo "</div>";
						endwhile;
						?>
						</div>
					<?php 

							
					else :
						

					endif;

				?>
	</div>
	</section>
	
	
	<?php get_footer(); ?>