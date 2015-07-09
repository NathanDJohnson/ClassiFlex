<?php

add_action( 'customize_register', 'classiflex_customize_register' );
function classiflex_customize_register($wp_customize) {

/* ------------
 * Homepage Options
 * ------------ */
 	$wp_customize->add_section( 'classiflex_homepage_options', array(
		'title'          => __( 'Homepage Options', 'classiflex' ),
		'description'    => __( 'Change some stuff on the homepage', 'classiflex' ),
		'priority'       => 40,
	) );
// Homepage Image
	$wp_customize->add_setting( 'classiflex_theme_options[homepage_image]', array(
    'default'        => get_stylesheet_directory_uri().'/flowchart.jpg',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Upload_Control( 
		$wp_customize, 
		'homepage_image', 
		array(
			'label'      => __( 'Homepage Image', 'classiflex' ),
			'section'    => 'classiflex_homepage_options',
			'settings'   => 'classiflex_theme_options[homepage_image]',
		) ) 
	);
// Homepage Text
	$wp_customize->add_setting( 'classiflex_theme_options[homepage_text]', array(
    'default'        => '',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control(
		new WP_Customize_Control(
		$wp_customize,
		'homepage_text',
		array(
			'label'          => __( 'Homepage text', 'classiflex' ),
			'section'        => 'classiflex_homepage_options',
			'settings'       => 'classiflex_theme_options[homepage_text]',
			'type'           => 'textarea',
		) )
	); 

/* ------------
 * Search Options
 * ------------ */
 	$wp_customize->add_section( 'classiflex_search_options', array(
		'title'          => __( 'Search Options', 'classiflex' ),
		'description'    => __( 'Search settings', 'classiflex' ),
		'priority'       => 41,
	) );
// Search by settings
	$wp_customize->add_setting( 'classiflex_theme_options[search_by]', array(
    'default'        => '',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control(
		new WP_Customize_Control(
		$wp_customize,
		'search_by',
		array(
			'label'          => __( 'Search Order', 'classiflex' ),
			'section'        => 'classiflex_search_options',
			'settings'       => 'classiflex_theme_options[search_by]',
			'type'           => 'text',
		) )
	); 
// Who gets a featured description
	$wp_customize->add_setting( 'classiflex_theme_options[featured_description]', array(
    'default'        => '',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control(
		new WP_Customize_Control(
		$wp_customize,
		'featured_description',
		array(
			'label'          => __( 'Search Order', 'classiflex' ),
			'section'        => 'classiflex_search_options',
			'settings'       => 'classiflex_theme_options[featured_description]',
			'type'           => 'text',
		) )
	); 
 
/* ------------
 * Primary Palette
 * ------------ */
   $wp_customize->add_section( 'classiflex_color_scheme', array(
    	'title'          => __( 'Primary Palette', 'classiflex' ),
    	'description'    => __( 'Add a description of the default color scheme.', 'classiflex' ),
   	'priority'       => 35,
	) );

// Primary Color
	$wp_customize->add_setting( 'classiflex_theme_options[primary_color]', array(
    'default'        => '#ffffff',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'primary_color', 
		array(
			'label'      => __( 'Primary Color', 'classiflex' ),
			'section'    => 'classiflex_color_scheme',
			'settings'   => 'classiflex_theme_options[primary_color]',
		) ) 
	);

// Secondary Color
	$wp_customize->add_setting( 'classiflex_theme_options[secondary_color]', array(
    'default'        => '#000000',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'secondary_color', 
		array(
			'label'      => __( 'Secondary Color', 'classiflex' ),
			'section'    => 'classiflex_color_scheme',
			'settings'   => 'classiflex_theme_options[secondary_color]',
		) ) 
	);

// Tertiary Color
	$wp_customize->add_setting( 'classiflex_theme_options[tertiary_color]', array(
    'default'        => '#000000',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'tertiary_color', 
		array(
			'label'      => __( 'Tertiary Color', 'classiflex' ),
			'section'    => 'classiflex_color_scheme',
			'settings'   => 'classiflex_theme_options[tertiary_color]',
		) ) 
	);

// Quarternary Color
	$wp_customize->add_setting( 'classiflex_theme_options[quaternary_color]', array(
    'default'        => '#0f0f0f',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'quaternary_color', 
		array(
			'label'      => __( 'Quaternary Color', 'classiflex' ),
			'section'    => 'classiflex_color_scheme',
			'settings'   => 'classiflex_theme_options[quaternary_color]',
		) ) 
	);

/* ------------
 * Accent Palette
 * ------------ */
   $wp_customize->add_section( 'classiflex_accent_scheme', array(
    	'title'          => __( 'Accent Palette', 'classiflex' ),
    	'description'    => __( 'Add a description of the default accent scheme.', 'classiflex' ),
   	'priority'       => 36,
	) );

// Primary Accent
	$wp_customize->add_setting( 'classiflex_theme_options[primary_accent]', array(
    'default'        => '#ffffff',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'primary_accent', 
		array(
			'label'      => __( 'Primary Accent', 'classiflex' ),
			'section'    => 'classiflex_accent_scheme',
			'settings'   => 'classiflex_theme_options[primary_accent]',
		) ) 
	);

// Secondary Color
	$wp_customize->add_setting( 'classiflex_theme_options[secondary_accent]', array(
    'default'        => '#000000',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'secondary_accent', 
		array(
			'label'      => __( 'Secondary Accent', 'classiflex' ),
			'section'    => 'classiflex_accent_scheme',
			'settings'   => 'classiflex_theme_options[secondary_accent]',
		) ) 
	);

// Tertiary Color
	$wp_customize->add_setting( 'classiflex_theme_options[tertiary_accent]', array(
    'default'        => '#000000',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'tertiary_accent', 
		array(
			'label'      => __( 'Tertiary Accent', 'classiflex' ),
			'section'    => 'classiflex_accent_scheme',
			'settings'   => 'classiflex_theme_options[tertiary_accent]',
		) ) 
	);

// Quarternary Color
	$wp_customize->add_setting( 'classiflex_theme_options[quaternary_accent]', array(
    'default'        => '#0f0f0f',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'quaternary_accent', 
		array(
			'label'      => __( 'Quaternary Accent', 'classiflex' ),
			'section'    => 'classiflex_accent_scheme',
			'settings'   => 'classiflex_theme_options[quaternary_accent]',
		) ) 
	);
// Quinary Color
	$wp_customize->add_setting( 'classiflex_theme_options[quinary_accent]', array(
    'default'        => '#0f0f0f',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'quinary_accent', 
		array(
			'label'      => __( 'Quinary Accent', 'classiflex' ),
			'section'    => 'classiflex_accent_scheme',
			'settings'   => 'classiflex_theme_options[quinary_accent]',
		) ) 
	);
// Septenary Color
	$wp_customize->add_setting( 'classiflex_theme_options[septenary_accent]', array(
    'default'        => '#0f0f0f',
    'type'           => 'option',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'septenary_accent', 
		array(
			'label'      => __( 'Septenary Accent', 'classiflex' ),
			'section'    => 'classiflex_accent_scheme',
			'settings'   => 'classiflex_theme_options[septenary_accent]',
		) ) 
	);

}

//load custom css
function custom_enqueue_style() {
	wp_register_style( 'custom-style', get_stylesheet_directory_uri() . '/custom.css', array('child-style') );
	wp_enqueue_style( 'custom-style' ); 
}
add_action( 'wp_enqueue_scripts', 'custom_enqueue_style' );

function classiflex_customize_css() {
	$options = get_option('classiflex_theme_options');
    
    ob_start(); ?>
		
   	<?php if ( $options['featured_description'] ) : ?>
		<?php $featured = explode(',', str_replace(", ",",",esc_html($options['featured_description'] ) ) );

			if(count($featured) > 6){ $featured = array_slice($featured, 0, 6); }
			$fnum = count($featured);
			$colors = array(
							'primary_accent',
							'secondary_accent',
							'tertiary_accent',
							'quaternary_accent',
							'quinary_accent',
							'septenary_accent'
						);
			if(count($colors) > count($featured)){ $colors = array_slice($colors, 0, count($featured)); }
			if(count($featured) > count($colors)){ $featured = array_slice($featured, 0, count($colors)); }
			$fun = array_combine( $colors, $featured );
			
			foreach( $fun as $k => $f ){ ?>
				.<?php echo strtolower( str_replace(' ','-', esc_html($f) ) ); ?> { background-color: <?php echo esc_html( $options[$k] ); ?>; }
			<?php
			}
		?>
		<?php endif; ?>
		
	<?php /* Primary color */ ?>
		<?php if ( $options[primary_color] ) : ?>
		 h1,h3,h5,h3 a,.header div#logo h1 a {color:<?php echo esc_html( $options[primary_color] ); ?>;}
		 .header_menu { border-top: 2px solid <?php echo esc_html( $options[primary_color] ); ?>;}
		 .footer { background-color: <?php echo esc_html( $options[primary_color] ); ?>; }
		<?php endif; ?>

	<?php /* Secondary color */ ?>
		<?php if ( $options[secondary_color] ) : ?>
			#main p.tag { color: <?php echo esc_html( $options[secondary_color] ); ?>;}
			h2,h4,h6 {color:<?php echo esc_html( $options[secondary_color] ); ?>;}
			.header_menu { background-color: <?php echo esc_html( $options[secondary_color] ); ?>;}
			.footer { border-top: 2px solid <?php echo esc_html( $options[secondary_color] ); ?>;}
		<?php endif; ?>

	<?php /* Tertiary color */ ?>
		<?php if ( $options[tertiary_color] ) : ?>
		 footer{ 
		 	background-color: <?php echo esc_html( $options[tertiary_color] ); ?>;
		 }
		<?php endif; ?>

	<?php /* Quaternary color */ ?>
		<?php if ( $options[quaternary_color] ) : ?>
		 p { color: <?php echo esc_html( $options[quaternary_color] ); ?>; }
		<?php endif; ?>

	<?php /* Tertiary accent */ ?>
		<?php if ( $options[tertiary_accent] ) : ?>
		 p.post-price { background-color: <?php echo esc_html( $options[tertiary_accent] ); ?>; }
		<?php endif; ?>
		
	<?php /* Quinary accent */ ?>
		<?php if ( $options[quinary_accent] ) : ?>
		 .colour, span.colour, a, .header_top_res p a, #main p { color: <?php echo esc_html( $options[quinary_accent] ); ?>; }
		<?php endif; ?>

			.btn_orange {
				border: 0;
			   border-top: 1px solid #3ec767;
			   background: #185e28;
			   background: -webkit-gradient(linear, left top, left bottom, from(#599c3e), to(#185e28));
			   background: -webkit-linear-gradient(top, #599c3e, #185e28);
			   background: -moz-linear-gradient(top, #599c3e, #185e28);
			   background: -ms-linear-gradient(top, #599c3e, #185e28);
			   background: -o-linear-gradient(top, #599c3e, #185e28);
			   padding: 6px 12px;
			   -webkit-border-radius: 4px;
			   -moz-border-radius: 4px;
			   border-radius: 4px;
			   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
			   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
			   box-shadow: rgba(0,0,0,1) 0 1px 0;
			   text-shadow: rgba(0,0,0,.4) 0 1px 0;
			   color: white;
			   font-size: 15px;
			   font-family: Helvetica, Arial, Sans-Serif;
			   text-decoration: none;
			   vertical-align: middle;
		   }
			.btn_orange:hover {
				border: 0;
				border-top: 1px solid;
			   border-top-color: #287836;
			   background: #287836;
			   color: #ccc;
		   }
			.btn_orange:active {
				border: 0;
				border-top: 1px solid;
			   border-top-color: #287836;
			   background: #287836;
			   color: #ccc;
		   }
		<?php
         $style = ob_get_contents();
         ob_end_clean();
         
         $style = classiflex_css_compress($style);
         classiflex_writeit(get_stylesheet_directory() . '/custom.css',$style);
}

if ( is_admin() ) {
	add_action( 'customize_save_after', 'classiflex_customize_css');
} else {
	add_action( 'wp_head', 'classiflex_customize_css');
}

// other functions

function classiflex_writeit($file,$data,$append='FILE_APPEND') {
    file_put_contents($file, $data);
}

function classiflex_css_compress($buffer) {
	// Remove comments
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

	// Remove space after colons
	$buffer = str_replace(': ', ':', $buffer);

	// Remove whitespace
	$buffer = str_replace(array("\r\n", "\r", "\n"), '', $buffer);
	$buffer = str_replace(array("\t", ' ', '  ', '   ', '    ', '     ', '      ', '       ', '        ', '         ', '          '), ' ', $buffer);

	$buffer = str_replace("  "," ",$buffer);
	
	// Trim more whitespace
	$buffer = str_replace(array("{ "," {"), "{", $buffer);
	$buffer = str_replace(array(" }"), '}', $buffer);
	$buffer = str_replace(array(", "," ,"), ',', $buffer);
	$buffer = str_replace(array(". "," ."), '.', $buffer);
	$buffer = str_replace(array("; "," ;"), ';', $buffer);
	$buffer = str_replace(array("# "," #"), '#', $buffer);
	
	$buffer = trim($buffer);

   return $buffer;
}
?>