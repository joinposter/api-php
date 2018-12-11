<?php

namespace poster\src;


/**
 * Singleton-style wrapper around PosterAPICore
 *
 * Unless you need multiple PosterAPICore instances in the same project, use this.
 */
class PosterApi
{
    /**
     * @var PosterApiCore singleton instance
     */
    private static $instance = null;

    /**
     * Creates instance of singleton
     *
     * @param array $config [
     * @var string $application_id
     * @var string $application_secret
     * @var string $redirect_uri
     * @var string $account_name
     * @var string $access_token
     * @var string $protocol default https
     * @var string $domain default joinposter.com
     * ]
     *
     * @throws \Exception
     */
    public static function init($config = [])
    {
        // Use env vars for configuration, if set
        if (isset($_ENV['POSTER_APPLICATION_ID']) && empty($config['application_id'])) {
            $config['application_id'] = $_ENV['POSTER_APPLICATION_ID'];
        }

        if (isset($_ENV['POSTER_APPLICATION_SECRET']) && empty($config['application_secret'])) {
            $config['application_secret'] = $_ENV['POSTER_APPLICATION_SECRET'];
        }
        if (isset($_ENV['POSTER_REDIRECT_URI']) && empty($config['redirect_uri'])) {
            $config['redirect_uri'] = $_ENV['POSTER_REDIRECT_URI'];
        }

        if (isset($_ENV['POSTER_ACCOUNT_NAME']) && empty($config['account_name'])) {
            $config['account_name'] = $_ENV['POSTER_ACCOUNT_NAME'];
        }

        if (isset($_ENV['POSTER_ACCESS_TOKEN']) && empty($config['access_token'])) {
            $config['access_token'] = $_ENV['POSTER_ACCESS_TOKEN'];
        }

        self::$instance = new PosterApiCore($config);
    }

    public static function singleton()
    {
        return self::$instance;
    }


    /** Core methods duplicate for your convenience ;) */

    /** API departments */

    public static function auth()
    {
        return self::singleton()->auth();
    }

    public static function application()
    {
        return self::singleton()->application();
    }

    public static function access()
    {
        return self::singleton()->access();
    }

    public static function clients()
    {
        return self::singleton()->clients();
    }

    public static function dash()
    {
        return self::singleton()->dash();
    }

    public static function finance()
    {
        return self::singleton()->finance();
    }

    public static function incomingOrders()
    {
        return self::singleton()->incomingOrders();
    }

    public static function menu()
    {
        return self::singleton()->menu();
    }

    public static function payments()
    {
        return self::singleton()->payments();
    }

    public static function settings()
    {
        return self::singleton()->settings();
    }

    public static function spots()
    {
        return self::singleton()->spots();
    }

    public static function storage()
    {
        return self::singleton()->storage();
    }

    public static function transactions()
    {
        return self::singleton()->transactions();
    }


    /** Setters and Getters  **/

    public static function setAccessToken($accessToken)
    {
        self::singleton()->setAccessToken($accessToken);
    }

    public static function setAccountName($accountName)
    {
        self::singleton()->setAccountName($accountName);
    }

    public static function getAccessToken()
    {
        return self::singleton()->getAccessToken();
    }

    public static function getAccountName()
    {
        return self::singleton()->getAccountName();
    }

    public static function setResponseFormat($responseFormat)
    {
        self::singleton()->setResponseFormat($responseFormat);
    }

    public static function getLastRequestHttpCode()
    {
        return self::singleton()->getLastRequestHttpCode();
    }

    public static function getApplicationId()
    {
        return self::singleton()->getApplicationId();
    }

    public static function getApplicationSecret()
    {
        return self::singleton()->getApplicationSecret();
    }

    public static function getRedirectUri()
    {
        return self::singleton()->getRedirectUri();
    }

    public static function getApiUrl()
    {
        return self::singleton()->getApiUrl();
    }

    public static function sendRequest($url, $type = 'get', $params = '', $json = false, $headers = [])
    {
        return self::singleton()->sendRequest($url, $type, $params, $json, $headers);
    }

    public static function makeApiRequest($method, $type = 'get', $params = '', $needSign = false)
    {
        return self::singleton()->makeApiRequest($method, $type, $params, $needSign);
    }
}