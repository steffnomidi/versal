	<?php get_header(); ?>
  
	<section class="global">
		  <div class="container">
			<div class="row">
				<div class="col-sm-5 col-md-4 col-lg-3">
					<div class="well catalog">
						<nav>
							<h3>Каталог товарiв</h3>
							<ul class="mainlist">
							<?php
							// придётся эти макароны комментировать, иначе трындец
							// кхм.. — Скрипт Вывода Левого Меню Для Главной Страницы
							
								// тут мы получаем список терминов первого уровеня типов
								$args = array(
									'hide_empty' => false,
									'parent' => 0,
									'orderby' => 'id'
									);
								$menu = get_terms( 'product_type', $args );
								
								// разбираем первый уровень
								foreach( $menu as $item) {
									// получаем для каждого пункта потомков (второй уровень)
									$args = array(
										'hide_empty' => false,
										'parent' => $item->term_id,
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
				</div>
				<div class="col-sm-7 col-md-8 col-lg-9 hidden-xs">
					<?php
					$carousel = get_posts('post_type=carousel');
					if ($carousel):
					?>
					<div class="owl-front-page">

						<?php
							foreach ($carousel as $slide):
							
						?>
						<div class="well slider" style="background-image: url(<?php echo get_field('image', $slide->ID) ?>)">
								<div class="inn">
									<div class="frame">
									<h3> <span></span><span> <?php echo $slide->post_title ?> </span><span></span> </h3>
									<p><?php echo $slide->post_content ?></p>
									<?php if (get_field('button_text', $slide->ID)): ?>
										<a href="<?php echo get_field('button_link', $slide->ID) ?>" class="btn"><?php echo get_field('button_text', $slide->ID) ?></a>
									<?php endif; //button ?>
									</div>
								</div>
						</div>
						

						<?php endforeach; // carousel ?>
						
					</div>
					<?php endif; // $carousel ?>
				</div>
			</div>
		  </div>
	</section>
	
	<?php get_footer(); ?>