
<?php include_once("config.php"); ?>


<?php   if (isset($_SESSION['logged_in'])) if($_SESSION['logged_in']== "false"){
    $message = "Login first";
    echo "<script type='text/javascript'>alert('$message');window.location.href='signin.php';</script>";
header("Location: signin.php");
exit;
}  ?>


<?php

//if((time() - $_SESSION['last_login_timestamp']) > 900) // 900 = 15 * 60
//{
//    unset($_SESSION['user_id']);
//    $_SESSION['logged_in'] = "false";
//    $message = "Automatic logout security.";
//    echo "<script type='text/javascript'>alert('$message');window.location.href='index.php';</script>";
//    exit;
//}
//else
//{
//    $_SESSION['last_login_timestamp'] = time();
//}



?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $system_title; ?> </title>
    <link rel="shortcut icon" href="assets/images/logo.png"/>
    <meta name="description" content="<?= $system_description; ?>">
    <meta name="author" content="">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Plugins -->

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

</head>
<body>
<img src="head.png" width="100%" height="15%">
<style>
    body {
        
        background-image: url('assets/images/bg.jpg'); 
        background-attachment: fixed;
        background-size: 100% 100%;
    }

    table{
        width:100%;
    }
    #example_filter{
        float:right;
    }
    #example_paginate{
        float:right;
    }
    label {
        display: inline-flex;
        margin-bottom: .5rem;
        margin-top: .5rem;

    }


    .sidebar-nav {
        padding: 9px 0;
    }

    .bloc_left_price {
        color: #c01508;
        text-align: center;
        font-weight: bold;
        font-size: 100%;
    }

    .category_block li:hover {
        background-color: #007bff;
    }

    .category_block li:hover a {
        color: #ffffff;
    }

    .category_block li a {
        color: #343a40;
    }

    .add_to_cart_block .price {
        color: #c01508;
        text-align: center;
        font-weight: bold;
        font-size: 200%;
        margin-bottom: 0;
    }

    .add_to_cart_block .price_discounted {
        color: #343a40;
        text-align: center;
        text-decoration: line-through;
        font-size: 140%;
    }

    .product_rassurance .list-inline li:hover {
        color: #343a40;
    }

    .reviews_product .fa-star {
        color: gold;
    }

    .pagination {
        margin-top: 20px;
    }

    footer {
        background: #00008B;
        padding: 40px;
    }

    footer a {
        color: #f8f9fa !important
    }

</style>
<section class=" text-center">
    <div class="container">
<!--        <h1 class="jumbotron-heading">  --><?//=$system_title;?><!-- </h1>-->
<!--        <p class="lead text-muted mb-0">Welcome, --><?//=$_SESSION['fullname'];?><!--</p>-->
    </div>
</section>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- jQuery and Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>

<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>


<?php include_once ('layout/navbar.php');?>