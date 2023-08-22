<?php

function Add_CSS ()
{
	wp_register_style ('Fonts', get_template_directory_uri () . '/styles/Fonts.css', false);
	wp_enqueue_style ('Fonts');
	wp_register_style ('Global', get_template_directory_uri () . '/styles/Global.css', false);
	wp_enqueue_style ('Global');
	wp_register_style ('Index', get_template_directory_uri () . '/styles/Index.css', false);
	wp_enqueue_style ('Index');
	wp_register_style ('Utility', get_template_directory_uri () . '/styles/Utility.css', false);
	wp_enqueue_style ('Utility');
}

add_action ('wp_enqueue_scripts', 'Add_CSS');

function Add_JavaScript ()
{
	wp_register_script ('Index', get_template_directory_uri () . '/Index.js', true);
	wp_enqueue_script ('Index');
}
add_action ('wp_enqueue_scripts', 'Add_JavaScript');

function Send_Email ()
{
	if (isset ($_POST))
	{
		$Name = $_POST ['Name'];
		$Email = $_POST ['Email'];
		$Subject = $_POST ['Subject'];
		$Message = $_POST ['Message'];
		$To = 'v.shein@uec-env.com.sa';
		$Headers = 'From: '. $Email . '\r\n' . 'Reply-To: ' . $Email . '\r\n';
		$Sending_Status = wp_mail ($To, $Subject, strip_tags ($Message), $Headers);
		if ($Sending_Status)
		{
			print_r ('We got your message! Our representative will contact you in a few business days.');
		}
		else 
		{
			print_r ('There was an error sending message');       
		}
	}
}
add_action('wp_ajax_Send_Email', 'Send_Email');
add_action('wp_ajax_nopriv_Send_Email', 'Send_Email');

?>