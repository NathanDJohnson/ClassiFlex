<?php
/**
 * Theme search bar template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.4
 */
?>
<?php
if ( function_exists('wp_custom_fields_search') ) : 
?>

<div id="search-bar" style="border-radius:">
	<?php	wp_custom_fields_search('preset-1'); ?>
</div> <!-- .search-bar -->
<?php
//if ( is_page_template( 'tpl-ads-home.php' ) || is_search() || is_404() || is_tax( APP_TAX_CAT ) || is_tax( APP_TAX_TAG ) || is_singular( APP_POST_TYPE ) ) :
else :
	$args = cp_get_dropdown_categories_search_args( 'bar' );?>
	<div id="search-bar">
		<div class="searchblock_out">
			<div class="searchblock">
				<form action="<?php echo home_url( '/' ); ?>" method="get" id="searchform" class="form_search">
					<input type="hidden" name="search-class" value="DB_CustomSearch_Widget-db_customsearch_widget">
					<input type="hidden" name="widget_number" value="preset-default">
					<div class="searchfield">
						<input name="cs-all-0" type="text" id="s" tabindex="1" class="editbox_search" style="<?php cp_display_style( 'search_field_width' ); ?>" value="<?php the_search_query(); ?>" placeholder="<?php esc_attr_e( 'What are you looking for?', APP_TD ); ?>" />
					</div>
					<div class='DropDownField'>
						<span class='searchform-input-wrapper'><select name='cs-cp_state-2' class="searchbar"><option value=''>State</option><option value='Alabama'>Alabama</option><option value=' Alaska'> Alaska</option><option value=' Arizona'> Arizona</option><option value=' Arkansas'> Arkansas</option><option value=' California'> California</option><option value=' Colorado'> Colorado</option><option value=' Connecticut'> Connecticut</option><option value=' Delaware'> Delaware</option><option value=' Florida'> Florida</option><option value=' Georgia'> Georgia</option><option value=' Hawaii'> Hawaii</option><option value=' Idaho'> Idaho</option><option value=' Illinois'> Illinois</option><option value=' Indiana'> Indiana</option><option value=' Iowa'> Iowa</option><option value=' Kansas'> Kansas</option><option value=' Kentucky'> Kentucky</option><option value=' Louisiana'> Louisiana</option><option value=' Maine'> Maine</option><option value=' Maryland'> Maryland</option><option value=' Massachusetts'> Massachusetts</option><option value=' Michigan'> Michigan</option><option value=' Minnesota'> Minnesota</option><option value=' Mississippi'> Mississippi</option><option value=' Missouri'> Missouri</option><option value=' Montana'> Montana</option><option value=' Nebraska'> Nebraska</option><option value=' Nevada'> Nevada</option><option value=' New Hampshire'> New Hampshire</option><option value=' New Jersey'> New Jersey</option><option value=' New Mexico'> New Mexico</option><option value=' New York'> New York</option><option value=' North Carolina'> North Carolina</option><option value=' North Dakota'> North Dakota</option><option value=' Ohio'> Ohio</option><option value=' Oklahoma'> Oklahoma</option><option value=' Oregon'> Oregon</option><option value=' Pennsylvania'> Pennsylvania</option><option value=' Rhode Island'> Rhode Island</option><option value=' South Carolina'> South Carolina</option><option value=' South Dakota'> South Dakota</option><option value=' Tennessee'> Tennessee</option><option value=' Texas'> Texas</option><option value=' Utah'> Utah</option><option value=' Vermont'> Vermont</option><option value=' Virginia'> Virginia</option><option value=' Washington'> Washington</option><option value=' West Virginia'> West Virginia</option><option value=' Wisconsin'> Wisconsin</option><option value=' Wyoming'> Wyoming</option></select></span>
					</div>
					<div class="searchbutcat">
						<?php wp_dropdown_categories( $args ); ?>
					</div>
					<div class="searchbutton"><button class="btn_orange" type="submit" tabindex="3" title="<?php _e( 'Search Ads', APP_TD ); ?>" id="go" value="search" name="search"><?php _e( 'Search Ads', APP_TD ); ?></button></div>
				</form>
				<div class="advanced-search-link">
					<a href="/advanced-search/">Advanced search...</a>
				</div> <!-- advanced-search-link -->
			</div> <!-- /searchblock -->
		</div> <!-- /searchblock_out -->
	</div> <!-- /search-bar -->
<?php endif; ?>