<?php
/**
 * Generic Author template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 1.0
 */
$curauth = get_queried_object();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$featured = cpc_is_featured_description( $curauth->ID );
?>
<div class="content">
	<div class="content_botbg">
		<div class="content_res">
			<!-- left block -->
			<div class="content_left">
				<div class="shadowblock_out">
					<div class="shadowblock">
						<h1 class="single dotted"><?php printf( __( 'About %s', APP_TD ), $curauth->display_name ); ?></h1>
						<?php if( $featured ) :?>
						<div class="post">
							<div id="user-photo"><?php appthemes_get_profile_pic($curauth->ID, $curauth->user_email, 96); ?></div>
							<div class="author-main">
								<ul class="author-info">
									<li><strong><?php _e( 'Member Since:', APP_TD ); ?></strong> <?php echo appthemes_display_date( $curauth->user_registered, 'date', true ); ?></li>
									<li><strong>Membership:</strong> <?php echo cpc_author_membership_pack( $curauth->ID ); ?></li>
									<?php if ( ! empty( $curauth->user_url ) ) { ?><li><strong><?php _e( 'Website:', APP_TD ); ?></strong> <a href="<?php echo esc_url( $curauth->user_url ); ?>"><?php echo strip_tags( $curauth->user_url ); ?></a></li><?php } ?>
									<?php if ( ! empty( $curauth->twitter_id ) ) { ?><li><div class="twitterico"></div><a href="http://twitter.com/<?php echo urlencode( $curauth->twitter_id ); ?>" target="_blank"><?php _e( 'Twitter', APP_TD ); ?></a></li><?php } ?>
									<?php if ( ! empty( $curauth->facebook_id ) ) { ?><li><div class="facebookico"></div><a href="<?php echo appthemes_make_fb_profile_url( $curauth->facebook_id ); ?>" target="_blank"><?php _e( 'Facebook', APP_TD ); ?></a></li><?php } ?>
								</ul>
								<?php cp_author_info( 'page' ); ?>
								<?php if( $phone = get_user_meta( $curauth->ID, 'user_phone_number', true ) ) : ?>
								<ul class="author-main" style="padding:0; min-height:0;">
									<li class="author-user_phone_number" style="list-style-type:none;"><strong class="title-user_phone_number"><?php _e( 'Phone:', APP_TD ); ?></strong> <div style="width:289px;clear:both;display:inline;" class="" id="phone-all" data-last="<?php echo substr($phone,-4);?>"><?php echo substr($phone,0,-4); ?><span id="phone-last" style="cursor:pointer;background-color:aliceblue;">XXXX</span></div></li>
								</ul>
									<script>
										(function($) {
											$('#phone-all').click(function() {
											    $('#phone-last').text( $(this).data('last') );
											    $("#phone-last").css({ 'cursor': "initial" });
											    $("#phone-last").css({ 'background-color': "initial" });
											});
										})(jQuery);
									</script>
								<?php endif ?>
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
				<?php if( $featured ) :?>
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
			<?php if( $featured ) :?>
				<?php get_sidebar( 'author' ); ?>
			<?php endif; ?>
			<div class="clr"></div>
		</div><!-- /content_res -->
	</div><!-- /content_botbg -->
</div><!-- /content -->