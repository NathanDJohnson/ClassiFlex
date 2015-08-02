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
<div class="post-wrapper <?php if( !is_author() ) { echo cpc_author_membership_style( get_the_author_meta('ID') ); } ?>">
<?php if ( get_post_meta( $post->ID, 'cp_ad_sold', true ) == 'yes' ) : ?>
	<div class="ProdDiv">
		<p class="Sold">SOLD</p>
	</div>
<?php endif; ?>
	<a href="<?php echo the_permalink(); ?>" title="<?php echo cpc_initial_caps( get_the_title() ); ?>">
		<div class="post-image">
		<?php if ( $cp_options->ad_images && ( cpc_is_featured_description( get_the_author_meta('ID') ) ) || is_sticky() ){
					cp_ad_loop_thumbnail();
				}
				else{ ?>
					<img class="preview no-image" alt="no image" title="" src="<?php echo get_template_directory_uri();?>/images/no-thumb-75.jpg">
				<?php }
		?>
		</div>
	</a>
	<div class="post-description">
		<a href="<?php echo the_permalink(); ?>" title="<?php echo cpc_initial_caps( get_the_title() ); ?>">
			<div class="post-head">
				<h3>
					<?php if ( mb_strlen( esc_html( get_the_title() ) ) >= 75 ) echo mb_substr( cpc_inital_caps( esc_html( get_the_title() ), 0, 75 ) ) . '...'; else echo cpc_initial_caps( esc_html( get_the_title() ) ) ; ?>
				</h3>
			</div>
			<div class="post-content">
				<p class="post-content">
				<?php
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
			<?php if( cpc_is_featured_description( get_the_author_meta('ID') ) ) :?>
				<div class="membership-pack">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/<?php echo cpc_author_membership_style(get_the_author_meta('ID') ) ?>.png" alt="<?php echo cpc_author_membership_pack( get_the_author_meta('ID') ); ?>" >
					<p class="membership-pack-meta"><em><?php echo cpc_author_membership_pack( get_the_author_meta('ID') ); ?></em></p>
				</div>
			<?php endif; ?>
		</a>
		<?php appthemes_after_post_title(); //post meta ?>
		<?php //appthemes_before_post_content(); // ? ?>
	</div>
</div>