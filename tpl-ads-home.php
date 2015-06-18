<?php
/**
 * Template Name: Ads Home Template
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.3
 */
?>
<div class="content">
	<div class="content_botbg">
		<div class="content_res">
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
				<div class="tabcontrol">
					<?php
						remove_action( 'appthemes_after_endwhile', 'cp_do_pagination' );
						$post_type_url = add_query_arg( array( 'paged' => 2 ), get_post_type_archive_link( APP_POST_TYPE ) );
					?>
					<div id="block1">
						<div class="clr"></div>
						<?php
							// show all ads but make sure the sticky featured ads don't show up first
							$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
							query_posts( array( 'post_type' => APP_POST_TYPE, 'ignore_sticky_posts' => 1, 'paged' => $paged ) );
							$total_pages = max( 1, absint( $wp_query->max_num_pages ) );
						?>
						<?php get_template_part( 'loop', 'ad_listing' ); ?>
						<?php
							if ( $total_pages > 1 ) {
						?>
								<div class="paging"><a href="<?php echo $post_type_url; ?>"> <?php _e( 'View More Ads', APP_TD ); ?> </a></div>
						<?php } ?>
					</div><!-- /block1 -->
				</div><!-- /tabcontrol -->
			</div><!-- /content_left -->
			<?php get_sidebar(); ?>
			<div class="clr"></div>
		</div><!-- /content_res -->
	</div><!-- /content_botbg -->
</div><!-- /content -->
