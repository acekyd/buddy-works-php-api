# Buddy Works APIs PHP SDK
[![Build Status](https://travis-ci.org/buddy-works/buddy-works-php-api.svg?branch=master)](https://travis-ci.org/buddy-works/buddy-works-php-api)

Official PHP client library for [Buddy Build Server with CI](https://buddy.works).

## Installation

This library is distributed on `packagist` and is working with `composer`. In order to add it as a dependency, run the following command:

``` sh
composer require buddy-works/buddy-works-php-api
```

> **Note:** This version of the Buddy SDK for PHP requires PHP 5.5 or greater.
 
## Usage of OAUTH

First you need to add application in your [Buddy ID](https://app.buddy.works/my-apps).

You will then obtain clientId & clientSecret to execute this code:

```php
$buddy = new Buddy\Buddy([
  'clientId' => 'your-client-id',
  'clientSecret' => 'your-client-secret'
]);
try {
  $url = $buddy->getOAuth()->getAuthorizeUrl([
    Buddy\BuddyOAuth::SCOPE_MANAGE_EMAILS
  ], 'state', 'redirectUrl');  
} catch(Buddy\Exceptions\BuddySDKException $e) {
  echo 'Buddy SDK return an error: ' . $e->getMessage();
  exit;
}
```

scopes is array of strings - [help](https://buddy.works/api/reference/getting-started/oauth#supported-scopes)

state should be an unguessable random string. It is used to protect against cross-site request forgery attacks.

redirectUrl is optional [more](https://buddy.works/api/reference/getting-started/oauth#web-application-flow)

You should redirect your user to returned url, after authorization he should get back to your page (configured in application or passed to the method).

After that you should call next method to acquire access token

```php
$buddy = new Buddy\Buddy([
  'clientId' => 'your-client-id',
  'clientSecret' => 'your-client-secret'
]);
try {
  $auth = $buddy->getOAuth()->getAccessToken('state');
} catch(Buddy\Exceptions\BuddyResponseException $e) {
  echo 'Buddy API return an error: ' . $e->getMessage();
  exit;
} catch(Buddy\Exceptions\BuddySDKException $e) {
  echo 'Buddy SDK return an error: ' . $e->getMessage();
  exit;
}
$accessToken = $auth->getAccessToken();
```

State should be the same as in getAuthorizeUrl method. 

## Usage of direct tokens

You can also use [api tokens](https://app.buddy.works/api-tokens).

That functionality is provided for testing purpose and will only work for individual tokens generated per user.

All requests will be called in behalf of the user whom provided token 

## Apis

For detailed info check [our documentation](https://buddy.works/api/reference/getting-started/overview)

To start using api you should pass to Buddy constructor acquired access token.

```php
$buddy = new Buddy\Buddy([
  'accessToken' => 'your access token'
]);
```

From there every method called from this instance of Buddy will be called on behalf of user for which access token was generated.

(You can also pass access tokens as last parameter to every api method)
 
### Workspaces

Get workspaces
```php
try {
    $resp = $buddy->getApiWorkspaces()->getWorkspaces([$accessToken]);
    var_dump($resp);
    exit;
} catch (Buddy\Exceptions\BuddyResponseException $e) {
    echo $e->getMessage();
    exit;
} catch (Buddy\Exceptions\BuddySDKException $e) {
    echo $e->getMessage();
    exit;
}
```

Get workspace
```php
try {
    $resp = $buddy->getApiWorkspaces()->getWorkspace($domain, [$accessToken]);
    var_dump($resp);
    exit;
} catch (Buddy\Exceptions\BuddyResponseException $e) {
    echo $e->getMessage();
    exit;
} catch (Buddy\Exceptions\BuddySDKException $e) {
    echo $e->getMessage();
    exit;
}
```

For more examples check [here](https://github.com/buddy-works/buddy-works-php-api/blob/master/examples)

## Tests

Add 2 direct tokens in your Buddy profile:
 - one with all scopes
 - second only with USER INFO scope
 
Add application & get client id, client secret

Copy file tests/env.php.dist -> tests/env.php and fill up variables

Run command:
``` sh
./vendor/bin/phpunit
```
> **Note:** It will test on provided account (add projects ie.)

## License

Please see the [license file](https://github.com/buddy-works/buddy-works-php-api/blob/master/LICENSE) for more information.
