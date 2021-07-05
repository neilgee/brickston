<?php namespace Bricks; ?>

<main class="bricks-post-wrapper layout-default">
	<?php bricks_render_post_header(); ?>

	<div class="bricks-content-wrapper bricks-container">
		<div class="bricks-element-post-taxnomony">
		<?php
		$post_content = new Element_Post_Content();

		$post_content->load();

		$post_content->init();
		?>
		</div>

		<div class="bricks-element-post-author">
			<?php
			$post_author = new Element_Post_Author( [
				'settings' => [
					'avatar'  => true,
					'name'    => true,
					'website' => true,
					'bio'     => true,
				]
			] );

			$post_author->load();

			$post_author->init();
			?>
		</div>

		<div class="bricks-post-meta-wrapper">
			<div class="bricks-element-post-taxnomony">
			<?php
			$post_tags = new Element_Post_Taxonomy( [
				'settings' => [
					'style' => 'dark',
				],
			] );

			$post_tags->load();

			$post_tags->init();
			?>
			</div>

			<div class="bricks-element-post-sharing">
			<?php
			$post_sharing = new Element_Post_Sharing( [
				'settings' => [
					'items' => [
						['service' => 'facebook'],
						['service' => 'twitter'],
						['service' => 'google'],
						['service' => 'linkedin'],
						['service' => 'pinterest'],
						['service' => 'email'],
					],
					'brandColors' => true,
				],
			] );

			$post_sharing->load();

			$post_sharing->init();
			?>
			</div>
		</div>

		<div class="bricks-element-related-posts">
		<?php
		echo '<h3>' . esc_html__( 'Related posts', 'bricks' ) . '</h3>';

		$related_posts = new Element_Related_Posts( [
			'settings' => [
				// 'noImage'       => true,
				'content'       => [
					[
						'dynamicData' => '{post_title:link}',
						'tag'         => 'h3',
					],
					['dynamicData' => '{post_date}'],
				],
			],
		] );

		$related_posts->load();

		$related_posts->init();
		?>
		</div>

		<div class="bricks-element-post-comments">
		<?php
		$post_comments = new Element_Post_Comments( [
			'settings' => [
				'title'             => true,
				'avatar'            => true,
				'submitButtonStyle' => 'primary',
			],
		] );

		$post_comments->load();

		$post_comments->init();
		?>

		<div class="bricks-element-post-navigation">
		<?php
		$post_navigation = new Element_Post_Navigation( [
			'settings' => [
				'image' => true,
				'title' => true,
				'label' => true,
			],
		] );

		$post_navigation->load();

		$post_navigation->init();
		?>
		</div>
	</div>
</main>
