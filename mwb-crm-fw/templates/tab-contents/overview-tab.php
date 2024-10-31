<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the premium page.
 *
 * @link       https://makewebbetter.com
 * @since      1.0.0
 *
 * @package    Mwb_Cf7_Integration_With_Gsheets
 * @subpackage Mwb_Cf7_Integration_With_Gsheets/admin/partials/templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- Overview content start -->

<div class="mwb-cf7-integration-overview">
	<div class="mwb-cf7-integration-overview__wrapper">
		<div class="mwb-cf7-integration-overview__container">
			<div class="mwb-cf7-integration-overview__icons-wrap">
				<a href="<?php echo esc_url( 'https://makewebbetter.com/contact-us/?utm_source=MWB-cf7-gsheets-org&utm_medium=MWB-org-backend&utm_campaign=MWB-cf7-gsheets-query' ); ?>">
					<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_GSHEETS_URL . 'admin/images/connect.svg' ); ?>" alt="contact-us-img">
				</a>
				<a href="<?php echo esc_url( 'https://docs.makewebbetter.com/mwb-cf7-integration-with-google-sheets/?utm_source=MWB-cf7-gsheets-org&utm_medium=MWB-org-backend&utm_campaign=MWB-cf7-gsheets-doc' ); ?>">
					<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_GSHEETS_URL . 'admin/images/doc.svg' ); ?>" alt="doc-img">
				</a>
			</div>
			<div class="mwb-cf7-integration-overview__banner-img">
				<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_GSHEETS_URL . 'admin/images/banner.png' ); ?>" alt="banner-img">
			</div>
			<div class="mwb-cf7-integration-overview__content">
				<h1><?php esc_html_e( 'What is  MWB CF7 Integration with Google Sheets?', 'mwb-cf7-integration-with-google-sheets' ); ?></h1>
				<p><?php esc_html_e( 'The MWB CF7 Integration with Google Sheets Plugin sends all the entries of your contact forms such as names, email address, subject etc. over Google Sheets. This integration helps to create simplified data over Google Sheets.', 'mwb-cf7-integration-with-google-sheets' ); ?></p>
			</div>
			<div class="mwb-cf7-integration-overview__features">
				<h2><?php esc_html_e( 'What does MWB CF7 Integration with Google Sheets do?', 'mwb-cf7-integration-with-google-sheets' ); ?></h2>
				<ul class="mwb-cf7-integration-overview__features-list">
					<li><?php esc_html_e( 'Smooth CF7 Integration With Your Google Sheets Account.', 'mwb-cf7-integration-with-google-sheets' ); ?></li>
					<li><?php esc_html_e( 'Easy CF7 Fields Association With Any Google Sheets Module Fields.', 'mwb-cf7-integration-with-google-sheets' ); ?></li>
					<li><?php esc_html_e( 'Filters CF7 submissions According To User Input.', 'mwb-cf7-integration-with-google-sheets' ); ?></li>
					<li><?php esc_html_e( 'Detailed Log Of CF7 Submission Sent To Google Sheets.', 'mwb-cf7-integration-with-google-sheets' ); ?></li>
					<li><?php esc_html_e( 'Error Email Notification.', 'mwb-cf7-integration-with-google-sheets' ); ?></li>
				</ul>
			</div>
			<div class="mwb-cf7-integration-overview__keywords-wrap">
				<h2><?php esc_html_e( 'Salient Features of MWB CF7 Integration with Google Sheets Plugin.', 'mwb-cf7-integration-with-google-sheets' ); ?></h2>
				<div class="mwb-cf7-integration-overview__keywords">
					<div class="mwb-cf7-integration-overview__keywords-item">
						<div class="mwb-cf7-integration-overview__keywords-card">
							<div class="mwb-cf7-integration-overview__keywords-text">
								<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_GSHEETS_URL . 'admin/images/Integration.jpg' ); ?>" alt="smooth-integration" width="100px">
								<h4 class="mwb-cf7-integration-overview__keywords-heading"><?php esc_html_e( 'Smooth CF7 Integration With Your Google Sheets Account', 'mwb-cf7-integration-with-google-sheets' ); ?></h4>
								<p class="mwb-cf7-integration-overview__keywords-description">
									<?php esc_html_e( 'MWB CF7 Integration with Google Sheets offers a smooth integration of both. The admin can enter their Google Sheets API credentials to integrate Contact Form 7 with their Google Sheets accounts.', 'mwb-cf7-integration-with-google-sheets' ); ?>
								</p>
							</div>
						</div>
					</div>
					<div class="mwb-cf7-integration-overview__keywords-item">
						<div class="mwb-cf7-integration-overview__keywords-card">
							<div class="mwb-cf7-integration-overview__keywords-text">
								<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_GSHEETS_URL . 'admin/images/Associate.png' ); ?>" alt="Easy-association" width="100px">
								<h4 class="mwb-cf7-integration-overview__keywords-heading"><?php esc_html_e( 'Easy CF7 Fields Association With Any Google Sheets Module Fields', 'mwb-cf7-integration-with-google-sheets' ); ?></h4>
								<p class="mwb-cf7-integration-overview__keywords-description">
									<?php esc_html_e( 'Any Contact Form 7 field can be linked to any Google Sheets field. You can send form entries over Google Sheets as per the form field mappings.', 'mwb-cf7-integration-with-google-sheets' ); ?>
								</p>
							</div>
						</div>
					</div>
					<div class="mwb-cf7-integration-overview__keywords-item">
						<div class="mwb-cf7-integration-overview__keywords-card">
							<div class="mwb-cf7-integration-overview__keywords-text">
								<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_GSHEETS_URL . 'admin/images/Filter.png' ); ?>" alt="Filter-form" width="100px">
								<h4 class="mwb-cf7-integration-overview__keywords-heading"><?php esc_html_e( 'Filters CF7 submissions According To User Input', 'mwb-cf7-integration-with-google-sheets' ); ?></h4>
								<p class="mwb-cf7-integration-overview__keywords-description">
									<?php esc_html_e( 'The admin can implement AND/OR conditions on your forms. If the CF7 form submissions don\'t meet the required conditions, then the submitted data will not go to Google Sheets and the logs will not be generated.', 'mwb-cf7-integration-with-google-sheets' ); ?>
								</p>
							</div>
						</div>
					</div>
					<div class="mwb-cf7-integration-overview__keywords-item">
						<div class="mwb-cf7-integration-overview__keywords-card">
							<div class="mwb-cf7-integration-overview__keywords-text">
								<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_GSHEETS_URL . 'admin/images/Comprehensive.png' ); ?>" alt="Detailed-log" width="100px">
								<h4 class="mwb-cf7-integration-overview__keywords-heading"><?php esc_html_e( 'Comprehensive Log Of CF7 Submission Sent To Google Sheets', 'mwb-cf7-integration-with-google-sheets' ); ?></h4>
								<p class="mwb-cf7-integration-overview__keywords-description">
									<?php esc_html_e( 'MWB CF7 Integration with Google Sheets plugin will provide a detailed log of each Contact form 7 sent to Google Sheets as per the response from the Google Sheets. There is logging of all the API interaction with Google Sheets for better error handling.', 'mwb-cf7-integration-with-google-sheets' ); ?>
								</p>
							</div>
						</div>
					</div>
					<div class="mwb-cf7-integration-overview__keywords-item">
						<div class="mwb-cf7-integration-overview__keywords-card">
							<div class="mwb-cf7-integration-overview__keywords-text">
								<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_GSHEETS_URL . 'admin/images/Clear-n-Dow.png' ); ?>" alt="Primary-key" width="100px">
								<h4 class="mwb-cf7-integration-overview__keywords-heading"><?php esc_html_e( 'Clear, Download & Delete logs', 'mwb-cf7-integration-with-google-sheets' ); ?></h4>
								<p class="mwb-cf7-integration-overview__keywords-description">
									<?php esc_html_e( 'Admin can easily clear logs entries and download the sync logs in a log file too. Delete Logs after N days will let you select the number of days you want to store the sync logs for. For example, selecting 30 days will store the logs for 30 days and be deleted after that.', 'mwb-cf7-integration-with-google-sheets' ); ?>
								</p>
							</div>
						</div>
					</div>
					<div class="mwb-cf7-integration-overview__keywords-item">
						<div class="mwb-cf7-integration-overview__keywords-card">
							<div class="mwb-cf7-integration-overview__keywords-text">
								<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_GSHEETS_URL . 'admin/images/Error-email.png' ); ?>" alt="Email-notification" width="100px">
								<h4 class="mwb-cf7-integration-overview__keywords-heading"><?php esc_html_e( 'Error eMail Notification For Admin', 'mwb-cf7-integration-with-google-sheets' ); ?></h4>
								<p class="mwb-cf7-integration-overview__keywords-description">
									<?php esc_html_e( 'E-mail notifications are sent to the admin if any input error occurs in the process of data sending entries over to Google Sheets. This way, the admin gets notified of any slight error in real-time.', 'mwb-cf7-integration-with-google-sheets' ); ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Overview content end-->
