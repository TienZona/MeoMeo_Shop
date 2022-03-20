<?php
    include '../../modal/pdo.php';
    include '../../modal/accounts.php';
    include '../../modal/user.php';
    include '../../modal/category.php';
    include '../../modal/product.php';
    include '../../modal/color.php';
    include '../../modal/size.php';
    include '../../modal/product_detail.php';
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
                        $username = htmlspecialchars($_POST["username"]);
                        $password = md5(htmlspecialchars($_POST["password"]));
                        if(!checkUsername($username)){
                            updateUserName($username, $id);
                            updatePassWord($password, $id);
                            echo "<meta http-equiv=\"refresh\" content=\"0;URL=..\admin\index.php?act=account\">";
                            include 'account/home.php';
                        }else{
                            echo "<script type='text/javascript'>alert('Tên tài khoản đã được sử dụng!');</script>";
                        }
                    }
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=..\admin\index.php?act=account\">";
                    include 'account/home.php';
                    break;
                case 'user':
                    include 'user/home.php';
                    break;
                case 'deleteUser':
                    if((isset($_GET['id']) && ($_GET['id'] != 1))){
                        $id = $_GET['id'];
                        if(!checkIdUser($id)){
                            deleteUser($id);   
                        }else{
                            echo "<script type='text/javascript'>alert('Không thể xóa người dùng!');</script>";
                        }
                    }else{
                        echo "<script type='text/javascript'>alert('Không thể xóa người dùng admin!');</script>";
                    }
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
                            $image = basename($_FILES["img"]["name"]);
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
                        }else{
                            // echo "<script>alert($errorImg)</script>";
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
                        $image = basename($_FILES["file"]["name"]);
                        if($image == ''){
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

    