<?php
/**
 * @author Samantha Jayasinghe
 *
 */

use APIExplorer\Client\Client;
use \League\OAuth2\Client\Provider\GenericProvider;
use APIExplorer\Service\EndPointService;

// DIC configuration
$container = $app->getContainer();

$container['oauthProvider'] = new GenericProvider([
    'clientId' => $config->clientId,
    'clientSecret' => $config->clientSecret,
    'redirectUri' => $config->redirectUri,
    'urlAuthorize' => $config->urlAuthorize,
    'urlAccessToken' => $config->urlAccessToken,
    'urlResourceOwnerDetails' => null,
    'scopes' => $config->scopes
]);

$container['httpClient'] = new Client('https://sandbox-quickbooks.api.intuit.com/');

$container['endpointService'] = new EndPointService();

