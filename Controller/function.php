<?php

include('config/db.php');

function getnav() {
	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}
	$sql = "SELECT * FROM menu";
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	$menu_items = [];
	
	//var_dump($conn->error);

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
	  while($row = mysqli_fetch_assoc($result)) {
		$item['id'] = $row['menu_id'];
		$item['title'] = $row['menu_title'];
		$item['href'] = $row['href'];
		
		if($item['title'] == "PRODUCTS"){
			$category_items = getCategory($item);
			array_push($menu_items, $category_items);
		}
		else if($item['title'] == "Raze Energy"){
			$item['href'] = "/product-category/best-seller";
			array_push($menu_items, $item);
		}
		else array_push($menu_items, $item);
	 }
	} else {
	  echo "0 results";
	}

	return $menu_items;
}

function getCategory($item){
	$category_items = $item;

	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}
	$sql = "SELECT * FROM category";
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	$sub_items = [];
	
	//var_dump($conn->error);

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$sub_item['id'] = $row['cat_id'];
			$sub_item['title'] = $row['cat_name'];
			$sub_item['href'] = "/product-category/" . $row['cat_slug'];

			$sub_item = getProductsItems($sub_item);

			array_push($sub_items, $sub_item);
		}
	}

	$category_items['sub_menu'] = $sub_items;

	return $category_items;
}

function getProductsItems($item){
	$product_items = $item;

	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}
	$cat_id = $item['id'];
	$sql = "SELECT * FROM products WHERE cat_id = '$cat_id'";
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	$sub_items = [];
	
	//var_dump($conn->error);

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$sub_item['id'] = $row['product_id'];
			$sub_item['title'] = $row['product_name'];
			$sub_item['href'] = "/product/" . $row['product_slug'];

			array_push($sub_items, $sub_item);
		}
	}

	$product_items['sub_menu'] = $sub_items;

	return $product_items;
}

function getCategoryId($category_slug){
	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}
	$sql = "SELECT * FROM category";
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	
	//var_dump($conn->error);
	$category_id = 0;

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			if($row['cat_slug'] == $category_slug) return $row['cat_id'];
		}
	}

	return $category_id;
}

function getProductId($product_slug){
	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}
	$sql = "SELECT * FROM products WHERE product_slug = '$product_slug'";
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	
	//var_dump($conn->error);
	$product_id = 0;

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$product_id = $row['product_id'];
		}
	}

	return $product_id;
}

function getProductType($product_slug){
	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}
	$sql = "SELECT * FROM products WHERE product_slug = '$product_slug'";
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	
	//var_dump($conn->error);
	$product_type = "";

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$product_type = $row['type'];
		}
	}

	return $product_type;
}

function getProductPrice($product_slug){
	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}
	$sql = "SELECT * FROM products WHERE product_slug = '$product_slug'";
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	
	//var_dump($conn->error);
	$product_price = 0;

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$product_price = $row['product_price'];
		}
	}

	return $product_price;
}

function getProductDetail($product_slug){
	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}
	
	$sql = "SELECT * FROM products WHERE product_slug = '$product_slug'";
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	
	//var_dump($conn->error);
	$product_detail = [];

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$product_detail[0] = $row['product description'];
			$product_detail[1] = $row['product_description2'];
		}
	}

	return $product_detail;
}

function getProductName($product_id){
	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}
	
	$sql = "SELECT * FROM products WHERE product_id = '$product_id'";
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	
	//var_dump($conn->error);
	$product_name = "";

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$product_name = $row['product_name'];
		}
	}

	return $product_name;
}

function getVariantName($product_variants_id){
	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}
	
	$sql = "SELECT * FROM product_variants WHERE product_variants_id = '$product_variants_id'";
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	
	//var_dump($conn->error);
	$variant_name = "";

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$variant_name = $row['name'];
		}
	}

	return $variant_name;
}

function getVariantInfo($product_id, $select_count, $product_variants_id){
	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}

	if($select_count == 1){
		$product_variants_id1 = $product_variants_id[1];
		$sql = "SELECT * FROM product_variant_sku WHERE product_id = '$product_id' AND product_variants_id1 = '$product_variants_id1'";
	}
	else{
		$product_variants_id1 = $product_variants_id[1];
		$product_variants_id2 = $product_variants_id[2];

		$sql = "SELECT * FROM product_variant_sku WHERE (product_id = '$product_id' AND product_variants_id1 = '$product_variants_id1' AND product_variants_id2 = '$product_variants_id2')";
	}
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	
	//var_dump($conn->error);
	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$variant_info['price'] = $row['price'];
			$variant_info['image_url'] = $row['image'];
		}
	}
	return $variant_info;
}

function getPrice($product_id, $select_count, $product_variants_id){
	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}

	if($select_count == 1){
		$product_variants_id1 = $product_variants_id[1];
		$sql = "SELECT * FROM product_variant_sku WHERE product_id = '$product_id' AND product_variants_id1 = '$product_variants_id1'";
	}
	else{
		$product_variants_id1 = $product_variants_id[1];
		$product_variants_id2 = $product_variants_id[2];

		$sql = "SELECT * FROM product_variant_sku WHERE product_id = '$product_id' AND product_variants_id1 = '$product_variants_id1' AND product_variants_id2 = '$product_variants_id2'";
	}
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	
	//var_dump($conn->error);
	$price = "";

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$price = $row['price'];
		}
	}

	return $price;
}

