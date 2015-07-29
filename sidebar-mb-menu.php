<nav>
<?php


// получаем главное меню
$pages = get_pages(array(
	'parent' => -1,
	'sort_column' => 'menu_order'
	)	 
);

$pages_hierarchy = wp_page_menu( array('echo'=>false) );

// набиваем страницы в мобильное меню 
$mmenu = [];
foreach ($pages as $page) {
	if ( $page->post_parent == 0 ) {
		$mmenu[$page->post_name] = array(
			'ID' => $page->ID,
			'title' => $page->post_title,
			'link' => get_permalink($page->ID)
		);
	}
	else // post_parent != 0
	{
		$post_data = get_post($page->post_parent, ARRAY_A);
		$slug = $post_data['post_name'];
		$mmenu[$slug]['submenu'][] = array(
			'ID' => $page->ID,
			'title' => $page->post_title,
			'link' => get_permalink($page->ID)
		);
	}
}

if ($mmenu['glavnaya']) { //если есть главная страница (куда бы она делась-то)

	//набиваем меню категорий и подкатегорий товаров
	$product_type_menu = [];
	$terms = get_terms('product_type', array(
		'hide_empty' => false,
	));
	$mainterms = get_terms('product_type', array(
		'hide_empty' => false, 
		'parent' => 0,
		'orderby' => 'id'
	));

	foreach ($mainterms as $term) {
		$product_type_menu[$term->slug] = array(
			'ID' => $term->term_id,
			'title' => $term->name,
			'link' => '/product_type/'.$term->slug
		); 
		foreach($terms as $subterm) {
			if ( $term->term_id == $subterm->parent) {
				$product_type_menu[$term->slug]['childs'][$subterm->slug] = array(
					'ID' => $subterm->term_id,
					'title' => $subterm->name,
					'link' => '/product_type/'.$subterm->slug
				); 
			}
		}
	}
	$mmenu['glavnaya']['submenu'] = $product_type_menu;
} // end: if glavnaya



// тестовый вывод
print_r($pages_hierarchy);
?>

