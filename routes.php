<?php

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($request_uri[0]) {
    case '/register':
        require_once('controllers/RegisterController.php');
        $cont = new RegisterController();
        $cont->{ $action }();
        break;
    case '/login':
        require_once('controllers/LoginController.php');
        $cont = new LoginController();
        $cont->{ $action }();
        break;
    case '/':
    case '/profile':
        require_once('controllers/ProfileController.php');
        $cont = new ProfileController();
        $cont->{ $action }();
        break;
    case '/user-uploads':
        require_once('controllers/UploadsController.php');
        $cont = new UploadsController();
        $cont->{ $action }();
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        echo 'error';
        break;
}