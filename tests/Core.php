<?php

use PHPUnit\Framework\TestCase;
use poster\src\PosterApi;


final class Core extends TestCase
{
    public function test_MakeApiRequest() {
        PosterApi::init([
            'account_name' => 'api-demo',
            'access_token' => '4164553abf6a031302898da7800b59fb',
        ]);

        $result = (object)PosterAPI::makeApiRequest('settings.getAllSettings', 'get');

        $this->assertEquals($result->response->COMPANY_ID, 'api-demo');
    }

    public function test_Settings_GetAllSettings()
    {
        PosterApi::init([
            'account_name' => 'api-demo',
            'access_token' => '4164553abf6a031302898da7800b59fb',
        ]);
        $result = (object)PosterAPI::settings()->getAllSettings();

        $this->assertEquals($result->response->COMPANY_ID, 'api-demo');
    }

    public function test_GetOauthUrl() {
        PosterApi::init([
            'application_id' => 'aaaaa',
            'application_secret' => 'poster-the-best',
            'redirect_uri' => 'http://redirect.com',
        ]);

        $oAuthUrl = PosterAPI::auth()->getOauthUrl();
        $this->assertEquals(
            "https://joinposter.com/api/auth?response_type=code&client_id=aaaaa&redirect_uri=http%3A%2F%2Fredirect.com",
            $oAuthUrl
        );
    }

    public function test_Application_SetEntityExtras() {
        PosterApi::init([
            'account_name' => 'api-demo',
            'access_token' => '4164553abf6a031302898da7800b59fb',
        ]);
        $result = (object)PosterAPI::application()->setEntityExtras([
            'entity_type' => 'settings',
            'extras' => [
                'param' => 'value'
            ]
        ]);

        $this->assertEquals($result->response, true);
    }
}