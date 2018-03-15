<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

//$capsule->addConnection(config::get('database'));

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'username' => 'root',
    'password' => '',
    'database' => 'romerorainier',
    'charset'  => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
]);

$capsule->setAsGlobal();  //this is important

$capsule->bootEloquent();

?>
