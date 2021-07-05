<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	// Get the content outside of loop (necessary in builder)
	global $post;

	$content = $post->post_content;
	add_filter( 'the_content', 'wpautop' );
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );

	echo $content;
	?>

	<?php
	wp_link_pages( [
		'before'      => '<div class="bricks-posts-navigation-wrapper"><ul><span class="title">' . esc_html__( 'Pages:', 'bricks' ) . '</span>',
		'after'       => '</ul></div>',
		'link_before' => '<span>',
		'link_after'  => '</span>',
	] );
	?>
</article>
