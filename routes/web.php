<?php 
$router->add('/patients','PatientController','index');
$router->add('/patients/ajouter', 'PatientController', 'store');
$router->add('/patients/get', 'PatientController', 'getPatientJson'); 
$router->add('/patients/modifier', 'PatientController', 'update');    
$router->add('/patients/supprimer', 'PatientController', 'destroy');
$router->add('/medecins', 'MedecinController','index');
$router->add('/medecins/ajouter','MedecinController','store');
// var_dump($router);