<?php 
require_once("Vendor/autoload.php");
include("./Controller/function.php");
include("./Controller/checkout.php");

$loader = new \Twig\Loader\FilesystemLoader('Templates');
$twig = new \Twig\Environment($loader);

$items = getnav();
$checkout_info = getCheckoutInfo();
$upsell_info = getUpsellInfo();
$orderbump = getOrderbumpInfo();
$button_text = getButtonText();

echo $twig->render('mixed-content.twig', [
    'name' => 'reppsports', 
    'items' => $items, 
    "checkout_info" => $checkout_info, 
    "button_text" => $button_text,
    "upsell_info" => $upsell_info,
    "orderbump" => $orderbump]);