<?php 
require_once("Vendor/autoload.php");
include("./Controller/function.php");

$loader = new \Twig\Loader\FilesystemLoader('Templates');
$twig = new \Twig\Environment($loader);



echo $twig->render('index.html', ['name' => 'reppsports']);




echo $twig->render('checkout.html');
echo $twig->render('scripts.html');