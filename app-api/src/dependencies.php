<?php
/**
 * @author Samantha Jayasinghe
 *
 */

// DIC configuration
$container = $app->getContainer();

$container['oauthProvider'] = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId' => $config->clientId,
    'clientSecret' => $config->clientSecret,
    'redirectUri' => $config->redirectUri,
    'urlAuthorize' => $config->urlAuthorize,
    'urlAccessToken' => $config->urlAccessToken,
    'urlResourceOwnerDetails' => null,
    'scopes' => $config->scopes
]);
