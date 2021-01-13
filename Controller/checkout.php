<?php

include('config/db.php');

function getCheckoutInfo(){
    $str = file_get_contents('config/settings.json');
    $json = json_decode($str);
    
    $checkout_info['header_contents'] = $json->checkout_info->header_contents;
    $checkout_info['description'] = $json->checkout_info->description;
    $checkout_info['product_picture'] = $json->checkout_info->product_picture;
    $checkout_info['user_review_picture'] = $json->checkout_info->user_review_picture;
    $checkout_info['faq'] = $json->checkout_info->faq;

    return $checkout_info;
}

function getUpsellInfo(){
    $str = file_get_contents('config/settings.json');
    $json = json_decode($str);

    $upsell_id_array = [];
    $upsell1_id = $json->upsell->upsell1;
    $upsell2_id = $json->upsell->upsell2;
    if($upsell1_id != "") {
        array_push($upsell_id_array, $upsell1_id);
    }
    if($upsell2_id != "") {
        array_push($upsell_id_array, $upsell2_id);
    }

    global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
    }
    
    $id = 1;
    $upsell_array = [];

    $product_id_info = $json->upsell->product;
    $product_id = $product_id_info->id;
    $product_variants_id1 = $product_id_info->variant_id1;
    $product_variants_id2 = $product_id_info->variant_id2;

    $sql = "SELECT * FROM products WHERE product_id = '$product_id'";

        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $upsell_item = [];
                $upsell_item['id'] = $id;
                $upsell_item['product_name'] = $row['product_name'];
                $upsell_item['product_image'] = $row['product_image'];
            }
        }

    $sql = "SELECT * FROM product_variants WHERE product_id = '$product_id' AND product_variants_id = '$product_variants_id1'";

        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $upsell_item['product_name'] = $upsell_item['product_name'] . " - " . $row['name'];
            }
        }

    $sql = "SELECT * FROM product_variants WHERE product_id = '$product_id' AND product_variants_id = '$product_variants_id2'";

        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $upsell_item['product_name'] = $upsell_item['product_name'] . " , " . $row['name'];
            }
        }
    $sql = "SELECT * FROM product_variant_sku WHERE product_id = '$product_id' AND product_variants_id1 = '$product_variants_id1' AND product_variants_id2 = '$product_variants_id2'";

        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $upsell_item['product_price'] = $row['price'];
            }
        }

    $upsell_item['id'] = $id;
    $id = $id + 1;

    array_push($upsell_array, $upsell_item);
    
    foreach ($upsell_id_array as $upsell_id) {
        $sql = "SELECT * FROM products WHERE product_id = '$upsell_id'";

        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $upsell_item = [];
                $upsell_item['id'] = $id;
                $id = $id + 1;
                $upsell_item['product_name'] = $row['product_name'];
                $upsell_item['product_image'] = $row['product_image'];
                $upsell_item['product_price'] = $row['product_price'];
                array_push($upsell_array, $upsell_item);
            }
        }
    }
    return $upsell_array;
}

function putShippingInfo($email, $firstname, $lastname, $phone, $address, $apartment, $city, $code, $country, $state) {
    global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
    }
    
    $sql = "DELETE FROM leads";
    $result = $con->query($sql);
    
    $sql = "INSERT INTO leads (email, first_name, last_name, phone, address, address2, city, zip, country, state) VALUES ('$email', '$firstname', '$lastname', '$phone', '$address', '$apartment', '$city', '$code', '$country', '$state')";
    $result = $con->query($sql);
}

function getOrderbumpInfo() {
    $str = file_get_contents('config/settings.json');
    $json = json_decode($str);

    global $con;
	if ($con->connect_errno) {
	  //echo "Failed to connect to MySQL: ".$conn->connect_error;
	  exit();
    }

    $orderbump_id = $json->upsell->orderbump;
    
    $sql = "SELECT * FROM products WHERE product_id = '$orderbump_id'";

    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $orderbump['name'] = $row['product_name'];
            $orderbump['price'] = $row['product_price'];
            $orderbump['image_url'] = $row['product_image'];
            $orderbump['description'] = $row['product description'];
        }
    }
    return $orderbump;
}

function getButtonText(){
    $str = file_get_contents('config/settings.json');
    $json = json_decode($str);

    $button_text['tab1'] = $json->button_text->tab1;
    $button_text['tab2'] = $json->button_text->tab2;

    return $button_text;
}