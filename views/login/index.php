<?php
    if(isset($test)){
        header($test);
    }
    include '../layouts/default.php';
    include '../layouts/header.php';
    if(isset($_GET['act'])){
        $act = $_GET['act'];
        switch($act){
            case 'home':
                include 'home.php';
                break;
            case 'log':
                include '../../modal/pdo.php';
                include '../../modal/accounts.php';
                include '../../modal/user.php';
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);
                    if(checkLogin($username, $password)){
                        $rule = getRuleAccount($username);
                        $id_user = getIdUserAcc($username);
                        $fullname = getFullname($id_user);
                        $_SESSION['rule'] = $rule;
                        $_SESSION['user'] = $fullname;
                        echo "<meta http-equiv=\"refresh\" content=\"0;URL=..\home\index.php\">";
                    }else{
                        $massage = 'Tên đăng nhập hoặc mật khẩu không đúng';
                    }
                }
                include 'home.php';
                break;
            case 'out':
                unset($_SESSION['user']);
                unset($_SESSION['rule']);
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
                break;
            default:
                include 'home.php';
        }
    }else{
        include 'home.php';
    }

    include '../layouts/footer.php';
    if(isset($massage) && $massage != ''){
        echo "<script> alert('$massage'); </script>";
    }
