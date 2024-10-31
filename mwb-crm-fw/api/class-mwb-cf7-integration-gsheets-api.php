<?php
/**
 * Base Api Class
 *
 * @link       https://makewebbetter.com/
 * @since      1.0.0
 *
 * @package    Mwb_Cf7_Integration_With_Gsheets
 * @subpackage Mwb_Cf7_Integration_With_Gsheets/mwb-crm-fw
 */

/**
 * Base Api Class.
 *
 * This class defines all code necessary api communication.
 *
 * @since      1.0.0
 * @package    Mwb_Cf7_Integration_With_Gsheets
 * @subpackage Mwb_Cf7_Integration_With_Gsheets/mwb-crm-fw
 */
class Mwb_Cf7_Integration_Gsheets_Api extends Mwb_Cf7_Integration_Gsheets_Api_Base {

	/**
	 * Crm prefix
	 *
	 * @var    string   Crm prefix
	 * @since  1.0.0
	 */
	public static $crm_prefix;

	/**
	 * Google Sheets Client id
	 *
	 * @var     string  Client ID
	 * @since   1.0.0
	 */
	public static $client_id;

	/**
	 * Google Sheets Client secret
	 *
	 * @var     string Client secret key
	 * @since   1.0.0
	 */
	public static $client_secret;

	/**
	 * Google sheets access token.
	 *
	 * @var     string $access_token
	 * @since   1.0.0
	 */
	private static $access_token;

	/**
	 * Google sheets refresh token.
	 *
	 * @var      string $refresh_token
	 * @since    1.0.0
	 */
	private static $refresh_token;

	/**
	 * Google sheets token id
	 *
	 * @var      string $id_token
	 * @since    1.0.0
	 */
	private static $id_token;

	/**
	 * Google sheets token duration
	 *
	 * @var      string $expires_in
	 * @since    1.0.0
	 */
	private static $expires_in;

	/**
	 * Google sheets token expiry time
	 *
	 * @var      string $expiry
	 * @since    1.0.0
	 */
	private static $expiry;

	/**
	 * Google sheets account owner name.
	 *
	 * @var      string $account_name
	 * @since    1.0.0
	 */
	private static $account_name;

	/**
	 * Google sheets account email.
	 *
	 * @var      string $account_email
	 * @since    1.0.0
	 */
	private static $account_email;

	/**
	 * Current instance of api class
	 *
	 * @var      object $_instance
	 * @since    1.0.0
	 */
	protected static $_instance = null; // phpcs:ignore

