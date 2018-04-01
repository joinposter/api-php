<?php

namespace poster\src;


class AuthAPI
{
    public $api;

    public function __construct(PosterAPICore $params)
    {
        $this->api = $params;
    }

    /**
     * Returns URL for 1st step of oAuth
     *
     * @return string
     * @throws \Exception
     */
    public function getOauthUrl()
    {
        if (!$this->api->getApplicationId()) {
            throw new \Exception('Missing application parameters');
        }

        $get_params = [
            'response_type' => 'code',
            'client_id' => $this->api->getApplicationId(),
            'redirect_uri' => $this->api->getRedirectUri(),
        ];

        return $this->api->getApiUrl() . 'auth?' . $this->api->prepareGetParams($get_params);
    }

    /**
     * Authorises user with oAuth code, sets token and gets result
     *
     * @param string $account_name – poster subdomain
     * @param string $code – code which you received after redirect
     * @return object apiResponse
     * @throws \Exception
     */
    public function getOauthToken($account_name, $code)
    {
        if (!$this->api->getApplicationId()) {
            throw new \Exception('Missing application parameters');
        }

        $this->api->setAccountName($account_name);

        $request_url = $this->api->getApiUrl() . 'auth/access_token';
        $post_params = [
            'client_id' => $this->api->getApplicationId(),
            'client_secret' => $this->api->getApplicationSecret(),
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->api->getRedirectUri(),
            'code' => $code,
        ];

        $response = $this->api->sendRequest($request_url, 'post', $post_params);
        $response = (object)json_decode($response);

        if (isset($response->access_token) && $response->access_token) {
            $this->api->setAccessToken($response->access_token);
        }

        return $response;
    }

    /**
     * Checks webhook secret
     *
     * @param $webHookBody
     * @return bool true if verified, false if corrupted
     */
    public function verifyWebHook($webHookBody)
    {
        // Приводим к нужному формату входящие данные
        $postData = json_decode($webHookBody, true);

        $verify_original = $postData['verify'];
        unset($postData['verify']);

        $verify = [
            $postData['account'],
            $postData['object'],
            $postData['object_id'],
            $postData['action'],
        ];

        // Если есть дополнительные параметры
        if (isset($postData['data'])) {
            $verify[] = $postData['data'];
        }
        $verify[] = $postData['time'];
        $verify[] = $this->api->getApplicationSecret();

        // Создаём строку для верификации запроса клиентом
        $verify = md5(implode(';', $verify));

        return $verify == $verify_original;
    }
}