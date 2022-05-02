<?php
    include '../layouts/default.php';
    include '../layouts/header.php';
    
    $listProduct = null;
    $page = 0;
    $number = 8;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    if(isset($_GET['act'])){
        $act = $_GET['act'];
        switch($act){
            case 'home':
                $listProduct = getAllProduct();
                include 'home.php';
                break;
            case 'search':
                if(isset($_GET['tim'])){
                    $tim = $_GET['tim'];
                    switch($tim){
                        case 'giacao':
                            $listProduct =  getProductExpensive(); break;
                        case 'giathap':
                            $listProduct =  getProductLowest(); break;
                        case 'banchay':
                            $listProduct = null; break;
                        case 'giamgia':
                            $listProduct = null; break;
                        default: 
                            $listProduct = null;
                    }
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }
                }else{
                    $listProduct = null;
                }
                include 'home.php';
                break;
            case 'category':
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $listProduct = getProductByCategory($id);
                }else{
                    $listProduct = getAllProduct();
                }
                include 'home.php';
                break;
            default:
                // $listProduct = getAllProduct();
                include 'home.php';
        }
    }else if(isset($_GET['search'])){
        $search = $_GET['search'];
        $listProduct = getProductBySearch($search);
        include 'home.php';
    }
    else{
        include 'home.php';
    }
    

    include '../layouts/footer.php';

    