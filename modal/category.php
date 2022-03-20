<?php
    class category {
        private $id;
        private $name;

        function _construct($name){
            $this->name = $name;
        }

        function getName(){
            return $this->name;
        }

        function setName($name){
            $this->name = $name;
        }
    }

    function getAllCategory(){
        $sql = "select * from `category`";
        return pdo_query($sql);
    }

    function getCategoryName($id){
        $sql = "select `name` from `category` where `id_category`=$id";
        $data = pdo_query($sql);
        extract($data[0]);
        return $name;
    }


    function addCategory($name){
        $sql = "insert into category(name) values('$name')";
        pdo_execute($sql);
    }

    function deleteCategory($id){
        $sql = "delete from category where `id_category`=$id";
        pdo_execute($sql);
    }

    function updateCategory($name, $id){
        $sql = "update `category` set `name`='$name' where `id_category`=$id";
        pdo_execute($sql);
    }

    function checkCategory($name){
        $sql = "select * from `category` where `name`=$name";
        $data = pdo_query($sql);
        return $data ? true : false;
    }
