<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the primary field of feeds section.
 *
 * @link       https://makewebbetter.com
 * @since      1.0.0
 *
 * @package    Mwb_Cf7_Integration_With_Gsheets
 * @subpackage Mwb_Cf7_Integration_With_Gsheets/includes/framework/templates/
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	exit;
}

?>
<div id="mwb-primary-field-section-wrapper"  class="mwb-feeds__content  mwb-content-wrap row-hide">
	<a class="mwb-feeds__header-link">
		<?php esc_html_e( 'Sheet tabs', 'mwb-cf7-integration-with-google-sheets' ); ?>
	</a>
	<div class="mwb-feeds__meta-box-main-wrapper">
		<div class="mwb-feeds__meta-box-wrap">
			<div class="mwb-form-wrapper">
				<select id="sheet-tab-field-select" name="tab_field">
					<?php $_tabs = ! empty( $params['tab_field'] ) ? $params['tab_field'] : ''; ?>
					<?php if ( ! empty( $params['crm_fields']['tabs'] ) ) : ?>
						<?php foreach ( $params['crm_fields']['tabs'] as $key => $tabs_data ) : ?>
							<option <?php selected( $_tabs, $tabs_data ); ?>  value="<?php echo esc_attr( $tabs_data ); ?>"><?php echo esc_html( $tabs_data ); ?></option>	
						<?php endforeach; ?>
					<?php endif; ?>
				</select>
				<p class="mwb-description row-hide">
					<?php
					esc_html_e(
						'Please select a field which should be used as "primary key" to update an existing record. 
						In case of duplicate records',
						'mwb-cf7-integration-with-google-sheets'
					);
					?>
				</p>
			</div>
		</div>
	</div>
</div>

