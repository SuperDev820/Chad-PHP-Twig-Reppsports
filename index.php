<html>
<?php 
require_once("Vendor/autoload.php");
include './Controller/slider_product_retrive.php';
include './Controller/function.php';

$loader = new \Twig\Loader\FilesystemLoader('Templates');
$twig = new \Twig\Environment($loader);

$products_bestseller = getproducts('bestseller');
$products_musclebuilding = getproducts('musclebuilding');
$products_apparel = getproducts('apparel');
$items= getnav();

session_start();
if(!isset($_SESSION['cart'])) {
    $cart = array();
    $_SESSION['cart'] = $cart;
}

echo $twig->render('index.twig', ['name' => 'reppsports', 'items' => $items, 'products_bestseller' => $products_bestseller, 'products_musclebuilding' => $products_musclebuilding, 'products_apparel' => $products_apparel]);
?>
</html>