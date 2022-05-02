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

    function getNewProduct(){
        $sql = "select * from `product` order by `created_at` limit 10";
        return pdo_query($sql);
    }

    function getProductById($id_product){
        $sql = "select * from `product` where `id_product`=$id_product";
        return pdo_query($sql);
    }

    function getProductExpensive(){
        $sql = "select * from `product` order by `price` desc";
        return pdo_query($sql);
    }

    function getProductLowest(){
        $sql = "select * from `product` order by `price`";
        return pdo_query($sql);
    }

    function getProductByCategory($id){
        $sql = "select * from `product` where `id_category`=$id";
        return pdo_query($sql);
    }

    function getProductWithCategory($id_category, $id_product){
        $sql = "select * from `product` where `id_product` <> $id_product and  `id_category`=$id_category";
        return pdo_query($sql);
    }

    function getProductBySearch($search){
        $sql = "select * from `product` where `name` like '%$search%'";
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

        $sql = "INSERT INTO `product`(`name`, `description`, `price`, `image`, `id_category`) VALUES ('$name','$description','$price','$image','$id_category')";
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

    function adddotstring($strNum) {
 
        $len = strlen($strNum);
        $counter = 3;
        $result = "";
        while ($len - $counter >= 0)
        {
            $con = substr($strNum, $len - $counter , 3);
            $result = '.'.$con.$result;
            $counter+= 3;
        }
        $con = substr($strNum, 0 , 3 - ($counter - $len) );
        $result = $con.$result;
        if(substr($result,0,1)=='.'){
            $result=substr($result,1,$len+1);   
        }
        return $result;
    }


    function renderProductLimit($number, $page, $listProduct){
        $start = $number * $page;
        if($listProduct)
            $listProduct = array_slice($listProduct, $start, $number);
        renderProduct($listProduct);
    }




    function renderProduct($listProduct){
        if($listProduct){
            foreach($listProduct as $product){
                extract($product);
                
                echo 
                '
                <div class="product__item col-6 col-sm-6 col-md-4 col-lg-3 col-xg-3">
                    <div class="card product__item-card">
                    <div class="image-container">
                        <div class="first">
                            <div class="d-flex justify-content-between align-items-center"> 
                            <span class="discount">-25%</span> 
                            <span class="wishlist"><i href="#" class="fa-solid fa-heart icon-heart"></i></span> 
                            </div>
                        </div> 
                        <div class="thumbnail-image">
                        <img src="'.$image.'" class="img-fluid rounded">
                        </div>
                    </div>
                    <div class="product-detail-container p-3">
                        <h5 class="product-name an-product-name d-inline-block text-center">'.$name.'</h5>
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="rating">
                            <span class="number-start">5</span>
                            <input type="radio" class="rating-start" name="rating" value="5" id="5">
                            <label for="5">☆</label> 
                            <input type="radio" class="rating-start" name="rating" value="4" id="4">
                            <label for="4">☆</label> 
                            <input type="radio" class="rating-start" name="rating" value="3" id="3">
                            <label for="3">☆</label> 
                            <input type="radio" class="rating-start" name="rating" value="2" id="2">
                            <label for="2">☆</label> 
                            <input type="radio" class="rating-start" name="rating" value="1" id="1">
                            <label for="1">☆</label>
                        </div>
                        <a href="../../product_detail/index.php?act=info&id='.$id_product.'" class="btn-card"><i class="fa-solid fa-bag-shopping icon"></i></a href="../../views/product_detail/index.php?act=info&id='.$id_product.'">
                        <div class="d-flex flex-column mb-2"> 
                            <span class="new-price">'.adddotstring($price).'đ</span> 
                            <!-- <small class="old-price text-right"><del>200.000đ</del></small>  -->
                            
                        </div>
                        </div>
    
                        <div class="d-flex justify-content-between pt-1">
                            <div class="color-select d-flex flex-wrap "> 
                ';
                                renderColorProduct($id_product);
                echo
                '
                            </div>
                            <div class="d-flex product-size "> 
                ';
                $sizes = getAllSizeOfProduct($id_product);
                foreach($sizes as $size){
                    extract($size);
                    echo '<span class="item-size m-1 btn" type="button">'.$size.'</span> ';
                }
                echo 
                '
                            </div>
                        </div>
                        
                    </div>
                    </div>
                </div>
                ';
            }
        }else{
            echo '<h3 class="text-center">Không có sản phẩm</h3>';
            echo '<img src="https://www.dokantec.com/resources/assets/front/images/no-product-found.png" class="img-fluid rounded">';
        }
    }

    function renderColorProduct($id_product){
        $colors = getAllColorOfProduct($id_product);
        foreach($colors as $color){
            extract($color);
            $name = '';
            switch ($color){
                case 'Xám':
                    $name = 'gray'; break;
                case 'Cam':
                    $name = 'orange'; break;
                case 'Đen':
                    $name = 'black'; break;
                case 'Đỏ':
                    $name = 'red'; break;
                case 'Hồng':
                    $name = 'pink'; break;
                case 'Trắng':
                    $name = 'white'; break;
                case 'Vàng':
                    $name = 'yellow'; break;
                case 'Xanh D':
                    $name = 'blue'; break;
                case 'Xanh L':
                    $name = 'green'; break;
                default: break;
            }
            echo '<input type="button" name="'.$name.'" class="btn '.$name.' m-1"> ';
        }
    }