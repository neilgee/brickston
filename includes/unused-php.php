<?php

//var_dump( Database::$global_settings);
/**
 * Register/enqueue custom scripts and styles
 */
//add_action( 'after_setup_theme', 'me_old_woo');
function  me_old_woo() {
	//add_action( 'wp_enqueue_scripts', 'bt_no_woo', 999);
	function bt_no_woo() {
		wp_dequeue_style('bricks-woocommerce');
		wp_enqueue_style('woocommerce-general');
		wp_enqueue_style('woocommerce-layout');
		wp_enqueue_style('woocommerce-smallscreen');
	}
}

add_action( 'init', function() {
	var_dump( \Bricks\Database::$global_settings );
	echo "and next";
	//var_dump( \Bricks\Theme_Styles::$active_style_settings );
  }, 11 );