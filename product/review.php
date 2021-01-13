<?php 
include '../Controller/function.php';	

$answer = $_REQUEST['answer'];
$answerInput = $_REQUEST['answerInput'];
if($answer != $answerInput) {
    header('Location: /product/comments-post.php');
    die();
}
$product_id = $_REQUEST['product_id'];
$stars = $_REQUEST['rating'];
if($stars == '') $stars = 0;
$description = $_REQUEST['description'];
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];

$ts = date('Y-m-d H:i:s');

$target_dir = "img/";
$myFile = $_FILES['imagesUpload'];
$fileCount = count($myFile["name"]);

if($myFile['name'][0] == "") $fileCount = 0;
$image_url_array = [];
for ($i = 0; $i < $fileCount; $i++) {
    $target_file = $target_dir . basename($_FILES["imagesUpload"]["name"][$i]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["imagesUpload"]["tmp_name"][$i], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["imagesUpload"]["name"][$i])). " has been uploaded.";
            array_push($image_url_array, $target_file);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
$product_slug = putReviewInfo($product_id, $name, $email, $description, $stars, $image_url_array, $ts);

header('Location: /product/' . $product_slug);
?>
