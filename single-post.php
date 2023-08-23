<?php 

/*
	* Template Name: Blog Post
	* Template Post Type: post
*/

get_header (); 

?>

<?php
	while (have_posts()) 
	{
		the_post ();
		?>
		<article>
			<h1><?php the_title (); ?></h1>
			<div class="Blog_Container">
				<?php the_content (); ?>
			</div>
			<?php comments_template (); ?>
		</article>
		<?php
	}
?>

<?php get_footer(); ?>