<?php
require_once("Vendor/autoload.php");
include './Controller/product_retrive.php';
include './Controller/function.php';

$loader = new \Twig\Loader\FilesystemLoader('Templates');
$twig = new \Twig\Environment($loader);

$items = getnav();
$product_list = getProductList($category_id);

echo $twig->render('category.twig', ['name' => 'reppsports', 'items' => $items, 'products' => $product_list]);

?>
