<?php

require '../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

// Подключение маршрутов
require __DIR__  .'/../src/routes.php';

$app->run(); 