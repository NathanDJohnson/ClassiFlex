<?php
/**
 * Generic Header template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 1.0
 */

global $cp_options;

define('CP_ADD_NEW_URL_INT','/sell/');
$options = get_option('classiflex_theme_options');
?>
<div class="header">
	<div class="header_top">
		<div class="header_top_res">
			<p>
				<?php echo cp_login_head(); ?>
			</p>
		</div><!-- /header_top_res -->
	</div><!-- /header_top -->
	<div class="header_main">
		<div class="header_main_bg">
			<div class="header_main_res">
				<div id="logo">
					<?php if ( get_header_image() ) : ?>
						<div class="float-left">
							<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php header_image(); ?>" class="header-logo" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
							</a>
						</div>
						<?php if( $options[homepage_image] ) : ?>
						<div class="float-right">
							<a class="site-logo" href="http://buysellcannabiz.com/">
								<img src="<?php echo esc_html( $options[homepage_image] ); ?>" class="header-logo" alt="">
							</a>
						</div>
						<?php endif; ?>
					<?php elseif ( display_header_text() ) :?>
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<?php bloginfo( 'name' ); ?>
							</a>
						</h1>
					<?php endif; ?>
					<?php if ( display_header_text() ) { ?>
						<div class="description"><?php bloginfo( 'description' ); ?></div>
					<?php } ?>
				</div><!-- /logo -->
				<div class="adblock">
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