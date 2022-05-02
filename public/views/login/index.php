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
               
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);
                    if(checkLogin($username, $password)){
                        $rule = getRuleAccount($username);
                        $id_user = getIdUserAcc($username);
                        $fullname = getFullname($id_user);
                        $_SESSION['rule'] = $rule;
                        $_SESSION['user'] = $fullname;
                        $_SESSION['id_user'] = $id_user;
                        echo "<meta http-equiv=\"refresh\" content=\"0;URL=..\home\index.php\">";
                        echo "<script>alert('Đăng nhập thành công!')</script>";
                    }else{
                        $massage = 'Tên đăng nhập hoặc mật khẩu không đúng';
                    }
                }
                include 'home.php';
                break;
            case 'out':
                unset($_SESSION['user']);
                unset($_SESSION['rule']);
                unset($_SESSION['id_user']);
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
