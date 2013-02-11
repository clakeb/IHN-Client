<?php

/*----------------------------------------------------------
                    The Registries
----------------------------------------------------------*/
add_action( 'init', 'as_register_custom_post_types');
	function as_register_custom_post_types() {
		register_post_type( 'home-section',
			array(
				'labels' => array(
					'name' => 'Home Sections',
					'singular_name' => 'Home Section',
					'add_new' => 'Add New',
					'add_new_item' => 'Add New Home Section',
					'edit_item' => 'Edit Home Section',
					'new_item' => 'New Home Section',
					'all_items' => 'All Home Sections',
					'view_item' => 'View Home Section',
					'search_items' => 'Search Home Sections',
					'not_found' =>  'No Home Sections found',
					'not_found_in_trash' => 'No Home Sections found in Trash', 
					'parent_item_colon' => '',
					'menu_name' => 'Home Sections'
				),
				'description' => 'This post type is for the four different sections on the home page.',
				'public' => false,
				'exclude_from_search' => true,
				'publicly_queryable' => false,
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'menu_position' => null,
				'menu_icon' => null,
				'map_meta_cap' => true,
				'hierarchical' => false,
				'supports' => array( 'title', 'thumbnail', 'page-attributes' ),
				'register_meta_box_cb' => None,
				'has_archive' => false,
				'rewrite' => array( 'slug' => 'home-section' ),
				'query_var' => false,
				'can_export' => true,
			)
		);

		// Add another custom post type here.
	}


/*----------------------------------------------------------
                    The Taxonomies
----------------------------------------------------------*/
// add_action( 'init', 'as_register_custom_taxonomies');
// 	function as_register_custom_taxonomies() {
// 		// Add any custom taxonomies here.
// 	}

/*----------------------------------------------------------
                    The Meta Boxes
----------------------------------------------------------*/
	// Add any custom meta boxes here.


/*----------------------------------------------------------
                    The Contextual Help
----------------------------------------------------------*/
	// Add any wp-admin help boxes here.

/*----------------------------------------------------------
                    The Flush
----------------------------------------------------------*/
add_action( 'after_switch_theme', 'as_rewrite_flush' );
function as_rewrite_flush() {
    flush_rewrite_rules();
}




