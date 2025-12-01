<?php
// index.php — ROOT FILE
require_once 'lib/bootstrap.php';

use Illuminate\Http\Request;

$request = Request::capture();
$router = require 'routes/web.php';

$response = $router->dispatch($request);
$response->send();