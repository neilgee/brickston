<main id="bricks-content-wrapper" class="bricks-content-wrapper bricks-container layout-default">
	<?php
	if ( have_posts() ) {
		global $wp_query;

		$query_vars = $wp_query->query_vars;
		$query_vars['post_type'] = is_home() ? 'post' : 'any';

		$current_page = $query_vars['paged'];

		$post_content = new Bricks\Element_Posts( [
			'settings' => [
				'query' => $query_vars,
				'layout' => 'grid',
				'columns' => 2,
				'gutter' => 30,
				'fields' => [
					[
						'dynamicData' => '{post_title}',
						'tag'         => 'h3',
					],
					[
						'dynamicData' => '{post_date}',
					],
					[
						'dynamicData' => '{post_excerpt:20}',
					],
				],
				'postsNavigation' => true,
				]
		] );

		$post_content->load();

		$post_content->init();

		// Helpers::posts_navigation( $current_page, $total_pages );
	} else {
		$no_posts_html = '<div class="bricks-no-posts-wrapper">';
		$no_posts_html .= '<h3 class="title">' . esc_html__( 'Nothing found.', 'bricks' ) . '</h3>';

		if ( current_user_can( 'publish_posts' ) ) {
			$no_posts_html .= '<p>';
			$no_posts_html .= esc_html__( 'Ready to publish your first post?', 'bricks' );
			$no_posts_html .= ' <a href="' . admin_url( 'post-new.php' ) . '">' . esc_html__( 'Get started here', 'bricks' ) . '</a>.';
			$no_posts_html .= '</p>';
		}

		$no_posts_html .= '</div>';

		echo $no_posts_html;
	}
	?>
</main>
