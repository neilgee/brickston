<?php
/**
 * Adding all Customizer Stuff Here.
 * @since 1.0.0
 * @package beavertron
 */

 /**
  * Set Up Default Colors - so if not changed in Customizer no CSS mark up is output
  * @since 1.0.0
  */
 
 function  bt_woo_button_text_color_default() {
 return '#ffffff';
 }

 function  bt_woo_button_text_hover_color_default() {
 return '#999999';
 }

 function  bt_woo_button_color_default() {
 return '#ebe9eb';
 }
 
 function  bt_woo_button_hover_color_default() {
  return '#dad8da';
 }

 function  bt_woo_button_border_color_default() {
return '#ebe9eb';
}

function  bt_woo_button_border_hover_color_default() {
return '#dad8da';
}

 function  bt_woo_button_dis_color_default() {
 return '#eee';
 }

function  bt_woo_button_dis_hover_color_default() {
  return '#ddd';
 }

 function bt_woo_price_color_default() {
  return '#77a464';
 }

 function bt_woo_sale_price_color_default() {
  return '#77a464';
 }

 function bt_woo_error_color_default() {
  return '#b81c23';
 }

 function bt_woo_info_color_default() {
  return '#1e85be';
 }

 function bt_woo_message_color_default() {
  return '#8fae1b';
 }



add_action( 'customize_register', 'bt_register_theme_customizer_woo', 20 );
/**
 * Register for the Customizer
 * @since 1.0.0
 */
