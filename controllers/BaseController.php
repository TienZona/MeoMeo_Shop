<?php

    if(isset($_GET['act'])){
        $act = $_GET['act'];

        include '../views/layouts/default.php';
        include '../views/layouts/header.php';

        switch($act){
            case 'home': 
                include '../views/home/home.php';
                break;
            case 'admin':
                include 'adminController.php';
                include '../views/admin/home.php';
                break;
            case 'product':
                include '../views/product/home.php';
                break;
            case 'login':
                include 'login.php';
                include '../views/login/home.php';
                break;
            case 'register':
                include 'register.php';
                include '../views/register/home.php';
                break;
            default:
                include '../views/home/home.php';
        }

        include '../views/layouts/footer.php';
    }else{
        include '../views/home/home.php';
    }
