<?php
    include './Controller/checkout.php';
    
    $email = $_REQUEST['email'];
    $firstname = $_REQUEST['firstname'];
    $lastname = $_REQUEST['lastname'];
    $phone = $_REQUEST['phone'];
    $address = $_REQUEST['address'];
    $apartment = $_REQUEST['apartment'];
    $city = $_REQUEST['city'];
    $code = $_REQUEST['code'];
    $country = $_REQUEST['country'];
    $state = $_REQUEST['state'];

    putShippingInfo($email, $firstname, $lastname, $phone, $address, $apartment, $city, $code, $country, $state);