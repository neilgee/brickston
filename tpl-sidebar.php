<?php

/*
Template Name: Sidebar
*/


get_header();

// Template Content
$post_id = get_the_ID();
$data = Bricks\Database::get_template_data( 'content' );

if ( is_array( $data ) && Bricks\Helpers::render_with_bricks() ) {
	echo '<main id="bricks-content-wrapper" class="bricks-content-wrapper">';
	echo Bricks\Frontend::render_data( $data, $post_id, 'content', true );
	echo '</main>';
} else {
	echo '<main class="sidebar-content-wrapper">';
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/page' );
		endwhile;
	endif;
	echo '<aside id="sidebar-blog_sidebar"><ul>';
	dynamic_sidebar('default');
	echo '</ul></aside>';
	echo '</main>';
}



get_footer();