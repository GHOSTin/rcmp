<?php
ini_set('display_errors', 1);
$root = substr(__DIR__, 0, (strlen(__DIR__) - strlen('/site'))).DIRECTORY_SEPARATOR;
require_once($root."libs/boxxy/boxxy.php");
\boxxy\autoload::path($root);
(new \boxxy\classes\container($root, new \app\app()))->run();