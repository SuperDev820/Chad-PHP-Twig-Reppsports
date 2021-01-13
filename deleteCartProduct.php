<?php 
session_start();
$cart = $_SESSION['cart'];
$delete_no = $_GET['no'];
var_dump($delete_no);
$cart_result = [];
for($no=0;$no<count($cart);$no++){
    if("delno".$no == $delete_no) continue;
    array_push($cart_result, $cart[$no]);
}
$_SESSION['cart'] = $cart_result;

header('Location: /cart.php');