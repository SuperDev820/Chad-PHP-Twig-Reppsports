<?php 
session_start();

require_once("Vendor/autoload.php"); 
include './Controller/function.php';

$loader = new \Twig\Loader\FilesystemLoader('Templates');
$twig = new \Twig\Environment($loader);

$items = getnav();
$cart = $_SESSION['cart'];

if(count($cart)){
    $cart_display = [];
    $cart_subtotal = 0;
    $no = 0;
    foreach($cart as $cart_item){
        $cart_display_item['product_name'] = $cart_item['product_name'];
        $cart_display_item['quantity'] = $cart_item['quantity'];
        $cart_display_item['price'] = $cart_item['price'];
        $cart_display_item['image_url'] = $cart_item['image_url'];
        $cart_display_item['subtotal'] = $cart_display_item['price'] * $cart_display_item['quantity'];
        $cart_display_item['no'] = $no;
        $no = $no + 1;
        $cart_subtotal = $cart_subtotal  + $cart_display_item['subtotal'];
        array_push($cart_display, $cart_display_item);
    }
    
    echo $twig->render('shoppingcart.twig', [
        'name' => 'reppsports', 
        'items' => $items, 
        'cart_display' => $cart_display, 
        'cart_subtotal' => $cart_subtotal]
    );    
}
else{
    echo $twig->render('shoppingcart.twig', [
        'items' => $items, 
        'cart_display' => []]
    );
}

