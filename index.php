<?php
session_start();

require_once "config.php";

// Personal autoload
spl_autoload_register(function ($class) {
    include_once 'model/' . str_replace('\\', '/', $class) . '.php';
});

// connect with MyPDO
try {
    $connectMyPDO = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=' . DB_CHARSET . ';port=' . DB_PORT, DB_LOGIN, DB_PWD);
} catch (Exception $e) {
    die($e->getMessage());
}

if(isset($_SESSION['myidsession'])&& $_SESSION['myidsession'] == session_id()){

}else{
    require "controller/publicController.php";
}