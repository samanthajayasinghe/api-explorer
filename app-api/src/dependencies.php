<?php
/**
 * @author Samantha Jayasinghe
 *
 */

use APIExplorer\Client\Client;
use APIExplorer\Service\APIService;
use APIExplorer\Adapter\QuickBook\Adapter;

// DIC configuration
$container = $app->getContainer();

$httpClient = new Client('https://sandbox-quickbooks.api.intuit.com/');

$quickBookApiAdapter = new Adapter();
$quickBookApiAdapter->setConfig($config);
$quickBookApiAdapter->setHttpClient($httpClient);

$apiService = new APIService();
$apiService->setApiAdapter($quickBookApiAdapter);

$container['apiService']  =  $apiService;

