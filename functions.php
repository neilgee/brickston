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
 * Register custom elements
 */
add_action( 'init', function() {
  $element_files = [
    __DIR__ . '/elements/title.php',
  ];

  foreach ( $element_files as $file ) {
    \Bricks\Elements::register_element( $file );
  }
}, 11 );

/**
 * Filter which elements to show in the builder
 * 
 * Simple outcomment (prefix: //) the elements you don't want to use in Bricks
 */
function bricks_filter_builder_elements( $elements ) {
	$elements = [
		// Basic
		// 'container', // since 1.2
		// 'heading',
		'text',
		'button',
		'icon',
		'image',
		'video',

		// General
		'divider',
		'icon-box',
		'list',
		'accordion',
		'tabs',
		'form',
		'map',
		'alert',
		'animated-typing',
		'countdown',
		'counter',
		'pricing-tables',
		'progress-bar',
		'pie-chart',
		'team-members',
		'testimonials',
		'html',
		'code',
		'logo',

		// Media
		'image-gallery',
		'audio',
		'carousel',
		'slider',
		'svg',

		// Social
		'social-icons',
		'facebook-page',
		'instagram-feed',

		// WordPress
		'wordpress',
		'posts',
		'nav-menu',
		'sidebar',
		'search',
		'shortcode',

		// Single
		'post-title',
		'post-excerpt',
		'post-meta',
		'post-content',
		'post-sharing',
		'post-related-posts',
		'post-author',
		'post-comments',
		'post-taxonomy',
		'post-navigation',

		// Hidden in builder panel
		'section',
		'row',
		'column',
	];

	return $elements;
}
// add_filter( 'bricks/builder/elements', 'bricks_filter_builder_elements' );

/**
 * Add text strings to builder
 */
add_filter( 'bricks/builder/i18n', function( $i18n ) {
  // For element category 'custom'
  $i18n['custom'] = esc_html__( 'Custom', 'bricks' );

  return $i18n;
} );

/**
 * Custom save messages
 */
add_filter( 'bricks/builder/save_messages', function( $messages ) {
	// First option: Add individual save message
	$messages[] = 'Yasss';

	// Second option: Replace all save messages
	$messages = [
		'Done',
		'Cool',
		'High five!',
		'WTF',
		'Jawohl'
	];

  return $messages;
} );


/** 
 * Add custom map style
 */
// add_filter( 'bricks/builder/map_styles', function( $map_styles ) {
//   // Shades of grey (https://snazzymaps.com/style/38/shades-of-grey)
//   $map_styles['shadesOfGrey'] = [
//     'label' => esc_html__( 'Shades of grey', 'bricks' ),
//     'style' => '[ { "featureType": "all", "elementType": "labels.text.fill", "stylers": [ { "saturation": 36 }, { "color": "#000000" }, { "lightness": 40 } ] }, { "featureType": "all", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#000000" }, { "lightness": 16 } ] }, { "featureType": "all", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative", "elementType": "geometry.fill", "stylers": [ { "color": "#000000" }, { "lightness": 20 } ] }, { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [ { "color": "#000000" }, { "lightness": 17 }, { "weight": 1.2 } ] }, { "featureType": "landscape", "elementType": "geometry", "stylers": [ { "color": "#000000" }, { "lightness": 20 } ] }, { "featureType": "poi", "elementType": "geometry", "stylers": [ { "color": "#000000" }, { "lightness": 21 } ] }, { "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [ { "color": "#000000" }, { "lightness": 17 } ] }, { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [ { "color": "#000000" }, { "lightness": 29 }, { "weight": 0.2 } ] }, { "featureType": "road.arterial", "elementType": "geometry", "stylers": [ { "color": "#000000" }, { "lightness": 18 } ] }, { "featureType": "road.local", "elementType": "geometry", "stylers": [ { "color": "#000000" }, { "lightness": 16 } ] }, { "featureType": "transit", "elementType": "geometry", "stylers": [ { "color": "#000000" }, { "lightness": 19 } ] }, { "featureType": "water", "elementType": "geometry", "stylers": [ { "color": "#000000" }, { "lightness": 17 } ] } ]'
//   ];

//   return $map_styles;
// } );

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


add_filter( 'bricks/builder/standard_fonts', function( $standard_fonts ) {
	// Option #1: Add individual standard font
	// $standard_fonts[] = '-apple-system, BlinkMacSystemFont, avenir next, avenir, segoe ui, helvetica neue, helvetica, Ubuntu, roboto, noto, arial, sans-serif;';
	
	// Option #2: Replace all standard fonts
	$standard_fonts = [
		'Arial',
		'Courier New',
		'Helvetica',
		'Helvetica Neue',
		'Georgia',
		'Times New Roman',
		'Verdana',
		'-apple-system, BlinkMacSystemFont, avenir next, avenir, segoe ui, helvetica neue, helvetica, Ubuntu, roboto, noto, arial, sans-serif',
		'Iowan Old Style, Apple Garamond, Baskerville, Times New Roman, Droid Serif, Times, Source Serif Pro, serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol',
		'Menlo, Consolas, Monaco, Liberation Mono, Lucida Console, monospace',
	];
	
	return $standard_fonts;
} );

