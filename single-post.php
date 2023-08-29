<?php 

/*
	* Template Name: Blog Post
	* Template Post Type: post
*/

get_header (); 

?>

<?php
	while (have_posts ()) 
	{
		the_post ();
		?>
		<article class="Blog_Container Background_Color_1">
			<h1><?php the_title (); ?></h1>
			<?php the_content (); ?>
			<?php comments_template (); ?>
		</article>
		<?php
	}
?>

<?php get_footer(); ?>