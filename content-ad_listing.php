<?php
/**
 * Listing loop content template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.4
 */
global $cp_options;
?>
<div class="post-wrapper <?php echo cpc_author_membership_style( get_the_author_meta('ID') ); ?>">
	<div class="post-image">
	<?php if ( $cp_options->ad_images ) cp_ad_loop_thumbnail(); ?>
	</div>
	<div class="post-description">
		<div class="post-head">
			<h3>
				<a href="<?php the_permalink(); ?>"><?php if ( mb_strlen( get_the_title() ) >= 75 ) echo mb_substr( get_the_title(), 0, 75 ) . '...'; else the_title(); ?></a>
			</h3>
		</div>
		<div class="post-content">
			<p class="post-content">
			<?php
//				if( cpc_author_membership_pack( get_the_author_meta('ID') ) == 'Featured Broker' && get_post_meta( get_the_ID(), 'cp_broker_description', true ) != '' ) {
				if( cpc_is_featured_description( get_the_author_meta('ID') ) ) {
					$fulldesc = get_post_meta( get_the_ID(), 'cp_broker_description', true ) . " " . wp_strip_all_tags( get_the_content() );
					if( strlen($fulldesc) > 500){ $fulldesc = substr($fulldesc, 0, 497) . "..."; }
					echo $fulldesc;
				}
				else{
					echo cp_get_content_preview( 250 );
				}
			?>
			</p>
			<?php appthemes_before_post_title(); // price tag?>
		</div>
		<?php //appthemes_after_post_title(); //post meta ?>
		<?php //appthemes_before_post_content(); // ? ?>
	</div>
</div>