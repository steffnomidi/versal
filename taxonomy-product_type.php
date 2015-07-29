	<?php get_header(); ?>
  
	<section class="fc">
	<div class="container catalog hidden-sm hidden-xs">
		<nav>
			<ul class="toplist htable_menu">
			<?php
			// придётся эти макароны комментировать, иначе трындец
			// кхм.. — Скрипт Вывода Верхнего Меню Категорий Товаров Для Внутренних Страниц
			
				// тут мы получаем список терминов первого уровеня типов
				$args = array(
					'hide_empty' => false,
					'parent' => 0,
					'orderby' => 'id'
					);
				$menu = get_terms( 'product_type', $args );
				
				// разбираем первый уровень
				$counter = 0; //счётчик используется ниже, дабы отделить первый элемент
				foreach( $menu as $item) {
					// получаем для каждого пункта потомков (второй уровень)
					$args = array(
						'hide_empty' => false,
						'parent' => $item->term_id,
						'orderby' => 'name',
						'order' => 'ASC'
					);
					$childs = get_terms( 'product_type', $args );
					
					// обнуляем итератор и таблицу
					$iter = -1;
					$table = '';
					if ($childs) { // если таки потомки имеются
						$table .= '<table class="children"><td>'; //создаём таблицу и открываем ячейку таблицы
						
						// перебираем потомков
						foreach($childs as $child) { 
							$iter++;
							if ( $iter == 14 ) {
								$table .= '</td><td>'; // если итератор кратен 14 закрываем ячейку и начинаем новую
								$iter = -1;	
								}
							$table .= ' 
								<a href="/product_type/'.$child->slug.'">'.$child->name.'</a>
							'; // таки добавляем ссылку
							
						} 
						$table.='</td></table>'; //Закрываем последнюю ячейку и таблицу
					}
					
					//if($counter++ > 0) {echo '<li class="delim"></li>';}
					// дальше выводим в элементе списка ссылку для первого уровня и все ячейки дочернего второго уровня, завёрнутые в тэйбл
					echo '
					<li class="'.$item->slug.'">
						<a href="/product_type/'.$item->slug.'">
							'.$item->name.' 
						</a>
						
						'.$table.'
						
					</li>
					';
				}
			?>
			</ul>
		</nav>
	</div>
	</section>

	<section>
		<div class="container">
			<?php
			
			$parent_category = $wp_query->queried_object->parent; // получаем ID категории родителя
			if ($parent_category == 0) : //значит категория первого уровня
			
				$args = array(
					'hide_empty' => false,
					'parent' => $wp_query->queried_object->term_id,
					'orderby' => 'name',
					'order' => 'ASC'
					
				);
				$childs = get_terms( 'product_type', $args );
				
				//echo '<pre>'.print_r($childs, true).'</pre>';
				
				if ($childs):
				
					echo '<div class="row">';
				
					foreach ($childs as $child):
						?>
						<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
							<div class="well subcat" data-id="<?php echo $child->term_id; ?>">
								<div class="thumb">
									<a href="/product_type/<?php echo $child->slug; ?>">
										<?php
										if (function_exists('z_taxonomy_image_url')) $thumb_url = z_taxonomy_image_url($child->term_id,'product');
										if ( $thumb_url ) {
											echo '<img src="'.$thumb_url.'" />';
										} else {
											echo '<img src="http://trenzal.net/wp-content/themes/anabol/img/no_image.png" />';
										}
										?>								
										<h4><?php echo $child->name; ?></h4>
									</a>
								</div>
							</div>
						</div>
						<?php
					endforeach;

					echo '</div>';

					
				endif; // childs
			
			else: //категория второго уровня
			
					$its_category_slug = $wp_query->queried_object->slug;
					
					$query_params = array(
						'showposts' => -1,
						'post_type' => 'product',
						'order'		=> 'ASC',
						'orderby' 	=> 'name',
						'tax_query' => array(
							array(
								'taxonomy' => 'product_type',
								'field'    => 'slug',
								'terms'    => $its_category_slug,
							),
						),
					);
					$top_query = new WP_Query($query_params);
					if($top_query->have_posts()) :
					?>
					<div class="row products">
						<?php
						while($top_query->have_posts()) : $top_query->the_post(); $first_post = $post->ID;
						?>
						<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 product">
							<div class="well subcat" data-id="">
							<div class="thumb">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail('product');
								} else {
									echo '<img src="http://trenzal.net/wp-content/themes/anabol/img/no_image.png" />';
								}
								?>
								<h4>
								<?php
									the_title();
								if ( get_field('second_string')) { echo '<br />' . get_field('second_string'); }
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
								 if (get_edit_post_link()) {
									echo '<a class="editlink" href="'.get_edit_post_link().'">змінити</a>';}else {}
									
							else :

								// no rows found

							endif;
							?>	
							</div>
						</div>
				
						<?php
						endwhile;
						?>
					</div>
					<?php
					endif;
					
			
			endif; //проверка уровня
			?>	

		</div>
	</section>
	
	<?php get_footer(); ?>