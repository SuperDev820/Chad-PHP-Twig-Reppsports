<?php 
require_once("Vendor/autoload.php"); 
include './Controller/function.php';
$loader = new \Twig\Loader\FilesystemLoader('Templates');
$twig = new \Twig\Environment($loader);

$items = getnav();

// contact.html
echo $twig->render('contact.twig', ['name' => 'reppsports', 'items' => $items]);

?>