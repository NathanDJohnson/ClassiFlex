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
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/flowchart.jpg" style="max-width:100%; height:auto;">
			</div>
				<div id="recent-featured-listings" class="tabcontrol" style="display: none;" >
					<?php
						$args = array(
							'post_type' => APP_POST_TYPE,
							'post_status' => 'publish',
							'post__in' => get_option('sticky_posts'),
							'posts_per_page' => 4,
							'orderby' => 'date',
							'suppress_filters' => false,
						);
 
						$args = apply_filters( 'cp_featured_slider_args', $args );
 						$featured = new WP_Query( $args ); ?>
 						
					 <?php if ( $featured->have_posts() ) : while ( $featured->have_posts() ) : $featured->the_post(); ?>
<div class="post-wrapper">
	<div class="post-image">
	<?php if ( $cp_options->ad_images ) cp_ad_loop_thumbnail(); ?>
	</div>
	<div class="post-description">
		<div class="post-head">
			<h3>
				<a href="<?php the_permalink(); ?>"><?php if ( mb_strlen( get_the_title() ) >= 75 ) echo mb_substr( get_the_title(), 0, 75 ) . '...'; else the_title(); ?></a>
			</h3>
			<?php appthemes_before_post_title(); // price tag?>
		</div>
		<p class="post-content"><?php echo cp_get_content_preview( 150 ); ?></p>
		<?php //appthemes_after_post_title(); //post meta ?>
		<?php //appthemes_before_post_content(); // ? ?>
	</div>
</div>
 <?php endwhile; 
 wp_reset_postdata();
 else : ?>
 <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
 <?php endif; ?>
				</div>
				<div class="tabcontrol" style="display:none;">
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