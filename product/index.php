<html>
<?php 
require_once("../vendor/autoload.php"); 
include '../Controller/slider_product_retrive.php';
include '../Controller/function.php';	
include '../Controller/Get_Variations.php';

$loader = new \Twig\Loader\FilesystemLoader('../Templates');
$twig = new \Twig\Environment($loader);

$product_slug = $_GET['slug'];
$product_id = getProductId($product_slug);
$product_name = getProductName($product_id);
$product_type = getProductType($product_slug);
$product_price = getProductPrice($product_slug);
$product_detail = getProductDetail($product_slug);
$items = getnav();
$variants = getVariants($product_id);
$images = getProductImages($product_id);
$robotcheck = getRobotCheck();

$review_array = getReviews($product_id);
echo $twig->render('detailpage.twig', [
		'name' => 'Repp Sports',
		'items'=> $items,
		'product_id' => $product_id,
		'product_name' => $product_name,
        'product_type' => $product_type,
		'product_price' => $product_price,
		'product_detail' => $product_detail,
		'variants' => $variants,
		'images' => $images,
		'robotCheck' => $robotcheck,
		'review_array' => $review_array,
]);

?>
</html>