function putReviewInfo($product_id, $name, $email, $description, $stars, $image_url_array, $ts) {
	global $con;
	if ($con->connect_errno) {
	  echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}

	$pic1 = "";
	$pic2 = "";
	$pic3 = "";
	if(count($image_url_array)>0) $pic1 = $image_url_array[0];
	if(count($image_url_array)>1) $pic2 = $image_url_array[1];
	if(count($image_url_array)>2) $pic3 = $image_url_array[2];
	
	$helpfulvote = 0;
	$vote = 0;

	$sql = "INSERT INTO review (product_id, review_name, email, review_description, stars, helpfulvote, vote, pic1, pic2, pic3, ts) 
						VALUES ('$product_id', '$name', '$email', '$description', '$stars', '$helpfulvote', '$vote', '$pic1', '$pic2', '$pic3', '$ts')";
	// $sql = "INSERT INTO category (cat_name) VALUES ('123')";
	// $result = $con->query($sql);
	if ($con->query($sql) === TRUE) {
			$result = "New record created successfully";
		} else {
			$result = "Error: " . $sql . "<br>" . $conn->error;
		}
	
	$sql = "SELECT * FROM products WHERE product_id = '$product_id'";

	$result = $con->query($sql);	
	
	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$slug = $row['product_slug'];
		}
	}
	return $slug;
}

function getRobotCheck(){
	$var1_num = rand(1,19);
	$var2_num = rand(1, $var1_num);
	$var1 = getVar($var1_num);
	$var2 = getVar($var2_num);

	$operatorId = rand(1,3);
	$str_num_check1 = rand(1, 2);
	$str_num_check2 = rand(1, 2);
	if($operatorId == 1) {
		$operator = ' + '; 
		$ans = $var1_num + $var2_num;
	}
	if($operatorId == 2) {
		$operator = ' - ';
		$ans = $var1_num - $var2_num;
	}
	if($operatorId == 3) {
		$operator = ' * ';
		$ans = $var1_num * $var2_num;
	}
	if($str_num_check1 == 1){
		$var1 = (string)$var1_num;
	}
	if($str_num_check2 == 1){
		$var2 = (string)$var2_num;
	}
	$question = $var1 . $operator . $var2 . " = ";

	$result['question'] = $question;
	$result['answer'] = $ans;
	return $result;
}

function getVar($var_num){
	if($var_num == 1) return "one";
	if($var_num == 2) return "two";
	if($var_num == 3) return "three";
	if($var_num == 4) return "four";
	if($var_num == 5) return "five";
	if($var_num == 6) return "six";
	if($var_num == 7) return "seven";
	if($var_num == 8) return "eight";
	if($var_num == 9) return "nine";
	if($var_num == 10) return "ten";
	if($var_num == 11) return "eleven";
	if($var_num == 12) return "twelve";
	if($var_num == 13) return "thirteen";
	if($var_num == 14) return "fourteen";
	if($var_num == 15) return "fifteen";
	if($var_num == 16) return "sixteen";
	if($var_num == 17) return "seventeen";
	if($var_num == 18) return "eighteen";
	if($var_num == 19) return "nineteen";
}

function getReviews($product_id){
	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}

	$sql = "SELECT * FROM review WHERE product_id = '$product_id'";
	
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	
	//var_dump($conn->error);
	$review_array = [];

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$review['review_id'] = $row['review_id'];
			$review['review_name'] = $row['review_name'];
			$review['review_description'] = $row['review_description'];
			$dt = new DateTime($row['ts']);

			$date = $dt->format('M d, Y');
			$review['review_date'] = $date;
			$stars = $row['stars'];

			$rating_star_array = [];
			for($i=0;$i<5;$i++) {
				if($i<$stars) $image_url = "img/star-full.png";
				else $image_url = "img/star-empty.png";
				array_push($rating_star_array, $image_url);
			}
			$review['rating_star_array'] = $rating_star_array;
			$review['helpfulvote'] = $row['helpfulvote'];
			$review['vote'] = $row['vote'];

			$image_array = [];
			if($row['pic1'] != '') {
				array_push($image_array, $row['pic1']);
			}

			if($row['pic2'] != '') {
				array_push($image_array, $row['pic2']);
			}

			if($row['pic3'] != '') {
				array_push($image_array, $row['pic3']);
			}
			$review['image_array'] = $image_array;

			array_push($review_array, $review);
		}
	}
	return $review_array;

}

function updateVote($action, $review_id) {
	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}
	
	$sql = "SELECT * FROM review WHERE review_id = '$review_id'";
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	
	//var_dump($conn->error);

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$helpfulvote = $row['helpfulvote'];
			$vote = $row['vote'];
		}
	}
	$vote = $vote + 1;
	if($action == "yes") {
		$helpfulvote = $helpfulvote + 1;
	}
	
	$sql = "UPDATE review SET vote='$vote', helpfulvote='$helpfulvote' WHERE review_id='$review_id'";
	if($con->query($sql) == TRUE) {
		$ans['vote'] = $vote;
		$ans['helpfulvote'] = $helpfulvote;
	}

	return $helpfulvote;
}