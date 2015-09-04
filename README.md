# posterapi-php-binding

Example of using with access_token
-------------

```php
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