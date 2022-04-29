<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="\MeoMeo_Shop\library\fontawesome-free-5.15.3-web\css\all.min.css">
    <link rel="stylesheet" href="\MeoMeo_Shop\library\fontawesome-free-6.1.0-web\css\all.min.css">

    <link rel="stylesheet" href="\MeoMeo_Shop\library\bootstrap\bootstrap-5.1.3-dist\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="\MeoMeo_Shop\library\slick\slick-1.8.1\slick\slick.css"\>
    <link rel="stylesheet" href="\MeoMeo_Shop\css\base.css">
    <link rel="stylesheet" href="\MeoMeo_Shop\css\main.css">
    <!--  JQuery  -->
    <script type="text/javascript" src="\MeoMeo_Shop\library\jQuery.js"></script>
    <script type="text/javascript" src="\MeoMeo_Shop\js\jquery.validater.js"></script>
    <script type="text/javascript" src="\MeoMeo_Shop\js\validator.js"></script>

    <!-- slick slide -->
    <script type="text/javascript" src="..\..\library\slick\slick-1.8.1\\slick\slick.min.js"></script>
    <script type="text/javascript" src="\MeoMeo_Shop\js\slickslider.js"></script>
    
    <!-- bootstrap -->
    <script type="text/javascript" src="\MeoMeo_Shop\library\bootstrap\bootstrap-5.1.3-dist\js\bootstrap.min.js"></script>
</head>

<?php
    include '../../modal/pdo.php';
    include '../../modal/product.php';
    include '../../modal/product_detail.php';
    include '../../modal/category.php';
    include '../../modal/cart.php';
    include '../../modal/accounts.php';
    include '../../modal/color.php';
    include '../../modal/size.php';
    include '../../modal/user.php';
    include '../../modal/order.php';
    include '../../modal/order_detail.php';

    session_start();  
    if(isset($_SESSION['id_user'])){
        $id_user = $_SESSION['id_user'];
    }
?>
