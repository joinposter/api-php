<?php
/**
 * Singleton-style wrapper around PosterAPICore
 *
 * Unless you need multiple PosterAPICore instances in the same project, use this.
 */
class PosterAPI {
	/** @var PosterAPICore */
	public static $instance = null;

	public static function init($config = array()) {

		// Use env vars for configuration, if set
		if (isset($_ENV['POSTER_APPLICATION_ID']) && !isset($config['application_id'])) {
			$config['application_id'] = $_ENV['POSTER_APPLICATION_ID'];
		}
		if (isset($_ENV['POSTER_APPLICATION_SECRET']) && !isset($config['application_secret'])) {
			$config['application_secret'] = $_ENV['POSTER_APPLICATION_SECRET'];
		}
		if (isset($_ENV['POSTER_REDIRECT_URI']) && !isset($config['redirect_uri'])) {
			$config['redirect_uri'] = $_ENV['POSTER_REDIRECT_URI'];
		}

		if (isset($_ENV['POSTER_ACCOUNT_NAME']) && !isset($config['account_name'])) {
			$config['account_name'] = $_ENV['POSTER_ACCOUNT_NAME'];
		}
		if (isset($_ENV['POSTER_ACCESS_TOKEN']) && !isset($config['access_token'])) {
			$config['access_token'] = $_ENV['POSTER_ACCESS_TOKEN'];
		}

		self::$instance = new PosterAPICore($config);
	}

    public static function __callStatic($name, $arguments) {
    	return call_user_func_array(array(self::$instance, $name), $arguments); 
    }
}


class PosterAPICore {
	const VERSION = "0.1";

	// required without access_token
	public $application_id = '';
	public $application_secret = '';
	public $redirect_uri = '';

	// required with access_token
	public $account_name = '';
	public $access_token = '';

	// optional / defaults
	public $base_api_url = 'https://joinposter.com/api/';
	public $account_api_url = 'https://{account_name}.joinposter.com/api/';
	public $user_agent = '';

	private $config_keys = array('application_id', 'application_secret', 'redirect_uri', 
		'account_name', 'access_token', 'user_agent', 'base_api_url', 'account_api_url');

	private $curl_ipresolve_supported;
	private $last_request_http_code;

	public function __construct($config) {

		foreach ($this->config_keys as $key) {
			if (isset($config[$key])) {
				$this->$key = $config[$key];
			}
		}

		if (! $this->account_name) {
			$this->access_token = '';
		}

		if (! $this->application_secret || ! $this->redirect_uri) {
			$this->application_id = '';
		}

		if ( ! $this->access_token && ! $this->application_id) {
			throw new Exception('Missing access token and application parameters');
		}

		if ( ! $this->user_agent) {
			throw new Exception('Missing user agent');
		}

		// PHP 5.3.0
		$this->curl_ipresolve_supported = defined('CURLOPT_IPRESOLVE');
	}

	public function get_last_request_http_code() {
		return $this->last_request_http_code;
	}

	private function send_request($url, $type = 'get', $params = '', $json = false)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

		if ($type == 'post') {
			curl_setopt($ch, CURLOPT_POST, true);

			if ($json) {
				$params = json_encode($params);

				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						'Content-Type: application/json',
						'Content-Length: ' . strlen($params))
				);
			}
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		}

		if ($this->curl_ipresolve_supported) {
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		}

		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);
		$result = curl_exec($ch);
		$this->last_request_http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		return $result;
	}

}