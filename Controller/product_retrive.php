<?php 

include('../config/db.php');

function getproducts()
{
	global $con;
	$query="select * from products where cat_id=1";
	$result=mysqli_query($con,$query);
	$products = [];
	if (mysqli_num_rows($result)>0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$product['id'] =$row['product_id'];
			$product['name'] =$row['product_name'];
			$product['image'] =$row['product_image'];
			$product['price'] = $row['product_price'];
			array_push($products, $product);
		}
	}
	return $products;
}

function getallproducts()
{
	global $con;
	$query="select * from products";
	$result=mysqli_query($con,$query);
	$allproducts = [];
	if (mysqli_num_rows($result)>0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$product['id'] =$row['product_id'];
			$product['name'] =$row['product_name'];
			$product['image'] =$row['product_image'];
			$product['price'] = $row['product_price'];
			array_push($allproducts, $product);
		}
	}
	return $allproducts;
}

// get products of given category id
function getProductList($category_id)
{
	global $con;
	$query="select * from products WHERE cat_id = '$category_id'";
	$result=mysqli_query($con,$query);
	$products = [];

	if (mysqli_num_rows($result)>0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$product['id'] =$row['product_id'];
			$product['name'] =$row['product_name'];
			$product['image'] =$row['product_image'];
			$product['price'] = $row['product_price'];
			$product['url'] = "/product/" . $row['product_slug'];
			
			array_push($products, $product);
		}
	}

	return $products;
}

?>
		 
