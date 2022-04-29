<?php
    class order_detail {
        private $id_order;
        private $id_product;
        private $color;
        private $size;
        private $quantity;
        private $total;

        function __construct($id_order, $id_product, $color, $size, $quanttiy, $total){
            $this->id_order = $id_order;
            $this->id_product = $id_product;
            $this->color = $color;
            $this->size = $size;
            $this->quantity = $quantity;
            $this->total = $total;
        }

        function getId_order(){
            return $this->id_order;
        }
        function setId_order($id_order){
            $this->id_order = $id_order;
        }
        function getId_product(){
            return $this->id_product;
        }
        function setId_product($id_product){
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
        function getTotal(){
            return $this->total;
        }
        function setTotal($total){
            $this->total = $total;
        }

    }

    function addOrderDetail($id_order, $id_product, $color, $size, $quantity, $total){
        $sql = "insert into `order_detail`(id_order, id_product, color, size, quantity, total) values($id_order, $id_product, '$color', '$size', $quantity, $total)";
        return pdo_execute($sql);
    }

    function getOrder_detail($id_order){
        $sql = "select * from `order_detail` where `id_order`=$id_order";
        return pdo_query($sql);
    }