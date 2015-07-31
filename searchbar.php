<?php
/**
 * Theme search bar template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.4
 */

	global $post;
	// Don't display the searchbar on certain pages
	if( is_page('listing-types') 
		|| is_page('create-listing') 
		|| is_page('register') 
		|| is_page('login') 
		|| is_page('purchase-membership') 
		|| is_page('become-a-broker') 
		|| is_page('find-a-cannabiz-broker') 
		|| is_page('sell') 
		|| 'find-a-cannabiz-broker' == get_the_slug( $post->post_parent ) ) {
			return;
	}
	?>
		<?php $args = cp_get_dropdown_categories_search_args( 'bar' );?>
		<?php $args['name']='cs-cat--1'; ?>
		<?php $args['value_field']='name'; ?>
		<div id="search-bar">
			<div class="searchblock_out">
				<div class="searchblock">
					<form action="<?php echo home_url( '/' ); ?>" method="get" id="searchform" class="form_search">
						<input type="hidden" name="search-class" value="DB_CustomSearch_Widget-db_customsearch_widget">
						<input type="hidden" name="widget_number" value="preset-1">
						<div class="searchfield">
							<input name="cs-all-0" type="text" id="s" tabindex="1" class="editbox_search" style="<?php cp_display_style( 'search_field_width' ); ?>" value="" placeholder="<?php esc_attr_e( 'What are you looking for?', APP_TD ); ?>" />
						</div>
						<div class='DropDownField' style='width:225px;'>
							<span style='width:210px;' class='searchform-input-wrapper'><select name='cs-cp_state-2' class="searchbar"><option value=''>State</option><option value='Alabama'>Alabama</option><option value=' Alaska'> Alaska</option><option value=' Arizona'> Arizona</option><option value=' Arkansas'> Arkansas</option><option value=' California'> California</option><option value=' Colorado'> Colorado</option><option value=' Connecticut'> Connecticut</option><option value=' Delaware'> Delaware</option><option value=' Florida'> Florida</option><option value=' Georgia'> Georgia</option><option value=' Hawaii'> Hawaii</option><option value=' Idaho'> Idaho</option><option value=' Illinois'> Illinois</option><option value=' Indiana'> Indiana</option><option value=' Iowa'> Iowa</option><option value=' Kansas'> Kansas</option><option value=' Kentucky'> Kentucky</option><option value=' Louisiana'> Louisiana</option><option value=' Maine'> Maine</option><option value=' Maryland'> Maryland</option><option value=' Massachusetts'> Massachusetts</option><option value=' Michigan'> Michigan</option><option value=' Minnesota'> Minnesota</option><option value=' Mississippi'> Mississippi</option><option value=' Missouri'> Missouri</option><option value=' Montana'> Montana</option><option value=' Nebraska'> Nebraska</option><option value=' Nevada'> Nevada</option><option value=' New Hampshire'> New Hampshire</option><option value=' New Jersey'> New Jersey</option><option value=' New Mexico'> New Mexico</option><option value=' New York'> New York</option><option value=' North Carolina'> North Carolina</option><option value=' North Dakota'> North Dakota</option><option value=' Ohio'> Ohio</option><option value=' Oklahoma'> Oklahoma</option><option value=' Oregon'> Oregon</option><option value=' Pennsylvania'> Pennsylvania</option><option value=' Rhode Island'> Rhode Island</option><option value=' South Carolina'> South Carolina</option><option value=' South Dakota'> South Dakota</option><option value=' Tennessee'> Tennessee</option><option value=' Texas'> Texas</option><option value=' Utah'> Utah</option><option value=' Vermont'> Vermont</option><option value=' Virginia'> Virginia</option><option value=' Washington'> Washington</option><option value=' West Virginia'> West Virginia</option><option value=' Wisconsin'> Wisconsin</option><option value=' Wyoming'> Wyoming</option></select></span>
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