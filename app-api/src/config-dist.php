<?php
/**
 * @author Samantha Jayasinghe
 *
 */

$config = new stdClass();

$config->appAPIHost = '{http://your app api path}'; //point to app-api/public/index.php
$config->appWebHost = '{http://your app web path}'; //point to app-web/index.html

$config->clientId = '';//Your Id here
$config->clientSecret = '';//Your client Secret here
$config->redirectUri = $config->appAPIHost.'/callback'; //frontend web path here
$config->urlAuthorize = 'https://appcenter.intuit.com/connect/oauth2';
$config->urlAccessToken = 'https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer';
$config->scopes = ['com.intuit.quickbooks.accounting'] ;

$config->secretKey = 'This is my secret key';
$config->secretIv = 'This is my secret iv';

return [
    'settings' => [
        'displayErrorDetails' => true
    ],
];
