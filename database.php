<?php 
include 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function connectBDD(): PDO
{
    return
        new PDO('mysql:host=' . $_ENV["DB_HOST"] . ';dbname=' . $_ENV["DB_NAME"] . '', 
        $_ENV["DB_USERNAME"] , 
        $_ENV["DB_PASSWORD"] , 
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} 