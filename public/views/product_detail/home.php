<div id="container">
    <div class="container py-4">
        <div class="row bg-light p-3 rounded-1">
            <div class="col col-4 col-xl-4">
                <div class="detail__img">
                    <img src="<?= $image; ?>" alt="">
                </div>
            </div>
            <div class="col col-8 col-xl-5 text-center">
                <h4 class="detail__name "><?= $name; ?></h4>
                <p class="detail__text">Mã SP: <span class="detail__code"><?= $id_product; ?></span></p>
                <p class="detail__text">Loại SP: <span class="detail__code"><?= $category; ?></span></p>
                <p class="detail__text">Giá: <span class="detail__price"> <?= adddotstring($price);  ?></span></p>
                <div class="detail__rating text-center">
                    <div class="detail__rating-list">
                        <span class="detail__rating-item fa-solid fa-star"></span>
                        <span class="detail__rating-item fa-solid fa-star"></span>
                        <span class="detail__rating-item fa-solid fa-star"></span>
                        <span class="detail__rating-item fa-solid fa-star"></span>
                        <span class="detail__rating-item fa-solid fa-star"></span>
                    </div>
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Màu sắc</th>
                        <th scope="col">Size</th>
                        <th scope="col">SL có sẵn</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thêm vào vỏ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($details as $detail){
                                extract($detail);
                                echo'
                                <tr>
                                    <td class="detail__color">'.$color.'</td>
                                    <td class="detail__size">'.$size.'</td>
                                    <td class="detail__number">'.$number.'</td>
                                    <td >
                                    <div class="detail-quantity d-flex">
                                        <button class="detail-quantity__minus fa-solid fa-minus"></button>
                                        <input class="detail-quantity__input text-center" value="0" min="0" max="'.$number.'" disable>
                                        <button class="detail-quantity__plus fa-solid fa-plus"></button>
                                    </div>
                                    </td>
                                    <td><button type="button" class="detail__list-btn ">Mua ngay</button></td>
                                </tr>
                                ';
                            }

                        ?>
                        
                    </tbody>
                    </table>
            </div>
            <div class="col col-12 col-xl-3">
                <h4 class="detail__description text-center">MÔ TẢ SẢN PHẨM</h4>
                <span class="detail__description-content">
                    <?= $description; ?>
                </span>
                
            </div>
        </div>
        <div class="row bg-light p-4 rounded-1">
            <h3 class="detail__heading">SẢN PHẨM CÙNG LOẠI</h3>
            <div class="row product-list" >
                <?php
                    renderProductLimit($number, $page ,$listProduct);
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

        // handle product item heart
        $('.icon-heart').click(function(e){
            e.target.classList.contains('active') ? e.target.classList.remove('active') : e.target.classList.add('active');
            
        })

        $('.detail-quantity__minus').each(function(index, item){
            item.onclick = function(){
                const number = parseInt($('.detail-quantity__input')[index].value) - 1;
                if(number >= 0){
                    $('.detail-quantity__input')[index].value = number;
                }
            }
        });

        $('.detail-quantity__plus').each(function(index, item){
            item.onclick = function(){
                const number = parseInt($('.detail-quantity__input')[index].value) + 1;
                const max = parseInt($('.detail-quantity__input')[index].max);
                if(number <= max){
                    $('.detail-quantity__input')[index].value = number;
                }else{
                    $('.detail-quantity__input')[index].value = max;
                    
                }
            };
        });
        $(".detail__list-btn").click(function(e){
            const id_user = <?= $id_user; ?>;    
            const id_product = <?= $id_product ?>;    
            const color = this.parentElement.parentElement.querySelector('.detail__color').innerHTML;
            const size = this.parentElement.parentElement.querySelector('.detail__size').innerHTML;
            const quantity = e.target.parentElement.parentElement.querySelector('.detail-quantity__input').value;
            if(quantity == '0'){
                alert('Vui lòng chọn số lượng!');
            }else{
                $.ajax({
                    url: "index.php",
                    method: "POST",
                    data: { id_user: id_user, id_product: id_product, color: color, size: size, quantity: quantity},
                    cache: false,
                    error: function(xhr ,text){
                        alert('Đã có lỗi: ' + text);
                    }
                });
                alert('Sản phẩm đã được thêm vào vỏ hàng!');
                showCart(id_user);
            }
            
        });

    });

</script>