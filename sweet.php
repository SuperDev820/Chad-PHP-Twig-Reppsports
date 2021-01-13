<?php 
require_once("Vendor/autoload.php");
include("./Controller/function.php");

$loader = new \Twig\Loader\FilesystemLoader('Templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('sweet_energy.html', ['title' => 'Free Raze Energy on the Go']);
echo $twig->render('sweetheader.html');
echo $twig->render('sweetslider.html');
echo $twig->render('sweetcontent.html');
echo $twig->render('sweetfooter.html');
echo $twig->render('scripts.html');