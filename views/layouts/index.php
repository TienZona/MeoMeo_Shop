<?php
    include '../../modal/pdo.php';
    include '../../modal/product.php';
    include '../../modal/product_detail.php';
    include '../../modal/category.php';
    include '../../modal/cart.php';
    include '../../modal/accounts.php';
    include '../../modal/color.php';
    include '../../modal/size.php';
    include '../../modal/user.php';
    if(isset($_POST['id_user']) && isset($_POST['id_product'])){
      $id_user = $_POST['id_user'];
      $id_product = $_POST['id_product'];
      $color = $_POST['color'];
      $size = $_POST['size'];
      $quantity = $_POST['quantity'];
      $item = new cart($id_user, $id_product, $color, $size, $quantity);
      // $item = new cart(1 ,116 ,'Trắng' ,'XL' ,4);
      deleteCart($item); 
  }

    if(isset($_GET['getCart'])){
        $id = $_GET['getCart'];
        $carts = getCartByIDUser($id);
        if($carts != null){
            foreach($carts as $cart){
              extract($cart);
              $data = getProductById($id_product);
              extract($data[0]);
              $total = $quantity * $price;
              $id_product = getIdProduct($name);
              echo 
              '
              <div class="bag-item d-flex justify-content-between align-items-center mb-2">
                <img class="bag-item__img" src="'.$image.'" alt="" width="50">
                <div class="d-flex flex-column align-items-center px-2">
                  <div class="an-1 bag-item__name">'.$name.'</div>
                  <div class="bag-item__content">
                    <span class="bag-item__color">'.$color.'</span>
                    x
                    <span class="bag-item__size">'.$size.'</span>
                    x
                    <span class="bag-item__quantity">'.$quantity.'</span>
                  </div>
                </div>
                <span class="bag-item__price">'.adddotstring($total).'đ</span>
                <button id="bag-item__delete" class="bag-item__delete" onclick="deleteItem('.$id_user.', '.$id_product.', \''.$color.'\', \''.$size.'\', '.$quantity.')">X</button>
              </div>
              ';
            };
            #'.$id_user.', '.$id_product.', '.$color.', '.$size.', '.$quantity.',
          }else{
            echo
            '
            <img src="../../img/empty-cart.jpg" alt="" width="320px" class="text-center">
            ';
          }

    }