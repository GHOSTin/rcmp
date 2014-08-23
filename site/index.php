<?php
$root = substr(__DIR__, 0, (strlen(__DIR__) - strlen('/site'))).DIRECTORY_SEPARATOR;
require_once($root."vendor/autoload.php");
\boxxy\autoload::path($root);
(new \boxxy\classes\container($root, new \app\app()))->run();