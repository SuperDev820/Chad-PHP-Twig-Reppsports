<html>
<?php 
require_once("Vendor/autoload.php"); 
include './Controller/slider_product_retrive.php';
include './Controller/function.php';
include './Controller/Get_Variations.php';

$loader = new \Twig\Loader\FilesystemLoader('Templates');
$twig = new \Twig\Environment($loader);

$items = getnav();
$products = getVariations();
$variations = getVariants(13);
$customScript = getProductScript(); //page specific script

echo $twig->render('detailpage.twig', [
		'name' => 'Repp Sports',
		'items'=> $items,
		'variations' => $variations,
		'images' => getProductImages(13),
		'customScript' => $customScript
]);

?>
</html>