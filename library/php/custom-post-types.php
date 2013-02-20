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
				'menu_position' => 26,
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

		register_post_type( 'ihn-coach-notes',
			array(
				'labels' => array(
					'name' => 'Coaches Notes',
					'singular_name' => 'Coaches Note',
					'add_new' => 'Add New',
					'add_new_item' => 'Add New Coaches Note',
					'edit_item' => 'Edit Coaches Note',
					'new_item' => 'New Coaches Note',
					'all_items' => 'All Coaches Notes',
					'view_item' => 'View Coaches Notes',
					'search_items' => 'Search Coaches Notes',
					'not_found' =>  'No Coaches Notes found',
					'not_found_in_trash' => 'No Coaches Notes found in Trash', 
					'parent_item_colon' => '',
					'menu_name' => 'Coaches Notes'
				),
				'description' => 'This post type is for the four different sections on the home page.',
				'public' => false,
				'exclude_from_search' => true,
				'publicly_queryable' => false,
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'menu_position' => 25,
				'menu_icon' => null,
				'map_meta_cap' => true,
				'hierarchical' => false,
				'supports' => array( 'title','editor','revisions','comments'),
				'has_archive' => false,
				'rewrite' => array( 'slug' => 'ihn-coaches-notes' ),
				'query_var' => false,
				'can_export' => true,
			)
		);

		register_post_type( 'ihn-md-notes',
			array(
				'labels' => array(
					'name' => 'MD Notes',
					'singular_name' => 'MD Note',
					'add_new' => 'Add New',
					'add_new_item' => 'Add New MD Note',
					'edit_item' => 'Edit MD Note',
					'new_item' => 'New MD Note',
					'all_items' => 'All MD Notes',
					'view_item' => 'View MD Note',
					'search_items' => 'Search MD Notes',
					'not_found' =>  'No MD Notes found',
					'not_found_in_trash' => 'No MD Notes found in Trash', 
					'parent_item_colon' => '',
					'menu_name' => 'MD Notes'
				),
				'description' => 'This post type is for the four different sections on the home page.',
				'public' => false,
				'exclude_from_search' => true,
				'publicly_queryable' => false,
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'menu_position' => 27,
				'menu_icon' => null,
				'map_meta_cap' => true,
				'hierarchical' => false,
				'supports' => array( 'title','editor','revisions','comments'),
				'has_archive' => false,
				'rewrite' => array( 'slug' => 'ihn-md-notes' ),
				'query_var' => false,
				'can_export' => true,
			)
		);

		// Add another custom post type here. Prolly don't need another until version 2.0.
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

//coach note meta
add_action( 'admin_init', 'as_ihn_coach_meta' );
function as_ihn_coach_meta () {
	add_meta_box("ihn_coach_meta", "Coaches Notes", "as_ihn_coach_fields", "ihn-coach-notes", "normal", "core");
}
function as_ihn_coach_fields () {
	global $post;
	$values = get_post_custom( $post->ID );
	$coach_notes = array(
		'journal' => $values["journal"][0],
		'protocol' => $values["protocol"][0],
		'coach-selected' => $values["coach-selected"][0],
		'actual-coach' => $values["actual-coach"][0]
	); ?>

	<p>
		<label>Did client bring and fill out journal?<br>
			<input type="radio" name="journal" value="<?php echo $coach_notes['journal'] ?>"> Yes<br>
			<input type="radio" name="journal" value="<?php echo $coach_notes['journal'] ?>"> No<br>
		</label><br>
		<label>Did client follow protocol as prescribed?<br>
			<input type="radio" name="protocol" value="<?php echo $coach_notes['protocol'] ?>"> Yes<br>
			<input type="radio" name="protocol" value="<?php echo $coach_notes['protocol'] ?>"> No<br>
		</label><br>
		<label>Coach Selected<br>
			<select name="coach-selected">
				<option value="<?php echo $coach_notes['coach-selected'] ?>"> <?php wp_dropdown_users(array('name' => 'coach-selected')); ?></option>
			</select><br>
		</label><br>
		<label> This was the logged in coach. It may be different than the selected coach above.<br>
			<input type="text" readonly="readonly" name="actual-coach" value="<?php echo $coach_notes['actual-coach'] ?>">
		</label>
	</p>
	<?php
}
	add_action ('save_post', 'save_coach_meta');
	add_action ('publish_post', 'save_coach_meta');

	function save_coach_meta () {
		global $post;
		update_post_meta($post->ID, "journal", $_POST["journal"]);
    	update_post_meta($post->ID, "protocol", $_POST["protocol"]);
    	update_post_meta($post->ID, "coach-selected", $_POST["coach-selected"]);
    	update_post_meta($post->ID, "actual-coach", $_POST["actual-coach"]);
	}

//md note meta
add_action( 'admin_init', 'as_ihn_md_meta' );
function as_ihn_md_meta () {
	add_meta_box("ihn_md_meta", "MD Notes", "as_ihn_md_fields", "ihn-md-notes", "normal", "core");
}
function as_ihn_md_fields () {
	global $post;
	$values = get_post_custom( $post->ID );
	$md_notes = array(
		'actual-login' => $values["actual-login"][0]
	); ?>

	<p>
		<label> This was the logged in user that created this note. It may differ from the actual person that wrote the note.<br>
			<input type="text" readonly="readonly" name="actual-login" value="<?php echo $md_notes['actual-login'] ?>">
		</label>
	</p>
	<?php
}
add_action ('save_post', 'save_md_meta');
add_action ('publish_post', 'save_md_meta');
function save_md_meta () {
	global $post;
	update_post_meta($post->ID, "actual-login", $_POST["actual-login"]);
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




