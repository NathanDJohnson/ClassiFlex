<?php
/**
 * The Template for displaying all single ads.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.0
 */
?>
<div class="content">
	<div class="content_botbg">
		<div class="content_res">
			<div class="clr"></div>
			<div class="content_left">
				<?php do_action( 'appthemes_notices' ); ?>
				<?php appthemes_before_loop(); ?>
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php appthemes_before_post(); ?>
						<?php appthemes_stats_update( $post->ID ); //records the page hit ?>
						<div class="shadowblock_out <?php cp_display_style( 'featured' ); ?>">
							<div class="shadowblock">
								<?php appthemes_before_post_title(); ?>
								<h1 class="single-listing"><a href="<?php the_permalink(); ?>" title="<?php echo cpc_initial_caps( esc_html( get_the_title() ) ) ; ?>"><?php echo cpc_initial_caps( esc_html( get_the_title() ) ) ; ?></a></h1>
								<div class="clr"></div>
								<?php appthemes_after_post_title(); ?>
								<div class="pad5 dotted"></div>
								<div class="bigright <?php cp_display_style( 'ad_single_images' ); ?>">
									<ul>
									<?php
										// grab the category id for the functions below
										$cat_id = appthemes_get_custom_taxonomy( $post->ID, APP_TAX_CAT, 'term_id' );
										if ( get_post_meta( $post->ID, 'cp_ad_sold', true ) == 'yes' ) {
									?>
											<li id="cp_sold"><span><?php _e( 'This item has been sold', APP_TD ); ?></span></li>
									<?php
										}
										// 3.0+ display the custom fields instead (but not text areas)
										cp_get_ad_details( $post->ID, $cat_id );
									?>
										<li id="cp_listed"><span><?php _e( 'Listed:', APP_TD ); ?></span> <?php echo appthemes_display_date( $post->post_date ); ?></li>
									<?php if ( $expire_date = get_post_meta( $post->ID, 'cp_sys_expire_date', true ) ) { ?>
										<li id="cp_expires"><span><?php _e( 'Expires:', APP_TD ); ?></span> <?php echo cp_timeleft( $expire_date ); ?></li>
									<?php } ?>
									</ul>
								</div><!-- /bigright -->
								<?php if ( $cp_options->ad_images && cpc_is_featured_description( get_the_author_meta('ID') ) || cpc_ad_has_image( get_the_ID() ) ) { ?>
									<div class="bigleft">
										<div id="main-pic">
											<?php cp_get_image_url(); ?>
											<div class="clr"></div>
										</div>
										<?php	if( cpc_is_featured_description( get_the_author_meta('ID') ) ) : ?>
										<div id="thumbs-pic">
											<?php
												$allowed_images = cpc_allowed_imaged_by_membership( cpc_author_membership_pack( get_the_author_meta('ID') ) );
												cp_get_image_url_single( $post->ID, 'thumbnail', $post->post_title, $allowed_images-1 );
											?>
											<div class="clr"></div>
										</div>
										<?php endif; ?>
									</div><!-- /bigleft -->
								<?php }else { ?>
								<div class="bigleft">
									<div id="main-pic">
										<img class="attachment-medium" alt="" title="" src="<?php echo get_template_directory_uri();?>/images/no-thumb.jpg">
										<div class="clr"></div>
									</div>
								</div>
								<?php } ?>
								<div class="clr"></div>
								<?php appthemes_before_post_content(); ?>
								<div class="single-main">
									<?php
										// 3.0+ display text areas in content area before content.
										if( cpc_is_featured_description( $post->post_author ) ) {
											?>
											<h3>Broker Description</h3>
											<p><?php
											echo get_post_meta( get_the_ID(), 'cp_broker_description', true );
											?></p><?php
										}
									?>
									<h3 class="description-area"><?php _e( 'Description', APP_TD ); ?></h3>
									<?php 
										$thecontent = get_the_content(); 
										if( !cpc_is_featured_description( $post->post_author ) ){
											$thecontent = substr($thecontent, 0, 500);
										}
										echo nl2br($thecontent);
									?>
								</div>
								<?php appthemes_after_post_content(); ?>
							</div><!-- /shadowblock -->
						</div><!-- /shadowblock_out -->
						<?php appthemes_after_post(); ?>
					<?php endwhile; ?>
					<?php appthemes_after_endwhile(); ?>
				<?php else: ?>
					<?php appthemes_loop_else(); ?>
				<?php endif; ?>
				<div class="clr"></div>
				<?php appthemes_after_loop(); ?>
				<?php wp_reset_query(); ?>
				<div class="clr"></div>
				<?php comments_template( '/comments-ad_listing.php' ); ?>
			</div><!-- /content_left -->
			<?php get_sidebar( 'ad' ); ?>
			<div class="clr"></div>
		</div><!-- /content_res -->
	</div><!-- /content_botbg -->
</div><!-- /content -->