<?php
/**
 * Generic Author template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 1.0
 */

//This sets the $curauth variable
$curauth = get_queried_object();

$authtype = cpc_author_membership_pack( $curauth->ID );

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$author_posts_count = count_user_posts( $curauth->ID );
?>
<div class="content">
	<div class="content_botbg">
		<div class="content_res">
			<!-- left block -->
			<div class="content_left">
				<div class="shadowblock_out">
					<div class="shadowblock">
						<h1 class="single dotted"><?php printf( __( 'About %s', APP_TD ), $curauth->display_name ); ?></h1>
						<?php if( cpc_is_featured_description( $curauth->ID ) ) :?>
						<div class="post">
							<div id="user-photo"><?php appthemes_get_profile_pic($curauth->ID, $curauth->user_email, 96); ?></div>
							<div class="author-main">
								<ul class="author-info">
									<li><strong><?php _e( 'Member Since:', APP_TD ); ?></strong> <?php echo appthemes_display_date( $curauth->user_registered, 'date', true ); ?></li>
									<li><strong>Membership:</strong> <?php echo $authtype; ?></li>
									<?php if ( ! empty( $curauth->user_url ) ) { ?><li><strong><?php _e( 'Website:', APP_TD ); ?></strong> <a href="<?php echo esc_url( $curauth->user_url ); ?>"><?php echo strip_tags( $curauth->user_url ); ?></a></li><?php } ?>
									<?php if ( ! empty( $curauth->twitter_id ) ) { ?><li><div class="twitterico"></div><a href="http://twitter.com/<?php echo urlencode( $curauth->twitter_id ); ?>" target="_blank"><?php _e( 'Twitter', APP_TD ); ?></a></li><?php } ?>
									<?php if ( ! empty( $curauth->facebook_id ) ) { ?><li><div class="facebookico"></div><a href="<?php echo appthemes_make_fb_profile_url( $curauth->facebook_id ); ?>" target="_blank"><?php _e( 'Facebook', APP_TD ); ?></a></li><?php } ?>
								</ul>
								<?php cp_author_info( 'page' ); ?>
							</div>
							<h3 class="dotted"><?php _e( 'Description', APP_TD ); ?></h3>
							<p><?php echo nl2br( $curauth->user_description ); ?></p>
						</div><!--/post-->
						<?php else: ?>
							<div class="not-broker">
								<p>This user is not a broker.</p>
							</div>
						<?php endif; ?>
					</div><!-- /shadowblock -->
				</div><!-- /shadowblock_out -->
				<?php if( cpc_is_featured_description( $curauth->ID ) ) :?>
				<div class="tabcontrol">
					<div id="block1">
						<div class="clr"></div>
						<div class="undertab"><h3>Latest Ads</h3></div>
							<?php query_posts( array( 'post_type' => APP_POST_TYPE, 'author' => $curauth->ID, 'paged' => $paged ) ); ?>
							<?php get_template_part( 'loop', 'ad_listing' ); ?>
					</div><!-- /block1 -->
				</div><!-- /tabcontrol -->
				<?php endif; ?>				
			</div><!-- /content_left -->
			<?php if( cpc_is_featured_description( $curauth->ID ) ) :?>
				<?php get_sidebar( 'author' ); ?>
			<?php endif; ?>
			<div class="clr"></div>
		</div><!-- /content_res -->
	</div><!-- /content_botbg -->
</div><!-- /content -->