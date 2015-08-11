<?php
/**
 * Template Name: Add New Listing
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.4
 */
?>
<style>
	p.dotted{ color: #fff; }
	.notice.success{ display: none; }
<?php if( !cpc_is_featured_description( get_current_user_id() ) ) : ?>
	#list_cp_broker_description { display: none; }
<?php endif; ?>
</style>
<script type='text/javascript'>jQuery(document).ready(function(){$('.dotted').each(function() {$(this).html('Create Your Listing');});});</script>
<div class="clr" style="margin-top:10px;"></div>
<?php
appthemes_display_checkout();