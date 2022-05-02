<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeoMeo</title>
    
    <link rel="stylesheet" href="..\..\library\fontawesome-free-5.15.3-web\css\all.min.css">
    <link rel="stylesheet" href="..\..\library\fontawesome-free-6.1.0-web\css\all.min.css">

    <link rel="stylesheet" href="..\..\library\bootstrap\bootstrap-5.1.3-dist\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="..\..\library\slick\slick-1.8.1\slick\slick.css"\>
    <link rel="stylesheet" href="..\..\css\base.css">
    <link rel="stylesheet" href="..\..\css\main.css">
    <!--  JQuery  -->
    <script type="text/javascript" src="..\..\js\jQuery.js"></script>
    <script type="text/javascript" src="..\..\library\jquery.validater.js"></script>
    <script type="text/javascript" src="..\..\js\validator.js"></script>

    <!-- slick slide -->
    <script type="text/javascript" src="..\..\library\slick\slick-1.8.1\\slick\slick.min.js"></script>
    <script type="text/javascript" src="..\..\js\slickslider.js"></script>
    
    <!-- bootstrap -->
    <script type="text/javascript" src="..\..\library\bootstrap\bootstrap-5.1.3-dist\js\bootstrap.min.js"></script>
</head>

<?php
    include '../../../models/pdo.php';
    include '../../../models/product.php';
    include '../../../models/product_detail.php';
    include '../../../models/category.php';
    include '../../../models/cart.php';
    include '../../../models/accounts.php';
    include '../../../models/color.php';
    include '../../../models/size.php';
    include '../../../models/user.php';
    include '../../../models/order.php';
    include '../../../models/order_detail.php';
    include '../../../models/notify.php';

    session_start();  
    if(isset($_SESSION['id_user'])){
        $id_user = $_SESSION['id_user'];
    }
?>
