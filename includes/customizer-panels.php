<?php
/**
 * Login  styles Customizer Stuff Here.
 * @since 1.0.0
 * @package Brickston
 */


add_action( 'customize_register', 'bt_register_theme_customizer', 20 );
/**
 * Register for the Customizer
 * @since 1.0.0
 */
function bt_register_theme_customizer( $wp_customize ) {

	global $wp_customize;

	/**
	 * Create login panel
	 * Add setting
	 * Add control
	 * @since 1.0.0
	 */
	// Add Panel
	// $wp_customize->add_panel( 'login_page', array(
	// 	'priority'       => 70,
	// 	'theme_supports' => '',
	// 	'title'          => __( 'Login', 'brickston' ),
	// 	'description'    => __( 'Set login page styles', 'brickston' ),
	// ) );

	// Add Login Styles
	// Add in Settings section with 'fl-settings'.
	$wp_customize->add_section( 'bt_login_styles' , array(
		'title'      => __( 'Login Styles','brickston' ),
		'panel'      => '',
		'priority'   => 120,
		) 
	);

	$wp_customize->add_setting( 'bt_login_accent_color', array(
			'default' => '#007cba', // Give it a default
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'bt_login_custom_accent_color', //give it an ID
		   array(
			   'label'      => __( 'Login accent color', 'brickston' ), //set the label to appear in the Customizer
			   'section'    => 'bt_login_styles', //select the section for it to appear under  
			   'settings'   => 'bt_login_accent_color' //pick the setting it applies to
		   )
	   )
	);

	$wp_customize->add_setting( 'bt_login_accent_hover_color', array(
			'default' => '#0071a1', // Give it a default
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'bt_login_custom_accent_hover_color', //give it an ID
			array(
					'label'      => __( 'Login accent hover color', 'brickston' ), //set the label to appear in the Customizer
					'section'    => 'bt_login_styles', //select the section for it to appear under  
					'settings'   => 'bt_login_accent_hover_color' //pick the setting it applies to
				)
			)
	);

	$wp_customize->add_setting( 'bt_login_link_color', array(
		'default' => '#555d66', // Give it a default
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'bt_login_custom_link_color', //give it an ID
			array(
				'label'      => __( 'Login link color', 'brickston' ), //set the label to appear in the Customizer
				'section'    => 'bt_login_styles', //select the section for it to appear under  
				'settings'   => 'bt_login_link_color' //pick the setting it applies to
			)
		)
	);

	$wp_customize->add_setting( 'bt_login_link_hover_color', array(
			'default' => '#00a0d2', // Give it a default
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'bt_login_custom_link_hover_color', //give it an ID
			array(
				'label'      => __( 'Login link hover color', 'brickston' ), //set the label to appear in the Customizer
				'section'    => 'bt_login_styles', //select the section for it to appear under  
				'settings'   => 'bt_login_link_hover_color' //pick the setting it applies to
			)
		)
	);

	$wp_customize->add_setting( 'bt_login_background_color', array(
		'default' => '#f1f1f1', // Give it a default
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'bt_login_custom_background_color', //give it an ID
			array(
				'label'      => __( 'Login background color', 'brickston' ), //set the label to appear in the Customizer
				'section'    => 'bt_login_styles', //select the section for it to appear under  
				'settings'   => 'bt_login_background_color' //pick the setting it applies to
			)
		)
	);	

	$wp_customize->add_setting( 'bt_login_form_color', array(
		'default' => '#ffffff', // Give it a default
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'bt_login_form_color', //give it an ID
			array(
				'label'      => __( 'Login form background color', 'brickston' ), //set the label to appear in the Customizer
				'section'    => 'bt_login_styles', //select the section for it to appear under  
				'settings'   => 'bt_login_form_color' //pick the setting it applies to
			)
		)
	);

	$wp_customize->add_setting( 'bt_login_form_text', array(
		'default' => '#444444', // Give it a default
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'bt_login_form_text', //give it an ID
			array(
				'label'      => __( 'Login form text color', 'brickston' ), //set the label to appear in the Customizer
				'section'    => 'bt_login_styles', //select the section for it to appear under  
				'settings'   => 'bt_login_form_text' //pick the setting it applies to
			)
		)
	);

	// Getting the default WP custom logo - 4 keys in the array - url[0], width[1], height[2] and a boolean[3]
	$custom_logo_id  = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
	if(!empty($custom_logo_id )) {
		$custom_logo_url = $custom_logo_id [0];
		$custom_logo_width = $custom_logo_id [1];
		$custom_logo_height = $custom_logo_id [2];
	}	
	else {
		$custom_logo_url = '';
	}

	// Add setting.
	$wp_customize->add_setting( 'bt_login_logo', array(
		'default'     => $custom_logo_url,
	) );

	// Add control.
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize, 'bt_login_logo', array(
			'label'      => __( 'Add alternative login logo here, otherwise custom_logo value from Site Identity will be displayed,', 'brickston' ),
			'section'    => 'bt_login_styles',
			'settings'   => 'bt_login_logo',
			)
	) );

	$wp_customize->add_setting( 'bt_admin_font',
		array(
		'default' => 0,
		)
	);
	
	$wp_customize->add_control( 'bt_admin_font',
		array(
		'label' => __( 'Make WP Dashboard font same as frontend' ),
		'section' => 'bt_login_styles',
		'priority' => 10, // Optional. Order priority to load the control. Default: 10
		'type' => 'checkbox',
		)
	);


}




