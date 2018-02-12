<?php
/**
 * @author Samantha Jayasinghe
 *
 */

use Slim\Http\Request;
use Slim\Http\Response;
// Routes
$app->get('/', function (Request $request, Response $response, array $args) {
    // Render index view
    print('test sample app');
});
$app->get('/connect', function (Request $request, Response $response) use ($app){

    $authorizationUrl = $this->get('oauthProvider')->getAuthorizationUrl();
    return $response->withHeader('Location', $authorizationUrl);
});

$app->get('/callback', function (Request $request, Response $response) use ($app){

    $token = $this->get('oauthProvider')->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    print($token->getToken());
});
