# API Explorer Application

[![Travis Test](https://img.shields.io/travis/samanthajayasinghe/cl-tech/master.svg)](https://travis-ci.org/samanthajayasinghe/cl-tech) [![codecov](https://codecov.io/gh/samanthajayasinghe/cl-tech/branch/master/graph/badge.svg)](https://codecov.io/gh/samanthajayasinghe/cl-tech)

API Explorer is featured to call the third-party API's via any interface. Currently, the application supports only to be called via web interface and API-middleware can be called via mobile or micro-device.

## How to set up

Rename app-api/src/config-dist.php as a app-api/src/config.php.

Update following config setting according to your local path.

```
$config->appAPIHost = '{http://your app api path}'; //point to app-api/public/index.php
$config->appWebHost = '{http://your app web path}'; //point to app-web/index.html
```

Create a Quick Book account and update following settings accordingly.

```
$config->clientId = '';//Your Id here
$config->clientSecret = '';//Your client Secret here
```
## How it supports to Quick Book API Explorer
API Explorer implements the Quick Book Adapter which supports to get the following information
* Quick Book API access token
* Execute HTTP Request for any HTTP method( Get, Post, Put, Delete ) 
* Get all endpoints 

## API Explorer Architecture 
### Component Diagram
The component diagram shows the interconnection of application layers.
![component diagram](https://github.com/samanthajayasinghe/cl-tech/wiki/images/API-Explorer%20Componen.jpg)

More information available in https://github.com/samanthajayasinghe/cl-tech/wiki

