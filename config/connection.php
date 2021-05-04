<?php
require(__DIR__.'/composer/vendor/autoload.php');

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host=$_ENV["HOSTNAME"];
$username=$_ENV["USER"];
$password=$_ENV["PASS"];
$dbname=$_ENV["DATABASE"];
$con=mysqli_connect($host,$username,$password,$dbname) or die("Could not connect to database");
?>
