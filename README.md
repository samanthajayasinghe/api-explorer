# API Explorer Application

[![Travis Test](https://img.shields.io/travis/samanthajayasinghe/cl-tech/master.svg)](https://travis-ci.org/samanthajayasinghe/cl-tech) [![codecov](https://codecov.io/gh/samanthajayasinghe/cl-tech/branch/master/graph/badge.svg)](https://codecov.io/gh/samanthajayasinghe/cl-tech)

 API Explorer application which supports browse API endpoints

# How to set up

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
