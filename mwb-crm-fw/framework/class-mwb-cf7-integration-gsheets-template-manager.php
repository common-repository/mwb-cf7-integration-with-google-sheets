<?php
/**
 * The core plugin templates are handled here.
 *
 * @since      1.0.0
 * @package    Mwb_Cf7_Integration_With_Gsheets
 * @subpackage Mwb_Cf7_Integration_With_Gsheets/mwb-crm-fw
 * @author     MakeWebBetter <https://makewebbetter.com>
 */

/**
 * Template manager class, handles plugin templates.
 *
 * @since      1.0.0
 * @package    Mwb_Cf7_Integration_With_Gsheets
 * @subpackage Mwb_Cf7_Integration_With_Gsheets/mwb-crm-fw
 * @author     MakeWebBetter <https://makewebbetter.com>
 */
class Mwb_Cf7_Integration_Gsheets_Template_Manager {

	/**
	 * Current crm slug.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $crm_slug    The current crm slug.
	 */
	public $crm_slug;

	/**
	 * Current crm name.
	 *
	 * @since     1.0.0
	 * @access    public
	 * @var       string   $crm_name    The current crm name.
	 */
	public $crm_name;

	/**
	 * Current crm title.
	 *
	 * @since     1.0.0
	 * @access    public
	 * @var       string   $crm_name    The current crm title.
	 */
	public $crm_title;

	/**
	 * Connect manager class name
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $connect   Name of the Connect manager class.
	 */
	private $connect;

	/**
	 * Instance of Connect manager class.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $connect_manager  Instance of the Connect manager class.
	 */
	private $connect_manager;

	/**
	 * Instance of Admin class.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $admin  Instance of the Admin class.
	 */
	private $admin;

	/**
	 * Instance of the plugin main class.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      object   $core_class    Name of the plugin core class.
	 */
	public $core_class = 'Mwb_Cf7_Integration_With_Gsheets';

	/**
	 *  The instance of this class.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $instance    The instance of this class.
	 */
	private static $instance;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		self::$instance = $this;

		// Initialise CRM name and slug.
		$this->crm_slug  = $this->core_class::get_current_crm( 'slug' );
		$this->crm_title = $this->core_class::get_current_crm( 'title' );
		$this->crm_name  = $this->core_class::get_current_crm();

		// Initialise Connect manager class.
		$this->connect         = 'Mwb_Cf7_Integration_Connect_' . $this->crm_name . '_Framework';
		$this->connect_manager = $this->connect::get_instance();

