<?php   

    include '../layouts/default.php';
    include '../layouts/header.php';
    if(isset($_GET['act'])){

        $act = $_GET['act'];
        switch($act){
            case 'reg': 
                include 'home.php';
                
                global $massage;
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $fullname = $_POST['fullname'];
                    $email = $_POST['email'];
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);
                    $date = date("Y-m-d");
                    $Account = new account($username, $password, $date);
                    $User = new user($fullname, $email, '', '', '', '', '');
                    if(checkEmail($email)){
                        $massage = 'Email đã được sử dụng !';
                    }else
                    if(checkUsername($username)){
                        $massage = 'Tên tài khoản đã được sử dụng !';
                    }else{
                        addUser($User);
                        $id = getIdUser($email);
                        addAcount($Account, $id);
                        $massage = 'Đăng ký thành công!';
                        echo "<meta http-equiv=\"refresh\" content=\"0;URL=..\login\index.php\">";
                    }
                }
                function add($data){ 
                    addAcount($data);
                    
                }
                
                break;
            case 'home':
                include 'home.php';
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
