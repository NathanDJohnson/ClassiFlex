<?php

// load customization
require_once( get_stylesheet_directory() . '/includes/customization.php' );


/**
 * Add post-thumbnails support
 */
add_theme_support( 'post-thumbnails' );

/**
 * Register footer widgets
 */
register_sidebar( array(
	'name' => 'Featured Broker Sidebar',
	'id' => 'featured-broker-sidebar',
	'description' => 'Appears in the header area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );
register_sidebar( array(
	'name' => 'Footer Sidebar 1',
	'id' => 'footer-sidebar-1',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );
register_sidebar( array(
	'name' => 'Footer Sidebar 2',
	'id' => 'footer-sidebar-2',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );
register_sidebar( array(
	'name' => 'Footer Sidebar 3',
	'id' => 'footer-sidebar-3',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );
register_sidebar( array(
	'name' => 'Footer Sidebar 4',
	'id' => 'footer-sidebar-4',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

/**
 * Mega menu support
 */
function register_mega_menu() {
  register_nav_menu('mega-menu',__( 'Mega Menu' ));
}
add_action( 'init', 'register_mega_menu' );

/**
 * Setup Featured Ads template
 */
function child_setup_featured_ads_template() {
	require_once dirname( __FILE__ ) . '/includes/child-views.php';
	new Child_Featured_Ads_Home;
}
add_action( 'appthemes_init', 'child_setup_featured_ads_template' );

/**
 * Assign Featured Ads template to front page
 */
function child_assign_templates_on_activation() {
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', Child_Featured_Ads_Home::get_id() );
	update_option( 'page_for_posts', CP_Blog_Archive::get_id() );
}
add_action( 'appthemes_first_run', 'child_assign_templates_on_activation' );

/**
 * Enqueue Parent theme CSS before child themes
 */
function cannabiz_enqueue_parent_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'cannabiz_enqueue_parent_style' );

function cannabiz_enqueue_child_style() {
	 wp_dequeue_style( 'at-main' );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array('parent-style','at-color') );
}
add_action( 'wp_enqueue_scripts', 'cannabiz_enqueue_child_style', 11 );

/**
 * Disable comments on ads
 */
function remove_custom_post_comment() {
	remove_post_type_support( APP_POST_TYPE, 'comments' );
	remove_post_type_support( APP_POST_TYPE, 'trackbacks' );
}
add_action( 'init', 'remove_custom_post_comment' );

/**
 * Remove auto generated feed links
 */
function my_remove_feeds() {
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
}
add_action( 'after_setup_theme', 'my_remove_feeds' );

/**
 * Remove Colors section from customization options
 */
function customize_register_init( $wp_customize ){
    $wp_customize->remove_section('colors');
}
add_action( 'customize_register', 'customize_register_init' );

/**
 * Function mostly copied from ClassiPress core theme
 * Modified for listings without images
 */
function cp_ad_loop_thumbnail() {
	global $post, $cp_options;

	// go see if any images are associated with the ad
	$image_id = cp_get_featured_image_id( $post->ID );

	// set the class based on if the hover preview option is set to "yes"
	$prevclass = ( $cp_options->ad_image_preview ) ? 'preview' : 'nopreview';

	if ( $image_id > 0 ) {

		// get 75x75 v3.0.5+ image size
		$adthumbarray = wp_get_attachment_image( $image_id, 'ad-thumb' );

		// grab the large image for onhover preview
		$adlargearray = wp_get_attachment_image_src( $image_id, 'large' );
		$img_large_url_raw = $adlargearray[0];

		// must be a v3.0.5+ created ad
		if ( $adthumbarray ) {
			echo '<a href="'. get_permalink() .'" title="'. the_title_attribute( 'echo=0' ) .'" class="'. $prevclass .'" data-rel="'. $img_large_url_raw .'">'. $adthumbarray .'</a>';

		// maybe a v3.0 legacy ad
		} else {
			$adthumblegarray = wp_get_attachment_image_src($image_id, 'thumbnail');
			$img_thumbleg_url_raw = $adthumblegarray[0];
			echo '<a href="'. get_permalink() .'" title="'. the_title_attribute( 'echo=0' ) .'" class="'. $prevclass .'" data-rel="'. $img_large_url_raw .'">'. $adthumblegarray .'</a>';
		}

	// no image so return the placeholder thumbnail
	} else {
		echo '<a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '"><img class="'. $prevclass .'" alt="no image" title="" src="' . appthemes_locate_template_uri( 'images/no-thumb-75.jpg' ) . '" /></a>';
	}
}

/**
 * Shortcode that displays a custom dotted rule
 */
function cpc_hr_shortcode( $atts ){
	$a = shortcode_atts( array(
		'url' => '',
		'type' => '',
	), $atts );
	ob_start();
	?>
		<img src="<?php echo get_stylesheet_directory_uri();?>/images/DottedRule.png" alt="Icon_CheckMark" class="no-shadow maxwidth cpc-hr">
	<?php
	return apply_filters( 'cpc_hr_shortcode_html', ob_get_clean() );
}
add_shortcode( 'cpc-hr', 'cpc_hr_shortcode' );

/**
 * Shortcode that displays a CSS styled button
 */
function cpc_button_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'url' => '',
		'type' => '',
	), $atts );
	ob_start();
	?>
		<a href="<?php echo esc_html($a['url']); ?>" class="btn_orange"><?php echo esc_html($a['type']); ?></a>
	<?php
	return ob_get_clean();
}
add_shortcode( 'cpc-button', 'cpc_button_shortcode' );

/**
 * Helper function to get the membership packs
 */
function cpc_get_membership_packs() {

	$args = array(
		'post_type' => array( 'package-membership' )
	);
	$testquery = new WP_Query( $args );

	if ( $testquery->have_posts() ) {
		$packs = array();
		foreach( $testquery->posts as $post ){
            $packs[] = $post->post_title;
		}
		return $packs;
	}
	return;
}

/**
 * Function that sorts the ads by membership type (if option set)
 */
add_action('wp', 'cpc_sort_ads_by_membership');
function cpc_sort_ads_by_membership( ) {
	// No need to sort by membership on author page
	if( is_author() ) { return; }

	global $wp_query;
	$ads = $wp_query;
	// Not sure how the ads are ordered
	// But we want to randomize them
	shuffle( $ads->posts );
	
	$options = get_option('classiflex_theme_options');
	if( $options['search_by'] ){
		$search_by = explode(',', str_replace(", ",",",esc_html($options['search_by'] ) ) );
	}
	else {
		return $ads;
	}

	// include other membership packs too	
	foreach( cpc_get_membership_packs() as $pack ){
		if( !in_array( $pack, $search_by ) ){
			$search_by[] = $pack;
		}
	}

	$search_by[]=''; // include ads without memberships attached at the end
	
	$result = array();
	
	if( $ads->have_posts( ) ) { 
		foreach( $ads->posts as $post ){
			$pack = cpc_author_membership_pack( $post->post_author );
			foreach( $search_by as $sort ){
				if( $pack == $sort ) {
					$result[$pack][] = $post;
				}
			}
		}
		if( count( $result ) > 1 ){
			foreach( $search_by as $sort ){
				if( $result[$sort] ){
					foreach ( $result[$sort] as $s ){
						$newads[] = $s;
					}
				}
			}
			$ads->posts = $newads ; 
		}
	}
	$wp_query->posts = $ads->posts;
	return;
}

/**
 * Returns true if the user has a membership that is featured
 */
function cpc_is_featured_description( $userID ){

	$options = get_option('classiflex_theme_options');
	if ( $options['featured_description'] ) {
		$featured = explode(',', str_replace(", ",",",esc_html($options['featured_description'] ) ) );
		
		$pack = cpc_author_membership_pack( $userID );

		foreach( $featured as $f ){
			if( $f == $pack ) {
				return true;
			}
		}
	}
	return false;
}

/**
 * Returns membership as a css style
 */
function cpc_author_membership_style( $userID ){
	return strtolower( str_replace(' ','-', cpc_author_membership_pack( $userID ) ) );
}

/**
 * Returns the Membership pack of a user
 */
function cpc_author_membership_pack( $userID ) {
	global $wpdb;
	$authtype = get_user_meta( $userID, 'active_membership_pack', true );
	
	if(is_numeric($authtype) && function_exists('ukljuci_ad_limit_jms') ){
		$sql = "	SELECT  `post_title` 
					FROM  `$wpdb->posts` 
					WHERE  `ID` =  '$authtype'
					LIMIT 1";
		
		$rows = $wpdb->get_results( $wpdb->prepare( $sql, '' ) );
		foreach ( $rows as $row ) {
			$authtype = $row->post_title;
		}		
	}
	return $authtype;
}

/**
 * If option set, restrict ads from displaying more than a certain number of images
 */
function cpc_allowed_imaged_by_membership( $membership_pack ){
	$options = get_option('classiflex_theme_options');
	
	$type = "classiflex_theme_options[images-$membership_pack]";
	if( $options[$type] ){
		return max( 1, $options[$type] );
	}
	else return 0;
}

/**
 * Add custom query vars
 */
function cpc_add_query_vars_filter( $vars ){
  $vars[] = "search-class";
  $vars[] = "widget_number";
  $vars[] = "cs-all-0";
  $vars[] = "cs-cat--1";
  $vars[] = "cs-cp_state-2";
  $vars[] = "cs-cp_city-3";
  $vars[] = "cs-cp_price-4";
  $vars[] = "cs-cp_business_name-5";
  return $vars;
}
add_filter( 'query_vars', 'cpc_add_query_vars_filter' );

/**
 * Doesn't work - so deprecated I guess
 */
/*
function cpc_get_ads() {

  $vars["search-class"] = get_query_var( "search-class" );
  $vars["widget_number"] = get_query_var( "widget_number" );
  $vars["cs-all-0"] = get_query_var( "cs-all-0" );
  $vars["cs-cat--1"] = get_query_var( "cs-cat--1" );
  $vars["cs-cp_state-2"] = get_query_var( "cs-cp_state-2" );
  $vars["cs-cp_city-3"] = get_query_var( "cs-cp_city-3" );
  $vars["cs-cp_price-4"] = get_query_var( "cs-cp_price-4" );
  $vars["cs-cp_business_name-5"] = get_query_var( "cs-cp_business_name-5" );
 // var_dump( $vars );

	$args = array(
		'post_type' => APP_POST_TYPE,
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'no_found_rows' => true,
		'suppress_filters' => false,
		'ignore_sticky_posts' => true,
		'orderby' => 'rand',
	);

	$ads = new WP_Query( $args );

	if ( ! $ads->have_posts() ) {
		return false;
	}
	return cpc_sort_ads_by_membership( $ads );
}
*/

/**
 * Return a string with the first letter of each word uppercase
 * and the other letter lowercase
*/
function cpc_initial_caps( $string ){
	$string = ucwords( strtolower( $string ) );

	// special cases like McDonald, P.O. Box, etc.
	$prefixes = 'Mc|P\.';
	$string = preg_replace("/\\b($prefixes)(\\w)/e", '"$1".strtoupper("$2")', $string);

	return $string;
}

/**
 * inital caps for <title>
*/
function cpc_wp_title( $title, $sep ) {
	return cpc_initial_caps( trim( $title ) );
}
add_filter( 'wp_title', 'cpc_wp_title', 10, 2 );

/**
 * Helper function get_the_slug() - self-explanatory
 */
if(!function_exists('get_the_slug')){
	function get_the_slug( $id=null ){
		if( empty($id) ):
			global $post;
			if( empty($post) ) {	return ''; } // No global $post var available.
			$id = $post->ID;
		endif;

		$slug = basename( get_permalink($id) );
		return $slug;
	}
}
/**
 * Helper function to get the author slug
 */
function cpc_author_slug(){
	return $GLOBALS['wp_rewrite']->author_base;
}

/**
 * Function that modifies the ad packages based on the user's membership pack
 * NOTE: This required a hack to the core ClassiPress theme
 * See: http://forums.appthemes.com/report-classipress-bugs/includes-custom_forms-php-88906/
 */
function cp_modify_ad_packs( $package ) {
	if( cpc_is_featured_description( get_current_user_id() ) ){
		if( $package->pack_name == 'Yearly' || $package->pack_name == 'Featured Yearly' || $package->pack_name == 'Monthly' || $package->pack_name == 'Featured Monthly' ) {
			$package->ID = false;
			$package->pack_name = false;
			$package = false;
		}
	}
	else{
		if( $package->pack_name == 'Broker' || $package->pack_name == 'Featured Broker' ) {
			$package->ID = false;
			$package->pack_name = false;
			$package = false;
		}
	}
	return $package;
}
add_filter( 'cp_package_field', 'cp_modify_ad_packs');