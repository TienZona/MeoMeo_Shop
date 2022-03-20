<?php
    class product {
        private $id;
        private $name;
        private $description;
        private $price;
        private $image;
        private $id_category;

        function __construct($id, $name, $description, $price, $image, $id_category){
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->price = $price;
            $this->image = $image;
            $this->id_category = $id_category;
        }

        function getId(){
            return $this->id;
        }
        function getName(){
            return $this->name;
        }
        function getDescription(){
            return $this->description;
        }
        function getPrice(){
            return $this->price;
        }
        function getImage(){
            return $this->image;
        }
        function getIdCategory(){
            return $this->id_category;
        }


        function setId($id){
            $this->id = $id;
        }
        function setName($name){
            $this->name = $name;
        }
        function setDescription($description){
            $this->description = $description;
        }
        function setPrice($price){
            $this->price = $price;
        }
        function setImage($image){
            $this->image = $image;
        }
        function setIdCategory($id_category){
            $this->id_category = $id_category;
        }
    }

    function getAllProduct(){
        $sql = "select * from `product`";
        return pdo_query($sql);
    }

    function getIdProduct($name){
        $sql = "select `id_product` from `product` where `name`='$name'";
        $datas = pdo_query($sql);
        foreach($datas as $data){
            extract($data);
            return $id_product;
        }
    }

    function getImageOfProduct($id_product){
        $sql = "select `image` from `product` where `id_product`=$id_product";
        $data = pdo_query($sql);
        extract($data[0]);
        return $image;
    }

    function checkCategoryProduct($id_category){
        $sql = "select * from `product` where `id_category`=$id_category";
        $data = pdo_query($sql);
        return $data ? true : false;
    }

    function addProduct($product){
        $id = $product->getId(); 
        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $image = $product->getImage();
        $id_category = $product->getIdCategory();

        $sql = "INSERT INTO `product`(`name`, `description`, `price`, `image`, `id_category`) VALUES ('$name','$description','$price','sssssssssssssssssssssssssssssssssssssssssss','$id_category')";
        pdo_execute($sql);
    }

    function deleteProduct($id){
        $sql = "delete from `product` where `id_product`=$id";
        pdo_execute($sql);
    }

    function updateProduct($product){
        $id = $product->getId(); 
        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $image = $product->getImage();
        $id_category = $product->getIdCategory();

        $sql = "update `product` set `name`='$name', `description`='$description', `price`='$price', `image`='$image', `id_category`='$id_category' where `id_product`=$id";
        pdo_execute($sql);
    }

    function updateImageProduct($id_product, $image){
        $sql = "update `product` set `image`='$image' where `id_product`=$id_product ";
        pdo_execute($sql);
    }
    
    function updateNameProduct($id_product, $name){
        $sql = "update `product` set `name`='$name' where `id_product`=$id_product ";
        pdo_execute($sql);
    }

    function updateCategoryProduct($id_product, $id_category){
        $sql = "update `product` set `id_category`='$id_category' where `id_product`=$id_product ";
        pdo_execute($sql);
    }

    function updateDescriptionProduct($id_product, $description){
        $sql = "update `product` set `description`='$description' where `id_product`=$id_product ";
        pdo_execute($sql);
    }

    function updatePriceProduct($id_product, $price){
        $sql = "update `product` set `price`='$price' where `id_product`=$id_product ";
        pdo_execute($sql);
    }