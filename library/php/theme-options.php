<?php

// if ( is_admin() ) {
// 	add_action( 'admin_menu', 'as_theme_menu' );
// 	add_action( 'admin_init', 'as_register_theme_settings' );
// }

function as_theme_menu() {
	add_submenu_page( 'themes.php', 'Theme Settings', 'Settings', 'manage_options', 'as-ideal-theme-options', 'as_theme_options' );
}

function register_mysettings() {
  register_setting( 'option-group', 'option_array' );
}

$tabs_array = array(
	'home_page' => array( // Content Blocks
		array(

		),
		
		array(

		),
	),
	
	'theme_settings' => array(

	),
);


function as_theme_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	} ?>

	<div class="wrap">
		<div id="icon-themes" class="icon32">
			<br>
		</div>

		<h2 class="nav-tab-wrapper">
			<a class="nav-tab nav-tab-active">Home Page</a>
			<a class="nav-tab">Theme Settings</a>
		</h2>

		<div id="as-options-content" class="as-options-home-page">
			<div class="as-nav-tab-wrapper">
				<a class="as-nav-tab">Tab 1</a>
				<a class="as-nav-tab">Tab 2</a>
				<a class="as-nav-tab">Tab 3</a>
			</div>
		</div>

		<div id="as-options-content" class="as-options-theme-settings">

		</div>
	</div> <?php
}

