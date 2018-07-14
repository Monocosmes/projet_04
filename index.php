<?php

require_once '_config.php';

MyAutoload::start();

$request = $_GET['r'];

$router = new Router($request);
$router->renderController();
