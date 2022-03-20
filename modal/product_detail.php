<?php

    class product_detail{
        private $id_product;
        private $color;
        private $size;
        private $number;

        function __construct($id_product, $color, $size, $number){
            $this->id_product = $id_product;
            $this->color = $color;
            $this->size = $size;
            $this->number = $number;
        }
        function getIdProduct(){
            return $this->id_product;
        }
        function getColor(){
            return $this->color;
        }
        function getSize(){
            return $this->size;
        }
        function getNumber(){
            return $this->number;
        }
        function setIdProduct($id_product){
            $this->id_product = $id_product;
        }
        function setIdColor($color){
            $this->color = $color;
        }
        function setIdSize($size){
            $this->size = $size;
        }
        function setNumber($number){
            $this->number = $number;
        }
    }

    function getAllProduct_detail($id_product){
        $sql = "select * from `product_detail` where `id_product`=$id_product";
        return pdo_query($sql);
    }

    function getAllColorOfProduct($id_product){
        $sql = "select distinct `color` from `product_detail` where `id_product`=$id_product";
        return pdo_query($sql);
    }

    function getAllSizeOfProduct($id_product){
        $sql = "select distinct `size` from `product_detail` where `id_product`=$id_product";
        return pdo_query($sql);
    }

    function getNumberOfProduct($id_product){
        $sql = "select `number` from `product_detail` where `id_product`=$id_product";
        $data = pdo_query($sql);
        extract($data[0]);
        return $number;
    }

    function addProduct_detail($product_detail){
        $id_product = $product_detail->getIdProduct();
        $color = $product_detail->getColor();
        $size = $product_detail->getSize();
        $number = $product_detail->getNumber();
        $sql = "insert into `product_detail`(id_product, color, size, number) values('$id_product','$color', '$size', '$number')";
        pdo_execute($sql);
    } 

    function deleteProduct_detail($id_product){
        $sql = "delete from `product_detail` where `id_product`=$id_product";
        pdo_execute($sql);
    }