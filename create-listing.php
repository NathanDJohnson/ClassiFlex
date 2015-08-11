<?php
/**
 * Template Name: Add New Listing
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.4
 */
?>
<?php if( !cpc_is_featured_description( get_current_user_id() ) ) : ?>
<style>
	#list_cp_broker_description {
		display: none;
	}
</style>
<?php endif; ?>
<script type='text/javascript'>jQuery(document).ready(function(){$('.dotted').each(function() {$(this).html('Create Your Listing');});});</script>
<div class="clr" style="margin-top:10px;"></div>
<?php
appthemes_display_checkout();