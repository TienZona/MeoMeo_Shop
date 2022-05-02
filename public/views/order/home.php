<div id="container">
    <div class="container pt-md-4">
       <div class="row bg-light p-3">
           <style>
               .order-item {
                   background-color: #ebe1e1;
                   padding: 20px;
               }
               .order-item__content {
                   background-color: #fff;
               }
               .order-item p {
                   margin: 0;
               }
               .order-item .btn-vote {
                   width: 120px;
               }
           </style>
            <h3 class="fs-2 p-3">Đơn hàng đã mua</h3>
            <div class="list-order">
                <?php
                    foreach($orders as $order){
                        extract($order);
                        $order_details = getOrder_detail($id_order);
                        echo
                        '
                        <div class="order-item mb-4 rounded-3">
                            <div class="order-item__head d-flex justify-content-between">
                            <h6>Mã đơn hàng: '.$id_order.'</h6>
                            <div class="head__transport mb-3">
                        ';
                                
                        if($state == 0){
                            echo '<i class="fa-solid fa-truck text-secondary"></i>
                                <span class="text-secondary fs-5">Chờ xác nhận đơn hàng</span>';
                        }
                        if($state == 1){
                            echo '<i class="fa-solid fa-truck text-warning"></i>
                                <span class="text-warning fs-5">Đã xác nhận đơn hàng</span>';
                        }
                        if($state == 2){
                            echo '<i class="fa-solid fa-truck text-danger"></i>
                                <span class="text-danger fs-5">Đã hủy đơn hàng</span>';
                        }
                        if($state == 3){
                            echo '<i class="fa-solid fa-truck text-primary"></i>
                                <span class="text-primary fs-5">Đang giao hàng</span>';
                        }
                        if($state == 4){
                            echo '<i class="fa-solid fa-truck text-success"></i>
                                <span class="text-success fs-5">Giao hàng thành công</span>';
                        }
                        echo
                        '
                            </div>
                                <div class="d-flex">
                                    <span class="fs-5">Ngày đặt: <span class="text-danger">'.$date_create.'</span></span>
                                    <div class="d-flex mx-3" style="height: 30px;">
                                        <div class="vr"></div>
                                    </div>
                                    <span class="fs-5">Ngày giao: <span class="text-danger">'.$date_ship.'</span></span>
                                </div>
                            </div>
                            <div class="order-item-list row gx-3 justify-content-start gy-3">
                        ';

                        foreach($order_details as $detail){
                            extract($detail);
                            $product = getProductById($id_product);
                            extract($product[0]);
                            echo
                            '
                            <div class="col col-12 col-sm-12 col-md-6 col-xl-6">
                                <div class="order-item__content d-flex ">
                                    <img src="'.$image.'" class="product-img img-fluid" width="200px"></img>
                                    <div class="p-3">
                                        <h5 class="product-name">'.$name.'</h5> 
                                        <div class="d-flex flex-column">
                                            <p class="fs-5 text-dark p-1">Màu sắc: <span class="product-color">'.$color.'</span></p>
                                            <p class="fs-5 text-dark p-1">Size: <span class="product-size">'.$size.'</span</p>
                                            <p class="fs-5 text-dark p-1">Số lượng: <span class="product-quantity">'.$size.'</p></p>
                                            <p class="fs-5 text-dark p-1">Tổng giá: <span class="product-price text-danger">'.adddotstring($total).'đ</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
                        }

                        echo
                        '
                            </div>
                            <div class="order-item__footer mt-4 row ">
                                <div class="col-4">
                                    <span class=" fs-5 text-dark">Tổng đơn hàng: <span class="total-price text-danger">'.adddotstring($total_price).'đ</span></span>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <button class=" btn-vote btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">Đánh giá</button>
                                </div>
                                <div class="col-4">
                                <span class=" fs-5">Địa chỉ giao hàng: <span>'.$address.'</span></span>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                ?>
    
            </div>
        </div>
        <!-- <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div> -->
    </div>
</div>