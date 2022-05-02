<?php
    include '../layouts/default.php';
    include '../layouts/header.php';
    if(isset($_GET['act'])){
        $act = $_GET['act'];
        $products = getNewProduct();
        switch($act){
            case 'home':
                include 'home.php';
                break;
            default:
                include 'home.php';
        }
    }else{
        $products = getNewProduct();
        include 'home.php';
    }

    include '../layouts/footer.php';
