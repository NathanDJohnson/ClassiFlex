<?php
/**
 * Membership Packages Template.
 *
 * @package ClassiPress\Templates
 * @author  AppThemes
 * @since   ClassiPress 3.4
 */
?>
<div class="content">
	<div class="content_botbg">
		<div class="content_res">
			<div class="shadowblock_out">
				<div class="shadowblock">
					<div id="step1">
						<h2 class="dotted"><?php _e( 'Purchase a Membership Pack', APP_TD ); ?></h2>
						<img src="<?php echo appthemes_locate_template_uri( 'images/step1.gif' ); ?>" alt="" class="stepimg" />
						<?php do_action( 'appthemes_notices' ); ?>
						<p class="dotted">&nbsp;</p>
						<form name="mainform" id="mainform" class="form_membership_step" action="<?php echo appthemes_get_step_url(); ?>" method="post" enctype="multipart/form-data">
							<?php wp_nonce_field( $action ); ?>
							<div id="membership-packs" class="wrap">
								<table id="memberships" class="widefat fixed footable">
									<thead style="text-align:left;">
										<tr>
											<th scope="col" data-class="expand"><?php _e( 'Name', APP_TD ); ?></th>
											<th scope="col" data-hide="phone"><?php _e( 'Membership Benefit', APP_TD ); ?></th>
											<th scope="col" data-hide="phone"><?php _e( 'Subscription', APP_TD ); ?></th>
											<th scope="col" style="width:75px;" data-hide="phone"></th>
										</tr>
									</thead>
								<?php
									if ( $packages ) {
										usort($packages, "fmp_cmpDescA");
								?>
										<tbody id="list">
										<?php
											foreach ( $packages as $package ) {
												// external plugins can modify or disable field
												$package = apply_filters( 'cp_package_field', $package, 'membership' );
												if ( ! $package ) {
													continue;
												}
												$rowclass = 'even';
												$requiredClass = '';
												$benefit = cp_get_membership_package_benefit_text( $package->ID );
												if ( $package->pack_satisfies_required ) {
													$requiredClass = 'required';
												}
										?>
												<tr class="<?php echo $rowclass . ' ' . $requiredClass; ?>">
													<td><strong><?php echo $package->pack_name; ?></strong></td>
													<td><?php echo $package->description; ?></td>
													<td><?php printf( __( '%1$s / %2$s days', APP_TD ), appthemes_get_price( $package->price ), $package->duration ); ?></td>
													<?php
														if( $package->price == 0 ){
															$paynow = "Free";
														}
														else{
															$paynow = "Pay Now";
														}
													?>
													<td><input type="submit" name="step1" id="step1" class="btn_orange" onclick="document.getElementById('pack').value=<?php echo $package->ID; ?>;" value="<?php echo $paynow; ?>" style="margin-left: 5px; margin-bottom: 5px;" /></td>
												</tr>
										<?php
											} // end for each
										?>
										</tbody>
								<?php
									} else {
								?>
										<tr>
											<td colspan="7"><?php _e( 'No membership packs found.', APP_TD ); ?></td>
										</tr>
								<?php
									}
								?>
								</table>
							</div><!-- end wrap for membership packs-->
							<input type="hidden" name="action" value="<?php echo esc_attr( $action ); ?>" />
							<input type="hidden" id="pack" name="pack" value="<?php if ( isset( $_POST['pack'] ) ) echo $_POST['pack']; ?>" />
						</form>
					</div>
				</div><!-- /shadowblock -->
			</div><!-- /shadowblock_out -->
			<div class="clr"></div>
		</div><!-- /content_res -->
	</div><!-- /content_botbg -->
</div><!-- /content -->
<?php
/**
 * function sorts array of objects by obj->price in descending order
 */
function fmp_cmpDescA($m, $n) {
   if ($m->price == $n->price) {
       return 0;
   }
   return ($m->price > $n->price) ? -1 : 1;
}
?>