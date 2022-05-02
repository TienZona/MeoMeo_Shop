<?php
    include '../layouts/default.php';
    if(isset($_SESSION['rule']) && $_SESSION['rule'] == 'admin'){
        include '../layouts/header.php';
        if(isset($_GET['act'])){
            $act = $_GET['act'];
            switch($act){
                case 'home':
                    include 'account/home.php';
                    break;
                case 'account':
                    include 'account/home.php';
                    break;
                case 'deleteAcc':
                    if((isset($_GET['id']) && ($_GET['id'] != 1))){
                        $id = $_GET['id'];
                        deleteAccount($id);
                    }else{
                        echo "<script type='text/javascript'>alert('Không thể xóa tài khoản admin!');</script>";
                    }
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=..\admin\index.php?act=account\">";
                    include 'account/home.php';
                    break;
                case 'updateAcc':
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $id = $_GET["id"];
                        $username = $_POST['username'];
                        $password = md5(htmlspecialchars($_POST["password"]));
                        updateUserName($username, $id);
                        updatePassWord($password, $id);
                        echo "<meta http-equiv=\"refresh\" content=\"0;URL=..\admin\index.php?act=account\">";
                        include 'account/home.php';
                    }
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=..\admin\index.php?act=account\">";
                    include 'account/home.php';
                    break;
                case 'user':
                    include 'user/home.php';
                    break;
                case 'deleteUser':
                    echo "<script type='text/javascript'>alert('Không thể xóa người dùng!');</script>";
                    include 'user/home.php';

                    break;
                case 'updateUser':
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $id = $_GET["id"];
                        $fullname = htmlspecialchars($_POST['fullname']);
                        $email = htmlspecialchars($_POST['email']);
                        $gender = $_POST['gender'];
                        $birthdate = $_POST['birthdate'];
                        $address = $_POST['address'];
                        $tel = $_POST['telephone'];
                        $user = new user( $fullname, $email, '', $gender, $birthdate, $address, $tel);
                        updateUser($user, $id);
                    }
                    include 'user/home.php';
                    break;
                case 'product':
                    include 'product/home.php';
                    break;
                case 'addProduct':
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        include 'upload.php';
                        if($uploadOk){
                            $name = htmlspecialchars($_POST['name']);
                            $id_category = htmlspecialchars($_POST['type']);
                            $description = htmlspecialchars($_POST['description']);
                            $price = $_POST['price'];
                            $image ="../../img/". basename($_FILES["file"]["name"]);
                            $product = new product(1,$name, $description, $price, $image, $id_category);
                            addProduct($product);
                            $id_product = getIdProduct($name);
                            $colors = $_POST['color'];
                            $sizes = $_POST['size'];
                            $numbers = $_POST['number'];
                            $index = 0;
                            foreach($colors as $color){
                                $product_detail = new product_detail($id_product, $color, $sizes[$index], $numbers[$index]);
                                addProduct_detail($product_detail);
                                $index++;
                            }
                            echo "<script>alert('Thêm sản phẩm thành công!')</script>";
                        }else{
                            echo "<script>alert('Vui lòng tải ảnh sản phẩm!')</script>";
                        }
                    }

                    include 'product/home.php';
                    break;
                case 'deleteProduct':
                    if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_GET['id']))){
                        $id = $_GET['id'];
                        deleteProduct_detail($id);
                        deleteProduct($id);
                        echo "<script>alert('Xóa thành công!')</script>";
                    }
                    include 'product/home.php';
                    break;
                case 'updateProduct':

                    if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_GET['id']))){
                        $id = $_GET['id'];
                        $image ="../../img/". basename($_FILES["file"]["name"]);
                        if($image == '../../img/'){
                            $image = getImageOfProduct($id);
                        }
                        include 'upload.php';
                        $name = htmlspecialchars($_POST['name']);
                        $id_category = htmlspecialchars($_POST['type']);
                        $description = htmlspecialchars($_POST['description']);
                        $price = $_POST['price'];

                        
                        $product = new product($id,$name, $description, $price, $image, $id_category);
                        updateProduct($product);

                        deleteProduct_detail($id);
                        $colors = $_POST['color'];
                        $sizes = $_POST['size'];
                        $numbers = $_POST['number'];
                        $index = 0;
                        foreach($colors as $color){
                            $product_detail = new product_detail($id, $color, $sizes[$index], $numbers[$index]);
                            addProduct_detail($product_detail);
                            $index++;
                        }
                        echo "<script>alert('Cập nhật thành công!')</script>";
                    }

                    include 'product/home.php';
                    break;
                case 'category':
                    include 'category/home.php';
                    break;
                case 'addCategory':
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $name = htmlspecialchars($_POST['name']);
                        addCategory($name);
                        echo "<script>alert('Thêm thành công!')</script>";
                    }
                    include 'category/home.php';
                    break;
                case 'deleteCategory':
                    if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_GET['id']))){
                        $id = $_GET['id'];
                        if(!checkCategoryProduct($id)){
                            deleteCategory($id);
                            echo "<script>alert('Xóa thành công!')</script>";
                        }else{
                            echo "<script>alert('Không thể xóa!')</script>";
                        }
                        
                    }

                    include 'category/home.php';
                    break;
                case 'updateCategory':
                    if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_GET['id']))){
                        $id = $_GET['id'];
                        $name = htmlspecialchars($_POST['name']);
                        updateCategory($name, $id);
                        echo "<script>alert('Cập nhật thành công!')</script>";
                    }
                    include 'category/home.php';
                    break;
                case 'order':
                    if(isset($_GET['order'])){
                        $actOrder = $_GET['order'];
                        switch($actOrder){
                            case 'all':
                                $orders = getAllOrder(); break;
                            case 'confirm':
                                $orders = getAllOrderWaiting(); break;
                            case 'transport':
                                $orders = getAllOrderTransport(); break;
                            case 'success':
                                $orders = getAllOrderSuccess(); break;
                            case 'cancel':
                                $orders = getAllOrderCancel(); break;
                            default:
                                
                        }
                    }else{
                        $actOrder = 'all';
                        $orders = getAllOrder();
                    }
                    include 'order/home.php';
                    break;
                case 'confirmOrder':
                    if(isset($_POST['id_orders'])){
                        $id_orders = $_POST['id_orders'];
                        foreach($id_orders as $id){
                            $details = getOrder_detail($id);
                            foreach($details as $detail){
                                extract($detail);
                                reduceNumber($id_product,  $color, $size, $quantity);
                            }
                            confirmOrder($id);
                            // create notify for user
                            $id_user = getId_user($id);
                            $title = "Đơn hàng $id đã được xác nhận";
                            $content = "Sản phẩm đang được giao hàng vui lòng chờ đợi";
                            $image = "";
                            createNotify($id_user, $title, $content, $image);
                        }
                    }

                    include 'order/home.php';
                    break;
                case 'cancelOrder':
                    if(isset($_POST['id_orders'])){
                        $id_orders = $_POST['id_orders'];
                        foreach($id_orders as $id){
                            cancelOrder($id);
                            // create notify for user
                            $id_user = getId_user($id);
                            $title = "Đơn hàng $id đã bị hủy";
                            $content = "Xin lỗi đơn hàng của bạn không thể cung cấp";
                            $image = "";
                            createNotify($id_user, $title, $content, $image);
                        }
                    }

                    include 'order/home.php';
                    break;
                case 'static':
                    include 'static/home.php';
                    break;
                default:
                include 'account/home.php';
            }
        }else{
            include 'account/home.php';

        }
        $massage = 'Cập nhật thành công!';
        include '../layouts/footer.php';
    }

    