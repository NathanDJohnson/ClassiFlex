<?php

add_action( 'customize_register', 'classiflex_customize_register' );
function classiflex_customize_register($wp_customize) {

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
    
	<?php /* Primary color sets site title, site description, and post title */ ?>
		<?php if ( $options[primary_color] ) : ?>
		 h1,h2,h3,h4,h5,h6 {color:<?php echo esc_html( $options[primary_color] ); ?>;}
		<?php endif; ?>

	<?php /* Secondary color sets masthead background */ ?>
		<?php if ( $options[secondary_color] ) : ?>
			.header_menu { background-color: <?php echo esc_html( $options[secondary_color] ); ?>;}
		<?php endif; ?>

	<?php /* Tertiary color sets main background */ ?>
		<?php if ( $options[tertiary_color] ) : ?>
		 #main,
		 footer > div { 
		 	background-color: <?php echo esc_html( $options[tertiary_color] ); ?>;
		 }
		<?php endif; ?>

	<?php /* Quaternary color sets main text color */ ?>
		<?php if ( $options[quaternary_color] ) : ?>
		 #main p { color: <?php echo esc_html( $options[quaternary_color] ); ?>; }
		 #full-sidebar { background-color: <?php echo esc_html( $options[quaternary_color] ); ?>; }
		<?php endif; ?>
		
		<?php if ( $options[secondary_color] && $options[quaternary_color]) { ?>
			.linearBg2 {
			  background-color: <?php echo esc_html( $options[quaternary_color] ); ?>;
			  background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo esc_html( $options[quaternary_color] ); ?>), to(<?php echo esc_html( $options[secondary_color] ); ?>));
			  background: -webkit-linear-gradient(top, <?php echo esc_html( $options[quaternary_color] ); ?>, <?php echo esc_html( $options[secondary_color] ); ?>);
			  background: -moz-linear-gradient(top, <?php echo esc_html( $options[quaternary_color] ); ?>, <?php echo esc_html( $options[secondary_color] ); ?>);
			  background: -ms-linear-gradient(top, <?php echo esc_html( $options[quaternary_color] ); ?>, <?php echo esc_html( $options[secondary_color] ); ?>);
			  background: -o-linear-gradient(top, <?php echo esc_html( $options[quaternary_color] ); ?>, <?php echo esc_html( $options[secondary_color] ); ?>);
			}
      <?php 
      		}
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