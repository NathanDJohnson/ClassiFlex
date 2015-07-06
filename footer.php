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
<div class="footer">
	<div id="footer-sidebar" class="secondary">
	<?php
		if(is_active_sidebar('footer-sidebar-1')){
	?>
		<div id="footer-sidebar1" class="fs">
		<?php
				$active_footers = $active_footers + 1;
				dynamic_sidebar('footer-sidebar-1');
		?>
		</div><!-- #footer-sidebar1 -->
	<?php
		}
	?>
	<?php
		if(is_active_sidebar('footer-sidebar-2')){
	?>
		<div id="footer-sidebar2" class="fs">
		<?php
				$active_footers = $active_footers + 1;
				dynamic_sidebar('footer-sidebar-2');
		?>
		</div><!-- #footer-sidebar2 -->
	<?php
		}
	?>
	<?php
		if(is_active_sidebar('footer-sidebar-3')){
	?>
		<div id="footer-sidebar3" class="fs">
		<?php
				$active_footers = $active_footers + 1;
				dynamic_sidebar('footer-sidebar-3');
		?>
		</div><!-- #footer-sidebar3 -->
	<?php
		}
	?>
	<?php
		if(is_active_sidebar('footer-sidebar-4')){
	?>
		<div id="footer-sidebar4" class="fs">
		<?php
				$active_footers = $active_footers + 1;
				dynamic_sidebar('footer-sidebar-4');
		?>
		</div><!-- #footer-sidebar4 -->
	<?php
		}
	?>
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
   min-width: 220px;
}
</style>