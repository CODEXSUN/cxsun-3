<?php
require_once __DIR__.'/../vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

// Load .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
$dotenv->safeLoad();

// Setup Eloquent
$capsule = new Capsule;
$capsule->addConnection(require __DIR__.'/../config/database.php');
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Helper: view
function view($template, $data = []): false|string
{
    extract($data);
    $path = __DIR__.'/../views/'.$template.'.php';
    if (file_exists($path)) {
        ob_start();
        include $path;
        return ob_get_clean();
    }
    return '';
}

// Helper: redirect
function redirect($url) {
    header("Location: $url");
    exit;
}
