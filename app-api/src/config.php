<?php
/**
 * @author Samantha Jayasinghe
 *
 */

$config = new stdClass();

$config->clientId = 'Q0b8xrCz7fqmieyDzVBoTn3aloTMzfjn8K9ixLG9ZitmV7Z7LP';
$config->clientSecret = 'urP4N4ZOgSClOq862FYkiybmf1UrgcCDoINcf7Hl';
$config->redirectUri = 'http://cl-tech.local/app-api/public/index.php/callback';
$config->urlAuthorize = 'https://appcenter.intuit.com/connect/oauth2';
$config->urlAccessToken = 'https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer';
$config->scopes = ['com.intuit.quickbooks.accounting'] ;

return [
    'settings' => [
        'displayErrorDetails' => true
    ],
];
