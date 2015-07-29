<nav>
<div class="container ls-menu">
	<ul class="htable_menu big">
	<?php 

$args = array(
	'authors'      => '',
	'child_of'     => 171,
	'date_format'  => get_option('date_format'),
	'depth'        => 1,
	'echo'         => 0,
	'exclude'      => '',
	'include'      => '',
	'link_after'   => '',
	'link_before'  => '',
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'show_date'    => '',
	'sort_column'  => 'menu_order, post_title',
    'sort_order'   => '',
	'title_li'     => '', 
	'walker'       => new Walker_Page
); 
$childs = wp_list_pages( $args );	
echo $childs;

	?>
	</ul>
<?php 

// тут макаронная магия

// узнаём поcледнего родителя
$parent = get_post_ancestors($post->ID);
if (count($parent) != 0 ) { // если есть родители
	$parentid = $parent[0]; // получаем ближнего
	//echo $parentid;
	if ( $parentid == 180 or $post->ID == 180 ) { // если вторая страница или родитель есть вторая страница, 
		$menuid = 180; // то вторая менюжка
	} else { $menuid = 178; } // иначе — первая менюжка
} else { $menuid = 178; } // если нет родителей — тоже первая менюжка


	
	$childs = get_pages( array (
		'parent' =>$menuid,
		'sort_column' => 'ID'
		)
		);
	
	echo '<ul class="htable_menu with-icons">';
	
	foreach ($childs as $child) :
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($child->ID), 'full' );
		$icon_image = $thumb['0']; 
		$current_page_item = '';
		if ( $child->ID == get_the_ID() ) { $current_page_item = ' class="current_page_item"'; }
		?>
		
		<li<?php echo $current_page_item; ?>>
			<a href="<?php echo get_permalink($child->ID) ?>" style= "background-image: url(<?php echo $icon_image; ?>)">
				<?php echo $child->post_title ?>
			</a>
		</li>
		
		<?php
		
	endforeach; // childs
	
	echo '</ul>'; // htable
	
	?>
</div>	
</nav>