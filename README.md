# API Explorer Application

[![Travis Test](https://img.shields.io/travis/samanthajayasinghe/cl-tech/master.svg)](https://travis-ci.org/samanthajayasinghe/cl-tech) [![codecov](https://codecov.io/gh/samanthajayasinghe/cl-tech/branch/master/graph/badge.svg)](https://codecov.io/gh/samanthajayasinghe/cl-tech)

API Explorer is a project that supports tocall the API via any interfaces. Currently, It supports to call it via the web interface and API-middleware supports to call it via mobile or micro-device.

## How to set up

Rename app-api/src/config-dist.php as a app-api/src/config.php.

Update following config setting based on your local path.

```
$config->appAPIHost = '{http://your app api path}'; //point to app-api/public/index.php
$config->appWebHost = '{http://your app web path}'; //point to app-web/index.html
```

Create a Quick Book account and update following setting based on your application

```
$config->clientId = '';//Your Id here
$config->clientSecret = '';//Your client Secret here
```
## API explorer middleware
API explorer middleware is a scalable microservice application that facilitates following features with third-party apps.
* Get Access token
* Get all supported end points
* Execute HTTP Request for HTTP methods (GET, POST, PUT, DELETE)

## API Explorer Web Application
API explorer web application is a single page application(SPA) which communicate with API middleware application. 

## How Application supports to Quick Book API Explorer
Current implementation supports to quickbook API explorer for given client id and secret.
