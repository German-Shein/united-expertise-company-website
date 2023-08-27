<?php

define ('API_Endpoint', get_template_directory_uri () . '/API.php');

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
add_action ('wp_ajax_Send_Email', 'Send_Email');
add_action ('wp_ajax_nopriv_Send_Email', 'Send_Email');

function Get_Blogs ($Language_Code)
{
    $Query = new WP_Query (array ('post_type' => 'post', 'orderby' => 'date', 'order' => $Language_Code === 'ar' ? 'ASC' : 'DESC'));
    if ($Query -> have_posts ()) 
	{
		$Post_Number = 1;
        while ($Query -> have_posts ())
		{
            $Query -> the_post ();
			$Language = array_map (fn ($Value): String => $Value -> name, get_the_category ()) [0];
			echo $Language_Code;
			if ($Language_Code == 'en' && $Language == 'English')
			{
				echo '<a class="Blog_Card Cover_Background Text_Color_2" href="' . get_permalink () . '" rel="prev" style="background-image: url(' . get_template_directory_uri () . '/assets/images/blog-card-' . $Post_Number . '.jpg);" target="_blank">';
					echo '<div class="Blog_Card_Overlay Background_Color_3">';
						echo '<span></span>';
						echo '<h3 class="Blog_Title Central_Text_Alignment Text_Color_2" id="Blog_Title_' . $Post_Number .'">' . get_the_title () . '</h3>';
						echo '<span class="Blog_Date Text_Color_2" id="Blog_Date_' . $Post_Number .'">' . get_the_date ('F j, Y') .'</span>';
					echo '</div>';
					echo '<div class="Blog_Card_Hover_Overlay Background_Color_3 Padding_2rem">';
						echo '<div class="Blog_Card_Hover_Overlay_Content Text_Color_2">';
							echo '<h4>Click to read</h4>';
							echo '<p>' . get_the_title () . '</p>';
						echo '</div>';
					echo '</div>';
				echo '</a>';
				$Post_Number = $Post_Number + 1;
			}
			else if ($Language_Code == 'ar' && $Language == 'Arabic')
			{
				echo '<a class="Blog_Card Cover_Background Text_Color_2" href="' . get_permalink () . '" rel="prev" style="background-image: url(' . get_template_directory_uri () . '/assets/images/blog-card-' . $Post_Number . '.jpg);" target="_blank">';
					echo '<div class="Blog_Card_Overlay Background_Color_3">';
						echo '<span></span>';
						echo '<h3 class="Blog_Title Central_Text_Alignment Text_Color_2 Arabic_Header" id="Blog_Title_' . $Post_Number .'">' . get_the_title () . '</h3>';
						echo '<span class="Blog_Date Text_Color_2 Arabic_Text" id="Blog_Date_' . $Post_Number .'">' . get_the_date ('F j, Y') .'</span>';
					echo '</div>';
					echo '<div class="Blog_Card_Hover_Overlay Background_Color_3 Padding_2rem">';
						echo '<div class="Blog_Card_Hover_Overlay_Content Text_Color_2">';
							echo '<h4 class="Arabic_Header">انقر للقراءة</h4>';
							echo '<p class="Arabic_Text">' . get_the_title () . '</p>';
						echo '</div>';
					echo '</div>';
				echo '</a>';
				$Post_Number = $Post_Number + 1;
			}
        }
    }
    wp_reset_postdata ();
}

?>