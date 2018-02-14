<?php
/**
 * @author Samantha Jayasinghe
 *
 */

use APIExplorer\Client\Client;
use APIExplorer\Service\EndPointService;
use APIExplorer\Service\APIService;
use APIExplorer\Adapter\QuickBook\Adapter;

// DIC configuration
$container = $app->getContainer();

$quickBookApiAdapter = new Adapter();
$quickBookApiAdapter->setConfig($config);

$apiService = new APIService();
$apiService->setApiAdapter($quickBookApiAdapter);

$container['httpClient'] = new Client('https://sandbox-quickbooks.api.intuit.com/');

$container['apiService']  =  $apiService;

$container['endpointService'] = new EndPointService();

