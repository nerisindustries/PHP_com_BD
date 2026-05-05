<?php
//config/db.php
function db(): PDO
{
$host = '127.0.0.1';
$dbname ='croud_php';
$user = 'root';
$pass = '';// no laragon, frequentemente fica vazio

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

$pdo = new PDO ($dsn, $user, $pass,[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETECH_MODE=> PDO::FETECH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES=>false,

]);
return $pdo;





}










?>