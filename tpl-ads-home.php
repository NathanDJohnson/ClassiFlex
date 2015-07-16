<?php
/**
 * Template Name: Ads Home Template
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.3
 */
?>

<?php	$options = get_option('classiflex_theme_options'); ?>

<div class="content">
	<div class="content_botbg">
		<div class="content_res">
				<div class="featured-listings control-width">
					<div class="featured-inner">
						<h3>Featured Listings</h3>
					</div>
				</div>
			<?php if( function_exists( 'cpflex_flexslider_slider' ) ) {
				cpflex_flexslider_slider();
			} else {
				get_template_part( 'featured' ); 
			} ?>
			<?php
				if ( has_nav_menu( 'mega-menu' ) ) {
					wp_nav_menu( array( 
						'theme_location' => 'mega-menu',
						'fallback_cb' => false,
						'container_id' => 'centeredmenu'
					) );
				}
			 ?>
			<!-- left block -->  
			<div class="content_left">
				<div class="recent-listings">
					<img src="<?php if ( $options[homepage_image] ){ echo $options[homepage_image]; } ?>" style="max-width:100%; height:auto;">
					<p><?php if ( $options[homepage_text] ){ echo esc_html( $options[homepage_text] ); } ?></p>
				</div>
			</div><!-- /content_left -->
			<?php get_sidebar(); ?>
			<div class="clr"></div>
		</div><!-- /content_res -->
	</div><!-- /content_botbg -->
</div><!-- /content -->