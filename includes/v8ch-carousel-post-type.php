<?php

// Security check
defined( 'ABSPATH' ) or die( 'Fail on direct access' );

function v8ch_carousel_post_type() {
	register_post_type( 'slide',
		array(
			'labels'              => array(
				'name'               => __( 'Slides', 'v8ch-carousel-widget' ),
				'singular_name'      => __( 'Slide', 'v8ch-carousel-widget' ),
				'all_items'          => __( 'All Slides', 'v8ch-carousel-widget' ),
				'add_new'            => __( 'Add New Slide', 'v8ch-carousel-widget' ),
				'add_new_item'       => __( 'Add New Slide', 'v8ch-carousel-widget' ),
				'edit'               => __( 'Edit Slide', 'v8ch-carousel-widget' ),
				'edit_item'          => __( 'Edit Slides', 'v8ch-carousel-widget' ),
				'new_item'           => __( 'New Slide', 'v8ch-carousel-widget' ),
				'view_item'          => __( 'View Slide', 'v8ch-carousel-widget' ),
				'search_items'       => __( 'Search Slides', 'v8ch-carousel-widget' ),
				'not_found'          => __( 'No Slides found in the Database.', 'v8ch-carousel-widget' ),
				'not_found_in_trash' => __( 'No Slides found in Trash', 'v8ch-carousel-widget' ),
				'parent_item_colon'  => ''
			),
			'description'         => __( 'Single slide for use in a carousel widget. Assign carousels to the slide, then enter the a carousel slug into the widget to display slides in a widget area.', 'v8ch-carousel-widget' ),
			'public'              => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'query_var'           => true,
			'menu_position'       => 8,
			'menu_icon'           => 'dashicons-book',
			'rewrite'             => array( 'slug' => 'slide', 'with_front' => false ),
			'has_archive'         => 'slide',
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'supports'            => array( 'title', 'thumbnail', 'editor', 'revisions', )
		)
	);

	register_taxonomy( 'carousels',
		array( 'slide' ),
		array(
			'hierarchical'      => false,
			'labels'            => array(
				'name'              => __( 'Carousels', 'v8ch-carousel-widget' ),
				'singular_name'     => __( 'Carousel', 'v8ch-carousel-widget' ),
				'search_items'      => __( 'Search Carousels', 'v8ch-carousel-widget' ),
				'all_items'         => __( 'All Carousels', 'v8ch-carousel-widget' ),
				'parent_item'       => __( 'Parent Carousel', 'v8ch-carousel-widget' ),
				'parent_item_colon' => __( 'Parent Carousel:', 'v8ch-carousel-widget' ),
				'edit_item'         => __( 'Edit Carousel', 'v8ch-carousel-widget' ),
				'update_item'       => __( 'Update Carousel', 'v8ch-carousel-widget' ),
				'add_new_item'      => __( 'Add New Carousel', 'v8ch-carousel-widget' ),
				'new_item_name'     => __( 'New Carousel Name', 'v8ch-carousel-widget' ),
			),
			'show_admin_column' => true,
			'show_ui'           => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'carousels' ),
		)
	);

	register_taxonomy_for_object_type( 'carousels', 'slides' );

}

add_action( 'init', 'v8ch_carousel_post_type' );