<?php

require_once ($_SERVER ['DOCUMENT_ROOT'] . '/wp-load.php');

function Reload_Blogs () 
{
    $Language = sanitize_text_field ($_GET ['language']);
    switch_to_locale ($Language);
    ob_start ();
    Get_Blogs ($Language);
    $Blogs_HTML = ob_get_clean ();
    echo 'Hey!'; 
    wp_die ();
}

add_action ('wp_ajax_reload_blogs', 'Reload_Blogs');

?>