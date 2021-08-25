<?php
//var_dump($_SERVER['QUERY_STRING']);
//require_once '../vendor/autoload.php';
require_once dirname(__DIR__) . '/config/init.php';
require_once LIBS . '/functions.php';
require_once CONF . '/routes.php';

new \ishop\App();

//throw new Exception('Страница не найдена', 500);

debug(\ishop\Router::getRoutes());