function bt_register_theme_customizer_woo( $wp_customize ) {

/**
 * Extend Range Slider
 * @since 1.0.0
 */

class WP_Customize_Range_Control extends WP_Customize_Control
{
    public $type = 'custom_range';
    public function enqueue()
    {
        wp_enqueue_script(
            'cs-range-control',
            '/wp-content/themes/brickston/js/range-control.js',
            array('jquery'),
            false,
            true
        );
    }
    public function render_content()
    {
        ?>
        <label>
            <?php if ( ! empty( $this->label )) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>
            <div class="cs-range-value"><?php echo esc_attr($this->value()); ?></div>
            <input data-input-type="range" type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
            <?php if ( ! empty( $this->description )) : ?>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
            <?php endif; ?>
        </label>
        <?php
    }
}

        /**
         * Add WooCommerce Colors Section
         * This title is changed further down the code to 'Buttons & Colors'
         * @since 2.0.0
         */
        $wp_customize->add_section( 'woocommerce_colors' , array(
                'title'      => __( 'WooCommerce Colors','brickston' ),
                'panel'      => 'woocommerce',
                'priority'   => 20,
        ));

        /**
         * Add Enable/Disable Additional Notes
         * @since 1.0.0
         */
        $wp_customize->add_setting(
                'bt_woo_additional', //give it an ID
                        array(
                        'default'   => 'enabled',
        ));

        $wp_customize->add_control(
                new WP_Customize_Control(
                        $wp_customize,
                        'bt_woo_additional_notes', //give it an ID
                        array (
                                'label'       => __( 'WooCommerce Additional Notes', 'brickston' ),
                                'section'     => 'woo_options',
                                'settings'    => 'bt_woo_additional',                                                                //pick the setting it applies to
                                'description' => __( 'Enable or disable Woo Additional/Order Notes on Checkout', 'fl-automator' ),
                                'type'        => 'select',
                                'choices'     => array(
                                        'enabled'           => __( 'Enabled', 'brickston' ),
                                        'disabled'          => __( 'Disabled', 'brickston' ),
                                ),
                        )
        ));


        /**
         * Add Enable/Disable Woo Sort
         * @since 1.0.0
         */
        $wp_customize->add_setting(
                'bt_woo_sort', //give it an ID
                        array(
                        'default'   => 'enabled',
                )
        );

        $wp_customize->add_control(
                new WP_Customize_Control(
                        $wp_customize,
                        'bt_woo_sort', //give it an ID
                        array (
                                'label'       => __( 'WooCommerce Default Sort', 'brickston' ),
                                'section'     => 'woo_options',
                                'settings'    => 'bt_woo_sort',                                                                //pick the setting it applies to
                                'description' => __( 'Enable or disable Woo Default Sort', 'brickston' ),
                                'type'        => 'select',
                                'choices'     => array(
                                        'enabled'           => __( 'Enabled', 'brickston' ),
                                        'disabled'          => __( 'Disabled', 'brickston' ),
                                ),
                        )
                )
        );

        /**
         * Enable/Disable Woo Display Results
         * @since 1.0.0
         */
        $wp_customize->add_setting(
                'bt_woo_results', //give it an ID
                        array(
                        'default'   => 'enabled',
                )
        );
        $wp_customize->add_control(
                new WP_Customize_Control(
                        $wp_customize,
                        'bt_woo_results', //give it an ID
                        array (
                                'label'       => __( 'WooCommerce Display Results', 'brickston' ),
                                'section'     => 'woo_options',
                                'settings'    => 'bt_woo_results',                                                                //pick the setting it applies to
                                'description' => __( 'Enable or disable Woo Display Results Notice', 'brickston' ),
                                'type'        => 'select',
                                'choices'     => array(
                                        'enabled'           => __( 'Enabled', 'brickston' ),
                                        'disabled'          => __( 'Disabled', 'brickston' ),
                                ),
                        )
                )
        );

        /**
         * Enable/Disable Woo SKU
         * Now enabled due to Woo PDF Voucher issue I found
         * @link https://github.com/woocommerce/woocommerce/issues/21906
         * Have hidden SKU with CSS in includes-child/woocommerce/woo.css
         * @since 1.7.0
         */
        $wp_customize->add_setting(
                'bt_woo_sku', //give it an ID
                        array(
                        'default'   => 'enabled',
                )
        );
        $wp_customize->add_control(
                new WP_Customize_Control(
                        $wp_customize,
                        'bt_woo_sku', //give it an ID
                        array (
                                'label'       => __( 'WooCommerce Display SKU', 'brickston' ),
                                'section'     => 'woo_options',
                                'settings'    => 'bt_woo_sku',                                                                //pick the setting it applies to
                                'description' => __( 'Enable or disable Woo SKU', 'brickston' ),
                                'type'        => 'select',
                                'choices'     => array(
                                        'enabled'           => __( 'Enabled', 'brickston' ),
                                        'disabled'          => __( 'Disabled', 'brickston' ),
                                ),
                        )
                )
        );

        /**
         * Remove related products on a WooCommerce product page
         * @since 1.7.0
         */
        $wp_customize->add_setting(
                'bt_woo_related', //give it an ID
                        array(
                        'default'   => 'disabled',
                )
        );
        $wp_customize->add_control(
                new WP_Customize_Control(
                        $wp_customize,
                        'bt_woo_related', //give it an ID
                        array (
                                'label'       => __( 'WooCommerce Remove Related', 'brickston' ),
                                'section'     => 'woo_options',
                                'settings'    => 'bt_woo_related',   //pick the setting it applies to
                                'description' => __( 'Remove Related Products on Product Page', 'brickston' ),
                                'type'        => 'select',
                                'choices'     => array(
                                        'enabled'           => __( 'Enabled', 'brickston' ),
                                        'disabled'          => __( 'Disabled', 'brickston' ),
                                ),
                        )
                )
        );


        /**
         * Remove Category Meta on WooCommerce product page
         * @since 1.7.0
         */
        $wp_customize->add_setting(
                'bt_woo_meta', //give it an ID
                        array(
                        'default'   => 'disabled',
                )
        );
        $wp_customize->add_control(
                new WP_Customize_Control(
                        $wp_customize,
                        'bt_woo_meta', //give it an ID
                        array (
                                'label'       => __( 'WooCommerce Remove Meta', 'brickston' ),
                                'section'     => 'woo_options',
                                'settings'    => 'bt_woo_meta',   //pick the setting it applies to
                                'description' => __( 'Remove Post Category Meta on Product Page', 'brickston' ),
                                'type'        => 'select',
                                'choices'     => array(
                                        'enabled'           => __( 'Enabled', 'brickston' ),
                                        'disabled'          => __( 'Disabled', 'brickston' ),
                                ),
                        )
                )
        );

        /**
         * Remove the WooCommerce breadcrumbs
         * @since 1.7.0
         */
        $wp_customize->add_setting(
                'bt_woo_breadcrumbs', //give it an ID
                        array(
                        'default'   => 'disabled',
                )
        );
        $wp_customize->add_control(
                new WP_Customize_Control(
                        $wp_customize,
                        'bt_woo_breadcrumbs', //give it an ID
                        array (
                                'label'       => __( 'WooCommerce Remove Breadcrumbs', 'brickston' ),
                                'section'     => 'woo_options',
                                'settings'    => 'bt_woo_breadcrumbs',   //pick the setting it applies to
                                'description' => __( 'Remove the WooCommerce breadcrumbs', 'brickston' ),
                                'type'        => 'select',
                                'choices'     => array(
                                        'enabled'           => __( 'Enabled', 'brickston' ),
                                        'disabled'          => __( 'Disabled', 'brickston' ),
                                ),
                        )
                )
        );

        /**
         * Change WooCommerce Order Received Text
         * @since 1.7.0
         */
        // Add section.
        $wp_customize->add_section( 'bt_woo_order_section' , array(
                'title'    => __('Order Received Text','brickston'),
                'panel'    => 'woocommerce',
                'priority' => 10
        ) );
        // Add setting
        $wp_customize->add_setting( 'bt_woo_order_received', array(
                'default'           => __( 'Thank you. Your order has been received.', 'brickston' ),
                'sanitize_callback' => 'sanitize_text'
        ) );
        // Add control
        $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
                'bt_woo_order_received',
                array(
                        'label'    => __( 'Order Received Text', 'brickston' ),
                        'section'  => 'bt_woo_order_section',
                        'settings' => 'bt_woo_order_received',
                        'type'     => 'textarea'
                )
        )
        );


        /**
         * Change WooCommerce Variation Dropdown Text
         * @since 1.7.0
         */
        // Add section.
        $wp_customize->add_section( 'bt_woo_vary_dropdown_section' , array(
                'title'    => __('Variation Dropdown Text','brickston'),
                'panel'    => 'woocommerce',
                'priority' => 10
        ) );
        // Add setting
        $wp_customize->add_setting( 'bt_woo_dropdown_variation', array(
                'default'           => __( 'Choose an option', 'brickston' ),
                'sanitize_callback' => 'sanitize_text'
        ) );
        // Add control
        $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
                'bt_woo_dropdown_variation',
                array(
                        'label'    => __( 'Variation Dropdown Text', 'brickston' ),
                        'section'  => 'bt_woo_vary_dropdown_section',
                        'settings' => 'bt_woo_dropdown_variation',
                        'type'     => 'textarea'
                )
        )
        );

        // Sanitize text
        function sanitize_text( $text ) {
        return sanitize_text_field( $text );
        }
                
        /**
         * Change number of WooCommerce Products Shop & Archive
         * @since 1.7.0
         */
        $wp_customize->add_setting(
                'bt_number_products', //give it an ID
                        array(
                                'default' => '12', // Give it a default
                                //'transport' => 'postMessage',
                        )
        );
        $wp_customize->add_control(
                new WP_Customize_Range_Control(
                        $wp_customize,
                        'bt_number_products', //give it an ID
                        array(
                                'label'    => __( 'Number of WooCommerce Products Shop & Archive', 'brickston' ),   //set the label to appear in the Customizer
                                'section'  => 'woo_options',                                      //select the section for it to appear under  
                                'settings' => 'bt_number_products',                    //pick the setting it applies to
                                'priority' => 5,
                                'type'     => 'number',
                                'input_attrs'  => array(
                                        'min'  => 0,
                                        'max'  => 100,
                                        'step' => 1,
                                ),
                        )
                )
        );

        /**
         * WooTabs Removalists
         * @since 1.7.0
         */

        $wp_customize->add_setting( 'bt_woo_tabs_review',
        array(
        'default' => 0,
        )
        );
        
        $wp_customize->add_control( 'bt_woo_tabs_review',
        array(
        'label' => __( 'Remove Woo Tabs Review' ),
        'section' => 'woo_options',
        'priority' => 10, // Optional. Order priority to load the control. Default: 10
        'type' => 'checkbox',
        )
        );

        $wp_customize->add_setting( 'bt_woo_tabs_description',
        array(
        'default' => 0,
        )
        );
        
        $wp_customize->add_control( 'bt_woo_tabs_description',
        array(
        'label' => __( 'Remove Woo Tabs Description' ),
        'section' => 'woo_options',
        'priority' => 10, // Optional. Order priority to load the control. Default: 10
        'type' => 'checkbox',
        )
        );

        $wp_customize->add_setting( 'bt_woo_tabs_information',
        array(
        'default' => 0,
        )
        );
        
        $wp_customize->add_control( 'bt_woo_tabs_information',
        array(
        'label' => __( 'Remove Woo Tabs Information' ),
        'section' => 'woo_options',
        'priority' => 10, // Optional. Order priority to load the control. Default: 10
        'type' => 'checkbox',
        )
        );

        // Change WooCommerce Panel Title
        $wp_customize->get_section('woocommerce_colors')->title = __( 'Buttons & Colors' );

        // Add buttons foreground color
        // Add setting.
	$wp_customize->add_setting( 'bt_woo_button_text_color', array(
		'default' => bt_woo_button_text_color_default(),
		'sanitize_callback' => 'sanitize_hex_color',
        ) );

	// Add control
        $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize, 'bt_woo_button_text_color', array(
		'label'      => __( 'Button Text Color', 'beavertron' ), //set the label to appear in the Customizer
		'section'    => 'woocommerce_colors', //select the section for it to appear under
		'settings'   => 'bt_woo_button_text_color' //pick the setting it applies to
		)
        ) );

	// Add buttons hover - focus foreground color
	// Add setting.
	$wp_customize->add_setting( 'bt_woo_button_text_hover_color', array(
		'default' => bt_woo_button_text_hover_color_default(),
		'sanitize_callback' => 'sanitize_hex_color',
        ) );

	// Add control
        $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize, 'bt_woo_button_text_hover_color', array(
		'label'      => __( 'Button Text Hover Color', 'beavertron' ), //set the label to appear in the Customizer
		'section'    => 'woocommerce_colors', //select the section for it to appear under
		'settings'   => 'bt_woo_button_text_hover_color' //pick the setting it applies to
		)
        ) );

	// Add buttons background color
	// Add setting.
	$wp_customize->add_setting( 'bt_woo_button_color', array(
		'default' => bt_woo_button_color_default(),
		'sanitize_callback' => 'sanitize_hex_color',
        ) );

	// Add control
        $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize, 'bt_woo_button_color', array(
		'label'      => __( 'Button Color', 'beavertron' ), //set the label to appear in the Customizer
		'section'    => 'woocommerce_colors', //select the section for it to appear under
		'settings'   => 'bt_woo_button_color' //pick the setting it applies to
		)
        ) );

	// Add buttons hover - focus background color
	// Add setting.
	$wp_customize->add_setting( 'bt_woo_button_hover_color', array(
		'default' => bt_woo_button_hover_color_default(),
		'sanitize_callback' => 'sanitize_hex_color',
        ) );

	// Add control
        $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize, 'bt_woo_button_hover_color', array(
		'label'      => __( 'Button Hover Color', 'beavertron' ), //set the label to appear in the Customizer
		'section'    => 'woocommerce_colors', //select the section for it to appear under
		'settings'   => 'bt_woo_button_hover_color' //pick the setting it applies to
		)
        ) );

    /* *
	 * Adding in a Border Color and Border Hover Control for Woo Buttons to the Woo panel
	 * Also can be done with fl_theme_add_panel_data filter - see 2 examples in customizer-filtered.php
	 * @since 1.7.0
	 */
        $wp_customize->add_setting( 'bt_woo_border_color', array(
                'default' => bt_woo_button_border_color_default(),
                'sanitize_callback' => 'sanitize_hex_color',
        ) );
        
	$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize, 'bt_woo_border_color', array(
                'label'      => __( 'Border Color', 'beavertron' ), //set the label to appear in the Customizer
                'section'    => 'woocommerce_colors', //select the section for it to appear under  
                'settings'   => 'bt_woo_border_color', //pick the setting it applies to
		)
        ) );
        
	$wp_customize->add_setting( 'bt_woo_border_color_hover', array(
                'default' => bt_woo_button_border_hover_color_default(),
                'sanitize_callback' => 'sanitize_hex_color',
        ) );
        
	$wp_customize->add_control( new WP_Customize_Color_Control(
	$wp_customize, 'bt_woo_border_color_hover', array(
                'label'      => __( 'Border Hover Color', 'beavertron' ), //set the label to appear in the Customizer
                'section'    => 'woocommerce_colors', //select the section for it to appear under  
                'settings'   => 'bt_woo_border_color_hover', //pick the setting it applies to
		)
	) );

        // Add buttons background disabled color
        // Add setting.
        $wp_customize->add_setting( 'bt_woo_button_dis_color', array(
                'default' => bt_woo_button_dis_color_default(),
                'sanitize_callback' => 'sanitize_hex_color',
        ) );

        // Add control
        $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize, 'bt_woo_button_dis_color', array(
                'label'      => __( 'Button Disabled Color', 'beavertron' ), //set the label to appear in the Customizer
                'section'    => 'woocommerce_colors', //select the section for it to appear under
                'settings'   => 'bt_woo_button_dis_color' //pick the setting it applies to
                )
        ) );

        // Add buttons hover - focus background color
        // Add setting.
        $wp_customize->add_setting( 'bt_woo_button_dis_hover_color', array(
                'default' => bt_woo_button_dis_hover_color_default(),
                'sanitize_callback' => 'sanitize_hex_color',
        ) );

        // Add control
        $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize, 'bt_woo_button_dis_hover_color', array(
                'label'      => __( 'Button Disabled Hover Color', 'beavertron' ), //set the label to appear in the Customizer
                'section'    => 'woocommerce_colors', //select the section for it to appear under
                'settings'   => 'bt_woo_button_dis_hover_color' //pick the setting it applies to
                )
        ) );

        // Add price color
        // Add setting.
        $wp_customize->add_setting( 'bt_woo_price_color', array(
                'default' => bt_woo_price_color_default(),
                'sanitize_callback' => 'sanitize_hex_color',
        ) );

        /* Adding in a Padding Controls for Woo Buttons to the 'woocommerce_colors' panel
         * @since 1.7.0
         */
        $wp_customize->add_setting(
                'bt_button_woo_padding_left_right', //give it an ID
                array(
                        'default' => '30', // Give it a default
                        //'transport' => 'postMessage',
                )
        );
        
        $wp_customize->add_control(
                new WP_Customize_Range_Control(
                $wp_customize,
                'bt_button_woo_padding_leftright', //give it an ID
                        array(
                                'type'     => 'number',
                                'label'    => __( 'Button Padding Left/Right', 'beavertron' ),   //set the label to appear in the Customizer
                                'section'  => 'woocommerce_colors',                                      //select the section for it to appear under  
                                'settings' => 'bt_button_woo_padding_left_right',                    //pick the setting it applies to
                                'priority' => 15,
                                'input_attrs'  => array(
                                        'min'  => 0,
                                        'max'  => 100,
                                        'step' => 1,
                                ),
                        )
                )
        );

        $wp_customize->add_setting(
                'bt_button_woo_padding_top_bottom', //give it an ID
                array(
                        'default' => '5', // Give it a default
                        //'transport' => 'postMessage',
                )
        );

        $wp_customize->add_control(
                new WP_Customize_Range_Control(
                $wp_customize,
                'bt_button_woo_padding_topbottom', //give it an ID
                        array(
                                'type'     => 'number',
                                'label'    => __( 'Button Padding Top/Bottom', 'beavertron' ),   //set the label to appear in the Customizer
                                'section'  => 'woocommerce_colors',                              //select the section for it to appear under  
                                'settings' => 'bt_button_woo_padding_top_bottom',                //pick the setting it applies to
                                'priority' => 15,
                                'input_attrs'  => array(
                                        'min'  => 0,
                                        'max'  => 100,
                                        'step' => 1,
                                ),
                        )
                )
        );
        // Add Woo button font family
        $wp_customize->add_setting(
                'bt_button_woo_font_family', //give it an ID
                    array(
                        'default' => 'Arial', // Give it a default
                        //'transport' => 'postMessage',
                    )
        );
            
        $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize,
                'bt_button_woo_font_family', //give it an ID
                        array(
                                'class'   => 'WP_Customize_Control',
                                'label'   => __( 'Font Family', 'beavertron' ),
                                'type'    => 'font',
                                'connect' => 'bt_button_woo_font_weight',  //set the label to appear in the Customizer
                                'section'  => 'woocommerce_colors',  //select the section for it to appear under  
                                'settings' => 'bt_button_woo_font_family',  //pick the setting it applies to
                                'priority' => 15,
                        ),
        ) );

        // Add Woo button font weight
        $wp_customize->add_setting(
                'bt_button_woo_font_weight', //give it an ID
                    array(
                        'default' => '400', // Give it a default
                        //'transport' => 'postMessage',
                    )
        );
            
        $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize,
                'bt_button_woo_font_weight', //give it an ID
                        array(
                                'class'   => 'WP_Customize_Control',
                                'label'   => __( 'Font Weight', 'beavertron' ),
                                'type'    => 'font-weight',
                                'connect' => 'bt_button_woo_font_family',  //set the label to appear in the Customizer
                                'section'  => 'woocommerce_colors',       //select the section for it to appear under  
                                'settings' => 'bt_button_woo_font_weight',   //pick the setting it applies to
                                'priority' => 15,
                        ),
        ) );

         // Add control
         $wp_customize->add_control( new WP_Customize_Color_Control(
                $wp_customize, 'bt_woo_price_color', array(
                        'label'    => __( 'Price Color', 'beavertron' ),   //set the label to appear in the Customizer
                        'section'  => 'woocommerce_colors',                //select the section for it to appear under
                        'settings' => 'bt_woo_price_color',                //pick the setting it applies to
                        'priority' => 20
                        )
        ) );


        // Add font size
        $wp_customize->add_setting(
                'bt_button_woo_font_size', //give it an ID
                array(
                        'default' => '16', // Give it a default
                        //'transport' => 'postMessage',
                )
        );
        
        $wp_customize->add_control(
                new WP_Customize_Range_Control(
                $wp_customize,
                'bt_button_woo_font_size', //give it an ID
                        array(
                                'class'   => 'WP_Customize_Range_Control',
                                'label'   => __( 'Font Size', 'Font size for buttons.', 'beavertron' ),
                               // 'type'       => 'number',
                                'section'  => 'woocommerce_colors',       //select the section for it to appear under  
                                'settings' => 'bt_button_woo_font_size',   //pick the setting it applies to
                                'priority' => 15,
                                'input_attrs' => array(
                                        'min' => 10,
                                        'max' => 80,
                                    ),
                        ),
        ) );

        // Add line-height
        $wp_customize->add_setting(
                'bt_button_woo_line_height', //give it an ID
                array(
                        'default'   => '1.2',
                      //  'transport' => 'postMessage',
                )
        );
        
        $wp_customize->add_control(
                new WP_Customize_Range_Control(
                $wp_customize,
                'bt_button_woo_line_height', //give it an ID
                        array(
                                'class'      => 'WP_Customize_Range_Control',
                                'label'      => __( 'Line Height', 'beavertron' ),
                                'type'       => 'number',
                                'input_attrs'    => array(
                                        'min'  => 1,
                                        'max'  => 3,
                                        'step' => 0.05,
                                ),
                                'section'  => 'woocommerce_colors',       //select the section for it to appear under  
                                'settings' => 'bt_button_woo_line_height',   //pick the setting it applies to
                                'priority' => 15,
                        ),
        ));


        // Add text transform
        $wp_customize->add_setting(
                'bt_button_woo_text_transform', //give it an ID
                array(
                        'default'   => 'none',
                        //'transport' => 'postMessage',
                )
        );
        
        $wp_customize->add_control(
                new WP_Customize_Control(
                $wp_customize,
                'bt_button_woo_text_transform', //give it an ID
                        array(
                        'class'   => 'WP_Customize_Control',
                        'label'   => _x( 'Text Transform', 'Text transform for buttons.', 'beavertron' ),
                        'type'    => 'select',
                        'choices' => array(
                                'none'       => __( 'Regular', 'beavertron' ),
                                'capitalize' => __( 'Capitalize', 'beavertron' ),
                                'uppercase'  => __( 'Uppercase', 'beavertron' ),
                                'lowercase'  => __( 'Lowercase', 'beavertron' ),
                        ),
                        'section'  => 'woocommerce_colors',       //select the section for it to appear under  
                        'settings' => 'bt_button_woo_text_transform',   //pick the setting it applies to
                        'priority' => 15,
                        ),
        ));

        // Add border style
        $wp_customize->add_setting(
                'bt_button_woo_border_style', //give it an ID
                array(
                        'default'   => 'none',
                       // 'transport' => 'postMessage',
                )
        );
        
        $wp_customize->add_control(
                new WP_Customize_Control(
                $wp_customize,
                'bt_button_woo_border_style', //give it an ID
                        array(
                        'class'   => 'WP_Customize_Control',
                        'label'   => _x( 'Border Style', 'Border style for buttons.', 'beavertron' ),
                        'type'    => 'select',
                        'choices' => array(
                                'none'    => __( 'None', 'beavertron' ),
                                'solid'   => __( 'Solid', 'beavertron' ),
                                'dotted'  => __( 'Dotted', 'beavertron' ),
                                'dashed'  => __( 'Dashed', 'beavertron' ),
                                'double'  => __( 'Double', 'beavertron' ),
                                'groove'  => __( 'Groove', 'beavertron' ),
                                'ridge'   => __( 'Ridge', 'beavertron' ),
                                'inset'   => __( 'Inset', 'beavertron' ),
                                'outset'  => __( 'Outset', 'beavertron' ),
                                'initial' => __( 'Initial', 'beavertron' ),
                                'inherit' => __( 'Inherit', 'beavertron' ),
                        ),
                        'section'  => 'woocommerce_colors',       //select the section for it to appear under  
                        'settings' => 'bt_button_woo_border_style',   //pick the setting it applies to
                        'priority' => 15,
                        ),
        ));

        // Add border width
        $wp_customize->add_setting(
                'bt_button_woo_border_width', //give it an ID
                array(
                        'default'   => '0',
                       // 'transport' => 'postMessage',
                )
        );
        
        $wp_customize->add_control(
                new WP_Customize_Range_Control(
                $wp_customize,
                'bt_button_woo_border_width', //give it an ID
                        array(
                        'class'   => 'WP_Customize_Range_Control',
                        'label'   => _x( 'Border Width', 'Border width for buttons.', 'beavertron' ),
                        'type'    => 'number',
                        'input_attrs' => array(
                                'min'  => 0,
                                'max'  => 10,
                                'step' => 1,
                        ),
                        'section'  => 'woocommerce_colors',       //select the section for it to appear under  
                        'settings' => 'bt_button_woo_border_width',   //pick the setting it applies to
                        'priority' => 15,
                        ),
        ));
        
        
        
        // Add border radius
        $wp_customize->add_setting(
                'bt_button_woo_border_radius', //give it an ID
                array(
                        'default'   => '0',
                       // 'transport' => 'postMessage',
                )
        );
        
        $wp_customize->add_control(
                new WP_Customize_Range_Control(
                $wp_customize,
                'bt_button_woo_border_radius', //give it an ID
                        array(
                        'class'   => 'WP_Customize_Range_Control',
                        'label'   => _x( 'Border Radius', 'Font size for buttons.', 'beavertron' ),
                        'type'    => 'number',
                        'input_attrs' => array(
                                'min'  => 0,
                                'max'  => 25,
                                'step' => 1,
                        ),
                        'section'  => 'woocommerce_colors',       //select the section for it to appear under  
                        'settings' => 'bt_button_woo_border_radius',   //pick the setting it applies to
                        'priority' => 15,
                        ),
        ));
        
        // Add sale price color
        // Add setting.
        $wp_customize->add_setting( 'bt_woo_sale_price_color', array(
                'default'           => bt_woo_sale_price_color_default(),
                'sanitize_callback' => 'sanitize_hex_color',
        ) );

        // Add control
        $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize, 'bt_woo_sale_price_color', array(
                'label'    => __( 'SALE Price Color', 'beavertron' ),   //set the label to appear in the Customizer
                'section'  => 'woocommerce_colors',                     //select the section for it to appear under
                'settings' => 'bt_woo_sale_price_color',                //pick the setting it applies to
                'priority' => 20
                )
        ) );



        // Add INFO color
        // Add setting.
        $wp_customize->add_setting( 'bt_woo_info_color', array(
                'default'           => bt_woo_info_color_default(),
                'sanitize_callback' => 'sanitize_hex_color',
        ) );

        // Add control
        $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize, 'bt_woo_info_color', array(
                'label'    => __( 'Info Color', 'beavertron' ),   //set the label to appear in the Customizer
                'section'  => 'woocommerce_colors',               //select the section for it to appear under
                'settings' => 'bt_woo_info_color',                //pick the setting it applies to
                'priority' => 20
                )
        ) );

        // Add Error color
        // Add setting.
        $wp_customize->add_setting( 'bt_woo_error_color', array(
                'default'           => bt_woo_error_color_default(),
                'sanitize_callback' => 'sanitize_hex_color',
        ) );

        // Add control
        $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize, 'bt_woo_error_color', array(
                'label'    => __( 'Error Color', 'beavertron' ),   //set the label to appear in the Customizer
                'section'  => 'woocommerce_colors',                //select the section for it to appear under
                'settings' => 'bt_woo_error_color',                //pick the setting it applies to
                'priority' => 20
                )
        ) );

        // Add Message color
        // Add setting.
        $wp_customize->add_setting( 'bt_woo_message_color', array(
                'default'           => bt_woo_message_color_default(),
                'sanitize_callback' => 'sanitize_hex_color',
        ) );

        // Add control
        $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize, 'bt_woo_message_color', array(
                'label'    => __( 'Message Color', 'beavertron' ),   //set the label to appear in the Customizer
                'section'  => 'woocommerce_colors',                  //select the section for it to appear under
                'settings' => 'bt_woo_message_color',                //pick the setting it applies to
                'priority' => 20
                )
        ) );

        // Add extra section in WooCommerce
	$wp_customize->add_section( 'woo_options', 
        array(
                'title'         => __( 'Woo Options', 'brickston' ),
                'priority'      => 1,
                'panel'         => 'woocommerce'
        ) );
}

