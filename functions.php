<?php 
/**
 * Brickston Theme
 *
 * @package brickston
 * @author  Neil Gowran
 * @license GPL-2.0+
 * @link    http://wpbeaches.com/
 */

/**
 * Register/enqueue custom scripts and styles
 */
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'bricks-child', get_stylesheet_uri(), ['bricks-frontend'], filemtime( get_stylesheet_directory() . '/style.css' ) );
} );


/**
 * Include all custom BricksBuilder functions
 * @since 1.0.0
 */
include_once( get_stylesheet_directory() . '/includes/bricksbuilder.php' );

/**
 * Clean up WP Head
 * @since 1.0.0
 */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * WOO Customizer Options
 * Load in WooCommerce customizer options and functions
 * @since 1.0.0
 */
if ( class_exists( 'WooCommerce' ) ) {
	include_once( get_stylesheet_directory() . '/includes/woocommerce/customizer-woo.php' );
	include_once( get_stylesheet_directory() . '/includes/woocommerce/woocommerce.php' );
}

/**
 * Add Customizer Options and CSS output.
 * @since 1.0.0
 */
require_once( get_stylesheet_directory() . '/includes/customizer-panels.php' );
require_once( get_stylesheet_directory() . '/includes/inline-css-style.php' );
require_once( get_stylesheet_directory() . '/includes/inline-css-style-login.php' );



/**
 * Client Logo for WP Login and backend dashboard admin clean up.
 * @since 1.0.0
 */
include_once( get_stylesheet_directory() . '/includes/dashboard.php' );

/**
 * Load in Gravity Forms functions
 * @since 1.0.0
 */
if ( class_exists( 'GFCommon' ) ) {
	include_once( get_stylesheet_directory() . '/includes/gravity.php' );
}

/**
 * Load in ACF functions
 * @since 1.7.0
 */
if ( class_exists( 'acf' ) ) {
	include_once( get_stylesheet_directory() . '/includes/acf.php' );
}
	

// Me shortcodes
include_once( get_stylesheet_directory() . '/includes/shortcodes.php' );
/**
 * Custom Image Sizes
 * Image sizes - add in required image sizes here. Not working for theme if inside after_setup_theme function
 * @since 1.0.0
 */
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'blog-feature', 600, 400, true );
	add_image_size( 'medium', 300, 300, true ); // Overwrite default and hard cropping
}

add_filter( 'intermediate_image_sizes_advanced', 'bt_remove_default_images' );
/**
 * Remove default image sizes
 * @since 1.0.0
 */
function bt_remove_default_images( $sizes ) {
	// unset( $sizes['small']); // 150px
	// unset( $sizes['medium']); // 300px
	// unset( $sizes['large']); // 1024px
	unset( $sizes['medium_large']); // 768px
	return $sizes;
}


add_filter( 'upload_mimes', 'bt_add_svg_images' );
/**
 * Allow SVG Images Via Media Uploader.
 * @since 1.0.0
 */
function bt_add_svg_images( $mimetypes ) {
	$mimetypes['svg'] = 'image/svg+xml';
	return $mimetypes;
}

/**
 * Add support for custom logo change the dimensions to suit. Need WordPress 4.5 for this.
 * @since 1.0.0
 */
add_theme_support( 'custom-logo', array(
	'height'      => 100, // set to your dimensions
	'width'       => 300,// set to your dimensions
	'flex-height' => true,
	'flex-width'  => true,
));

add_shortcode( 'client_logo', 'bt_client_logo' );
/**
 * Position the content with a shortcode [client_logo]
 * @since 1.0.0
 */
function bt_client_logo() {
ob_start();
	if ( function_exists( 'the_custom_logo' ) ) {    
		echo '<div itemscope itemtype="http://schema.org/Organization">' . get_custom_logo() . '</div>';
	}
return ob_get_clean();
}


add_action( 'add_attachment', 'bt_image_meta_upon_image_upload' );
/**
 * Automatically set the image Title, Alt-Text, Caption & Description upon upload
 * @since 1.0.0
 * @link https://brutalbusiness.com/automatically-set-the-wordpress-image-title-alt-text-other-meta/
 */
function bt_image_meta_upon_image_upload( $post_ID ) {
	// Check if uploaded file is an image, else do nothing
	if ( wp_attachment_is_image( $post_ID ) ) {

		$my_image_title = get_post( $post_ID )->post_title;

		// Sanitize the title:  remove hyphens, underscores & extra spaces:
		$my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $my_image_title );

		// Sanitize the title:  capitalize first letter of every word (other letters lower case):
		$my_image_title = ucwords( strtolower( $my_image_title ) );

		// Create an array with the image meta (Title, Caption, Description) to be updated
		// Note:  comment out the Excerpt/Caption or Content/Description lines if not needed
		$my_image_meta = array(
			'ID'		=> $post_ID,			// Specify the image (ID) to be updated
			'post_title'	=> $my_image_title,		// Set image Title to sanitized title
			//'post_excerpt'	=> $my_image_title,		// Set image Caption (Excerpt) to sanitized title
			//'post_content'	=> $my_image_title,		// Set image Description (Content) to sanitized title
		);

		// Set the image Alt-Text
		update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );

		// Set the image meta (e.g. Title, Excerpt, Content)
		wp_update_post( $my_image_meta );
	} 
}

add_action('wp_enqueue_scripts','wpb_post_scripts' );
function wpb_post_scripts() {
	
   if ( is_front_page() && ! is_user_logged_in() ) {
		wp_deregister_style( 'dashicons' );
	}
}

add_action('manage_posts_custom_column', 'column_content', 5, 2);
/**
* See Post ID in Dashboard
*/
function add_column( $columns ){
	$columns['post_id_clmn'] = 'ID'; // $columns['Column ID'] = 'Column Title';
	return $columns;
}
add_filter('manage_posts_columns', 'add_column', 5);

function column_content( $column, $id ){
	if( $column === 'post_id_clmn')
		echo $id;
}


