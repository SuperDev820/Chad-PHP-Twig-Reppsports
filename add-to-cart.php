<?php
include './Controller/function.php';

session_start();
$product_id = $_REQUEST['product_id'];
$quantity = $_REQUEST['quantity'];
$select_count = $_REQUEST['select_count'];

$product_name = getProductName($product_id);
if($select_count){
    $product_name = $product_name." – ";
}

for($no=1;$no<=$select_count;$no++){
    $product_variants_id[$no] = $_POST['select'.$no];
    $variant_name = getVariantName($product_variants_id[$no]);
    if($no == 1){
        $product_name = $product_name . $variant_name;
    }
    else{
        $product_name = $product_name . ", " . $variant_name;
    }
}
$image_url = getImageUrl($product_id, $select_count, $product_variants_id);
$price = getPrice($product_id, $select_count, $product_variants_id);

$cart_item = array(
    'product_name' => $product_name,
    'product_id' => $product_id,
    'quantity' => $quantity,
    'image_url' => $image_url,
    'price' => $price,
);
$cart = $_SESSION['cart'];

$exist_flag = "false";
$cart_new = [];

foreach($cart as $cart_item_exist){
    $cart_item_temp = $cart_item_exist;
    if($cart_item_temp['product_name'] == $cart_item['product_name']){
        $exist_flag = "true";
        $cart_item_temp['quantity'] = $cart_item_temp['quantity'] + $cart_item['quantity'];
    }
    array_push($cart_new, $cart_item_temp);
}
if($exist_flag == "false"){
    array_push($cart_new, $cart_item);
}

$_SESSION['cart'] = $cart_new;

header('Location: /cart.php');
?>