<?php
/**
 * @author Samantha Jayasinghe
 *
 */

use APIExplorer\Client\Client;
use APIExplorer\Service\APIService;
use APIExplorer\Adapter\QuickBook\Adapter;
use APIExplorer\Security\TokenHandler;

// DIC configuration
$container = $app->getContainer();

$httpClient = new Client('https://sandbox-quickbooks.api.intuit.com/');
$tokenHandler = new TokenHandler($config->secretKey, $config->secretIv);

$quickBookApiAdapter = new Adapter();
$quickBookApiAdapter->setConfig($config);
$quickBookApiAdapter->setHttpClient($httpClient);
$quickBookApiAdapter->setTokenHandler($tokenHandler);

$apiService = new APIService();
$apiService->setApiAdapter($quickBookApiAdapter);

$container['apiService']  =  $apiService;