		$this->admin = 'Mwb_Cf7_Integration_With_' . $this->crm_name . '_Admin';
	}

	/**
	 * Main Mwb_Cf7_Integration_Insightly_Template_Manager Instance.
	 *
	 * Ensures only one instance of Mwb_Cf7_Integration_Insightly_Template_Manager is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @return Mwb_Cf7_Integration_Insightly_Template_Manager - Main instance.
	 */
	public static function get_instance() {

		if ( is_null( self::$instance ) ) {

			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Add a header panel for all screens in plugin.
	 * Returns :: HTML
	 *
	 * @since     1.0.0
	 * @return    void
	 */
	public function render_navigation_tab() {

		if ( $this->admin::pro_dependency_check() ) {
			$pro_main   = 'Cf7_Integration_With_' . $this->crm_name;
			$license    = $pro_main::$mwb_cf7_pro_license_cb;
			$ini_days   = $pro_main::$mwb_cf7_pro_ini_license_cb;
			$days_count = $pro_main::$ini_days();

			if ( $pro_main::$license() || 0 <= $days_count ) {
				if ( ! $pro_main::$license() && 0 <= $days_count ) {

					$warning = floor( $days_count );

					/* translators: %s is replaced with "days remaining" */
					$day_string = sprintf( _n( '%s day', '%s days', $warning, 'mwb-cf7-integration-with-google-sheets' ), number_format_i18n( $warning ) );
					?>
					<div id="mwb-cf7-thirty-days-notify" class="notice notice-warning mwb-notice">
						<p>
							<strong><a href="<?php echo esc_url( admin_url( 'admin.php' ) . '?page=mwb_' . $this->crm_slug . '_cf7_page&tab=license' ); ?>">

							<!-- License warning. -->
							<?php esc_html_e( 'Activate', 'mwb-cf7-integration-with-google-sheets' ); ?></a>
							<?php
							/* translators: %s is replaced with "days remaining" */
							printf( esc_html__( ' the license key before %s or you may risk losing data and the plugin will also become dysfunctional.', 'mwb-cf7-integration-with-google-sheets' ), '<span id="mwb-sf-cf7-day-count" >' . esc_html( $day_string ) . '</span>' );
							?>
							</strong>
						</p>
					</div>
					<?php
				}
			} else {
				?>
				<div id="mwb-cf7-thirty-days-notify" class="notice notice-warning mwb-notice">
					<p>
						<strong>
							<?php esc_html_e( 'Trail expried !! ', 'mwb-cf7-integration-with-google-sheets' ); ?></a>
							<a href="<?php echo esc_url( admin_url( 'admin.php' ) . '?page=mwb_' . $this->crm_slug . '_cf7_page&tab=license' ); ?>">

							<!-- License warning. -->
							<?php esc_html_e( 'Activate', 'mwb-cf7-integration-with-google-sheets' ); ?></a>
							<?php
							/* translators: %s is replaced with "days remaining" */
							printf( esc_html__( ' your license and continue enjoying the pro version features.', 'mwb-cf7-integration-with-google-sheets' ) );
							?>
						</strong>
					</p>
				</div>
				<?php
			}
			$this->get_nav_tabs();

		} else {
			$this->get_nav_tabs();
		}

	}

	/**
	 * Get navigaton tabs.
	 *
	 * @since     1.0.0
	 * @return    void
	 */
	public function get_nav_tabs() {

		$active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'accounts'; // phpcs:ignore

		/* Tabs section start. */
		?>
		<?php if ( ! mwb_gs_cf7_is_plugin_active( 'cf7-integration-with-google-sheets/cf7-integration-with-google-sheets.php' ) ) : ?>
		<div class="mwb-about__list-item-btn mwb-floating-btn">
			<span class="dashicons dashicons-star-filled mwb-premium-icon"></span>
			<a href="<?php echo esc_url( 'https://makewebbetter.com/product/cf7-integration-with-google-sheets/?utm_source=MWB-google-sheet-&utm_medium=MWB-site&utm_campaign=MWB-google-sheets-site' ); ?>" target="_blank" class="mwb-btn mwb-btn--filled">
				<?php esc_html_e( 'Go Premium', 'mwb-cf7-integration-with-google-sheets' ); ?>
			</a>
		</div>
		<?php endif; ?>

		<nav class="mwb-cf7-integration-navbar">
			<div class="mwb-cf7-intergation-nav-collapse">
				<ul class="mwb-cf7-nav mwb-cf7-integration-nav-tabs" role="tablist">
					<?php $tabs = $this->retrieve_nav_tabs(); ?>
					<?php if ( ! empty( $tabs ) && is_array( $tabs ) ) : ?>
						<?php foreach ( $tabs as $href => $label ) : ?>
							<li class="mwb-cf7-integration-nav-item">
								<a class="mwb-cf7-integration-nav-link nav-tab <?php echo esc_html( $active_tab == $href ? 'nav-tab-active' : '' ); // phpcs:ignore ?>" href="?page=mwb_<?php echo esc_html( $this->crm_slug ); ?>_cf7_page&tab=<?php echo esc_html( $href ); ?>"><?php echo esc_html( $label ); ?></a>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
		</nav>

		<?php
		/* Tabs section end */

		switch ( $active_tab ) {

			case 'accounts':
				$params = array();

				$params['owner_name']  = $this->connect_manager->get_crm_token_details( 'account_owner' );
				$params['owner_email'] = $this->connect_manager->get_crm_token_details( 'account_email' );
				$params['expires_in']  = $this->connect_manager->get_crm_token_details( 'expiry' );
				$params['count']       = get_option( 'mwb-' . $this->crm_slug . '-cf7-synced-forms-count' );
				$params['links']       = $this->add_plugin_links();

				$this->load_template( 'accounts', $params );
				$this->load_template( 'extras', $params );
				break;

			case 'feeds':
				$params = array();

				$params['wpcf7']      = $this->connect_manager->get_available_cf7_forms();
				$params['feeds']      = $this->connect_manager->get_available_crm_feeds();
				$params['feed_class'] = 'Mwb_Cf7_Integration_' . $this->crm_name . '_Feed_Module';
				$this->load_template( 'feeds', $params );
				break;

			case 'logs':
				$params               = array();
				$params['log_enable'] = $this->connect_manager->get_settings_details( 'logs' );
				$this->load_template( 'logs', $params );
				break;

			case 'settings':
				$params = array();

				$params['option']   = get_option( 'mwb-' . $this->crm_slug . '-cf7-setting', $this->connect_manager->get_plugin_default_settings() );
				$params['response'] = get_option( 'mwb-' . $this->crm_slug . '-cf7-settings-response' );
				$this->load_template( 'settings', $params );
				break;

			case 'license':
				$params = array();
				$this->load_template( 'license', $params );
				break;

			case 'sheets':
				$params           = array();
				$params['sheets'] = $this->connect_manager->get_available_crm_objects();
				$this->load_template( 'sheets', $params );
				break;

			default:
				'';

		}
	}

	/**
	 * Render authorisation screen.
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	public function render_authorisation_screen() {
		$params = array();

		$params['client_id']     = get_option( 'mwb-cf7-' . $this->crm_slug . '-client-id' );
		$params['client_secret'] = get_option( 'mwb-cf7-' . $this->crm_slug . '-client-secret' );
		$this->load_template( 'authorisation', $params );
	}

	/**
	 * Get all nav tabs of current screen.
	 *
	 * @since     1.0.0
	 * @return    array   An array of screen tabs.
	 */
	public function retrieve_nav_tabs() {

		$current_screen = ! empty( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : false; // phpcs:ignore

		$tabs = '';

		switch ( $current_screen ) {

			case 'mwb_' . $this->crm_slug . '_cf7_page':
				$tabs = array(
					'accounts' => esc_html__( 'Dashboard', 'mwb-cf7-integration-with-google-sheets' ),
					'feeds'    => esc_html__( 'Feeds', 'mwb-cf7-integration-with-google-sheets' ),
					'logs'     => esc_html__( 'Logs', 'mwb-cf7-integration-with-google-sheets' ),
					'settings' => esc_html__( 'Settings', 'mwb-cf7-integration-with-google-sheets' ),
				);
				break;
		}

		return apply_filters( $current_screen . '_tab', $tabs );
	}

	/**
	 * Loads plugin templates.
	 *
	 * @param     string $template     Name of the template.
	 * @param     array  $params       Parameters to pass to template.
	 * @since     1.0.0
	 * @return    void
	 */
	protected function load_template( $template = '', $params = array() ) {

		if ( empty( $template ) ) {
			return;
		}

		if ( 'license' == $template ) { // phpcs:ignore
			if ( $this->admin::pro_dependency_check() ) {
				require_once CF7_INTEGRATION_WITH_GSHEETS_DIRPATH . 'mwb-crm-fw/framework/templates/tab-content/license-tab.php';
			}
		} elseif ( 'sheets' == $template ) { // phpcs:ignore
			if ( $this->admin::pro_dependency_check() ) {
				if ( ! $this->admin::is_pro_available_and_active() ) {
					require_once CF7_INTEGRATION_WITH_GSHEETS_DIRPATH . 'mwb-crm-fw/framework/templates/tab-content/sheets-tab.php';
				}
			}
		} else {
			$params['admin_class'] = $this->admin;

			$path = 'templates/tab-contents/' . $template . '-tab.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . $path;
		}
	}

	/**
	 * Get plugin important links.
	 *
	 * @since   1.0.0
	 * @return  array
	 */
	public function add_plugin_links() {

		$links = array(
			'doc'     => 'https://docs.makewebbetter.com/mwb-cf7-integration-with-google-sheets/?utm_source=MWB-cf7-gsheets-org&utm_medium=MWB-org-backend&utm_campaign=MWB-cf7-gsheets-doc',
			'ticket'  => 'https://makewebbetter.com/submit-query/?utm_source=MWB-cf7-gsheets-org&utm_medium=MWB-org-backend&utm_campaign=MWB-cf7-gsheets-support',
			'contact' => 'https://makewebbetter.com/contact-us/?utm_source=MWB-cf7-gsheets-org&utm_medium=MWB-org-backend&utm_campaign=MWB-cf7-gsheets-query',
		);

		return apply_filters( 'mwb_' . $this->crm_slug . '_cf7_plugin_links', $links );
	}

	/**
	 * Get individual field mapping section.
	 *
	 * @param    array $field_options             CF7 field mapping options.
	 * @param    array $fields_data               CRM fields.
	 * @param    array $default_data              Default mapping data.
	 * @since    1.0.0
	 * @return   void
	 */
	public static function get_field_section_html( $field_options, $fields_data, $default_data = array() ) {

		if ( empty( $default_data ) ) {

			$default_data = array(
				'field_type'  => 'standard_field',
				'field_value' => '',
			);
		}

		$row_stndrd   = ( 'standard_field' === $default_data['field_type'] ) ? '' : 'row-hide';
		$row_custom   = ( 'custom_value' === $default_data['field_type'] ) ? '' : 'row-hide';
		$custom_value = ! empty( $default_data['custom_value'] ) ? $default_data['custom_value'] : '';
		$field_value  = ! empty( $default_data['field_value'] ) ? $default_data['field_value'] : '';
		?>
		<div class="mwb-feeds__form-wrap mwb-fields-form-row">
			<div class="mwb-form-wrapper">

				<div class="mwb-fields-form-section-head">
					<span class="field-label-txt"><?php echo esc_html( $fields_data['label'] ); ?></span>
					<input type="hidden" class="crm-field-name" name="crm_field[]" value="<?php echo esc_html( $fields_data['name'] ); ?>">
					<span class="field-delete dashicons">
						<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_GSHEETS_URL . 'admin/images/trash.svg' ); ?>" style="max-width: 20px;">
					</span>
				</div>

				<div class="mwb-fields-form-section-meta">
					<span>
						<?php esc_html_e( 'Name : ', 'mwb-cf7-integration-with-google-sheets' ); // phpcs:ignore ?>
						<?php echo esc_html( $fields_data['name'] ); ?>
					</span>
					<span>
						<?php esc_html_e( 'Type : ', 'mwb-cf7-integration-with-google-sheets' ); ?>
						<?php echo esc_html( $fields_data['type'] ); ?> 
					</span>
					<span>
						<?php if ( ! empty( $fields_data['length'] ) ) : ?>
							<?php esc_html_e( 'Length : ', 'mwb-cf7-integration-with-google-sheets' ); ?>
							<?php echo esc_html( ! empty( $fields_data['length'] ) ? $fields_data['length'] : '' ); ?> 
						<?php endif; ?>
					</span>
				</div>

				<div class="mwb-fields-form-section-form">

					<div class="form-field-row row-field-type">
						<label>
							<?php esc_html_e( 'Field Type', 'mwb-cf7-integration-with-google-sheets' ); ?>
						</label>
						<select class="field-type-select" name="field_type[]">
							<option value=""><?php esc_html_e( 'Select an Option', 'mwb-cf7-integration-with-google-sheets' ); ?></option>
							<option value="standard_field" <?php echo esc_attr( selected( 'standard_field', $default_data['field_type'] ) ); ?> >
								<?php esc_html_e( 'Standard Value', 'mwb-cf7-integration-with-google-sheets' ); ?>
							</option>
							<option value="custom_value" <?php echo esc_attr( selected( 'custom_value', $default_data['field_type'] ) ); ?>>
								<?php esc_html_e( 'Custom Value', 'mwb-cf7-integration-with-google-sheets' ); ?>		
							</option>
						</select>
					</div>

					<div class="form-field-row row-field-value row-standard_field <?php echo esc_attr( $row_stndrd ); ?>">
						<label><?php esc_html_e( 'Field Value', 'mwb-cf7-integration-with-google-sheets' ); ?></label>
						<select class="field-value-select" name="field_value[]">
							<option value=""><?php esc_html_e( 'Select an Option', 'mwb-cf7-integration-with-google-sheets' ); ?></option>
							<?php foreach ( $field_options as $k1 => $options ) : ?>
								<optgroup label="<?php echo esc_attr( ucfirst( str_replace( '_', ' ', $k1 ) ) ); ?>">
								<?php foreach ( $options as $k2 => $name ) : ?>
									<option value="<?php echo esc_attr( $k1 . '_' . $k2 ); ?>" <?php echo esc_attr( selected( $k1 . '_' . $k2, $field_value ) ); ?>>
										<?php echo esc_html( $name ); ?>
									</option>
								<?php endforeach; ?>
								</optgroup>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-field-row row-custom_value row-field-value <?php echo esc_attr( $row_custom ); ?>">
						<label>
							<?php esc_html_e( 'Custom Value', 'mwb-cf7-integration-with-google-sheets' ); ?>
						</label>
						<input type="text" class="custom-value-input" name="custom_value[]" value="<?php echo esc_attr( $custom_value ); ?>">
						<select class="custom-value-select" name="custom_field[]">
							<option value=""><?php esc_html_e( 'Select an Option', 'mwb-cf7-integration-with-google-sheets' ); ?></option>
							<?php foreach ( $field_options as $k1 => $options ) : ?>
								<optgroup label="<?php echo esc_attr( ucfirst( str_replace( '_', ' ', $k1 ) ) ); ?>">
								<?php foreach ( $options as $k2 => $name ) : ?>
									<option value="<?php echo esc_attr( $k1 . '_' . $k2 ); ?>">
										<?php echo esc_html( $name ); ?>
									</option>
								<?php endforeach; ?>
								</optgroup>
							<?php endforeach; ?>
						</select>
					</div>

				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Feeds Condtional html.
	 *
	 * @param     string $and_condition  The and condition of current html.
	 * @param     string $and_index      The and offset of current html.
	 * @param     string $or_index       The or offset of current html.
	 * @since     1.0.0
	 * @return    mixed
	 */
	public function render_and_conditon( $and_condition = array(), $and_index = '1', $or_index = '' ) {

		if ( empty( $and_index ) || empty( $and_condition ) || empty( $or_index ) ) {
			return;
		}

		?>
		<div class="and-condition-filter" data-and-index=<?php echo esc_attr( $and_index ); ?> >
			<select name="condition[<?php echo esc_html( $or_index ); ?>][<?php echo esc_html( $and_index ); ?>][field]"  class="condition-form-field">
				<option value="-1" ><?php esc_html_e( 'Select Field', 'mwb-cf7-integration-with-google-sheets' ); ?></option>
				<?php foreach ( $and_condition['form'] as $key => $value ) : ?>
					<optgroup label="<?php echo esc_html( $key ); ?>" >
						<?php foreach ( $value as $index => $field ) : ?>
							<option value="<?php echo esc_html( $index ); ?>" <?php selected( $and_condition['field'], $index ); ?> ><?php echo esc_html( $field ); ?></option>
						<?php endforeach; ?>
					</optgroup>
				<?php endforeach; ?>
			</select>
			<select name="condition[<?php echo esc_html( $or_index ); ?>][<?php echo esc_html( $and_index ); ?>][option]" class="condition-option-field">
				<option value="-1"><?php esc_html_e( 'Select Condition', 'mwb-cf7-integration-with-google-sheets' ); ?></option>
				<?php foreach ( $this->connect_manager->get_avialable_form_filters() as $key => $value ) : ?>
					<option value="<?php echo esc_html( $key ); ?>" <?php selected( $and_condition['option'], $key ); ?>><?php echo esc_html( $value ); ?></option>
				<?php endforeach; ?>
			</select>
			<input type="text" name="condition[<?php echo esc_html( $or_index ); ?>][<?php echo esc_html( $and_index ); ?>][value]" class="condition-value-field" value="<?php echo esc_html( ! empty( $and_condition['value'] ) ? $and_condition['value'] : '' ); ?>" placeholder="<?php esc_html_e( 'Enter value', 'mwb-cf7-integration-with-google-sheets' ); ?>">
			<?php if ( 1 != $and_index ) : // @codingStandardsIgnoreLine ?>
				<span class="dashicons dashicons-no"></span>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Get feeds filter html.
	 *
	 * @param     object $feed    Feed object.
	 * @since     1.0.0
	 * @return    mixed
	 */
	public function get_filter_section_html( $feed ) {

		$feed_class  = 'Mwb_Cf7_Integration_' . $this->crm_name . '_Feed_Module';
		$feed_module = $feed_class::get_instance();

		if ( ! empty( $feed ) ) {
			$_status        = get_post_status( $feed->ID );
			$edit_link      = get_edit_post_link( $feed->ID );
			$cf7_from       = $feed_module->fetch_feed_data( $feed->ID, 'mwb-' . $this->crm_slug . '-cf7-form', '-' );
			$crm_object     = $feed_module->fetch_feed_data( $feed->ID, 'mwb-' . $this->crm_slug . '-cf7-object', '-' );
			$primary_field  = $feed_module->fetch_feed_data( $feed->ID, 'mwb-' . $this->crm_slug . '-cf7-primary-field', '-' );
			$checked        = 'publish' == $_status ? 'checked="checked"' : ''; // phpcs:ignore
			$filter_applied = $feed_module->fetch_feed_data( $feed->ID, 'mwb-' . $this->crm_slug . '-cf7-enable-filters', '-' );
			?>
			<li class="mwb-cf7-integration__feed-row">
				<div class="mwb-cf7-integration__left-col">
					<h3 class="mwb-about__list-item-heading"><?php echo esc_html( $feed->post_title ); ?></h3>
					<div class="mwb-feed-status__wrap">
						<p class="mwb-feed-status-text_<?php echo esc_attr( $feed->ID ); ?>" ><strong><?php echo esc_html( 'publish' == $_status ? 'Active' : 'Sandbox' ); ?></strong></p>
						<p><input type="checkbox" class="mwb-feed-status" value="publish" <?php echo esc_html( $checked ); ?> feed-id=<?php esc_attr( $feed->ID ); ?>></p>
					</div>
					<p>
						<span class="mwb-about__list-item-sub-heading"><?php esc_html_e( 'Form : ', 'mwb-cf7-integration-with-google-sheets' ); ?></span>
						<span><?php echo esc_html( get_the_title( $cf7_from ) ); ?></span>    
					</p>
					<p>
						<span class="mwb-about__list-item-sub-heading"><?php esc_html_e( 'Object : ', 'mwb-cf7-integration-with-google-sheets' ); ?></span>
						<span><?php echo esc_html( $crm_object ); ?></span> 
					</p>
					<p> 
						<span class="mwb-about__list-item-sub-heading"><?php esc_html_e( 'Primary Key : ', 'mwb-cf7-integration-with-google-sheets' ); ?></span>
						<span><?php echo esc_html( $primary_field ); ?></span> 
					</p>
					<p>
						<span class="mwb-about__list-item-sub-heading"><?php esc_html_e( 'Conditions : ', 'mwb-cf7-integration-with-google-sheets' ); ?></span>
						<span><?php echo esc_html( 'yes' != $filter_applied ? '-' : esc_html__( 'Applied', 'mwb-cf7-integration-with-google-sheets' ) ); // phpcs:ignore ?></span> 
					</p>
				</div>
				<div class="mwb-cf7-integration__right-col">
					<a href="<?php echo esc_url( $edit_link ); ?>"><img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_GSHEETS_URL . 'admin/images/edit.svg' ); ?>" alt="<?php esc_html_e( 'Edit feed', 'mwb-cf7-integration-with-google-sheets' ); ?>"></a>
					<div class="mwb-cf7-integration__right-col1">
						<a href="javascript:void(0)" class="mwb_cf7_integration_trash_feed" feed-id="<?php echo esc_html( $feed->ID ); ?>">
							<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_GSHEETS_URL . 'admin/images/trash.svg' ); ?>" alt="<?php esc_html_e( 'Trash feed', 'mwb-cf7-integration-with-google-sheets' ); ?>">
						</a>
					</div>
				</div>
			</li>
			<?php
		}

	}

}

