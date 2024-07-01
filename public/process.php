<?php

require __DIR__.'/../bootstrap/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Design;

// Load the Laravel environment file
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$dbHost = $_ENV['DB_HOST'];
$dbDatabase = $_ENV['DB_DATABASE'];
$dbUsername = $_ENV['DB_USERNAME'];
$dbPassword = $_ENV['DB_PASSWORD'];

// Establish the database connection
$capsule = new Capsule();
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => $dbHost,
    'database' => $dbDatabase,
    'username' => $dbUsername,
    'password' => $dbPassword,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Retrieve the serialized data from the request
$serializedData = $_POST['data'];
$decodedData = base64_decode($serializedData);

// Extract the title and remaining data
$data = json_decode($decodedData, true);
$title = $data['title'];
unset($data['title']);

// Create a new Design instance
$design = new Design();
$design->title = $title;
$design->details = $data;

// Save the design to the database
$design->save();

// Return a success response
echo "ok";