<?php

global $home_section_query;

$home_section_args = array(
	'post_type' => 'home-section',
	'posts_per_page' => 4,
	'order_by' => 'menu_order',
	'order' => 'ASC',
);
$home_section_query = new WP_Query($home_section_args);