<?php
    include '../modal/accounts.php';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        add();
    }

    function add(){
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $date = date("Y-m-d");
        if(true){
            $data = new accounts($fullname, $username, $email, $password, $date);
            addAcount($data);
        }

        // if(checkFullname($fullname)){
        //     $_SESSION['status'] = "Họ và tên đã được sử dụng!";
        //     header('Location: re');
        // }
        // if(isset($_POST["btn-login"])){
        //     $name = $_POST["fullname"];
        //     if(checkFullname($name)){
                
        //     }
        // }
    }


    $_SESSION['test'] = 'TEST';