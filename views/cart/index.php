<?php
    include '../layouts/default.php';
    include '../layouts/header.php';
    if(isset($_GET['act']) && isset($_GET['id'])){
        $act = $_GET['act'];
        $id = $_GET['id'];
        $carts = getCartByIDUser($id);
        switch($act){
            case 'home':
                include 'home.php';
                break;
            case 'updateCart':
                if(isset($_POST['id_product'])){
                    $id_product = $_POST['id_product'];
                    $color = $_POST['color'];
                    $size = $_POST['size'];
                    $quantity = $_POST['quantity'];
                    $item = new cart($id_user, $id_product, $color, $size, $quantity);
                    updateQuantityCart($item);
                }
            case 'order':
                // list product item
                $id_products = $_POST['id_product'];
                $colors = $_POST['color'];
                $sizes = $_POST['size'];
                $names = $_POST['name'];
                $quantitys = $_POST['number'];
                $totals = $_POST['total'];

                // information order
                $fullname = $_POST['fullname'];
                $telephone = $_POST['telephone'];
                $address = $_POST['address1'];
                $address_detail = $_POST['address2'];
                $note = $_POST['note'];
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $date_create = date("Y-m-d h:i:sa");
                $date_ship = "0000-00-00 00:00:00";
                $total_price = 0;
                foreach($totals as $total){
                    $total_price += $total;
                }
                $message  = '';
                $state = 0;
                //add order
                addOrder($id, $date_create, $date_ship, $total_price, $address, $address_detail, $state, $message, $fullname, $telephone, $note);
                $data = getIdOrder($id, $date_create);
                extract($data[0]);
                for($i = 0;  $i < count($id_products); $i++){
                    $id_product = $id_products[$i];
                    $color = $colors[$i];
                    $size = $sizes[$i];
                    $quantity = $quantitys[$i];
                    $total = $totals[$i];
                    $item = new cart($id, $id_product, $color, $size, $quantity);
                    addOrderDetail($id_order, $id_product, $color, $size, $quantity, $total);
                    deleteCart($item);
                }
                echo "<script>alert('Đặt hàng thành công vui lòng chờ đợi thông báo!')</script>";
                include 'home.php';
               
                break;
            default:
                include 'home.php';

        }
    }else{
        include 'home.php';
    }

    include '../layouts/footer.php';
