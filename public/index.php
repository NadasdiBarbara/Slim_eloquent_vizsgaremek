<?php 

require '../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager;
use Slim\Factory\AppFactory;


$app=AppFactory::create();

$config=require '../src/config.php';

$dbManager = new Manager();
$dbManager->addConnection([
    'driver' => 'mysql',
    'host' => $config['DB_HOST'],
    'database' => $config['DB_DATABASE'],
    'username' => $config['DB_USER'],
    'password' => $config['DB_PASS'],
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$dbManager->setAsGlobal();
$dbManager->bootEloquent();

$routes=require '../src/routes.php';
$routes($app);