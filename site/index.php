<?php
define('ROOT' , substr(__DIR__, 0, (strlen(__DIR__) - strlen('/site'))).DIRECTORY_SEPARATOR);
require_once ROOT."libs/autoload.php";
autoload::path(ROOT);
$s = new \app\site();
$s->run();