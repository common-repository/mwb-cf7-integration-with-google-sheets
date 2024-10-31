<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the select object section of feeds.
 *
 * @link       https://makewebbetter.com
 * @since      1.0.0
 *
 * @package    Mwb_Cf7_Integration_With_Gsheets
 * @subpackage Mwb_Cf7_Integration_With_Gsheets/includes/framework/templates/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$objects = isset( $params['objects'] ) ? $params['objects'] : array();

if ( ! is_array( $objects ) ) {
	echo esc_html( $objects );
	return;
}

?>
<div class="mwb-feeds__content  mwb-content-wrap  mwb-feed__select-object">
	<a class="mwb-feeds__header-link active">
		<?php
		/* translators: %s: Crm title */
		printf( esc_html__( 'Select %s', 'mwb-cf7-integration-with-google-sheets' ), esc_html( $this->crm_title ) );
		?>
	</a>

	<div class="mwb-feeds__meta-box-main-wrapper">
		<div class="mwb-feeds__meta-box-wrap">
			<div class="mwb-form-wrapper">
				<select name="crm_object" id="mwb-feeds-<?php echo esc_attr( $this->crm_slug ); ?>-object" class="mwb-form__dropdown">
					<option value="-1"><?php esc_html_e( 'Select Google Sheets', 'mwb-cf7-integration-with-google-sheets' ); ?></option>
					<?php if ( is_array( $objects ) ) : ?>
						<?php foreach ( $objects as $key => $object ) : ?>
							<option value="<?php echo esc_attr( $object['id'] ); ?>" <?php selected( $params['selected_object'], $object['id'] ); ?> >
								<?php echo esc_html( $object['name'] ); ?>
							</option>
						<?php endforeach; ?>
					<?php endif; ?>
				</select>
			</div>
			<div class="mwb-form-wrapper">
				<a id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-refresh-object" class="button refresh-object">
					<span class="mwb-sf_cf7-refresh-object ">
						<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_GSHEETS_URL . 'admin/images/refresh.svg' ); ?>">
					</span>
					<?php esc_html_e( 'Refresh Objects', 'mwb-cf7-integration-with-google-sheets' ); ?>
				</a>
				<a id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-refresh-fields" class="button refresh-fields">
					<span class="mwb-sf_cf7-refresh-fields ">
						<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_GSHEETS_URL . 'admin/images/refresh.svg' ); ?>">
					</span>
					<?php esc_html_e( 'Refresh Fields', 'mwb-cf7-integration-with-google-sheets' ); ?>
				</a>
			</div>
		</div>
	</div>
</div>
