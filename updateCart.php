<?php 
session_start();

$cart = $_SESSION['cart'];
$cart_result = [];
for($no=0;$no<count($cart);$no++){
    $quantity = $_REQUEST['quantity'.$no];
    $cart[$no]['quantity'] = $quantity;
    if($quantity) array_push($cart_result, $cart[$no]);
}
$_SESSION['cart'] = $cart_result;
header('Location: /cart.php');
