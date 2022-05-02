<?php
    include '../layouts/default.php';
    if(isset($_GET['act']) && isset($_SESSION['id_user'])){
        include '../layouts/header.php';
        $act = $_GET['act'];
        $id_user = $_SESSION['id_user'];
        $orders = getOrderById_user($id_user);
        switch($act){
            case 'home':
                include 'home.php';
                break;
            default:
                include 'home.php';
        }
        include '../layouts/footer.php';
    }