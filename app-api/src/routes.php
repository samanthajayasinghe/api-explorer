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
$app->get('/connect', function (Request $request, Response $response) use ($app) {

    $authorizationUrl = $this->get('apiService')->getApiAdapter()->getAuthorizationUrl();

    return $response->withHeader('Location', $authorizationUrl);
});

$app->get('/callback', function (Request $request, Response $response) use ($app) {

    $token = $this->get('apiService')->getApiAdapter()->getAccessToken('authorization_code', [
        'code' => $_GET['code'],
    ]);

    return $response->withHeader('Location',
        'http://cl-tech.local/app-web/?companyId=' . $_GET['realmId'] . '&token=' . $token->getToken());
});

$app->get('/endpoints', function (Request $request, Response $response) {

    return $response->withJson($this->get('endpointService')->getEndPoints());
});

$app->post('/read', function ($request, $response) {
    $httpRequest = new HTTPRequest(
        $request->getParam('endpoint'),
        $request->getParam('form-data')
    );
    $httpRequest->setToken($request->getParam('token'));
    $httpResponse = $this->get('apiService')->executeHTTPRequest($httpRequest, 'get');

    return $response->withJson($httpResponse->getResult());
});
