<?php
use app\conf;

$root = substr(__DIR__, 0, (strlen(__DIR__) - strlen(DIRECTORY_SEPARATOR.'scripts'))).DIRECTORY_SEPARATOR;
require_once($root."vendor/autoload.php");
\boxxy\autoload::path($root);
$pdo = new PDO('mysql:host='.conf::db_host.';dbname='.conf::db_name,
    conf::db_user, conf::db_password);
$pdo->beginTransaction();
$pdo->exec("ALTER TABLE `users` ADD `roles` TEXT NULL DEFAULT NULL");
$pdo->commit();