<?php 

include('../config/db.php');

function getVariations()
{
	global $con;
	$query="Select * from product_variants where priority=1";
		$result=mysqli_query($con,$query);
		$products = [];
	if (mysqli_num_rows($result)>0) {
		while ($row = mysqli_fetch_assoc($result)) {
				$product['pro_v_id'] =$row['product_variants_id'];
				$product['product_id'] =$row['product_id'];
				$product['variant_name'] =$row['variant_name'];
				$product['name'] = $row['name'];
			array_push($products, $product);
			
		}
	}
	return $products;
}

function Get_Sub_Variations()
{
	global $con;
	$query="Select * from product_variants , product_variant_sku";
		$result=mysqli_query($con,$query);
		$sub_variations = [];
	if (mysqli_num_rows($result)>0) {
		while ($row = mysqli_fetch_assoc($result)) {
				$sub_variation['pro_v_id'] =$row['product_variants_id'];
				$sub_variation['product_id'] =$row['product_id'];
				$sub_variation['variant_name'] =$row['variant_name'];
				$sub_variation['name'] = $row['name'];
				$sub_variation['image'] =$row['image'];
			array_push($sub_variations, $sub_variation);
			
		}
	}
	getProductImages(13);
	// getVariants(13);
	//return getVariants(13);
}

function getProductImages($product_id) {
	global $con;
	// $variants = getVariants($id);
	$images = [];
	// $id = 1;
	// foreach ($variants as $v) {
	// 	if (!in_array($v['image'], $images)) {
	// 		$img = [];
	// 		$img['id'] = $id;
	// 		$img['url'] = $v['image'];
	// 		array_push($images, $img);
	// 		$id = $id + 1;
	// 	}
	// }
	if ($con->connect_errno) {
		//echo "Failed to connect to MySQL: ".$conn->connect_error;
		exit();
	  }
	  $sql = "SELECT * FROM product_pictures WHERE product_id = '$product_id'";
	  //$result = mysqli_query($conn, $sql);
	  $result = $con->query($sql);
	  
	  if (mysqli_num_rows($result) > 0) {
		// output data of each row
			$id = 1;
			while($row = mysqli_fetch_assoc($result)) {
				$img['url'] = $row['url'];
				$img['id'] = $id;
				$id = $id + 1;
				array_push($images, $img);
			}
	  }
  
	return $images;
}

function getVariants ($product_id) {
	global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
	}
	$sql = "SELECT * FROM product_variants WHERE product_id = '$product_id'";
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	
	$array = [];

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			array_push($array, $row);
		}
	}

	$variants = getVariantsArray($array);
	
	if(count($variants)) {
		$product_variants_id1 = $variants[0]['content'][0]['product_variants_id'];
	}
	else{
		$product_variants_id1 = "";
	}
	
	if(count($variants)>1) {
		$product_variants_id2 = $variants[1]['content'][0]['product_variants_id'];
	}
	else{
		$product_variants_id2 = "";
	}

	$sql = "SELECT * FROM product_variant_sku WHERE product_variants_id1 = '$product_variants_id1' AND product_variants_id2 = '$product_variants_id2'";
	//$result = mysqli_query($conn, $sql);
	$result = $con->query($sql);
	
	$array = [];

	if (mysqli_num_rows($result) > 0) {
	  // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$variants[0]['variant_price'] = $row['price'];
		}
	}

	// $query = "select * from product_variants pv, product_variant_sku pvs where pv.product_id = $id and (pv.product_variants_id = pvs.product_variants_id1 or pv.product_variants_id = pvs.product_variants_id2) order by pv.priority";
	return $variants;
}

function getVariantsArray($array){
	$flag =[];
	foreach ($array as $item) {
		array_push($flag, 1);
	}

	$variants =[];
	$No = 1;
	for ($no=0;$no<count($array);$no++){
		if($flag[$no] == 0) continue;
		$variant_item['no'] = $No;
		$No = $No + 1;
		$variant_item['variant_name'] = $array[$no]['variant_name'];
		$content_temp = [$array[$no]];
		for($x=$no+1;$x<count($array);$x++){
			if($array[$x]['variant_name'] == $variant_item['variant_name']){
				$flag[$x] = 0;
				array_push($content_temp, $array[$x]);
			}
		}
		$content = sortByPriority($content_temp);
		$variant_item['content'] = $content;

		array_push($variants, $variant_item);
	}
	return $variants;
}

function sortByPriority($content_temp){
	$content = $content_temp;
	for($i=0;$i<count($content_temp);$i++){
		for($j=$i+1;$j<count($content_temp);$j++){
			if($content_temp[$i]['priority']>$content_temp[$j]['priority']){
				$temp = $content_temp[$i];
				$content_temp[$i] = $content_temp[$j];
				$content_temp[$j] = $content_temp[$i];
			}
		}
	}
	return $content;
}
?>