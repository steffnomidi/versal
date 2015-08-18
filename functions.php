<?php

	add_theme_support('menus');
	add_theme_support('post-thumbnails');
	add_image_size ( 'product', 512, 512, true );
	add_image_size ( 'owlgallery-full', 1140, 700, true );
	
function vb_enqueue_style() {
	wp_enqueue_style( 'bs', get_bloginfo('template_url').'/css/bootstrap.min.css', false ); 
	wp_enqueue_style( 'owl', get_bloginfo('template_url').'/js/assets/owl.carousel.css', false ); 
	wp_enqueue_style( 'core', get_bloginfo('template_url').'/style.css', false ); 
}

function vb_enqueue_script() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bs', get_bloginfo('template_url').'/js/bootstrap.min.js', array('jquery'), false ); 
	wp_enqueue_script( 'owl', get_bloginfo('template_url').'/js/owl.carousel.min.js', array('jquery'), false ); 
	wp_enqueue_script( 'core', get_bloginfo('template_url').'/js/script.js', array('jquery', 'owl', 'bs'), false ); 
	
}

add_action( 'wp_enqueue_scripts', 'vb_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'vb_enqueue_script' );	



/* Регистрируем тип и таксономию для товара */
// Register Custom Post Type
function product_custom_type() {

	$labels = array(
		'name'                => 'Товары',
		'singular_name'       => 'Товар',
		'menu_name'           => 'Товары',
		'name_admin_bar'      => 'Товар',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'           => 'Все товары',
		'add_new_item'        => 'Добавить новый товар',
		'add_new'             => 'Добавить товар',
		'new_item'            => 'Новый товар',
		'edit_item'           => 'Изменить товар',
		'update_item'         => 'Обновить товар',
		'view_item'           => 'Промотреть товар',
		'search_items'        => 'Найти товар',
		'not_found'           => 'Не найдено',
		'not_found_in_trash'  => 'Не найдено в корзине',
	);
	$args = array(
		'label'               => 'product',
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'editor', 'author' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'menu_icon'			=> 'dashicons-products', 
	);
	register_post_type( 'product', $args );

}

// Hook into the 'init' action
add_action( 'init', 'product_custom_type', 0 );

// Register Custom Taxonomy
function custom_taxonomy_product() {

	$labels = array(
		'name'                       => 'Категории',
		'singular_name'              => 'Категория',
		'search_items'      => 'Найти категории',
		'all_items'         => 'Все категории',
		'parent_item'       => __( 'Родительская категория' ),
		'parent_item_colon' => __( 'Родительская категория:' ),
		'edit_item'         => __( 'Изменить категорию' ),
		'update_item'       => __( 'Обновить категорию' ),
		'add_new_item'      => __( 'Добавить новую категорию' ),
		'new_item_name'     => __( 'Имя новой категории' ),
		'menu_name'         => __( 'Категории товаров' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'product_type', array( 'product' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy_product', 0 );

function carousel_custom_type() {

	$labels = array(
		'name'                => 'Слайды',
		'singular_name'       => 'Слайд',
		'menu_name'           => 'Карусель',
		'name_admin_bar'      => 'Слайд',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'           => 'Все слайды',
		'add_new_item'        => 'Добавить новый слайд',
		'add_new'             => 'Добавить слайд',
		'new_item'            => 'Новый слайд',
		'edit_item'           => 'Изменить слайд',
		'update_item'         => 'Обновить слайд',
		'view_item'           => 'Промотреть слайд',
		'search_items'        => 'Найти слайд',
		'not_found'           => 'Не найдено',
		'not_found_in_trash'  => 'Не найдено в корзине',
	);
	$args = array(
		'label'               => 'carousel',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'menu_icon'			=> 'dashicons-images-alt2', 
	);
	register_post_type( 'carousel', $args );

}

// Hook into the 'init' action
add_action( 'init', 'carousel_custom_type', 0 );

/* add css for admin editing page */


add_action( 'admin_head', 'admin_css' );

function admin_css(){ ?>
     <style>
		table.acf_input tbody tr td.label {
			width: 100px;
		}
     </style>
<?php
}