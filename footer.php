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
.fs{
   width: calc( <?php echo $footer_width; ?>% - <?php echo $padding_width;?>px );
}
</style>