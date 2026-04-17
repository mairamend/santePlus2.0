<?php
session_start();
require_once __DIR__ . '/../app/Database.php';
require_once __DIR__ . '/../app/Router.php';
require_once __DIR__ . '/../app/controllers/patientController.php';
$router = new Router();
require_once __DIR__ . '/../routes/web.php';
$router->run();