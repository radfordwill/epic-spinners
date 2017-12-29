<?php
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

/**
 * Provides a admin area view for the plugin
 * Plugin URI: https://github.com/radfordwill/epic_spinners
 * Version: 3.1.6
 * @author     Will Radford <radford.will@gmail.com>
 * @link       http://radford.online/
 * @since      1.0.0
 *
 * @package epic-spinners
 */

/**
 * Provides an admin area view for the plugi. Mobile views and wide screen views are supported
 * (Bootstrap 3 css\js and Wordpress css)
 *
 *
 */

$plugin_data = epic_spinners::init();
$plugin_name_version = $plugin_data->get_plugin_data()[ 'Name' ] . ' v' . $plugin_data->get_plugin_data()[ 'Version' ];
$epic_spinners_the_url = $plugin_data->epic_spinners_the_url();
$epic_spinners_plugin_lang = epic_spinners::TEXTDOMAIN;

?> <!-- This file  primarily consists of HTML with a little bit of PHP. -->
<div class="wrap body-epic-spinners">
	<div class="row">
		<div class="col-lg-4">
			<h1>
				<!-- place holder for admin notice -->
			</h1>
		</div>
	</div>
	<!-- Content -->
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
      <h2><?php _e('Epic Spinners Animated Icons For Wordpress', $epic_spinners_plugin_lang)?>	</h2>			<p class="font-weight-bold small">
					<?php echo _e('Easily use epicmax\'s animated spinner icons in your website\'s content with the editor\'s built in buttons.', $epic_spinners_plugin_lang)?>
				</p>
			</div>
			<div class="col-lg-4">
				<table style="text-align:center">
					<?php /* Donation Form */ ?>
					<div id="submitdiv" class="form" style="padding: 6px; margin-top:20px; border-left: 5px solid   #FF0000;">
						<hr/>
						<h3 class="font-weight-bold">
							<?php _e('Please consider making a donation so I can keep up support for this plugin. You can donate any amount.', $epic_spinners_plugin_lang)?>
						</h3>
						<form name="_xclick" action="https://www.paypal.com/yt/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_xclick">
							<input type="hidden" name="business" value="power.sell2002@gmail.com">
							<input type="hidden" name="item_name" value="Epic Spinners - Donations">
							<input type="hidden" name="currency_code" value="USD">
							<tr class="bg-primary">
								<th scope="row">
									<label for="paypal_amount"><span class="glyphicon glyphicon-usd"></span></label>
								</th>
								<td class="input-group-sm">
									<input class="input-group-sm" type="text" name="amount" value="" required="required" placeholder="<?php _e('Enter amount', $epic_spinners_plugin_lang)?>" class="regular-text ltr">
								</td>
								<td>
									<input type="image" src="<?php echo $epic_spinners_the_url; ?>assets/images/x-click-butcc-donate.gif" border="0" name="submit" alt="Make Donations with Paypal">
								</td>
							</tr>
					</div>
				</table>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">

			</div>
		</div>

	</div>
	<footer class="footer">
		<div class="container">

			<div class="col-lg-4 align-baseline footer-span">

				<span class="text-white small">
					<p class="font-weight-bold">
						<?php _e($plugin_name_version, $epic_spinners_plugin_lang)?>
					</p>
					<p class="font-weight-bold small footer-span">*
						<a class="footer-link dashicons dashicons-admin-links text-nowrap" href="https://github.com/epicmaxco/epic-spinners#license" title="license" target="_blank">
							<?php _e('(see github for epicmaxco epic spinners icon license)', $epic_spinners_plugin_lang)?></a>
					</p>
				</span>

			</div>

			<?php if( isset($_GET['settings-updated']) ) { ?>
			<div class=”updated”>
				<div class="notice notice-success is-dismissible col-xs-4">
					<strong>
						<?php _e('Settings Saved.', $epic_spinners_plugin_lang)?>
					</strong>
				</div>
				<?php } ?>
			</div>
	</footer>
	</div>
