<?php 
require_once("Vendor/autoload.php"); 
include './Controller/product_retrive.php';
include './Controller/function.php';

$loader = new \Twig\Loader\FilesystemLoader('Templates');
$twig = new \Twig\Environment($loader);

$products = getproducts();
$items = getnav();

echo $twig->render('shop.twig', ['name' => 'reppsports', 'products' => $products, 'items' => $items]);

?>





