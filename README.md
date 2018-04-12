# PosterApi Library for PHP

PHP library which makes Poster API using smooth as glass. 
You can use suggestions to api methods names and don\`t have to worry about request type.
Just navigate through API sections like `settings` or `menu`.


### Installation 

```bash
composer require poster/api
```


### Example of making API calls 

It's convenient to use singleton class `PosterApi`. 
All you need to is initialize class with user credentials and then you can call Poster API methods anywhere in your project   


```php
<?php

use poster\src\PosterApi;

// Setting up account and token for requests 
PosterApi::init([
    'account_name' => 'demo',
    'access_token' => '4164553abf6a031302898da7800b59fb',
]);

// Reading settings
$result = (object)PosterApi::settings()->getAllSettings(); 
var_dump($result);

// Setting up extras for account 
$result = (object)PosterApi::application()->setEntityExtras([
    'entity_type' => 'settings',
    'extras' => [
        'synced' => true
    ]
]);
var_dump($result);

```


### Example of OAuth


1. Generate url and redirect user to it to start oAuth 

```php
<?php

use poster\src\PosterApi;

PosterApi::init([
    'application_id' => 1, // Your application id (client_id) 
    'application_secret' => '1362900b6c441dd0f219bd0974c7e2b8', // secret
    'redirect_uri' => 'http://example.com/poster/auth',
]);

$oAuthUrl = PosterApi::auth()->getOauthUrl();

// Redirect user to this url to start authorization
http_redirect($oAuthUrl);
```


2. Catch user redirect to the `redirect_uri` which you used in previous step and get access token 

```php
<?php 

use poster\src\PosterApi;

$result = (object)PosterApi::auth()->getOauthToken($_GET['account'], $_GET['code']);

if (empty($result->access_token)) {
    echo "Poster auth error";
	var_dump($result);
	die;
}

// In case of successful auth, token and account name would be placed into config automatically
$settings = PosterApi::settings()->getAllSettings();
var_dump($settings);
```
