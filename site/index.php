<?php
$root = substr(__DIR__, 0, (strlen(__DIR__) - strlen('/site'))).DIRECTORY_SEPARATOR;
require_once($root."libs/boxxy/boxxy.php");
\boxxy\autoload::path($root);
$s = new \app\site();
$s->run($root);