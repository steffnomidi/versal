<?php // сперва определим, на какой мы странице

	$the_product = $the_product_type = "";
	if (is_tax()) {
		$the_product_type = $wp_query->query['product_type']; // slug типа продуктов
		}
	if (is_single()) {
		$the_product = $wp_query->query['product']; // slug продукта
		$type_as_array = get_the_terms( $post->ID, 'product_type');
		$the_product_type = $type_as_array[0]->slug; // slug типа продуктов
		}
?>

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
				//$counter = 0; //счётчик используется ниже, дабы отделить первый элемент
				foreach( $menu as $item) {
					
				
					// получаем для каждого пункта список товаров (второй уровень)
					$args = array(
						'posts_per_page' => -1,
						'post_type' => 'product',
						'hide_empty' => false,
						'tax_query' => array(
							array(
								'taxonomy' => 'product_type',
								'field'    => 'id',
								'terms'    => $item->term_id,
							),
						),
						'orderby' => 'name',
						'order' => 'ASC'
					);
					$prods = get_posts( $args );
					
					// обнуляем итератор и таблицу
					$iter = -1;
					$table = '';
					if ($prods) { // если таки потомки имеются
						$table .= '<table class="children"><td>'; //создаём таблицу и открываем ячейку таблицы
						
						// перебираем потомков
						foreach($prods as $prod) { 
							$iter++;
							if ( $iter == 14 ) {
								$table .= '</td><td class="delim"><hr /></td><td>'; // если итератор кратен 14 закрываем ячейку и начинаем новую
								$iter = -1;	
								}
							if ($prod->post_name == $the_product ) {$active = " class=\"active\""; } else { $active = ""; }
							$table .= ' 
								<a href="/product/'.$prod->post_name . '"' . $active. '>' . $prod->post_title . '</a>
							'; // таки добавляем ссылку
							
						} 
						$table.='</td></table>'; //Закрываем последнюю ячейку и таблицу
					}
					

					// дальше выводим в элементе списка ссылку для первого уровня и все ячейки дочернего второго уровня, завёрнутые в тэйбл
					if ($item->slug == $the_product_type ) {$active = " class=\"active\""; } else { $active = ""; }
					
					echo '
					<li class="'.$item->slug.'">
						<a href="/product_type/'.$item->slug.'"'.$active.'>
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
	
	<?php
	//А сдесь будет костыль. Не придумал способа элегантней. Некогда было.
	// подсвечиваем менюху
	?>
	<script>
		jQuery(document).ready( function($) {
			$('.menu-item-228>a').css('color', '#339933');
		} );
	</script>
	