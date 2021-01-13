<?php
require_once("Vendor/autoload.php");
include './Controller/function.php';

$loader = new \Twig\Loader\FilesystemLoader('Templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('index.html', ['name' => 'reppsports']);

$items = getnav();

echo $twig->render('header.html', [
	'p' => 'RAZE Focus Now Available - Shop Now!',
	'pp' => 'Test PRO Now Available',
	'p2' => 'TRACK MY ORDER',
	'btn' => 'MEMBERLOGIN',
	'userimage' => 'fa fa-user',
	'logo' => 'https://reppsports.com/wp-content/uploads/2020/08/REPP_SPORTS-svg.svg',
	'items' => $items
]);

echo $twig->render('stack.html');

$product = [
	[
		'ptitle' => 'BEST TEST STACK',
		'pprice' => '$49.9',
		'pimage' => 'https://reppsports.com/wp-content/uploads/2020/03/arimivar-rpct-500x583-1.png',
		'btn' => 'ADD TO CART'
	],
	[
		'ptitle' => 'BEST TEST STACK',
		'pprice' => '$49.9',
		'pimage' => 'https://reppsports.com/wp-content/uploads/2020/03/reactr-arimivar-rpct-500x583.png',
		'btn' => 'ADD TO CART'
	],
	[
		'ptitle' => 'BEST TEST STACK',
		'pprice' => '$49.9',
		'pimage' => 'https://reppsports.com/wp-content/uploads/2020/02/abol-activ-500x583.png',
		'btn' => 'ADD TO CART'
	],
	[
		'ptitle' => 'BEST TEST STACK',
		'pprice' => '$49.9',
		'pimage' => 'https://reppsports.com/wp-content/uploads/2020/03/phenibut-rpct-arimivar-500x583.png',
		'btn' => 'ADD TO CART'
	],

];

echo "<div class='container'><div class='row'>";
foreach ($product as $product) {
	echo $twig->render('stack.html', ['ptitle' => $product['ptitle'], 'pprice' => $product['pprice'], 'pimage' => $product['pimage'], 'btn' => $product['btn']]);
}
echo "</div></div>";

// footer
echo $twig->render('footer.html');
echo $twig->render('scripts.html');
