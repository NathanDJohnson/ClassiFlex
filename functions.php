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
			echo $adthumbarray;

		// maybe a v3.0 legacy ad
		} else {
			$adthumblegarray = wp_get_attachment_image_src($image_id, 'thumbnail');
			$img_thumbleg_url_raw = $adthumblegarray[0];
			echo $adthumblegarray;
		}

	// no image so return the placeholder thumbnail
	} else {
		echo '<img class="'. $prevclass .'" alt="no image" title="" src="' . appthemes_locate_template_uri( 'images/no-thumb-75.jpg' ) . '" />';
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
 * Helper function to get the membership packs by post_title
*/
function cpc_get_membership_packs_by_post_title( ){
	return cpc_get_membership_packs('post_title');
}

/**
 * Helper function to get the membership packs by ID
*/
function cpc_get_membership_packs_by_ID( ){
	return cpc_get_membership_packs( 'ID' );
}

/**
 * Helper function to get the membership packs
 */
function cpc_get_membership_packs( $by = 'post_title') {	
	$args = array(
		'post_type' => array( 'package-membership' )
	);
	$testquery = new WP_Query( $args );

	if ( $testquery->have_posts() ) {
		$packs = array();
		foreach( $testquery->posts as $post ){
            $packs[] = $post->$by;
		}
		return $packs;
	}
	return;
}

/**
 * Helper function to get the ad packs
 */
function cpc_get_ad_packs( $by = 'post_title') {	
	$args = array(
		'post_type' => array( 'package-listing' )
	);
	$testquery = new WP_Query( $args );

	if ( $testquery->have_posts() ) {
		$packs = array();
		foreach( $testquery->posts as $post ){
            $packs[] = $post->$by;
		}
		return $packs;
	}
	return;
}

/**
 * Prior to getting the posts, apply a filter that orderby meta_key 
 */
add_action('pre_get_posts','cpc_search_filter');
function cpc_search_filter( $query ) {
	if ( !is_page() && !is_admin() && $query->is_main_query() ) {
		$query->set('orderby','meta_value_num');
		$query->set('meta_key','cpc_sys_sort_value'); 
		$query->set('order','ASC'); 
	}
}

/**
 * Function that sorts the ads by membership type (if option set)
 */
add_action('wp', 'cpc_sort_ads_by_membership');
function cpc_sort_ads_by_membership( ) {
	// No need to sort by membership on author page
	if( is_admin || is_author() || is_page() ) { return; }

	global $wp_query;
	$ads = $wp_query;
	
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
	
	$search_by[] = ''; // include ads without memberships attached at the end
	
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
 * Returns true if the user has a membership that is featured on the homepage
 */
function cpc_is_featured_ad( $userID ){
	$options = get_option('classiflex_theme_options');
	if ( $options['featured_ad'] ) {
		$featured = explode(',', str_replace(", ",",",esc_html($options['featured_ad'] ) ) );
		
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
 * Returns true if the ad pack includes an image
 */
function cpc_ad_has_image( $postID ){

	$pack = cpc_ad_pack_used( $postID );
	
	// Hard code this for now, add option later
	if( in_array( $pack, array( 'Yearly Upgrade' , 'Monthly Upgrade' ) ) ){
		return true;
	}
	return false;
}

/**
 * Returns true if the user has a membership that includes an image
 */
function cpc_is_featured_image( $userID ){

	$options = get_option('classiflex_theme_options');
	if ( $options['featured_image'] ) {
		$featured = explode(',', str_replace(", ",",",esc_html($options['featured_description'] ) ) );
		
		if( in_array( cpc_author_membership_pack( $userID ), $featured ) ){
			return true;
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
 * Does the membership pack include free listings
 */
function cpc_free_listings_with_membership( $pack ){
	$options = get_option('classiflex_theme_options');
	if ( $options['ads_included'] ) {
		$featured = explode(',', str_replace(", ",",",esc_html($options['ads_included'] ) ) );
		
		foreach( $featured as $f ){
			if( $f == $pack ) {
				return true;
			}
		}
	}
	return false;
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
add_filter( 'title_save_pre', 'cpc_wp_title', 10, 2);

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
	
	// Check if a user has the free membership or not 
	// and display ad packages accordingly
	$pack = cpc_author_membership_pack( get_current_user_id() );
	if( cpc_free_listings_with_membership( $pack ) ){
		if( in_array( 
				$package->pack_name,  array( 
					'Yearly',
					'Yearly Upgrade',
					'Monthly',
					'Monthly Upgrade'
				)
			)
		){
			$package->ID = false;
			$package->pack_name = false;
			$package = false;
		}
	}
	else{
		if( in_array( 
				$package->pack_name,  array( 
					'Broker',
					'Featured Broker'
				)
			)
		){
			$package->ID = false;
			$package->pack_name = false;
			$package = false;
		}
	}
	return $package;
}
add_filter( 'cp_package_field', 'cp_modify_ad_packs');

/**
 * Helper function to see if cpc_sys_ad_pack is defined
 */
function cpc_is_ad_pack_meta( $postID ){
	if( !$postID ){
		global $post;
		if( !$post ){ 
			return; 
		}
		$postID = $post->ID;
	}

	if( get_post_meta( $postID, 'cpc_sys_ad_pack', true ) ){
		return true;
	}
	return false;
}

/**
 * Checks the meta data to see if cpc_sys_ad_pack is defined
 * If not, tries to guess the ad pack used
 * Returns ad pack or false.
 */
function cpc_ad_pack_used( $postID, $by = 'ID' ){
	if( !$postID ){
		global $post;
		if( !$post ){ 
			return; 
		}
		$postID = $post->ID;
	}
	
	if( $pack = get_post_meta( $postID, 'cpc_sys_ad_pack', true ) ){
		if( $by == 'name' ) { 
			return get_the_title( $pack );
		}
		return $pack;
	}
	else{
		return cpc_guess_ad_pack( $postID, $by = 'ID' );
	}
	// Nothing matched :(
	return false;
}

/**
 * ClassiPress doesn't store the ad pack used in the custom post meta data
 * This function attempts to guess the pack used based on the listing fee
 * and ad duration.
 *
 * NOTE: If two ad packs have exactly the same fee and duration, it will not
 * distinguish between the two and will return the one with higher priority.
 */
function cpc_guess_ad_pack( $postID, $by = 'ID' ){
	if( !$postID ){
		global $post;
		if( !$post ){ 
			return; 
		}
		$postID = $post->ID;
	}

	$price = get_post_meta( $postID, 'cp_sys_ad_listing_fee', true );
	$duration = get_post_meta( $postID, 'cp_sys_ad_duration', true );
	
	// loop through Ad Packs and see if $cost and $duration match ad packs
	foreach( cpc_get_ad_packs('ID') as $pack ){
		$pack_price = get_post_meta( $pack, 'price', true );
		$pack_duration =  get_post_meta( $pack, 'duration', true );
		
		if( $pack_price == $price && $pack_duration == $duration ){
			// Found! Add it to post meta, so we can use it later
			add_post_meta( $postID, 'cpc_sys_ad_pack', $pack );
			if( $by == 'name' ) { 
				return get_the_title( $pack );
			}
			return $pack;
		}
	}
	// Nothing matched :(
	// But if the duration is 365 it's yearly
	// And if it's 30 days it's monthly
	if( floatval( $price_duration ) == 365 ){
		$pack = 'Yearly';
		add_post_meta( $postID, 'cpc_sys_ad_pack', $pack );
		if( $by == 'name' ) { 
			return get_the_title( $pack );
		}
		return $pack;
	}
	elseif( floatval( $price_duration ) == 30 ){
		$pack = 'Monthly';
		add_post_meta( $postID, 'cpc_sys_ad_pack', $pack );
		if( $by == 'name' ) { 
			return get_the_title( $pack );
		}
		return $pack;
	}
	// I've got nothing
	return;
}

/**
 * Helper function returns cpc_sys_ad_pack from post meta
 */
function cpc_ad_pack_meta_data( $postID ){
	if( !$postID ){
		global $post;
		if( !$post ){ 
			return; 
		}
		$postID = $post->ID;
	}
	return get_post_meta( $postID, 'cpc_sys_ad_pack', true );
}

/**
 * When an ad_listing is saved, check to see if the ad pack is stored in meta data
 * If it's not, try to determine the ad pack used from length and cost of ad.
 * Finally, write the sort meta data
 */
add_action( 'save_post_ad_listing', 'cpc_save_post_ad_listing' );
function cpc_save_post_ad_listing( ){
	global $post;
	
	// This shouldn't be necessary, but check anyway
	// Only do this if post_type = ad_listing
	if( $post->post_type != 'ad_listing' ){
		return;
	}
	// If Ad Pack meta data doesn't exists, try guessing it
	if( ! cpc_is_ad_pack_meta( $post->ID ) ) { 
		cpc_guess_ad_pack( $post->ID );
	}

	// Check to make sure the guess worked
	if( cpc_is_ad_pack_meta( $post->ID ) ) { 
		$ad_pack = cpc_ad_pack_used( $post->ID, 'name' );
	}
	
	// Determine the sort value based on membership or ad pack
	// Check if the meta key 'cpc_sys_sort_value' exists
	// Either add or update the value
	return cpc_update_search_meta( $post );
}

/*
 * Function that actually writes the search meta data to the database
 */
function cpc_update_search_meta( $post ) {
	
	// Only do this if post_type = ad_listing
	if( $post->post_type != 'ad_listing' ){
		return;
	}
	
	$options = get_option('classiflex_theme_options');
	$membership_pack = cpc_author_membership_pack( $post->post_author );
	$ad_pack = cpc_ad_pack_used( $post->ID, 'name' );
	
	if( $options['search_by'] ){
		//$search_by = explode(',', str_replace(", ",",",esc_html($options['search_by'] ) ) );
		// For now, let's hard code this, will modify later
		$search_by = array(
			'Premium Broker',
			'Featured Broker',
			'Standard Broker',
			'Featured Yearly||Featured Monthly',
			'Yearly||Monthly',
			'',
		);
								
		foreach( $search_by as $key => $value ){
			$m = explode( '||', $value );
			if( ! is_array($m) ){
				$m = array( $m );
			}
			foreach( $m as $newval ){
				if( $newval == $membership_pack || $newval == $ad_pack ){
					if( null == get_post_meta( $post->ID, 'cpc_sys_sort_value', true ) ) {
						add_post_meta( $post->ID, 'cpc_sys_sort_value', $key );
						continue;
					}
					elseif( $oldval != $key ){
						$oldval = intval( get_post_meta( $postID, 'cpc_sys_sort_value', true ) );
						update_post_meta( $postID, 'cpc_sys_sort_value', $key, $oldval );
						continue;
					}
				}
			}
		}
	}
	return;
}

/**
 * Update the meta search data after a user has been updated
 * This fires when a user updates their profile and when an 
 * admin updates a user's profile. It should update after a
 * membership pack is purchased.
 * See: http://forums.appthemes.com/help-using-classipress/hook-membership-change-89067/
 */
add_action('personal_options_update', 'update_extra_profile_fields');
add_action('edit_user_profile_update', 'update_extra_profile_fields');
function update_extra_profile_fields($user_id) {
	
	// Check to see if the users membership pack has changed
	$membership_pack = cpc_author_membership_pack( $user_id );
	
	$listings = cpc_get_user_listings( $user_id );
	
	if( $listings && $listings->have_posts() ){
		foreach( $listings->posts as $post ){
			cpc_update_search_meta( $post );
			echo $post->ID;
		}
	}
}

/*
 * Get the listings for a given user
 */

function cpc_get_user_listings( $user_id, $args = array() ) {
	if( !isset( $user_id ) ){
		return;
	}
	$defaults = array(
		'post_type' => APP_POST_TYPE,
		'post_status' => 'publish, pending, draft',
		'author' => $user_id,
	);
	$args = wp_parse_args( $args, $defaults );
	
	//$args = apply_filters( 'cp_user_dashboard_listings_args', $args );
	
	$listings = new WP_Query( $args );
	
	if ( ! $listings->have_posts() ) {
		return false;
	}
	
	return $listings;
	//return apply_filters( 'cp_user_dashboard_listings', $listings );
}

function cpc_check_php_version(){
	if ( defined('PHP_VERSION') ) {
		$version = explode('.', PHP_VERSION);
		define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
	}
	if( $version[0] >= 5 || ( $version[0] == 4 && $version[1] >= 3 ) ){
		return true;
	}
	return false;
}