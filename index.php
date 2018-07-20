<?php

require_once '_config.php';

MyAutoload::start();

(isset($_GET['r']) ? $request = $_GET['r'] : $request = 'home.html';
$request = $_GET['r'];

$router = new Router($request);
$router->renderController();
