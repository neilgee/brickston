<?php
/**
 * Beavertron Inline CSS
 *
 * This file adds the required CSS to the front end of Beavertron theme.
 *
 * @package beavertron
 * @author  @_neilgee
 * @license GPL-2.0+
 * @link    http://wpbeaches.com
 */

add_action( 'wp_enqueue_scripts', 'bt_css', 1001 );
/**
 * Customizer Settings referenced and added via CSS
 *
 * @since 1.0
 */

function bt_css() {
	
	// Choice here of passing inline CSS straight after the BB Skin CSS or the Child Theme CSS
	$handle  = 'woocss';
	/* Our Customiser settings, stored as variables */
	
	// WooCommerce
	if ( class_exists( 'WooCommerce' ) ) {

	$bt_woo_button_text_color        = get_theme_mod( 'bt_woo_button_text_color', bt_woo_button_text_color_default() );
	$bt_woo_button_text_hover_color  = get_theme_mod( 'bt_woo_button_text_hover_color', bt_woo_button_text_hover_color_default() );

	$bt_woo_button_color           	= get_theme_mod( 'bt_woo_button_color', bt_woo_button_color_default() );
	$bt_woo_button_hover_color     	= get_theme_mod( 'bt_woo_button_hover_color', bt_woo_button_hover_color_default() );
	$bt_woo_border_color     		= get_theme_mod( 'bt_woo_border_color', bt_woo_button_border_color_default() );
	$bt_woo_border_hover_color		= get_theme_mod( 'bt_woo_border_color_hover', bt_woo_button_border_hover_color_default() );

	$bt_button_woo_padding_top_bottom = get_theme_mod( 'bt_button_woo_padding_top_bottom');
	$bt_button_woo_padding_left_right = get_theme_mod( 'bt_button_woo_padding_left_right');
	$bt_button_woo_font_family        = get_theme_mod( 'bt_button_woo_font_family');
	$bt_button_woo_font_weight        = get_theme_mod( 'bt_button_woo_font_weight');
	$bt_button_woo_font_size          = get_theme_mod( 'bt_button_woo_font_size');
	$bt_button_woo_line_height        = get_theme_mod( 'bt_button_woo_line_height');
	$bt_button_woo_text_transform     = get_theme_mod( 'bt_button_woo_text_transform');
	$bt_button_woo_border_style       = get_theme_mod( 'bt_button_woo_border_style');

	$bt_button_woo_border_width  = get_theme_mod( 'bt_button_woo_border_width');
	$bt_button_woo_border_radius = get_theme_mod( 'bt_button_woo_border_radius');

	$bt_woo_button_dis_color       = get_theme_mod( 'bt_woo_button_dis_color', bt_woo_button_dis_color_default() );
	$bt_woo_button_dis_hover_color = get_theme_mod( 'bt_woo_button_dis_hover_color', bt_woo_button_dis_hover_color_default() );

	$bt_woo_price_color      = get_theme_mod( 'bt_woo_price_color', bt_woo_price_color_default() );
	$bt_woo_sale_price_color = get_theme_mod( 'bt_woo_sale_price_color', bt_woo_sale_price_color_default() );

	$bt_woo_error_color   = get_theme_mod( 'bt_woo_error_color', bt_woo_error_color_default() );
	$bt_woo_info_color    = get_theme_mod( 'bt_woo_info_color', bt_woo_info_color_default() );
	$bt_woo_message_color = get_theme_mod( 'bt_woo_message_color', bt_woo_message_color_default() );
	}

	//* Calculate Color Contrast
	function bt_color_contrast( $color ) {

		$hexcolor = str_replace( '#', '', $color );

		$red   = hexdec( substr( $hexcolor, 0, 2 ) );
		$green = hexdec( substr( $hexcolor, 2, 2 ) );
		$blue  = hexdec( substr( $hexcolor, 4, 2 ) );

		$luminosity = ( ( $red * 0.2126 ) + ( $green * 0.7152 ) + ( $blue * 0.0722 ) );
		// Changed from 128 to give more white text against darker backgrounds
		return ( $luminosity > 155 ) ? '#333333' : '#ffffff';
	}

	
	function adjustBrightness($hex, $steps) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max(-255, min(255, $steps));

		// Normalize into a six character long hex string
		$hex = str_replace('#', '', $hex);
		if (strlen($hex) == 3) {
			$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
		}

		// Split into three parts: R, G and B
		$color_parts = str_split($hex, 2);
		$return = '#';

		foreach ($color_parts as $color) {
			$color   = hexdec($color); // Convert to decimal
			$color   = max(0,min(255,$color + $steps)); // Adjust color
			$return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
		}

		return $return;
	}

	/* Start off with •nuffink*/
	$css = '';
	


