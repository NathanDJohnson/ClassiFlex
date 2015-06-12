<?php
/**
 * Template Name: Ads Home Template
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.3
 */
?>
<div class="content">
	<div class="content_botbg">
		<div class="content_res">
			<?php if( function_exists( 'cs_flexslider_slider' ) ) {
				cs_flexslider_slider();
			} else {
				get_template_part( 'featured' ); 
			} ?>
			<?php
				wp_nav_menu( array( 
					'menu' => 'mega-menu', 
					'theme_location' => '__no_such_location', 
					'fallback_cb' => false,
					'menu_id' => 'suckerfishnav' 
					) );
			 ?>
			<!-- left block -->  
<style>
/*
#suckerfishnav {
  text-align: center;
  margin: 0;
  padding: 10px;
  clear: both;
  
  font-size:18px;
  font-family:verdana,sans-serif;
  font-weight:bold;
  margin-bottom: 1em;
  margin-left: auto;
  margin-right: auto;
  line-height: 40px;
  padding: 0;
}

#suckerfishnav a {
  text-decoration: none;
  border-radius: 5px;
  padding: 3px 8px;
  display:block;
  color:#eee;
}

#suckerfishnav ul {
    float:left;
    list-style:none;
    line-height:40px;
    padding:0;
    border:1px solid #aaa;
    margin:0;
    width:100%;
    }

#suckerfishnav li {
  display: inline-block;
  z-index:999;
  padding:0;
  border-radius: 5px;
  margin: 5px;
}
#suckerfishnav li:hover {
  background-color: #654123;
}

.push_button {
	position: relative;
	width:220px;
	height:40px;
	text-align:center;
	color:#FFF;
	text-decoration:none;
	line-height:43px;
	font-family:'Oswald', Helvetica;
	display: block;
	margin: 30px;
}
.push_button:before {
	background:#f0f0f0;
	background-image:-webkit-gradient(linear, 0% 0%, 0% 100%, from(#D0D0D0), to(#f0f0f0));
	
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	border-radius:5px;
	
	-webkit-box-shadow:0 1px 2px rgba(0, 0, 0, .5) inset, 0 1px 0 #FFF; 
	-moz-box-shadow:0 1px 2px rgba(0, 0, 0, .5) inset, 0 1px 0 #FFF; 
	box-shadow:0 1px 2px rgba(0, 0, 0, .5) inset, 0 1px 0 #FFF;
	
	position: absolute;
	content: "";
	left: -6px; right: -6px;
	top: -6px; bottom: -10px;
	z-index: -1;
}

.push_button:active {
	-webkit-box-shadow:0 1px 0 rgba(255, 255, 255, .5) inset, 0 -1px 0 rgba(255, 255, 255, .1) inset;
	top:5px;
}
.push_button:active:before{
	top: -11px;
	bottom: -5px;
	content: "";
}

.red {
	text-shadow:-1px -1px 0 #A84155;
	background: #D25068;
	border:1px solid #D25068;
	
	background-image:-webkit-linear-gradient(top, #F66C7B, #D25068);
	background-image:-moz-linear-gradient(top, #F66C7B, #D25068);
	background-image:-ms-linear-gradient(top, #F66C7B, #D25068);
	background-image:-o-linear-gradient(top, #F66C7B, #D25068);
	background-image:linear-gradient(to bottom, #F66C7B, #D25068);
	
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	border-radius:5px;
	
	-webkit-box-shadow:0 1px 0 rgba(255, 255, 255, .5) inset, 0 -1px 0 rgba(255, 255, 255, .1) inset, 0 4px 0 #AD4257, 0 4px 2px rgba(0, 0, 0, .5);
	-moz-box-shadow:0 1px 0 rgba(255, 255, 255, .5) inset, 0 -1px 0 rgba(255, 255, 255, .1) inset, 0 4px 0 #AD4257, 0 4px 2px rgba(0, 0, 0, .5);
	box-shadow:0 1px 0 rgba(255, 255, 255, .5) inset, 0 -1px 0 rgba(255, 255, 255, .1) inset, 0 4px 0 #AD4257, 0 4px 2px rgba(0, 0, 0, .5);
}

.red:hover {
	background: #F66C7B;
	background-image:-webkit-linear-gradient(top, #D25068, #F66C7B);
	background-image:-moz-linear-gradient(top, #D25068, #F66C7B);
	background-image:-ms-linear-gradient(top, #D25068, #F66C7B);
	background-image:-o-linear-gradient(top, #D25068, #F66C7B);
	background-image:linear-gradient(top, #D25068, #F66C7B);
}

.blue {
	text-shadow:-1px -1px 0 #2C7982;
	background: #3EACBA;
	border:1px solid #379AA4;
	background-image:-webkit-linear-gradient(top, #48C6D4, #3EACBA);
	background-image:-moz-linear-gradient(top, #48C6D4, #3EACBA);
	background-image:-ms-linear-gradient(top, #48C6D4, #3EACBA);
	background-image:-o-linear-gradient(top, #48C6D4, #3EACBA);
	background-image:linear-gradient(top, #48C6D4, #3EACBA);
	
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	border-radius:5px;
	
	-webkit-box-shadow:0 1px 0 rgba(255, 255, 255, .5) inset, 0 -1px 0 rgba(255, 255, 255, .1) inset, 0 4px 0 #338A94, 0 4px 2px rgba(0, 0, 0, .5);
	-moz-box-shadow:0 1px 0 rgba(255, 255, 255, .5) inset, 0 -1px 0 rgba(255, 255, 255, .1) inset, 0 4px 0 #338A94, 0 4px 2px rgba(0, 0, 0, .5);
	box-shadow:0 1px 0 rgba(255, 255, 255, .5) inset, 0 -1px 0 rgba(255, 255, 255, .1) inset, 0 4px 0 #338A94, 0 4px 2px rgba(0, 0, 0, .5);
}

.blue:hover {
	background: #48C6D4;
	background-image:-webkit-linear-gradient(top, #3EACBA, #48C6D4);
	background-image:-moz-linear-gradient(top, #3EACBA, #48C6D4);
	background-image:-ms-linear-gradient(top, #3EACBA, #48C6D4);
	background-image:-o-linear-gradient(top, #3EACBA, #48C6D4);
	background-image:linear-gradient(top, #3EACBA, #48C6D4);
}
*/
</style>
			<div class="content_left">
				<?php if ( $cp_options->home_layout == 'directory' ) { ?>
					<div class="shadowblock_out">
						<div class="shadowblock">
							<h2 class="dotted"><?php _e( 'Ad Categories', APP_TD ); ?></h2>
							<div id="directory" class="directory <?php cp_display_style( 'dir_cols' ); ?>">
								<?php echo cp_create_categories_list( 'dir' ); ?>
								<div class="clr"></div>
							</div><!--/directory-->
						</div><!-- /shadowblock -->
					</div><!-- /shadowblock_out -->
				<?php } ?>
				<div class="tabcontrol">
					<ul class="tabnavig">
						<li><a href="#block1"><span class="big"><?php _e( 'Just Listed', APP_TD ); ?></span></a></li>
						<li><a href="#block2"><span class="big"><?php _e( 'Most Popular', APP_TD ); ?></span></a></li>
					</ul>
					<?php
						remove_action( 'appthemes_after_endwhile', 'cp_do_pagination' );
						$post_type_url = add_query_arg( array( 'paged' => 2 ), get_post_type_archive_link( APP_POST_TYPE ) );
					?>
					<!-- tab 1 -->
					<div id="block1">
						<div class="clr"></div>
						<div class="undertab"><span class="big"><?php _e( 'Classified Ads', APP_TD ); ?> / <strong><span class="colour"><?php _e( 'Just Listed', APP_TD ); ?></span></strong></span></div>
						<?php
							// show all ads but make sure the sticky featured ads don't show up first
							$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
							query_posts( array( 'post_type' => APP_POST_TYPE, 'ignore_sticky_posts' => 1, 'paged' => $paged ) );
							$total_pages = max( 1, absint( $wp_query->max_num_pages ) );
						?>
						<?php get_template_part( 'loop', 'ad_listing' ); ?>
						<?php
							if ( $total_pages > 1 ) {
						?>
								<div class="paging"><a href="<?php echo $post_type_url; ?>"> <?php _e( 'View More Ads', APP_TD ); ?> </a></div>
						<?php } ?>
					</div><!-- /block1 -->
					<!-- tab 2 -->
					<div id="block2">
						<div class="clr"></div>
						<div class="undertab"><span class="big"><?php _e( 'Classified Ads', APP_TD ); ?> / <strong><span class="colour"><?php _e( 'Most Popular', APP_TD ); ?></span></strong></span></div>
						<?php get_template_part( 'loop', 'popular' ); ?>
						<?php
							global $cp_has_next_page;
							if ( $cp_has_next_page ) {
								$popular_url = add_query_arg( array( 'sort' => 'popular' ), $post_type_url );
						?>
								<div class="paging"><a href="<?php echo $popular_url; ?>"> <?php _e( 'View More Ads', APP_TD ); ?> </a></div>
						<?php } ?>
						<?php wp_reset_query(); ?>
					</div><!-- /block2 -->
				</div><!-- /tabcontrol -->
			</div><!-- /content_left -->
			<?php get_sidebar(); ?>
			<div class="clr"></div>
		</div><!-- /content_res -->
	</div><!-- /content_botbg -->
</div><!-- /content -->