<?php
    //dev mod
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    //dev mod
    session_start();
    require 'vendor/autoload.php';
    $dwoo = new Dwoo_Core();
    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'index';
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';
    $controller = ucfirst($controller) . "Controller";
    $action = $action . "Action";
    require_once 'app/controllers/' . $controller . '.php';
    $obj = new $controller($dwoo);
    $obj->$action();
