<?php 
require_once("Vendor/autoload.php");
include './Controller/slider_product_retrive.php';
include './Controller/function.php';

$loader = new \Twig\Loader\FilesystemLoader('Templates');
$twig = new \Twig\Environment($loader);
$items= getnav();

echo $twig->render('myaccount.twig', ['name' => 'reppsports', 'items' => $items]);

 ?>