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
				<?php if ( $cp_options->home_layout == 'directory' ) { ?>
					<div class="shadowblock_out">
						<div class="shadowblock">
							<h2 class="dotted"><?php _e( 'Ad Categories', APP_TD ); ?></h2>
							<div id="directory" class="directory <?php cp_display_style( 'dir_cols' ); ?>">
								<?php echo cp_create_categories_list( 'dir' ); ?>
								<div class="clr"></div>
							</div><!--/directory-->
						</div><!-- /shadowblock -->
					</div><!-- /shadowblock_out -->
				<?php } ?>
				<div class="tabcontrol">
					<ul class="tabnavig">
						<li><a href="#block1"><span class="big"><?php _e( 'Just Listed', APP_TD ); ?></span></a></li>
						<li><a href="#block2"><span class="big"><?php _e( 'Most Popular', APP_TD ); ?></span></a></li>
					</ul>
					<?php
						remove_action( 'appthemes_after_endwhile', 'cp_do_pagination' );
						$post_type_url = add_query_arg( array( 'paged' => 2 ), get_post_type_archive_link( APP_POST_TYPE ) );
					?>
					<!-- tab 1 -->
					<div id="block1">
						<div class="clr"></div>
						<div class="undertab"><span class="big"><?php _e( 'Classified Ads', APP_TD ); ?> / <strong><span class="colour"><?php _e( 'Just Listed', APP_TD ); ?></span></strong></span></div>
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
					<!-- tab 2 -->
					<div id="block2">
						<div class="clr"></div>
						<div class="undertab"><span class="big"><?php _e( 'Classified Ads', APP_TD ); ?> / <strong><span class="colour"><?php _e( 'Most Popular', APP_TD ); ?></span></strong></span></div>
						<?php get_template_part( 'loop', 'popular' ); ?>
						<?php
							global $cp_has_next_page;
							if ( $cp_has_next_page ) {
								$popular_url = add_query_arg( array( 'sort' => 'popular' ), $post_type_url );
						?>
								<div class="paging"><a href="<?php echo $popular_url; ?>"> <?php _e( 'View More Ads', APP_TD ); ?> </a></div>
						<?php } ?>
						<?php wp_reset_query(); ?>
					</div><!-- /block2 -->
				</div><!-- /tabcontrol -->
			</div><!-- /content_left -->
			<?php get_sidebar(); ?>
			<div class="clr"></div>
		</div><!-- /content_res -->
	</div><!-- /content_botbg -->
</div><!-- /content -->
