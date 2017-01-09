<?php
/**
 * Replace With Theme Name Theme Customizer
 *
 * Contains methods for customizing the theme customization screen.
 *
 * @link 		http://codex.wordpress.org/Theme_Customization_API
 * @since 		1.0.0
 * @package  	thebabyfold
 */
class thebabyfold_Customize {

   /**
	* This hooks into 'customize_register' (available as of WP 3.4) and allows
	* you to add new sections and controls to the Theme Customize screen.
	*
	* Note: To enable instant preview, we have to actually write a bit of custom
	* javascript. See live_preview() for more.
	*
	* @access 		public
	* @see 			add_action( 'customize_register', $func )
	* @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	* @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	* @since 		1.0.0
	*/
	public static function register( $wp_customize ) {

		// Theme Options Panel
		$wp_customize->add_panel( 'babyfold_options',
			array(
				'capability' 		=> 'edit_theme_options',
				'description' 		=> __( 'Options for The Baby Fold theme', 'thebabyfold' ),
				'priority' 			=> 10,
				'theme_supports' 	=> '',
				'title' 			=> __( 'Theme Options', 'thebabyfold' ),
			)
		);



		// Default Footer Image Section
		$wp_customize->add_section( 'babyfold_footer',
			array(
				'capability' 	=> 'edit_theme_options',
				'description' 	=> __( 'Default Footer Image', 'thebabyfold' ),
				'panel' 		=> 'babyfold_options',
				'priority' 		=> 10,
				'title' 		=> __( 'Default Footer Image', 'thebabyfold' ),
			)
		);

		// Image Upload Field
		$wp_customize->add_setting(
			'default_footer_image',
			array(
				'default' 	=> '',
				'transport' => 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'default_footer_image',
				array(
					'capability' 	=> 'edit_theme_options',
					'label' 		=> __( 'Default Footer Image', 'thebabyfold' ),
					'section' 		=> 'babyfold_footer',
					'settings' 		=> 'default_footer_image'
				)
			)
		);



		// Promo Box 1 Section
		$wp_customize->add_section( 'babyfold_hp_promo_box_1',
			array(
				'capability' 	=> 'edit_theme_options',
				'description' 	=> __( 'Homepage Promo Box 1', 'thebabyfold' ),
				'panel' 		=> 'babyfold_options',
				'priority' 		=> 10,
				'title' 		=> __( 'Promo Box 1', 'thebabyfold' )
			)
		);

		// Promo Box 1 Image
		$wp_customize->add_setting(
			'promo_box_1_image',
			array(
				'default' 	=> '',
				'transport' => 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'promo_box_1_image',
				array(
					'capability' 	=> 'edit_theme_options',
					'label' 		=> __( 'Promo Box 1 Image', 'thebabyfold' ),
					'section' 		=> 'babyfold_hp_promo_box_1',
					'settings' 		=> 'promo_box_1_image'
				)
			)
		);

		// Promo Box 1 URL
		$wp_customize->add_setting(
			'promo_box_1_url',
			array(
				'default' 	=> '',
				'transport' => 'postMessage'
			)
		);
		$wp_customize->add_control(
			'promo_box_1_url',
			array(
				'capability' 	=> 'edit_theme_options',
				'label' 		=> __( 'Promo Box 1 Link', 'thebabyfold' ),
				'section' 		=> 'babyfold_hp_promo_box_1',
				'settings' 		=> 'promo_box_1_url',
				'type' 			=> 'url'
			)
		);

		// Promo Box 1 Text
		$wp_customize->add_setting(
			'promo_box_1_text',
			array(
				'default' 	=> '',
				'transport' => 'postMessage'
			)
		);
		$wp_customize->add_control(
			'promo_box_1_text',
			array(
				'capability' 	=> 'edit_theme_options',
				'label' 		=> __( 'Promo Box 1 Text', 'thebabyfold' ),
				'section' 		=> 'babyfold_hp_promo_box_1',
				'settings' 		=> 'promo_box_1_text',
				'type' 			=> 'text'
			)
		);



		// Promo Box 2 Section
		$wp_customize->add_section( 'babyfold_hp_promo_box_2',
			array(
				'capability' 	=> 'edit_theme_options',
				'description' 	=> __( 'Homepage Promo Box 2', 'thebabyfold' ),
				'panel' 		=> 'babyfold_options',
				'priority' 		=> 10,
				'title' 		=> __( 'Promo Box 2', 'thebabyfold' )
			)
		);

		// Promo Box 2 Image
		$wp_customize->add_setting(
			'promo_box_2_image',
			array(
				'default' 	=> '',
				'transport' => 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'promo_box_2_image',
				array(
					'capability' 	=> 'edit_theme_options',
					'label' 		=> __( 'Promo Box 2 Image', 'thebabyfold' ),
					'section' 		=> 'babyfold_hp_promo_box_2',
					'settings' 		=> 'promo_box_2_image'
				)
			)
		);

		// Promo Box 2 URL
		$wp_customize->add_setting(
			'promo_box_2_url',
			array(
				'default' 	=> '',
				'transport' => 'postMessage'
			)
		);
		$wp_customize->add_control(
			'promo_box_2_url',
			array(
				'capability' 	=> 'edit_theme_options',
				'label' 		=> __( 'Promo Box 2 Link', 'thebabyfold' ),
				'section' 		=> 'babyfold_hp_promo_box_2',
				'settings' 		=> 'promo_box_2_url',
				'type' 			=> 'url'
			)
		);

		// Promo Box 2 Text
		$wp_customize->add_setting(
			'promo_box_2_text',
			array(
				'default' 	=> '',
				'transport' => 'postMessage'
			)
		);
		$wp_customize->add_control(
			'text_field',
			array(
				'capability' 	=> 'edit_theme_options',
				'label' 		=> __( 'Promo Box 2 Text', 'thebabyfold' ),
				'section' 		=> 'babyfold_hp_promo_box_2',
				'settings' 		=> 'promo_box_2_text',
				'type' 			=> 'text'
			)
		);



		// Promo Box 3 Section
		$wp_customize->add_section( 'babyfold_hp_promo_box_3',
			array(
				'capability' 	=> 'edit_theme_options',
				'description' 	=> __( 'Homepage Promo Box 3', 'thebabyfold' ),
				'panel' 		=> 'babyfold_options',
				'priority' 		=> 10,
				'title' 		=> __( 'Promo Box 3', 'thebabyfold' )
			)
		);

		// Promo Box 3 Image
		$wp_customize->add_setting(
			'promo_box_3_image',
			array(
				'default' 	=> '',
				'transport' => 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'promo_box_3_image',
				array(
					'capability' 	=> 'edit_theme_options',
					'label' 		=> __( 'Promo Box 3 Image', 'thebabyfold' ),
					'section' 		=> 'babyfold_hp_promo_box_3',
					'settings' 		=> 'promo_box_3_image'
				)
			)
		);

		// Promo Box 3 URL
		$wp_customize->add_setting(
			'promo_box_3_url',
			array(
				'default' 	=> '',
				'transport' => 'postMessage'
			)
		);
		$wp_customize->add_control(
			'promo_box_3_url',
			array(
				'capability' 	=> 'edit_theme_options',
				'label' 		=> __( 'Promo Box 3 Link', 'thebabyfold' ),
				'section' 		=> 'babyfold_hp_promo_box_3',
				'settings' 		=> 'promo_box_3_url',
				'type' 			=> 'url'
			)
		);

		// Promo Box 3 Text
		$wp_customize->add_setting(
			'promo_box_3_text',
			array(
				'default' 	=> '',
				'transport' => 'postMessage'
			)
		);
		$wp_customize->add_control(
			'promo_box_3_text',
			array(
				'capability' 	=> 'edit_theme_options',
				'label' 		=> __( 'Promo Box 3 Text', 'thebabyfold' ),
				'section' 		=> 'babyfold_hp_promo_box_3',
				'settings' 		=> 'promo_box_3_text',
				'type' 			=> 'text'
			)
		);



/*
		// New Section
		$wp_customize->add_section( 'new_section',
			array(
				'capability' 	=> 'edit_theme_options',
				'description' 	=> __( 'New Customizer Section', 'thebabyfold' ),
				'panel' 		=> 'babyfold_options',
				'priority' 		=> 10,
				'title' 		=> __( 'New Section', 'thebabyfold' )
			)
		);




		// Existing Settings
		title_tagline		Site Title & Tagline
		colors 				Colors
		header_image 		Header Image
		background_image 	Background Image
		nav 				Navigation
		static_front_page 	Static Front Page



		// Add Controls

		// Text Field
		$wp_customize->add_setting(
			'text_field',
			array(
				'default' 	=> '',
				'transport' => 'postMessage'
			)
		);
		$wp_customize->add_control(
			'text_field',
			array(
				'label' 	=> __( 'Text Field', 'thebabyfold' ),
				'section' 	=> 'new_section',
				'settings' 	=> 'text_field',
				'type' 		=> 'text'
			)
		);



		// Checkbox Field
		$settingargs['default'] 			= 'true';
		$settingargs['transport'] 			= 'postMessage';
		$wp_customize->add_setting( 'checkbox_field', $settingargs );

		$controlargs['label'] 				= __( 'Checkbox Field', 'thebabyfold' );
		$controlargs['section'] 			= 'new_section';
		$controlargs['settings'] 			= 'checkbox_field';
		$wp_customize->add_control( 'checkbox_field', $controlargs );



		// Radio Field
		$settingargs['default'] 			= 'choice1';
		$settingargs['transport'] 			= 'postMessage';
		$wp_customize->add_setting( 'radio_field', $settingargs );

		$controlargs['choices']['choice1'] 	= 'Choice 1';
		$controlargs['choices']['choice2'] 	= 'Choice 2';
		$controlargs['choices']['choice3'] 	= 'Choice 3';
		$controlargs['label'] 				= __( 'Radio Field', 'thebabyfold' );
		$controlargs['section'] 			= 'new_section';
		$controlargs['settings'] 			= 'radio_field';
		$wp_customize->add_control( 'radio_field', $controlargs );



		// Select Field
		$settingargs['default'] 			= 'choice1';
		$settingargs['transport'] 			= 'postMessage';
		$wp_customize->add_setting( 'select_field', $settingargs );

		$controlargs['choices']['choice1'] 	= 'Choice 1';
		$controlargs['choices']['choice2'] 	= 'Choice 2';
		$controlargs['choices']['choice3'] 	= 'Choice 3';
		$controlargs['label'] 				= __( 'Select Field', 'thebabyfold' );
		$controlargs['section'] 			= 'new_section';
		$controlargs['settings'] 			= 'select_field';
		$controlargs['type'] 				= 'dropdown-pages';
		$wp_customize->add_control( 'select_field', $controlargs );



		// Textarea Field
		function textarea_customizer( $wp_customize ) {

			class Example_Customize_Textarea_Control extends WP_Customize_Control {

				public $type = 'textarea';

				public function render_content() {

					?><label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
					</label><?php

				} // render_content()

			} // class

		} // textarea_customizer()

		$wp_customize->add_setting( 'textarea' );

		$controlargs['label'] 				= __( 'Textarea', 'thebabyfold' );
		$controlargs['section'] 			= 'new_section';
		$controlargs['settings'] 			= 'textarea';
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'textarea', $controlargs ) );



		// Page Select Field
		$settingargs['transport'] 			= 'postMessage';
		$wp_customize->add_setting( 'select_page_field', $settingargs );

		$controlargs['label'] 				= __( 'Select Page', 'thebabyfold' );
		$controlargs['section'] 			= 'new_section';
		$controlargs['settings'] 			= 'select_page_field';
		$wp_customize->add_control( 'select_page_field', $controlargs );



		// Color Chooser Field
		$settingargs['default'] 			= '#ffffff';
		$settingargs['transport'] 			= 'postMessage';
		$wp_customize->add_setting( 'color_field', $settingargs );

		$controlargs['label'] 				= __( 'Color Field', 'thebabyfold' );
		$controlargs['section'] 			= 'new_section';
		$controlargs['settings'] 			= 'color_field';
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_field', $controlargs ) );



		// File Upload Field
		$wp_customize->add_setting( 'file-upload' );

		$controlargs['label'] 				= __( 'File Upload', 'thebabyfold' );
		$controlargs['section'] 			= 'new_section';
		$controlargs['settings'] 			= 'file-upload';
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'file-upload', $controlargs ) );



		// Image Upload Field
		$settingargs['default'] 			= '';
		$settingargs['transport'] 			= 'postMessage';
		$wp_customize->add_setting( 'image_field', $settingargs );

		$controlargs['label'] 				= __( 'Image Field', 'thebabyfold' );
		$controlargs['section'] 			= 'new_section';
		$controlargs['settings'] 			= 'image_field';
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'image_field', $controlargs ) );
*/


		// Enable live preview JS
		$wp_customize->get_setting( 'blogname' )->transport 		= 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport 	= 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	} // register()

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 * Used by hook: 'wp_head'
	 *
	 * @access 		public
	 * @see 		add_action( 'wp_head', $func )
	 * @since 		1.0.0
	 */
	public static function header_output() {

		?><!--Customizer CSS-->
		<style type="text/css"><?php

			thebabyfold_Customize::generate_css( '#site-title a', 'color', 'header_textcolor', '#' );
			thebabyfold_Customize::generate_css( 'body', 'background-color', 'background_color', '#' );
			thebabyfold_Customize::generate_css( 'a', 'color', 'link_textcolor' );

		?></style><!--/Customizer CSS--><?php

	} // header_output()

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * Used by hook: 'customize_preview_init'
	 *
	 * @access 		public
	 * @see 		add_action( 'customize_preview_init', $func )
	 * @since 		1.0.0
	 * @uses 	wp_enqueue_script()
	 * @uses 	get_template_directory_uri()
	 */
	public static function live_preview() {

		wp_enqueue_script( 'thebabyfold_customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'jquery', 'customize-preview' ), '20130508', true );

	} // live_preview()

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @access 		public
	 * @since 		1.0.0
	 * @param 		string 		$selector 		CSS selector
	 * @param 		string 		$style 			The name of the CSS *property* to modify
	 * @param 		string 		$mod_name 		The name of the 'theme_mod' option to fetch
	 * @param 		string 		$prefix 		Optional. Anything that needs to be output before the CSS property
	 * @param 		string 		$postfix 		Optional. Anything that needs to be output after the CSS property
	 * @param 		bool 		$echo 			Optional. Whether to print directly to the page (default: true).
	 * @uses 		get_theme_mod()
	 * @return 		string 						Returns a single line of CSS with selectors and a property.
	 */
	public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {

		$return = '';
		$mod 	= get_theme_mod( $mod_name );

		if ( ! empty( $mod ) ) {

			$return = sprintf('%s { %s:%s; }',
				$selector,
				$style,
				$prefix . $mod . $postfix
			);

			if ( $echo ) {

				echo $return;

			}

		}

		return $return;

	} // generate_css()

} // class

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register', array( 'thebabyfold_Customize' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head', array( 'thebabyfold_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init', array( 'thebabyfold_Customize' , 'live_preview' ) );

