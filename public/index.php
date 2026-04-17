<?php
session_start();
require_once __DIR__ . '/../app/Database.php';
require_once __DIR__ . '/../app/Router.php';
require_once __DIR__ . '/../app/controllers/patientController.php';
$router = new Router();
$router->add('/patients','PatientController','index');
$router->add('/patients/ajouter', 'PatientController', 'store');
$router->add('/patients/get', 'PatientController', 'getPatientJson'); 
$router->add('/patients/modifier', 'PatientController', 'update');    
$router->add('/patients/supprimer', 'PatientController', 'destroy');
$router->run();