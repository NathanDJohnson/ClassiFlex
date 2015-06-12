<?php
/**
 * Generic Footer template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 1.0
 */

global $cp_options;
$active_footers = 0;
?>
<div class="footer linearBg2">
	<div id="footer-sidebar" class="secondary">
		<div id="footer-sidebar1" class="fs">
		<?php
			if(is_active_sidebar('footer-sidebar-1')){
				$active_footers = $active_footers + 1;
				dynamic_sidebar('footer-sidebar-1');
			}
		?>
		</div>
		<div id="footer-sidebar2" class="fs">
		<?php
			if(is_active_sidebar('footer-sidebar-2')){
				$active_footers = $active_footers + 1;
				dynamic_sidebar('footer-sidebar-2');
			}
		?>
		</div>
		<div id="footer-sidebar3" class="fs">
		<?php
			if(is_active_sidebar('footer-sidebar-3')){
				$active_footers = $active_footers + 1;
				dynamic_sidebar('footer-sidebar-3');
			}
		?>
		</div>
		<div id="footer-sidebar3" class="fs">
		<?php
			if(is_active_sidebar('footer-sidebar-4')){
				$active_footers = $active_footers + 1;
				dynamic_sidebar('footer-sidebar-4');
			}
		?>
		</div>
	</div>
	<div id="bottom-footer-sidebar" class="">
	<?php
		if(is_active_sidebar('sidebar_footer')){
			dynamic_sidebar('sidebar_footer');
		}
	?>
	</div>
</div><!-- /footer -->
<?php
	// Calculate width of footers here
	$footer_width = 100 / $active_footers;
	$padding_width = $active_footers * 2;
?>
<style>
#bottom-footer-sidebar {
  clear: both;
  border: 0;
  padding: 10px 20px 20px 20px;
  margin: -20px;
  background: black;
}
#bottom-footer-sidebar ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
#bottom-footer-sidebar ul li {
	display: inline;
}

#bottom-footer-sidebar ul li:after { 
	content: " \00b7"; 
}
#bottom-footer-sidebar ul li:last-child:after { 
	content: none;
}

#acurax_si_widget_simple img {
  float: left;
}

.footer, .footer a, .footer p {
  color: #cdcdcd;
  text-decoration: none;
}
.footer a:hover {
	opacity: 0.8;
}
.footer h3.widget-title {
  color: white;
}
.fs{
   width: calc( <?php echo $footer_width; ?>% - <?php echo $padding_width;?>px );
}

.linearBg2 {
  /* fallback */
  background-color: #0B7300;

  /* Safari 4-5, Chrome 1-9 */
  background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#313131), to(#0B7300));

  /* Safari 5.1, Chrome 10+ */
  background: -webkit-linear-gradient(top, #679325, #0B7300);

  /* Firefox 3.6+ */
  background: -moz-linear-gradient(top, #679325, #0B7300);

  /* IE 10 */
  background: -ms-linear-gradient(top, #679325, #0B7300);

  /* Opera 11.10+ */
  background: -o-linear-gradient(top, #679325, #0B7300);
}
</style>