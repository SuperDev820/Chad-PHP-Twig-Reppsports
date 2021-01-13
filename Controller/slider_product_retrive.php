<?php 

include('config/db.php');

function getproducts($category)
{
	$str = file_get_contents('config/category.json');
	$json = json_decode($str);
	
	global $con;
	if($category == 'bestseller') {
		$category_id = 1;
		$id_array = $json->category->bestseller->id;
	}
	if($category == 'musclebuilding') {
		$category_id = 2;
		$id_array = $json->category->musclebuilding->id;
	}
	if($category == 'apparel') {
		$category_id = 3;
		$id_array = $json->category->apparel->id;
	}
	$products = [];
	foreach( $id_array as $product_id ) {
		$query="select * from products where product_id='$product_id'";

		$result=mysqli_query($con, $query);
		if (mysqli_num_rows($result)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$product['id'] =$row['product_id'];
				$product['name'] =$row['product_name'];
				$product['image'] =$row['product_image'];
				$product['price'] = $row['product_price'];
				array_push($products, $product);
			}
		}	
	}
	return $products;
}

 ?>