<?php
    include './Controller/function.php';

    $product_id = $_REQUEST['id'];
    $variant_id1 = $_REQUEST['id1'];
    $variant_id2 = $_REQUEST['id2'];

    $product_variants_id = [];
    $product_variants_id[1] = $variant_id1;
    if($variant_id2 == "none") $select_count = 1;
    else {
        $select_count = 2;
        $product_variants_id[2] = $variant_id2;
    }

    $variant_info = getVariantInfo($product_id, $select_count, $product_variants_id);

    echo json_encode($variant_info);