// WooCommerce
	if ( class_exists( 'WooCommerce' ) ) {

		$css .= ( bt_woo_button_color_default() !== $bt_woo_button_color ) ? sprintf( '
		
		.woocommerce-page ul.products li.product a.button,
		.woocommerce-page .woocommerce-message a.button,
		.woocommerce-page a.button,
		.woocommerce-page button.button,
		.woocommerce-page .woocommerce button[type=submit],
		/* Alt Selectors */
		.woocommerce #respond input#submit.alt.disabled,
		.woocommerce #respond input#submit.alt.disabled:hover,
		.woocommerce #respond input#submit.alt:disabled[disabled],
		.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
		.woocommerce a.button.alt.disabled,
		.woocommerce a.button.alt.disabled:hover,
		.woocommerce a.button.alt:disabled[disabled],
		.woocommerce a.button.alt:disabled[disabled]:hover,
		.woocommerce button.button.alt.disabled,
		.woocommerce button.button.alt.disabled:hover,
		.woocommerce button.button.alt:disabled[disabled],
		.woocommerce button.button.alt:disabled[disabled]:hover,
		.woocommerce input.button.alt.disabled,
		.woocommerce input.button.alt.disabled:hover,
		.woocommerce input.button.alt:disabled[disabled],
		.woocommerce input.button.alt:disabled[disabled]:hover,
		.woocommerce #respond input#submit.alt,
		.woocommerce a.button.alt,
		.woocommerce button.button.alt,
		.woocommerce input.button.alt,
		.woocommerce-page button.button, 
		.woocommerce-page .woocommerce button[type=submit],
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce-cart .woocommerce table button[type="submit"],
		.woocommerce-cart .woocommerce .cart-collaterals .wc-proceed-to-checkout .button  {
			background-color: %1$s;
			color: %2$s;
			padding: %4$spx %5$spx !important;
			font-family: %6$s, Arial;
			font-weight: %7$s;
			font-size: %8$spx;
			line-height: %9$s;
			text-transform: %10$s;
			border: %12$spx %11$s %14$s !important;
			border-radius: %13$spx;
		}
		', $bt_woo_button_color, $bt_woo_button_text_color , $bt_woo_border_color, $bt_button_woo_padding_top_bottom,
		$bt_button_woo_padding_left_right, $bt_button_woo_font_family, $bt_button_woo_font_weight, 
		$bt_button_woo_font_size,$bt_button_woo_line_height, $bt_button_woo_text_transform, $bt_button_woo_border_style, 
		$bt_button_woo_border_width, $bt_button_woo_border_radius, $bt_woo_border_color  ) : '';

		
		$css .= ( bt_woo_button_hover_color_default() !== $bt_woo_button_hover_color ) ? sprintf( '

		.woocommerce-page ul.products li.product a.button:hover,
		.woocommerce-page a.button:hover,
		.woocommerce-page button.button:hover,
		.woocommerce-page .woocommerce button[type=submit]:hover,
		/* ALt Selectors */
		.woocommerce #respond input#submit.alt:hover,
		.woocommerce a.button.alt:hover,
		.woocommerce button.button.alt:hover,
		.woocommerce input.button.alt:hover,
		.woocommerce-page ul.products li.product a.button:hover, 
		.woocommerce-page .woocommerce-message a.button:hover, 
		.woocommerce-page button.button:hover, 
		.woocommerce-page button.button.alt:hover, 
		.woocommerce-page a.button.alt:hover, 
		.woocommerce-page a.button:hover, 
		.woocommerce-page .woocommerce button[type=submit]:hover,
		.woocommerce-page .woocommerce a.button.wc-forward,
		.woocommerce-cart .woocommerce table button[type="submit"]:hover,
		.woocommerce-cart .woocommerce .cart-collaterals .wc-proceed-to-checkout .button:hover,
		.woocommerce-account .woocommerce .woocommerce-MyAccount-content .button:hover  {
			background-color: %1$s !important;
			color: %2$s !important;
			border: %4$spx %5$s %3$s !important;
		}
		', $bt_woo_button_hover_color, $bt_woo_button_text_hover_color, $bt_woo_border_hover_color, $bt_button_woo_border_width, $bt_button_woo_border_style ) : '';



		$css .= ( bt_woo_button_dis_color_default() !== $bt_woo_button_dis_color ) ? sprintf( '
		.woocommerce #respond input#submit.disabled,
		.woocommerce #respond input#submit:disabled[disabled],
		.woocommerce a.button.disabled, .woocommerce a.button:disabled,
		.woocommerce a.button:disabled[disabled],
		.woocommerce button.button:disabled,
		.woocommerce button.button:disabled[disabled],
		.woocommerce input.button.disabled,
		.woocommerce input.button:disabled[disabled] {
			background-color: %1$s;
			border: %3$spx %4$s %1$s;
			color: %2$s;
		}
		', $bt_woo_button_dis_color, bt_color_contrast( $bt_woo_button_dis_color ), $bt_button_woo_border_width, $bt_button_woo_border_style  ) : '';


		$css .= ( bt_woo_button_dis_hover_color_default() !== $bt_woo_button_dis_hover_color ) ? sprintf( '
		.woocommerce #respond input#submit.disabled:hover,
		.woocommerce #respond input#submit:disabled[disabled]:hover,
		.woocommerce a.button.disabled:hover,
		.woocommerce a.button:disabled[disabled]:hover,
		.woocommerce button.button:disabled:hover,
		.woocommerce button.button:disabled[disabled]:hover,
		.woocommerce input.button:disabled:hover,
		.woocommerce input.button:disabled[disabled]:hover {
			background-color: %1$s;
			border: %3$spx %4$s %1$s;
			color: %2$s;
		}
		', $bt_woo_button_dis_hover_color, bt_color_contrast( $bt_woo_button_dis_hover_color ), $bt_button_woo_border_width, $bt_button_woo_border_style ) : '';


		$css .= ( bt_woo_price_color_default() !== $bt_woo_price_color ) ? sprintf( '
		.woocommerce div.product p.price,
		.woocommerce div.product span.price,
		.woocommerce ul.products li.product .price,
		.single-product .summary .price del {
			color: %s;
		}
		', $bt_woo_price_color ) : '';


		$css .= ( bt_woo_sale_price_color_default() !== $bt_woo_sale_price_color ) ? sprintf( '
		.woocommerce .sale ins {
			text-decoration: none;
		}
		.woocommerce .sale ins .woocommerce-Price-amount{
			color: %s;
		}
		', $bt_woo_sale_price_color ) : '';


		$css .= ( bt_woo_info_color_default() !== $bt_woo_info_color  ) ? sprintf( '
		.woocommerce-info {
			color:%1$s;
		    background-color:%2$s;
			border-left: 3px solid %1$s;
		}
		.woocommerce-info .button {
			background-color:%1$s !important;
		}
		', $bt_woo_info_color, adjustBrightness($bt_woo_info_color, 164) ) : '';



		$css .= ( bt_woo_error_color_default() !== $bt_woo_error_color  ) ? sprintf( '
		.woocommerce-error:before,
		.woocommerce form .form-row.woocommerce-invalid label,
		.woocommerce form .form-row .required,
		.woocommerce a.remove,
		ul.woocommerce-error li {
		    color:%1$s !important;
			background-color: %2$s;
		}
		', $bt_woo_error_color, adjustBrightness($bt_woo_error_color, 164)  ) : '';


		$css .= ( bt_woo_error_color_default() !== $bt_woo_error_color  ) ? sprintf( '
		.woocommerce form .form-row.woocommerce-invalid .select2-container,
		.woocommerce form .form-row.woocommerce-invalid input.input-text,
		.woocommerce form .form-row.woocommerce-invalid select {
		    border-color: %s;
		}
		', $bt_woo_error_color ) : '';


		$css .= ( bt_woo_error_color_default() !== $bt_woo_error_color  ) ? sprintf( '
		.woocommerce a.remove:hover {
		    background-color: %s;
		}
		', $bt_woo_error_color ) : '';


		$css .= ( bt_woo_message_color_default() !== $bt_woo_message_color  ) ? sprintf( '

		.woocommerce-notices-wrapper .woocommerce-message {
			background-color: %2$s;
			color: %1$s;
			border-left-color: %1$s;
			border-left: 3px solid;	
		}

		.woocommerce-notices-wrapper .woocommerce-message a {
			background-color: %1$s !important;
		}
		', $bt_woo_message_color, adjustBrightness($bt_woo_message_color, 164)  ) : '';


	}

	if ( $css ) {
		wp_add_inline_style( $handle, $css );
	}


}

