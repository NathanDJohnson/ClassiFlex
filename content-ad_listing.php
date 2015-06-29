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