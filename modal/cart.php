<?php

    class cart{
        private $id_user;
        private $id_product;
        private $color;
        private $size;
        private $quantity;

        function __construct($id_user, $id_product, $color, $size, $quantity){
            $this->id_user = $id_user;
            $this->id_product = $id_product;
            $this->color = $color;
            $this->size = $size;
            $this->quantity = $quantity;
        }

        function getIdUser(){
            return $this->id_user;
        }
        function setIdUser($id_user){
            $this->id_user = $id_user;
        }

        function getIdProduct(){
            return $this->id_product;
        }
        function setIdProduct($id_product){
            $this->id_product = $id_product;
        }

        function getColor(){
            return $this->color;
        }
        function setColor($color){
            $this->color = $color;
        }

        function getSize(){
            return $this->size;
        }
        function setSize($size){
            $this->size = $size;
        }

        function getQuantity(){
            return $this->quantity;
        }
        function setQuantity($quantity){
            $this->quantity = $quantity;
        }
    }

    function getCartByIDUser($id){
        $sql = "select * from `cart` where `id_user`=$id";
        return pdo_query($sql);
    }

    function addCart($item){
        $id_user = $item->getIdUser();
        $id_product = $item->getIdProduct();
        $color = $item->getColor();
        $size = $item->getSize();
        $quantity = $item->getQuantity();
        $sql = "insert into `cart`(id_user, id_product, color, size, quantity) values($id_user, $id_product,'$color', '$size', $quantity)";
        pdo_execute($sql);
    }

    function deleteCart($item){
        $id_user = $item->getIdUser();
        $id_product = $item->getIdProduct();
        $color = $item->getColor();
        $size = $item->getSize();
        $quantity = $item->getQuantity();
        $sql = "delete from `cart` where `id_user`=$id_user and `id_product`=$id_product and `color`='$color' and `size`='$size' and `quantity`=$quantity";
        pdo_execute($sql);
    }

    function updateQuantityCart($item){
        $id_user = $item->getIdUser();
        $id_product = $item->getIdProduct();
        $color = $item->getColor();
        $size = $item->getSize();
        $quantity = $item->getQuantity();
        $sql = "update `cart` set `quantity`=$quantity where `id_user`=$id_user and `id_product`=$id_product and `color`='$color' and `size`='$size'";
        $sql = pdo_execute($sql); 
    }
