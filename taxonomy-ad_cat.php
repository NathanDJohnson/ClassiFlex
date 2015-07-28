<?php
/**
 * Taxonomy Template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.0
 */
?>
<div class="content">
	<div class="content_botbg">
		<div class="content_res">
			<!-- left block -->
			<div class="content_left">
				<?php $term = get_queried_object(); ?>
				<div class="shadowblock_out" style="overflow:hidden;">
					<div class="shadowblock" style="overflow:hidden;">
						<h1 class="single dotted"><?php _e( 'Listings for', APP_TD ); ?> <?php echo $term->name; ?> (<?php echo $wp_query->found_posts; ?>)</h1>
						<?php if( $term->description ) : ?>
							<p><?php echo $term->description; ?></p>
						<?php else : ?>
							<p>&nbsp;</p>
						<?php endif; ?>
						<?php get_template_part( 'loop', 'ad_listing' ); ?>
					</div><!-- /shadowblock -->
				</div><!-- /shadowblock_out -->
			</div><!-- /content_left -->
			<?php get_sidebar(); ?>
			<div class="clr"></div>
		</div><!-- /content_res -->
	</div><!-- /content_botbg -->
</div><!-- /content -->