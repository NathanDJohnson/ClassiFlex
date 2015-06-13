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

// Remove auto generated feed links
function my_remove_feeds() {
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
}
add_action( 'after_setup_theme', 'my_remove_feeds' );

function customize_register_init( $wp_customize ){
    $wp_customize->remove_section('colors');
}

add_action( 'customize_register', 'customize_register_init' );