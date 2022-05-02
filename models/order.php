<?php

    class order{
        private $id_order;
        private $id_user;
        private $date_create;
        private $date_ship;
        private $total_price;
        private $address;
        private $address_detail;
        private $state;  // 0 = waiting, 1 = confirm, 2 = cancel, 3 = transport, 4 = success
        private $message;
        private $name;
        private $telephone;
        private $note;


        function __construct( $id_order, $id_user, $date_create, $date_ship, $total_price, $address, $address_detail, $state, $message, $name, $telephone, $note){
            $this->id_order = $id_order;
            $this->id_user = $id_user;
            $this->date_create = $date_create;
            $this->date_ship = $date_ship;
            $this->total_price = $total_price;
            $this->address = $address;
            $this->address_detail = $address_detail;
            $this->state = $state;
            $this->message = $message;
            $this->name = $name;
            $this->telephone = $telephone;
            $this->note = $note;
        }

        function getId_order(){
            return $this->id_order;
        }
        function setId_order($id_order){
            $this->id_order = $id_order;
        }
        function getId_user(){
            return $this->id_user;
        }
        function setId_user($id_user){
            $this->id_user = $id_user;
        }
        function getDate_create(){
            return $this->date_create;
        }
        function setDate_create($date_create){
            $this->date_create = $date_create;
        }
        function getDate_ship(){
            return $this->date_ship;
        }
        function setDate_ship($date_ship){
            $this->date_ship = $date_ship;
        }
        function getTotal_price(){
            return $this->total_price;
        }
        function setTotal_price($total_price){
            $this->total_price = $total_price;
        }
        function getAddress(){
            return $this->address;
        }
        function setAddress($address){
            $this->address = $address;
        }
        function getAddress_detail(){
            return $this->address_detail;
        }
        function setAddress_detail($address_detail){
            $this->address_detail = $address_detail;
        }
        function getState(){
            return $this->state;
        }
        function setState($state){
            $this->state = $state;
        }
        function getMessage(){
            return $this->message;
        }
        function setMessage($message){
            $this->message = $message;
        }
        function getName(){
            return $this->name;
        }
        function setName($name){
            $this->name = $name;
        }
        function getTelephone(){
            return $this->telephone;
        }
        function setTelephone($telephone){
            $this->telephone = $telephone;
        }
        function getNote(){
            return $this->note;
        }
        function setNote($note){
            $this->note = $note;
        }
    }

    function getAllOrder(){
        $sql = "select * from `order` order by `date_create` DESC";
        return pdo_query($sql);
    }

    function getAllOrderWaiting(){
        $sql = "select * from `order` where `state`=0 order by `date_create` DESC";
        return pdo_query($sql);
    }

    function getAllOrderTransport(){
        $sql = "select * from `order` where `state`=3 order by `date_create` DESC";
        return pdo_query($sql);
    }

    function getAllOrderSuccess(){
        $sql = "select * from `order` where `state`=4 order by `date_create` DESC";
        return pdo_query($sql);
    }

    function getAllOrderCancel(){
        $sql = "select * from `order` where `state`=2 order by `date_create` DESC";
        return pdo_query($sql);
    }

    function getOrderById($id){
        $sql = "select * from `order` where `id_order`=$id";
        return pdo_query($sql);
    }

    function getOrderById_user($id){
        $sql = "select * from `order` where `id_user`=$id";
        return pdo_query($sql);
    }

    function addOrder($id_user, $date_create, $date_ship, $total_price, $address, $address_detail, $state, $message, $name, $telephone, $note){
        $sql = "insert into `order`(id_user, date_create, date_ship, total_price, address, address_detail, state, message, name, telephone, note) values($id_user, '$date_create', '$date_ship', $total_price, '$address', '$address_detail', $state, '$message ', '$name', $telephone, '$note')";
        return pdo_execute($sql);
    }

    function getIdOrder($id_user, $date_create){
        $sql = "select `id_order` from `order` where `id_user`=$id_user and `date_create`='$date_create'";
        return pdo_query($sql);
    }

    function confirmOrder($id_order){
        $sql = "update `order` set `state`=3  where `id_order`=$id_order ";
        return pdo_execute($sql);
    }

    function cancelOrder($id_order){
        $sql = "update `order` set `state`=2  where `id_order`=$id_order ";
        return pdo_execute($sql);
    }

    function getId_user($id_order){
        $sql = "select `id_user` from `order` where `id_order`=$id_order";
        $arr = pdo_query($sql);
        extract($arr[0]);
        return $id_user;
    }
    // $data = getIdOrder(1, '2022-04-12 01:15:49');
    // extract($data);
    // echo $id_order;
    // date_default_timezone_set('Asia/Ho_Chi_Minh');
    // $date = date("Y-m-d h:i:sa");
    // addOrder(1, $date, $date, 200000, 'KG', 'AB', 1, 'Giao hang can than');