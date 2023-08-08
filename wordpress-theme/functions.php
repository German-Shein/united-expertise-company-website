<?php

function Add_CSS ()
{
	wp_register_style ('Fonts', get_template_directory_uri () . '/styles/Fonts.css', false);
	wp_enqueue_style ('Fonts');
	wp_register_style ('Global', get_template_directory_uri () . '/styles/Global.css', false);
	wp_enqueue_style ('Global');
	wp_register_style ('Index', get_template_directory_uri () . '/styles/Index.css', false);
	wp_enqueue_style ('Index');
	wp_register_style ('Fonts', get_template_directory_uri () . '/styles/Utility.css', false);
	wp_enqueue_style ('Utility');
}

add_action ('wp_enqueue_scripts', 'Add_CSS');

function Add_JavaScript ()
{
	wp_register_script ('Index', get_template_directory_uri () . '/Index.js', 1.1, true);
	wp_enqueue_script ('Index');
}
add_action ('wp_enqueue_scripts', 'Add_JavaScript');

?>