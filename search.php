<?php
/**
 * Search results template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 1.0
 */

	$searchTxt = get_search_query();
	if ( empty( $searchTxt ) || $searchTxt == __( 'What are you looking for?', APP_TD ) ) {
		$searchTxt = '*';
	}
?>
	<div class="content">
		<div class="content_botbg">
			<div class="content_res">
				<div id="breadcrumb"><?php cp_breadcrumb(); ?></div>
				<!-- left block -->
				<div class="content_left">
					<div class="shadowblock_out">
						<div class="shadowblock">
							<h1 class="single dotted"><?php printf( __( 'Found %2$s results', APP_TD ), $searchTxt, $wp_query->found_posts ); ?></h1>
						</div><!-- /shadowblock -->
						<div class="shadowblock" style="overflow:hidden;">
							<?php get_template_part( 'loop', 'ad_listing' ); ?>
						</div><!-- /shadowblock -->
					</div><!-- /shadowblock_out -->
				</div><!-- /content_left -->
				<?php get_sidebar(); ?>
				<div class="clr"></div>
			</div><!-- /content_res -->
		</div><!-- /content_botbg -->
	</div><!-- /content -->