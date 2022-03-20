<?php
    class user {
        private $fullname;
        private $email;
        private $image;
        private $gender;
        private $birthdate;
        private $address;
        private $telephone;

        public function __construct($fullname, $email, $image, $gender, $birthdate, $address, $telephone){
            $this->fullname = $fullname;
            $this->email = $email;
            $this->image = $image;
            $this->gender = $gender;
            $this->birthdate = $birthdate;
            $this->address = $address;
            $this->telephone = $telephone;
        }

        public function getFullname(){
            return $this->fullname;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getImage(){
            return $this->image;
        }
        public function getGender(){
            return $this->gender;
        }
        public function getBirthdate(){
            return $this->birthdate;
        }
        public function getAddress(){
            return $this->address;
        }
        public function getTelephone(){
            return $this->telephone;
        }
    }

    function getIdUser($email){
        $sql = "select `id_user` from `user` where `email`='$email'";
        $datas = pdo_query($sql);
        extract($datas[0]);
        return $id_user;
    }

    function getFullname($id){
        $sql = "select `fullname` from `user` where `id_user`='$id'";
        $datas = pdo_query($sql);
        extract($datas[0]);
        return $fullname;
    }

    function checkFullname($fullname){
        $sql = "select `fullname` from user where `fullname`='$fullname'";
        $datas = pdo_query($sql);
        if($datas){
            return true;
        }else{
            return false;
        }
    }

    function checkEmail($email){
        $sql = "select `email` from user where `email`='$email'";
        $datas = pdo_query($sql);
        if($datas){
            return true;
        }else{
            return false;
        }
    }

    function checkTelephone($telephone){
        $sql = "select `telephone` from user where `telephone`='$telephone'";
        $datas = pdo_query($sql);
        if($datas){
            return true;
        }else{
            return false;
        }
    }

    function addUser($User){
        $fullname = $User->getFullname();
        $email = $User->getEmail();
        $sql = "insert into user(fullname, email) values('$fullname','$email')";
        pdo_execute($sql);
    }

    function deleteUser($id){
        $sql = "delete from `user` where id_user=$id";
        pdo_execute($sql);
    }

    function updateUser($User, $id){
        $fullname = $User->getFullname();
        $email = $User->getEmail();
        $gender = $User->getGender();
        $birthdate = $User->getBirthdate();
        $address = $User->getAddress();
        $telephone = $User->getTelephone();
        $image = $User->getImage();
        $sql = "update `user` SET `fullname`='$fullname',`email`='$email',`gender`='$gender',`birthdate`='$birthdate',`address`='$address',`telephone`='$telephone',`avatar`='$image' WHERE `id_user`= $id";
        pdo_execute($sql);
    }