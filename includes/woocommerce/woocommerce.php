<?php

add_action( 'wp_enqueue_scripts', 'woo_css_styles', 900 );
/**
 * WOO CSS styles
 * @since 1.0.0
 */
function woo_css_styles() {
        if ( is_woocommerce() ||  is_cart() ||  is_checkout() || is_account_page() ) {
        wp_enqueue_style( 'woocss' , get_stylesheet_directory_uri() . '/includes/woocommerce/woo.css', array(), '2.0.0', 'all' );
        } 
}

add_action( 'template_redirect', 'bt_remove_woocommerce_styles_scripts', 999 );
/**
 * Remove Woo Styles and Scripts from non-Woo Pages
 * @link https://gist.github.com/DevinWalker/7621777#gistcomment-1980453
 * @since 1.0.0
 */
function bt_remove_woocommerce_styles_scripts() {

        // Skip Woo Pages
        if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
                return;
        }
        // Otherwise...
        remove_action('wp_enqueue_scripts', [WC_Frontend_Scripts::class, 'load_scripts']);
        remove_action('wp_print_scripts', [WC_Frontend_Scripts::class, 'localize_printed_scripts'], 5);
        remove_action('wp_print_footer_scripts', [WC_Frontend_Scripts::class, 'localize_printed_scripts'], 5);
}


add_action( 'wp_enqueue_scripts', 'bt_dequeue_woocommerce_fragments', 99 );
/**
 * Disable WooCommerce Fragments on Product Pages
 * Make sure 'Redirect to Cart After Successful Addition' is set in WC backend
 * @since 1.0.0
 */
function bt_dequeue_woocommerce_fragments() {
        if ( is_product() ) {
                wp_dequeue_script( 'wc-cart-fragments' );
        }
}


/**
 * Remove Supports for zoom/slider/gallery
 * @since 1.0.0
 */
//remove_theme_support( 'wc-product-gallery-zoom' );
//remove_theme_support( 'wc-product-gallery-lightbox' );
//remove_theme_support( 'wc-product-gallery-slider' );


add_filter( 'woocommerce_pagination_args', 'bt_woocommerce_pagination' );
/**
 * Update the next and previous arrows to the default style.
 *
 * @since 1.0.0
 *
 * @return string New next and previous text string.
 */
function bt_woocommerce_pagination( $args ) {

	$args['prev_text'] = sprintf( '&laquo; %s', __( 'Previous Page', 'brickston' ) );
	$args['next_text'] = sprintf( '%s &raquo;', __( 'Next Page', 'brickston' ) );

	return $args;
}


add_filter( 'woocommerce_breadcrumb_defaults', 'bt_change_breadcrumb_home_text' );
/**
 * Rename "home" in WooCommerce breadcrumb
 */
function bt_change_breadcrumb_home_text( $defaults ) {
    // Change the breadcrumb home text from 'Home' to 'Shop'
	$defaults['home'] = 'Shop';
	return $defaults;
}

add_filter( 'woocommerce_breadcrumb_home_url', 'bt_custom_breadrumb_home_url' );
/**
 * Replace the home link URL in WooCommerce breadcrumb
 */
function bt_custom_breadrumb_home_url() {
    return '/shop/';
}