	/**
	 * Main Mwb_Cf7_Integration_Google_Sheets_Api_Base Instance.
	 *
	 * Ensures only one instance of Mwb_Cf7_Integration_Google_Sheets_Api_Base is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @return Mwb_Cf7_Integration_Gsheets_Api_Base - Main instance.
	 */
	public static function get_instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		self::initialize();
		return self::$_instance;
	}


	/**
	 * Initialize properties.
	 *
	 * @since 1.0.0
	 *
	 * @param  array $token_data Saved token data.
	 */
	private static function initialize( $token_data = array() ) {

		self::$crm_prefix = Mwb_Cf7_Integration_With_Gsheets::get_current_crm( 'slug' );

		self::$client_id     = get_option( 'mwb-cf7-' . self::$crm_prefix . '-client-id', '' );
		self::$client_secret = get_option( 'mwb-cf7-' . self::$crm_prefix . '-client-secret', '' );

		if ( empty( $token_data ) ) {
			$token_data = get_option( 'mwb-cf7-' . self::$crm_prefix . '-token-data', array() );
		}

		self::$access_token  = isset( $token_data['access_token'] ) ? $token_data['access_token'] : '';
		self::$refresh_token = isset( $token_data['refresh_token'] ) ? $token_data['refresh_token'] : '';
		self::$expires_in    = isset( $token_data['expires_in'] ) ? $token_data['expires_in'] : '';
		self::$id_token      = isset( $token_data['id_token'] ) ? $token_data['id_token'] : '';
		self::$expiry        = isset( $token_data['expires'] ) ? $token_data['expires'] : '';

		$userinfo = get_option( 'mwb-cf7-' . self::$crm_prefix . '-user-info', array() );

		self::$account_name  = isset( $userinfo['name'] ) ? $userinfo['name'] : '';
		self::$account_email = isset( $userinfo['email'] ) ? $userinfo['email'] : '';

	}

	/**
	 * Get redirect uri.
	 *
	 * @since    1.0.0
	 * @return   string   Site redirecrt Uri.
	 */
	public function get_redirect_uri() {
		return admin_url();
	}

	/**
	 * Get token id.
	 *
	 * @since     1.0.0
	 * @return    string    Refresh token.
	 */
	public function get_id_token() {
		return ! empty( self::$id_token ) ? self::$id_token : false;
	}

	/**
	 * Get access token.
	 *
	 * @since    1.0.0
	 * @return   string   Access token.
	 */
	public function get_access_token() {
		return ! empty( self::$access_token ) ? self::$access_token : false;
	}

	/**
	 * Get refresh token.
	 *
	 * @since     1.0.0
	 * @return    string    Refresh token.
	 */
	public function get_refresh_token() {
		return ! empty( self::$refresh_token ) ? self::$refresh_token : false;
	}

	/**
	 * Get token expiry.
	 *
	 * @since     1.0.0
	 * @return    string    Refresh token.
	 */
	public function get_access_token_expiry() {
		return ! empty( self::$expiry ) ? self::$expiry : false;
	}

	/**
	 * Get owner name.
	 *
	 * @since     1.0.0
	 * @return    string    Refresh token.
	 */
	public function get_account_owner_name() {
		return ! empty( self::$account_name ) ? self::$account_name : false;
	}

	/**
	 * Get owner email.
	 *
	 * @since     1.0.0
	 * @return    string    Refresh token.
	 */
	public function get_account_owner_email() {
		return ! empty( self::$account_email ) ? self::$account_email : false;
	}

	/**
	 * Check if access token is valid.
	 *
	 * @since    1.0.0
	 * @return   boolean
	 */
	public function is_access_token_valid() {
		return ! empty( self::$expiry ) ? ( self::$expiry > time() ) : false;
	}

	/**
	 * Get Base Authorization url.
	 *
	 * @since    1.0.0
	 * @return   string   Base Authorization url.
	 */
	public function base_auth_url() {
		$url = 'https://www.googleapis.com/oauth2/v4/';
		return $url;
	}

	/**
	 * Get Google api url.
	 *
	 * @since    1.0.0
	 * @return   string
	 */
	public function base_crm_url() {
		$url = 'https://www.googleapis.com/';
		return $url;
	}

	/**
	 * Get Google sheets url.
	 *
	 * @since    1.0.0
	 * @return   string
	 */
	public function base_sheets_url() {
		$url = 'https://sheets.googleapis.com/';
		return $url;
	}

	/**
	 * Get authorization headers for getting token.
	 *
	 * @since   1.0.0
	 * @return  array   Headers.
	 */
	public function get_token_auth_header() {
		return array(
			'content-type' => 'application/x-www-form-urlencoded',
		);
	}

	/**
	 * Get Request headers.
	 *
	 * @since    1.0.0
	 * @return   array   Headers.
	 */
	public function get_auth_header() {

		$headers = array(
			'Authorization' => 'Bearer ' . $this->get_access_token(),
			'content-type'  => 'application/json',
		);

		return $headers;
	}

	/**
	 * Check if response has expired access token message.
	 *
	 * @param  array $response Api response.
	 * @return bool            Access token status.
	 */
	public function if_access_token_expired( $response ) {
		if ( isset( $response['code'] ) && 401 == $response['code'] && 'Unauthorized' == $response['message'] ) { // phpcs:ignore
			return $this->renew_access_token();
		}
		return false;
	}

	/**
	 * Renew Access token.
	 *
	 * @return bool
	 */
	public function renew_access_token() {

		$refresh_token = $this->get_refresh_token();

		if ( ! empty( $refresh_token ) ) {
			$response = $this->process_access_token( false, $refresh_token );
		}

		return ! empty( $response['code'] ) && 200 == $response['code'] ? true : false; // phpcs:ignore
	}

	/**
	 * Save New token data into db.
	 *
	 * @since   1.0.0
	 * @param   string $code    Unique code to generate token.
	 */
	public function save_access_token( $code ) {
		$this->process_access_token( $code );
	}

	/**
	 * Get auth code URL
	 *
	 * @since     1.0.0
	 * @return    string   Auth url.
	 */
	public function get_auth_code_url() {
		$nonce       = wp_create_nonce( 'mwb_cf7_' . self::$crm_prefix . '_state' );
		$account_url = 'https://accounts.google.com/o/oauth2/auth';
		$auth_params = array(
			'response_type'   => 'code',
			'access_type'     => 'offline',
			'approval_prompt' => 'force',
			'state'           => urlencode( $nonce ), // phpcs:ignore
			'client_id'       => self::$client_id,
			'redirect_uri'    => $this->get_redirect_uri(),
			'scope'           => 'https://www.googleapis.com/auth/spreadsheets https://www.googleapis.com/auth/drive.readonly email profile',
		);
		$auth_url    = add_query_arg( $auth_params, $account_url );
		return $auth_url;
	}

	/**
	 * Merge refresh token with new access token data.
	 *
	 * @since   1.0.0
	 * @param   array $new_token_data   Latest token data.
	 * @return  array                   Token data.
	 */
	public function merge_refresh_token( $new_token_data ) {

		$old_token_data = get_option( 'mwb-cf7-' . self::$crm_prefix . '-token-data', array() );

		if ( empty( $old_token_data ) ) {
			return $new_token_data;
		}

		foreach ( $old_token_data as $key => $value ) {
			if ( isset( $new_token_data[ $key ] ) ) {
				$old_token_data[ $key ] = $new_token_data[ $key ];
			}
		}
		return $old_token_data;
	}

	/**
	 * Get refresh token data from api.
	 *
	 * @since   1.0.0
	 * @param   string $code            Unique code to generate token.
	 * @param   string $refresh_token   Unique code to renew token.
	 * @return  array
	 */
	public function process_access_token( $code = '', $refresh_token = '' ) {

		$endpoint = 'token';

		$this->base_url = $this->base_auth_url();

		$params = array(
			'grant_type'    => 'authorization_code',
			'client_id'     => self::$client_id,
			'client_secret' => self::$client_secret,
			'redirect_uri'  => admin_url(),
			'code'          => $code,
		);

		if ( empty( $code ) ) {
			$params['refresh_token'] = $refresh_token;
			$params['grant_type']    = 'refresh_token';
			unset( $params['code'] );
		}

		$response = $this->post( $endpoint, $params, $this->get_token_auth_header() );

		if ( isset( $response['code'] ) && 200 == $response['code'] ) { // phpcs:ignore

			// Save token.
			$token_data = ! empty( $response['data'] ) ? $response['data'] : array();
			$token_data = $this->merge_refresh_token( $token_data );

			$token_data['expires'] = time() + $token_data['expires_in'];
			update_option( 'mwb-cf7-' . self::$crm_prefix . '-token-data', $token_data );
			update_option( 'mwb-cf7-' . self::$crm_prefix . '-crm-active', true );
			self::initialize( $token_data );
		} else {
			// On failure add to log.
			delete_option( 'mwb-cf7-' . self::$crm_prefix . '-token-data' );
			delete_option( 'mwb-cf7-' . self::$crm_prefix . '-crm-active' );
			delete_option( 'mwb-cf7-' . self::$crm_prefix . '-authorised' );
		}

		return $response;
	}

	/**
	 * Get User info.
	 */
	public function get_userinfo() {
		$endpoint       = 'oauth2/v3/userinfo';
		$this->base_url = $this->base_crm_url();
		$headers        = $this->get_auth_header();
		$response       = $this->get( $endpoint, '', $headers );
		$userinfo       = array();

		if ( isset( $response['code'] ) && 200 == $response['code'] ) { // phpcs:ignore
			if ( isset( $response['data'] ) ) {
				$userinfo['name']  = $response['data']['name'];
				$userinfo['email'] = $response['data']['email'];
			}
		}
		update_option( 'mwb-cf7-' . self::$crm_prefix . '-user-info', $userinfo );
		return $userinfo;
	}

	/**
	 * Get Google sheets.
	 *
	 * @param     bool   $force     Action.
	 * @param     array  $data      Module data.
	 * @param     string $token     Nextpage token.
	 * @since     1.0.0
	 * @return    array
	 */
	public function get_modules_data( $force = false, $data = array(), $token = false ) {
		$data = get_transient( 'mwb_cf7_' . self::$crm_prefix . '_objects_data' );
		if ( ! $force && false !== ( $data ) ) {
			return $data;
		}

		$this->base_url = $this->base_crm_url();
		$endpoint       = 'drive/v3/files';
		$query_args     = array(
			'q' => "mimeType contains 'spreadsheet'",
		);

		$query_args['fields'] = 'files(id, name,modifiedTime,owners)';

		if ( $token && ! empty( $token ) ) {
			$query_args              = array();
			$query_args['pageToken'] = $token;
		}

		$headers  = $this->get_auth_header();
		$response = $this->get( $endpoint, $query_args, $headers );

		if ( $this->if_access_token_expired( $response ) ) {
			$headers  = $this->get_auth_header();
			$response = $this->get( $endpoint, $query_args, $headers );
		}

		if ( isset( $response['code'] ) && 200 == $response['code'] && 'OK' == $response['message'] ) { // phpcs:ignore
			if ( ! empty( $response['data'] ) && isset( $response['data']['files'] ) ) {
				$data = $response['data']['files'];

				if ( ! empty( $response['data']['nextPageToken'] ) ) {
					$data = $this->get_modules_data( $data, $response['data']['nextPageToken'] );
				}
				set_transient( 'mwb_cf7_' . self::$crm_prefix . '_objects_data', $data );
			}
		}
		return $data;
	}

	/**
	 * Get google sheet fields.
	 *
	 * @param       string $module    Sheet ID.
	 * @param       string $tab       Tab ID.
	 * @param       bool   $force     Action.
	 * @since       1.0.0
	 * @return      array
	 */
	public function get_module_fields( $module = '', $tab = '', $force = false ) {

		$g_sheets     = array();
		$sheet_fields = array();
		$sheet_data   = array();

		$this->base_url = $this->base_sheets_url();
		$endpoint       = 'v4/spreadsheets/' . $module;
		$headers        = $this->get_auth_header();
		$response       = $this->get( $endpoint, '', $headers );
		if ( $this->if_access_token_expired( $response ) ) {
			$headers  = $this->get_auth_header();
			$response = $this->get( $endpoint, '', $headers );
		}

		if ( isset( $response['code'] ) && 200 == $response['code'] && 'OK' == $response['message'] ) { // phpcs:ignore
			if ( ! empty( $response['data'] ) && ! empty( $response['data']['sheets'] ) ) {

				foreach ( $response['data']['sheets'] as $key ) {
					$sheet_title = $key['properties']['title'];
					$g_sheets[]  = $sheet_title;

					if ( empty( $tab ) ) {
						$tab = $sheet_title;
					}
				}

				if ( ! in_array( $tab, $g_sheets ) ) { // phpcs:ignore
					$tab = $g_sheets[0];
				}

				$endpoint  = 'v4/spreadsheets/' . $module . '/values/' . urlencode( "'" . $tab . "'!1:1" ); // phpcs:ignore
				$tabs_data = $this->get( $endpoint, '', $headers );

				if ( $this->if_access_token_expired( $tabs_data ) ) {
					$headers   = $this->get_auth_header();
					$tabs_data = $this->get( $endpoint, '', $headers );
				}

				if ( isset( $tabs_data['code'] ) && 200 == $tabs_data['code'] && 'OK' == $tabs_data['message'] ) { // phpcs:ignore
					if ( ! empty( $tabs_data['data'] ) && ! empty( $tabs_data['data']['values'][0] ) ) {

						foreach ( $tabs_data['data']['values'][0] as $key => $value ) {
							if ( empty( $value ) ) {
								$value = 'Column #' . ( $key + 1 );
							}
							$key                  = 'field-' . $key;
							$sheet_fields[ $key ] = array(
								'name'  => $key,
								'label' => $value,
								'type'  => 'Text',
							);
							if ( 'field-0' === $key ) {
								$sheet_fields[ $key ]['required'] = true;
							} else {
								$sheet_fields[ $key ]['required'] = false;
							}
						}

						$sheet_data = array(
							'tabs'   => $g_sheets,
							'fields' => $sheet_fields,
						);

					} else {
						$sheet_data = array(
							'status' => false,
							'msg'    => esc_html__( 'Sheet header is empty, Please enter first row in sheet', 'mwb-cf7-integration-with-google-sheets' ),
						);
					}
				}
			}
		}

		return $sheet_data;

	}

	/**
	 * Create single record on CRM.
	 *
	 * @param  string $module      CRM Module name.
	 * @param  string $tab         Sheet tab.
	 * @param  array  $record_data Request data.
	 * @param  array  $log_data    Data to create log.
	 *
	 * @since 1.0.0
	 *
	 * @return array Response data.
	 */
	public function handle_single_record( $module, $tab, $record_data, $log_data = array() ) {
		$data = array();

		$response = $this->create_record( $module, $tab, $record_data, $log_data );

		if ( $this->is_success( $response ) ) {
			$response['data']['mwb-event'] = 'Create';

			$data = $response['data'];
		} else {
			$data = $response;
		}

		return $data;
	}

	/**
	 * Create of update record data.
	 *
	 * @param  string $module     Module name.
	 * @param  string $tab        Sheet tab.
	 * @param  array  $record_data Module data.
	 * @param  array  $log_data   Data to create log.
	 *
	 * @return array               Response data.
	 */
	private function create_record( $module, $tab, $record_data, $log_data ) {

		if ( empty( $module ) || empty( $record_data ) ) {
			return;
		}

		$event          = 'Create record';
		$this->base_url = $this->base_sheets_url();
		$extra_params   = array(
			'data_type' => ! empty( $record_data['data_type'] ) ? $record_data['data_type'] : 'RAW',
			'row_type'  => ! empty( $record_data['row_type'] ) ? $record_data['row_type'] : 'INSERT_ROWS',
		);
		unset( $record_data['data_type'] );
		unset( $record_data['row_type'] );

		$query_args = ':append?valueInputOption=' . $extra_params['data_type'] . '&insertDataOption=' . $extra_params['row_type'];
		$endpoint   = 'v4/spreadsheets/' . $module . '/values/' . urlencode( "'" . $tab . "'!A:A" ) . $query_args; // phpcs:ignore
		$request    = array(
			'values'         => array( $record_data ),
			'majorDimension' => 'ROWS',
		);
		$request_data = wp_json_encode( $request );
		$headers      = $this->get_auth_header();
		$response     = $this->post( $endpoint, $request_data, $headers );

		if ( $this->if_access_token_expired( $response ) ) {
			$headers  = $this->get_auth_header();
			$response = $this->post( $endpoint, $request_data, $headers );
		}

		$this->log_request_in_db( $event, $module, $request_data, $response, $log_data );

		return $response;

	}

	/**
	 * Fetch object id of created record.
	 *
	 * @param  array $response Api response.
	 * @return string           Id of object.
	 */
	public function get_object_id_from_response( $response ) {
		$id = '-';
		if ( isset( $response['data'] ) && isset( $response['data']['spreadsheetId'] ) ) {
			$data = $response['data']['spreadsheetId'];
				return $data;
		}
		return $id;
	}

	/**
	 * Log request and response in database.
	 *
	 * @param  string $event       Event of which data is synced.
	 * @param  string $object  Update or create crm object.
	 * @param  array  $request     Request data.
	 * @param  array  $response    Api response.
	 * @param  array  $log_data    Extra data to be logged.
	 */
	public function log_request_in_db( $event, $object, $request, $response, $log_data ) {

		$feed_class  = 'Mwb_Cf7_Integration_' . self::$crm_prefix . '_Feed_Module';
		$feed_module = $feed_class::get_instance();

		$feed    = ! empty( $log_data['feed_name'] ) ? $log_data['feed_name'] : false;
		$feed_id = ! empty( $log_data['feed_id'] ) ? $log_data['feed_id'] : false;
		$event   = ! empty( $event ) ? $event : false;

		$gsheet_id = $this->get_object_id_from_response( $response );
		$request   = serialize( $request ); // phpcs:ignore
		$response  = serialize( $response ); // phpcs:ignore
		$gsheet    = $feed_module->get_google_sheet( $object );
		$log       = array(
			'event'    => $event,
			'feed_id'  => $feed_id,
			'feed'     => $feed,
			'request'  => $request,
			'response' => $response,
			Mwb_Cf7_Integration_With_Gsheets::get_current_crm( 'slug' ) . '_id' => $gsheet_id,
			Mwb_Cf7_Integration_With_Gsheets::get_current_crm( 'slug' ) . '_object' => $gsheet,
			'time'     => time(),
		);

		// Insert log.
		$this->insert_log_data( $log );
	}

	/**
	 * Check if resposne has success code.
	 *
	 * @param  array $response  Response data.
	 *
	 * @since 1.0.0
	 *
	 * @return boolean true|false.
	 */
	public function is_success( $response ) {
		if ( isset( $response['code'] ) ) {
			return in_array( $response['code'], array( 200, 201, 204, 202 ) ); //phpcs:ignore
		}
		return false;
	}

	/**
	 * Insert data into database.
	 *
	 * @param  array $log_data Log data.
	 */
	public function insert_log_data( $log_data ) {

		$connect         = 'Mwb_Cf7_Integration_Connect_' . Mwb_Cf7_Integration_With_Gsheets::get_current_crm() . '_Framework';
		$connect_manager = $connect::get_instance();

		if ( 'yes' != $connect_manager->get_settings_details( 'logs' ) ) { // phpcs:ignore
			return;
		}
		global $wpdb;
		$table = $wpdb->prefix . 'mwb_' . Mwb_Cf7_Integration_With_Gsheets::get_current_crm( 'slug' ) . '_cf7_log';
		$wpdb->insert( $table, $log_data ); // phpcs:ignore

	}


	// End of class.
}
