<?php 
require_once("Vendor/autoload.php"); 
include './Controller/function.php';
$loader = new \Twig\Loader\FilesystemLoader('Templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('index.html', ['name' => 'reppsports']);

$items = getnav();
echo $twig->render('header.html', [

		'p' =>'RAZE Focus Now Available - Shop Now!',
		'pp' => 'Test PRO Now Available', 
		'p2' => 'TRACK MY ORDER',
		'btn' => 'MEMBERLOGIN',
		'userimage' => 'fa fa-user',
		'logo' => 'https://reppsports.com/wp-content/uploads/2020/08/REPP_SPORTS-svg.svg',
		'items'=> $items
	]
);
// contact.html
echo $twig->render('claim.html');

// footer
echo $twig->render('footer.html');
echo $twig->render('scripts.html');