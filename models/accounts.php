<?php
    class account {
        private $username;
        private $password;
        private $rule = 'user';
        private $date = '2022-01-01';

        public function __construct($username, $password, $date){
            $this->username = $username;
            $this->password = $password;
            $this->date = $date;
        }

        public function getUserName(){
            return $this->username;
        }

        public function getPassword(){
            return $this->password;
        }

        public function getRule(){
            return $this->rule;
        }

        public function getDate(){
            return $this->date;
        }
    }

    function addAcount($Account, $id){
        $username = $Account->getUserName();
        $password = $Account->getPassword();
        $rule = $Account->getRule();
        $date = $Account->getDate();
        $sql = "insert into account(username, password, rule, date_create, id_user) values('$username','$password','$rule', '$date', $id)";
        pdo_execute($sql);
    }

    function checkUsername($username){
        $sql = "select `username` from account where `username`='$username'";
        $datas = pdo_query($sql);
        if($datas){
            return true;
        }else{
            return false;
        }
    }

    function checkPassword($password1, $id){
        $sql = "select `password` from account where `id_account`=$id";
        $datas = pdo_query($sql);
        extract($datas[0]);
        if($password1 == $password)
            return true;
        else    
            return false;
    }

    function checkLogin($username, $password){
        $sql = "select `username`,`password` from account where `username`='$username' and `password`='$password'";
        $datas = pdo_query($sql);
        if($datas){
            return true;
        }else{
            return false;
        }
    }

    function checkIdUser($id){
        $sql = "select `id_user` from account where `id_user`=$id";
        $datas = pdo_query($sql);
        if($datas){
            return true;
        }else{
            return false;
        }
    }



    function getRuleAccount($username){
        $sql = "select  `rule` from account where `username`='$username'";
        $datas = pdo_query($sql);
        foreach($datas as $data){
            extract($data);
            return $rule;
        }
    }

    function getUsername($username){
        $sql = "select  `fullname` from account where `username`='$username'";
        $datas = pdo_query($sql);
        foreach($datas as $data){
            extract($data);
            return $fullname;
        }
    }

    function getIdUserAcc($username){
        $sql = "select * from account where `username`='$username'";
        $datas = pdo_query($sql);
        if($datas){
            extract($datas[0]);
            return $id_user;
        }else{
            return '';
        }
    }


    function deleteAccount($id){
        $sql = "delete from `account` where id_account=$id";
        pdo_execute($sql);
    }

    function updateUserName($username, $id){
        $sql = "update `account` set `username`='$username' where id_account=$id";
        pdo_execute($sql);
    }

    function updatePassWord($password, $id){
        $sql = "update `account` set `password`='$password' where id_account=$id";
        pdo_execute($sql);
    }