<?php
    include '../layouts/default.php';
    include '../layouts/header.php';
    $listProduct = null;
    $page = 0;
    $number = 4;

    $id_product = $_GET['id'];
    
    if(isset($_POST['id_user']) && isset($_POST['id_product'])){
        $id_user = $_POST['id_user'];
        $id_product = $_POST['id_product'];
        $color = $_POST['color'];
        $size = $_POST['size'];
        $quantity = $_POST['quantity'];
        $item = new cart($id_user, $id_product, $color, $size, $quantity);
        addCart($item); 
    }

    if(isset($_GET['act'])){
        $act = $_GET['act'];
        switch($act){
            case 'info':
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $product = getProductById($id);
                    extract($product[0]);
                    $category = getCategoryName($id_category);
                    $details = getAllProduct_detail($id);
                    $listProduct = getProductWithCategory($id_category, $id);
                    include 'home.php';
                }
                break;
                
            default: break;
        }
    }
    else{
        include 'home.php';
    }
    

    include '../layouts/footer.php';