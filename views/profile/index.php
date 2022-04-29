<?php
    include '../layouts/default.php';
    if(isset($_GET['act']) && isset($_SESSION['user'])){
        include '../layouts/header.php';
        $act = $_GET['act'];
        switch($act){
            case 'profile':
                include 'profile.php';
                break;
            case 'updateUser':
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $id = $_GET["id"];
                    $fullname = htmlspecialchars($_POST['fullname']);
                    $email = htmlspecialchars($_POST['email']);
                    $gender = $_POST['gender'];
                    $birthdate = $_POST['birthdate'];
                    $address = $_POST['address'];
                    $tel = $_POST['telephone'];
                    $avatar = getAvatar($id);
                    $user = new user( $fullname, $email, $avatar, $gender, $birthdate, $address, $tel);
                    updateUser($user, $id);
                    echo "<script>alert('Cập nhật hồ sơ thành công!')</script>";
                }
                include 'profile.php';
                break;
            case 'updateAvatar':
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    include 'upload.php';
                    if($uploadOk){
                        $id = $_GET['id'];
                        $avatar ="../../img/". basename($_FILES["file"]["name"]);
                        updateAvatar($id , $avatar);
                        echo "<script>alert('Cập nhật ảnh đại diện thành công!')</script>";
                    }
                    
                }

                include 'profile.php';
                break;
            case 'updatePW':
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $id = $_GET['id'];
                    $password_old = md5(htmlspecialchars($_POST["password_old"]));
                    if(checkPassword($password_old, $id)){
                        $password = md5(htmlspecialchars($_POST["password_new"]));
                        updatePassWord($password, $id);
                        echo "<script>alert('Đổi mật khẩu thành công!')</script>";
                    }else{
                        echo "<script>alert('Mật khẩu cũ không đúng!')</script>";
                    }
                }
                include 'profile.php';
                break;
            default:
                include 'profile.php';
        }
        include '../layouts/footer.php';
    }

