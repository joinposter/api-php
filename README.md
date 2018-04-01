# PosterAPI Library for PHP

Example of using with only access_token
-------------

```php
<?php
require_once 'PosterAPI.php';

$config = array(
	'account_name' => 'demo',
	'access_token' => '745d516e1b9320ed85b84d5bfda14148',

	'user_agent' => 'Poster (http://joinposter.com)',
);

PosterAPI::init($config);

$params = [];

echo '<pre>';
var_dump(PosterAPI::dash_getAnalytics($params));
echo '</pre>';
```
Example of OAuth using
-------------

```php
<?php

$account_name = '';
$access_token = '';

require_once 'PosterAPI.php';

$config = array(
	'application_id' => 1,
	'application_secret' => '1362900b6c441dd0f219bd0974c7e2b8',
	'redirect_uri' => 'http://my_domain.com/test_api.php',

	'account_name' => $account_name,
	'access_token' => $access_token,

	'user_agent' => 'Poster (http://joinposter.com)',
);

PosterAPI::init($config);

if ( ! $access_token) {
	if (isset ($_GET['code']) && $_GET['code'] != '') {

		$account_name = $_GET['account'];
		$access_token = PosterAPI::get_oauth_token($account_name, $_GET['code']);

	} else {
		PosterAPI::start_oauth();
	}
}

$params = [];

echo "<pre>";
echo "account_name = " . $account_name . "\n"; 
echo "access_token = " . $access_token . "\n\n"; 

var_dump(PosterAPI::dash_getAnalytics($params));
echo "</pre>";


