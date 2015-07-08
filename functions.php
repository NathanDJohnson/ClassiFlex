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
 * And (in future ) to not display images for non-broker level members
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
 * Very inefficient sorting function
 */
function cpc_sort_ads_by_membership( $ads ) {

	$options = get_option('classiflex_theme_options');
	if( $options['search_by'] ){
		$search_by = explode(',', str_replace(", ",",",esc_html($options['search_by'] ) ) );
	}
	else {
		return $ads;
	}
	
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
		foreach( $search_by as $sort ){
			foreach ( $result[$sort] as $s ){
				$newads[] = $s;
			}
		}
		$ads->posts = $newads ; 
	}	
	return $ads;
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
 *
 */
function cpc_get_ads() {

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