<?php

/*----------------------------------------------------------
                    The Registries
----------------------------------------------------------*/
add_action( 'init', 'as_register_custom_post_types');
	function as_register_custom_post_types() {
		register_post_type( 'ihn-measurements',
			array(
				'labels' => array(
					'name' => 'Weights and Measurements',
					'singular_name' => 'Weights and Measurement',
					'add_new' => 'Add New',
					'add_new_item' => 'Add New Weights and Measurement',
					'edit_item' => 'Edit Weights and Measurement',
					'new_item' => 'New Weights and Measurement',
					'all_items' => 'All Weights and Measurements',
					'view_item' => 'View Weights and Measurement',
					'search_items' => 'Search Weights and Measurements',
					'not_found' =>  'No Weights and Measurements found',
					'not_found_in_trash' => 'No Weights and Measurements found in Trash', 
					'parent_item_colon' => '',
					'menu_name' => 'Weights and Measurements'
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
				'supports' => array( 'title'),
				'has_archive' => false,
				'rewrite' => array( 'slug' => 'ihn-measurements' ),
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
add_action( 'admin_init', 'add_ihn_measurements_meta_box' );
function add_ihn_measurements_meta_box(){
	add_meta_box("ihn_measurements_meta", "Measurements", "ihn_measurements_fields", "ihn-measurements", "normal", "core");
}

function ihn_measurements_fields() {
	global $post;
	$custom = get_post_custom($post->ID);
	$measurements = array(
		'current_weight' => $custom["current_weight"][0],
		'chest' => $custom["chest"][0],
		'true_waist' => $custom["true_waist"][0],
		'belly_button' => $custom["belly_button"][0],
		'hips' => $custom["hips"][0],
		'right_arm' => $custom["right_arm"][0],
		'left_arm' => $custom["left_arm"][0],
		'right_thigh' => $custom["right_thigh"][0],
		'left_thigh' => $custom["left_thigh"][0],
		'neck' => $custom["neck"][0],
		'clothing_size' => $custom["clothing_size"][0]
	); ?>

	<p>
		<label><input type="number" min="0" max="999" name="current_weight" value="<?php echo $measurements['current_weight'] ?>">Current Weight</label></br>
		<label><input type="number" min="0" max="999" name="chest" value="<?php echo $measurements['chest'] ?>">Chest</label></br>
		<label><input type="number" min="0" max="999" name="true_waist" value="<?php echo $measurements['true_waist'] ?>">True Waist</label></br>
		<label><input type="number" min="0" max="999" name="belly_button" value="<?php echo $measurements['belly_button'] ?>">Belly Button</label></br>
		<label><input type="number" min="0" max="999" name="hips" value="<?php echo $measurements['hips'] ?>">Hips</label></br>
		<label><input type="number" min="0" max="999" name="right_arm" value="<?php echo $measurements['right_arm'] ?>">Right Arm</label></br>
		<label><input type="number" min="0" max="999" name="left_arm" value="<?php echo $measurements['left_arm'] ?>">Left Arm</label></br>
		<label><input type="number" min="0" max="999" name="right_thigh" value="<?php echo $measurements['right_thigh'] ?>">Right Thigh</label></br>
		<label><input type="number" min="0" max="999" name="left_thigh" value="<?php echo $measurements['left_thigh'] ?>">Left Thigh</label></br>
		<label><input type="number" min="0" max="999" name="neck" value="<?php echo $measurements['neck'] ?>">Neck</label></br>
		<label><input type="number" min="0" max="999" name="clothing_size" value="<?php echo $measurements['clothing_size'] ?>">Clothing Size</label></br>
	</p>
	<?php
}

add_action ('save_post', 'save_measurements_meta');
add_action ('publish_post', 'save_measurements_meta');


function save_measurements_meta(){
    global $post;
    update_post_meta($post->ID, "current_weight", $_POST["current_weight"]);
    update_post_meta($post->ID, "chest", $_POST["chest"]);
    update_post_meta($post->ID, "true_waist", $_POST["true_waist"]);
    update_post_meta($post->ID, "belly_button", $_POST["belly_button"]);
    update_post_meta($post->ID, "hips", $_POST["hips"]);
    update_post_meta($post->ID, "right_arm", $_POST["right_arm"]);
    update_post_meta($post->ID, "left_arm", $_POST["left_arm"]);
    update_post_meta($post->ID, "right_thigh", $_POST["right_thigh"]);
    update_post_meta($post->ID, "left_thigh", $_POST["left_thigh"]);
    update_post_meta($post->ID, "neck", $_POST["neck"]);
    update_post_meta($post->ID, "clothing_size", $_POST["clothing_size"]);
}
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




