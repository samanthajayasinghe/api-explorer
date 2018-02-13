<?php
/**
 * @author Samantha Jayasinghe
 *
 */

use Slim\Http\Request;
use Slim\Http\Response;
use APIExplorer\Client\HTTPRequest;

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

    return $response->withHeader('Location', 'http://cl-tech.local/app-web/?companyId='.$_GET['realmId'].'&token='.$token->getToken());
});

$app->get('/endpoints', function (Request $request, Response $response){

    return $response->withJson($this->get('endpointService')->getEndPoints());
});

$app->post('/read', function($request, $response){
    $token = $request->getParam('token');
    $companyId = $request->getParam('companyId');
    $httpRequest = new HTTPRequest('company/'.$companyId.'/query?query=Select * From Account', []);
    $httpRequest->setApiVersion('v3');
    $httpRequest->setToken($token);
    $httpResponse = $this->get('httpClient')->get($httpRequest);
    return $response->withJson($httpResponse->getResult());
});
