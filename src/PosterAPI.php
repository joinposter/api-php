<?php

namespace PosterApiLibrary;


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

    public static function instance()
    {
        return self::$instance;
    }
}