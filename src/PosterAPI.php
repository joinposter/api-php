<?php
namespace poster\api_php_binding;

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
	const VERSION = "0.2.1";

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
	public $response_format = 'json';

	private $config_keys = array('application_id', 'application_secret', 'redirect_uri', 'account_name', 
		'access_token', 'user_agent', 'base_api_url', 'account_api_url', 'response_format');

	private $methods = array('get', 'create', 'update', 'add', 'edit', 'set', 'delete', 'change', 
		'remove', 'close');


	private $curl_ipresolve_supported;
	private $last_request_http_code;

	public function __construct($config) {

		foreach ($this->config_keys as $key) {
			if (isset($config[$key])) {
				$this->$key = $config[$key];
			}
		}

		if ( ! $this->account_name) {
			$this->access_token = '';
		}

		if ( ! $this->application_secret || ! $this->redirect_uri) {
			$this->application_id = '';
		}

		if ( ! $this->access_token && ! $this->application_id) {
			throw new \Exception('Missing access token and application parameters');
		}

		if ( ! $this->user_agent) {
			throw new \Exception('Missing user agent');
		}

		// PHP 5.3.0
		$this->curl_ipresolve_supported = defined('CURLOPT_IPRESOLVE');
	}

	public function get_oauth_url() {

		if ( ! $this->application_id) {
			throw new \Exception('Missing application parameters');
		}

		$get_params = array(
			'response_type' => 'code',
			'client_id' => $this->application_id,
			'redirect_uri' => $this->redirect_uri,
		); 

		return $this->get_api_url() . 'auth?' . $this->prepare_get_params($get_params);
	}

	public function start_oauth() {
		header('Location: ' . $this->get_oauth_url());
		exit;
	}

	public function get_oauth_token($account_name, $code) {

		if ( ! $this->application_id) {
			throw new \Exception('Missing application parameters');
		}

		$this->set_account_name($account_name);

		$request_url = $this->get_api_url() . 'auth/access_token';

		$post_params = array(
			'client_id' => $this->application_id,
			'client_secret' => $this->application_secret,
			'grant_type' => 'authorization_code',
			'redirect_uri' => $this->redirect_uri,
			'code' => $code,
		); 

		$response = $this->send_request($request_url, 'post', $post_params);
		$response = json_decode($response);

		if ( ! isset($response->access_token) || ! $response->access_token) {
			throw new \Exception('Authorization fail');
		}

		$this->set_access_token($response->access_token);

    	return $response->access_token;
	}

    public function __call($name, $arguments) {

    	if ( ! $this->access_token) {
			throw new \Exception('Missing access token');
    	}

    	if ( ! $this->account_name) {
			throw new \Exception('Missing account name');
    	}

    	// second argument is value for response_format 
    	if (isset($arguments[1])) {
			$this->response_format = $arguments[1];
    	}

    	if ( ! in_array($this->response_format, array('xml', 'json'))) {
			throw new \Exception('Incorrect response format');
    	}

    	$name = explode('_', $name);

    	if (count($name) != 2) {
			throw new \Exception('Incorrect api method name');
    	}

    	$request_api_method = implode('.', $name);

    	$name = strtolower($name[1]);
    	$api_method = '';
    	foreach ($this->methods as $method) {
    		$len = strlen($method);
    		if (substr($name, 0, $len) == $method) {
    			$api_method = $method;
    		}
    	}

    	if ($api_method == '') {
			throw new \Exception('Incorrect api method');
    	}

    	$request_type = ($api_method == 'get')? 'get' : 'post';

		$get_params = array(
			'format' => $this->response_format,
			'token' => $this->access_token
		); 

		$arguments = (isset($arguments[0]))? $arguments[0] : array();

		if ($request_type == 'get') {
			$get_params = array_merge($get_params, $arguments);
			$post_params = '';
		} else {
			$post_params = $arguments;
		}

		$request_url = $this->get_api_url() . 
			$request_api_method . '?' . 
			$this->prepare_get_params($get_params);

		$response = $this->send_request($request_url, $request_type, $post_params);

		if ($this->response_format == 'json') {
			$response = json_decode($response);
		}

    	return $response;
    }

	public function set_access_token($access_token) {
		$this->access_token = $access_token;
	}

	public function set_account_name($account_name) {
		$this->account_name = $account_name;
	}

	public function set_response_format($response_format) {
		$this->response_format = $response_format;
	}

	private function get_api_url() {
		return ($this->account_name)? 
			str_replace('{account_name}', $this->account_name, $this->account_api_url) :
			$this->base_api_url;
	}

	public function get_last_request_http_code() {
		return $this->last_request_http_code;
	}

	private function prepare_get_params($params) {

		$result = array();

		foreach ($params as $key => $value) {
			$result[] = $key . '=' . urlencode($value);
		}

		return implode('&', $result);
	}

	private function send_request($url, $type = 'get', $params = '', $json = false) {
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