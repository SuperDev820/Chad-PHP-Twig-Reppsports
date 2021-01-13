<?php 
include '../Controller/function.php';	

$review_id = $_REQUEST['review_id'];
$action = $_REQUEST['action'];

$updatedvote = updateVote($action, $review_id);

echo $updatedvote;
?>
