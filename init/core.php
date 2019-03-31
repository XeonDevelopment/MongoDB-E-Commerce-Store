<?php 
session_start();

$mongoClient = new MongoClient();
$db = $mongoClient->ecommerce;

require_once 'funcs.php';
require_once 'basket_funcs.php';




?>