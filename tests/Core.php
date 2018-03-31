<?php

use PHPUnit\Framework\TestCase;
use PosterApiLibrary\PosterApi;


final class Core extends TestCase
{
    public function test_MakeApiRequest() {
        PosterAPI::init([
            'account_name' => 'api-demo',
            'access_token' => '4164553abf6a031302898da7800b59fb',
        ]);
        $result = (object)PosterAPI::instance()->makeApiRequest('settings.getAllSettings', 'get');

        $this->assertEquals($result->response->COMPANY_ID, 'api-demo');
    }

    public function test_Settings_GetAllSettings()
    {
        PosterAPI::init([
            'account_name' => 'api-demo',
            'access_token' => '4164553abf6a031302898da7800b59fb',
        ]);
        $result = (object)PosterAPI::instance()->settings()->getAllSettings();

        $this->assertEquals($result->response->COMPANY_ID, 'api-demo');
    }

    public function test_GetOauthUrl() {
        PosterAPI::init([
            'application_id' => 'aaaaa',
            'application_secret' => 'poster-the-best',
            'redirect_uri' => 'http://redirect.com',
        ]);

        $oAuthUrl = PosterAPI::instance()->auth()->getOauthUrl();
        $this->assertEquals(
            "https://joinposter.com/api/auth?response_type=code&client_id=aaaaa&redirect_uri=http%3A%2F%2Fredirect.com",
            $oAuthUrl
        );
    }

    public function test_Application_SetEntityExtras() {
        PosterAPI::init([
            'account_name' => 'api-demo',
            'access_token' => '4164553abf6a031302898da7800b59fb',
        ]);
        $result = (object)PosterAPI::instance()->application()->setEntityExtras([
            'entity_type' => 'settings',
            'extras' => [
                'param' => 'value'
            ]
        ]);

        $this->assertEquals($result->response, true);
    }
}