<?php

namespace poster\src;


class PosterApiCore
{
    const VERSION = "1.0.1";

    // required without access_token
    public $application_id;
    public $application_secret;
    public $redirect_uri;

    // required with access_token
    public $account_name;
    public $access_token;

    // optional / defaults
    public $user_agent = 'Poster PHP API Library';
    public $domain = 'joinposter.com';
    public $protocol = 'https';
    public $response_format = 'json';
    public $need_sign = false;

    // helpers
    public $base_api_url;
    public $account_api_url;

    public $curl_ipresolve_supported;
    public $last_request_http_code;


    public function __construct($config)
    {
        foreach ($config as $key => $value) {
            $this->$key = $value;
        }

        $this->base_api_url = $this->protocol . '://' . $this->domain . '/api/';
        $this->account_api_url = $this->protocol . '://{account_name}.' . $this->domain . '/api/';

        if (!$this->account_name) {
            $this->access_token = '';
        }

        if (!$this->application_secret || !$this->redirect_uri) {
            $this->application_id = '';
        }

        if (!$this->access_token && !$this->application_id) {
            throw new \Exception('Missing access token or application_id');
        }
        if (!$this->access_token && !$this->application_secret) {
            throw new \Exception('Missing access token or application_secret');
        }
        if (!$this->access_token && !$this->redirect_uri) {
            throw new \Exception('Missing access token or redirect_uri');
        }

        if (!$this->user_agent) {
            throw new \Exception('Missing user agent');
        }

        // PHP 5.3.0
        $this->curl_ipresolve_supported = defined('CURLOPT_IPRESOLVE');
    }

    /**
     * Makes request to Poster
     *
     * @param string $url
     * @param string $type
     * @param string $params
     * @param bool $json
     * @return mixed
     */
    public function sendRequest($url, $type = 'get', $params = '', $json = false, $headers = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


        if (count($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        if ($type == 'post') {
            curl_setopt($ch, CURLOPT_POST, true);

            if ($json) {
                $params = json_encode($params);

                curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($headers, [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($params)
                ]));
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }

        if ($this->curl_ipresolve_supported) {
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        }

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60 * 20);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);
        $result = curl_exec($ch);
        $this->last_request_http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $result;
    }

    /**
     * Makes request to poster API method
     *
     * @param string $method – method name, e.g. menu.getProducts
     * @param string $type – GET or POST
     * @param string $params
     * @param boolean $needSign
     * @return mixed
     */
    public function makeApiRequest($method, $type = 'get', $params = '', $needSign = false)
    {
        $getParams = [
            'format' => $this->response_format,
        ];

        if ($this->access_token) {
            $getParams['token'] = $this->access_token;
        }

        $arguments = $params ? $params : [];

        if ($needSign) {
            $arguments['application_id'] = $this->application_id;
            $arguments['sign_time'] = time();
            $arguments['sign'] = md5(
                $arguments['application_id'] . ';' .
                $arguments['sign_time'] . ';' .
                $this->application_secret
            );
        }

        if ($type == 'get') {
            $getParams = array_merge($getParams, $arguments);
            $postParams = '';
        } else {
            $postParams = $arguments;
        }

        $request_url = self::getApiUrl() . $method . '?' . self::prepareGetParams($getParams);
        $response = self::sendRequest($request_url, $type, $postParams, true);

        return json_decode($response);
    }


    /** API departments */

    public function auth()
    {
        return new AuthAPI($this);
    }

    public function application()
    {
        return new ApplicationAPI($this);
    }

    public function access()
    {
        return new AccessAPI($this);
    }

    public function clients()
    {
        return new ClientsAPI($this);
    }

    public function dash()
    {
        return new DashAPI($this);
    }

    public function finance()
    {
        return new FinanceAPI($this);
    }

    public function incomingOrders()
    {
        return new IncomingOrdersAPI($this);
    }

    public function menu()
    {
        return new MenuAPI($this);
    }

    public function payments()
    {
        return new PaymentsAPI($this);
    }

    public function settings()
    {
        return new SettingsAPI($this);
    }

    public function spots()
    {
        return new SpotsAPI($this);
    }

    public function storage()
    {
        return new StorageAPI($this);
    }

    public function transactions()
    {
        return new TransactionsAPI($this);
    }


    /** Setters and Getters  **/

    public function setAccessToken($accessToken)
    {
        $this->access_token = $accessToken;
    }

    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function getAccountName()
    {
        return $this->account_name;
    }

    public function setAccountName($accountName)
    {
        $this->account_name = $accountName;
    }

    public function setResponseFormat($responseFormat)
    {
        $this->response_format = $responseFormat;
    }

    public function getLastRequestHttpCode()
    {
        return $this->last_request_http_code;
    }

    public function getApplicationId()
    {
        return $this->application_id;
    }

    public function getApplicationSecret()
    {
        return $this->application_secret;
    }

    public function getRedirectUri()
    {
        return $this->redirect_uri;
    }

    public function getApiUrl()
    {
        if ($this->account_name) {
            return str_replace('{account_name}', $this->account_name, $this->account_api_url);
        } else {
            return $this->base_api_url;
        }
    }

    public function prepareGetParams($params)
    {
        $result = [];

        foreach ($params as $key => $value) {
            $result[] = $key . '=' . urlencode($value);
        }

        return implode('&', $result);
    }
}