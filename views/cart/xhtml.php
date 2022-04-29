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
$id = $_GET['id'];
$carts = getCartByIDUser($id);
if($carts){
    foreach($carts as $cart){
        extract($cart);
        $product = getProductById($id_product);
        $colors = getAllColorOfProduct($id_product);
        $sizes = getAllSizeOfProduct($id_product);
        extract($product[0]);
        $colorItem = $color;
        $sizeItem = $size;
        echo 
        '
        <div class="item my-3 d-flex align-items-center justify-content-between">
            <img src="'.$image.'" class="item__img" alt="" width="80px">
            <input type="hidden" value="'.$id_product.'" name="id_product[]" id="id_product">
            <span class="item__name an">'.$name.'</span>
            <div class="item__color">
                Màu sắc: 
                <select name="color[]" id="color" height="20px">
        ';
            foreach($colors as $color){
                extract($color);
                echo '<option class="item__color" value="'.$color.'"';
                if($color == $colorItem) echo "selected";
                echo '>'.$color.'</option>';
            }
        echo'
                </select>
            </div>
            <div class="item__size">
                Size: 
                <select name="size[]" id="size" height="20px">
        ';
            foreach($sizes as $size){
                extract($size);
                echo '<option class="item__size" value="'.$size.'"';
                if($size == $sizeItem) echo "selected";
                echo '>'.$size.'</option>';
            }
        echo '
                </select>
            </div>
            <div class="item-group d-flex">
                <span class="item__price">'.adddotstring($price).'đ</span>
                <div class="detail-quantity d-flex " >
                    <button class="detail-quantity__minus fa-solid fa-minus" onclick="changeQuantity(0,this, '.$id_user.','.$id_product.','.$quantity.', \''.$colorItem.'\', \''.$sizeItem.'\')"></button>
                    <input class="detail-quantity__input text-center" value="'.$quantity.'" min="0" max="100" disable onchange="changeQuantity(2,this, '.$id_user.','.$id_product.','.$quantity.', \''.$colorItem.'\', \''.$sizeItem.'\')">
                    <button class="detail-quantity__plus fa-solid fa-plus" onclick="changeQuantity(1,this, '.$id_user.','.$id_product.','.$quantity.', \''.$colorItem.'\', \''.$sizeItem.'\')"></button>
                </div>
                <span class="item__total">'.adddotstring($price * $quantity).'đ</span>
                <button class="item__delete btn " onclick="deleteItem('.$id_user.', '.$id_product.', \''.$colorItem.'\', \''.$sizeItem.'\', '.$quantity.')">Xóa</button>
            </div>
        </div>
        ';
    }
}else{
    echo '<img src="../../img/empty-cart.jpg" alt="" >';
}