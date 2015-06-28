<?php
/**
 * Generic Header template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 1.0
 */

global $cp_options;

define('CP_ADD_NEW_URL_INT','/listing-types/'); /* new line */
?>

<?php

$cpuser = cp_get_user_membership_package(2);
//var_dump( $cpuser );
$cpuser = cp_get_user_membership_package(3);
//var_dump( $cpuser );


/**
 * custom post types:
 *
 * post
 * page
 * attachment
 * revision
 * nav_menu_item
 * ad_listing
 * package-listing
 * package-membership
 * transaction
 */
?>

<div class="header">
	<div class="header_top">
		<div class="header_top_res">
			<p>
				<?php echo cp_login_head(); ?>
				<a href="<?php echo appthemes_get_feed_url(); ?>" class="srvicon rss-icon" target="_blank" title="<?php _e( 'RSS Feed', APP_TD ); ?>"><?php _e( 'RSS Feed', APP_TD ); ?></a>
				<?php if ( $cp_options->facebook_id ) { ?>
					&nbsp;|&nbsp;<a href="<?php echo appthemes_make_fb_profile_url( $cp_options->facebook_id ); ?>" class="srvicon facebook-icon" target="_blank" title="<?php _e( 'Facebook', APP_TD ); ?>"><?php _e( 'Facebook', APP_TD ); ?></a>
				<?php } ?>
				<?php if ( $cp_options->twitter_username ) { ?>
					&nbsp;|&nbsp;<a href="http://twitter.com/<?php echo $cp_options->twitter_username; ?>" class="srvicon twitter-icon" target="_blank" title="<?php _e( 'Twitter', APP_TD ); ?>"><?php _e( 'Twitter', APP_TD ); ?></a>
				<?php } ?>
			</p>
		</div><!-- /header_top_res -->
	</div><!-- /header_top -->
	<div class="header_main">
		<div class="header_main_bg">
			<div class="header_main_res">
				<div id="logo">
					<?php if ( get_header_image() ) { ?>
						<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php header_image(); ?>" class="header-logo" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
						</a>
					<?php } elseif ( display_header_text() ) { ?>
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<?php bloginfo( 'name' ); ?>
							</a>
						</h1>
					<?php } ?>
					<?php if ( display_header_text() ) { ?>
						<div class="description"><?php bloginfo( 'description' ); ?></div>
					<?php } ?>
				</div><!-- /logo -->
				<div class="adblock">
					<?php if ( is_active_sidebar( 'featured-broker-sidebar' ) ) : ?>
						<div id="featured-broker-sidebar" class="header-sidebar widget-area" role="complementary">
							<?php dynamic_sidebar( 'featured-broker-sidebar' ); ?>
						</div><!-- #featured-broker-sidebar -->
					<?php endif; ?>
					<?php // appthemes_advertise_header(); ?>
				</div><!-- /adblock -->
				<div class="clr"></div>
			</div><!-- /header_main_res -->
		</div><!-- /header_main_bg -->
	</div><!-- /header_main -->
	<div class="header_menu">
		<div class="header_menu_res">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'menu-header', 'fallback_cb' => false, 'container' => false ) ); ?>
			<a href="<?php echo CP_ADD_NEW_URL_INT; ?>" class="obtn btn_orange"><?php _e( 'Sell a CannaBiz', APP_TD ); ?></a>
			<div class="clr"></div>
		</div><!-- /header_menu_res -->
	</div><!-- /header_menu -->
</div><!-- /header -->