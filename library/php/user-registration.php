<?php
global $wpdb, $table_prefix;

$entry_data = $wpdb->get_results( "
	SELECT id, name
	FROM ihn_frm_items
	WHERE form_id = 6
" );

// print_r($entry_data);
$results = array();
foreach ($entry_data as $entry) {
	global $entryID;
	$entryID = $entry->id;
	$entry_data_email[$entryID] = $wpdb->get_results( "
		SELECT meta_value
		FROM ihn_frm_item_metas
		WHERE item_id = $entryID 
			AND field_id = 85
	" );

	$entry_data_last[$entryID] = $wpdb->get_results( "
		SELECT meta_value
		FROM ihn_frm_item_metas
		WHERE item_id = $entryID 
			AND field_id = 84
	" );

	$entry_data_first[$entryID] = $wpdb->get_results( "
		SELECT meta_value
		FROM ihn_frm_item_metas
		WHERE item_id = $entryID 
			AND field_id = 83
	" );

	$results[] = array(
		'first' => $entry_data_first[$entryID][0]->meta_value,
		'last' => $entry_data_last[$entryID][0]->meta_value,
		'email' => $entry_data_email[$entryID][0]->meta_value,
	);
}

foreach($results as $array) {
	global $entryID;
	if( !(email_exists( strtolower($array['email'] ))) ) {
		wp_create_user( strtolower($array['email']), wp_generate_password(), strtolower($array['email']));
	} else {
		// $userID = strtolower($array['email'] );
		// wp_insert_user( array(
		// 		'ID' => $userID,
		// 		'first_name' => $array['first'],
		// 		'last_name' => $array['last'],
		// 		'display_name' => $array['first'] . ' ' . $array['first'],
		// 		'role' => 'ihn_client',
		// 	)
		// );
	};
};