<?php
define('FACE_START', microtime(true));
define('ROOT_PATH', __DIR__ . "/../");
define('APP_PATH', __DIR__ . "/../app/");
/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__ . '/../vendor/autoload.php';

//require __DIR__ . "/../app/routes.php";

(new \App\Application())->run();
