<div id="container" class="container" style="margin: 150px auto 100px">
    <div class="row">
      <div class="col-2 box-menu">
        <h3 class="box-menu__header">Quản lý</h3>
        <ul class="list-group">
          <a class="list-group-item" href="index.php?act=account">Tài khoản</a>
          <a class="list-group-item" href="index.php?act=user">Người dùng</a>
          <a class="list-group-item" href="index.php?act=product">Sản phẩm</a>
          <a class="list-group-item" href="index.php?act=category">Danh mục</a>
          <a class="list-group-item active" href="index.php?act=order">Đơn hàng</a>
          <a class="list-group-item" href="index.php?act=static">Thống kê</a>
        </ul>
      </div>
      <div class="col-10">
        <div class="admin-content__heading bg-secondary d-flex justify-content-md-around">
          <h3 class="display-7">Quản lý đơn hàng</h3>
        </div>
        <style>
          .order-nav {
            background-color: #b4daef !important;
          }
          .order-nav a {
            color: #333 !important;
          }
          .order-nav a.active{
            color: red !important;
            background-color: #fff !important;
          }
          .order-nav a:hover {
            cursor: pointer;
            color: red !important;
            background-color: #fff !important;
          }
        </style>
        <div class="bg-light">
          <nav class="d-flex justify-content-start border-bottom order-nav">
            <a href="index.php?act=order&order=all" class="text-dark px-4 py-2 text-decoration-none <?php if($actOrder=='all') echo "active"; ?>">Tất cả</a>
            <a href="index.php?act=order&order=confirm" class="text-dark px-4 py-2 text-decoration-none <?php if($actOrder=='confirm') echo "active"; ?>">Xác nhận</a>
            <a href="index.php?act=order&order=transport" class="text-dark px-4 py-2 text-decoration-none <?php if($actOrder=='transport') echo "active"; ?>">Đang giao</a>
            <a href="index.php?act=order&order=success" class="text-dark px-4 py-2 text-decoration-none <?php if($actOrder=='success') echo "active"; ?>">Thành công</a>
            <a href="index.php?act=order&order=cancel" class="text-dark px-4 py-2 text-decoration-none <?php if($actOrder=='cancel') echo "active"; ?>">Đã hủy</a>
          </nav>
          <div class="order-container p-3">
            <div class="order-confirm">
              <?php
              if(!$orders){
                echo
                '
                <div class="d-flex flex-column justify-content-center align-items-center">
                  <img src="https://meetanshi.com/media/catalog/product/cache/ccb305b1061c785de33da9c79e0526ce/m/2/m2-missing-orders-product-image-380x410.png" width="300px"></img>
                  <h4 class="text-center">Chưa có đơn hàng nào!</h4>
                </div>
                ';
              }else{
                echo
                '
                <table class="table table-striped">
                  <thead>
                    <tr>
                ';
                if($actOrder == 'confirm')  
                echo '<th scope="col"> <input type="checkbox" id="check-all"> Tất cả</th>';
                echo
                '
                      <th scope="col">Mã đơn</th>
                      <th scope="col">Khách hàng</th>
                      <th scope="col">Ngày đặt</th>
                      <th scope="col">SĐT</th>
                      <th scope="col">Địa chỉ</th>
                      <th scope="col">Đơn giá</th>
                  ';
                if($actOrder == 'all')
                echo '<th scope="col">Trạng thái</th>';
                echo
                '
                      <th scope="col">Chi tiết</th>
                    </tr>
                  </thead>
                  <tbody class="list-order">
                ';
                foreach($orders as $order){
                  extract($order);
                  $fullname = $name;
                  $details = getOrder_detail($id_order);
                  $total = adddotstring($total_price);
                  $arr1 = json_encode($details);
                  $arr2 = array();
                  foreach($details as $index => $detail){
                    extract($detail);
                    $product = getProductById($id_product);
                    extract($product[0]);
                    $a = array('name' => $name,'img' => $image);
                    $arr2 = array_merge($arr2, $a);
                  }
                  $arr2 = json_encode($arr2);
                  $date = substr($date_create, 0, 10);
                  $price = adddotstring($total_price);
                  echo
                  "
                  <tr class='order-item'>
                  ";
                  if($actOrder == 'confirm')
                  echo "<td><input type='checkbox' class='check-item' value='$id_order'></td>";
                  echo
                  "
                    <td><span class='id_order'>$id_order</span></td>
                    <td class='text-start'><span class='name'>$fullname</span></td>
                    <td><span class='date_create'>$date</span></td>
                    <td><span class='telephone'>$telephone</span></td>
                    <td><span class='address'>$address</span></td>
                    <td><span class='price text-danger'>$price đ</span></td>
                  ";
                  if($actOrder == 'all'){
                    if($state == 0)  echo "<td><span class='state text-primary'>Chờ xác nhận</span></td>";
                    if($state == 1) echo "<td><span class='state text-info'>Đã xác nhận</span></td>";
                    if($state == 2) echo "<td><span class='state text-danger'>Đã hủy</span></td>"; 
                    if($state == 3) echo "<td><span class='state text-secondary'>Đang giao</span></td>";; 
                    if($state == 4) echo "<td><span class='state text-success'>Thành công</span></td>";; 
                   
                  }
              
                  echo
                  "
                    <td><button onclick='handleModal($arr1, $arr2, \"$fullname\", \"$telephone\", \"$date_create\", \"$total\", \"$address\", \"$address_detail\", \"$note\")' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#exampleModal'>Xem</button></td>
                  </tr>
                  ";
                }
                echo
                '
                    </tbody>
                  </table>
                ';
              }
              ?>
            
              
              <?php
              if($orders && $actOrder == 'confirm'){
                echo
                '
                <div class="order-footer d-flex justify-content-center">
                  <button class="btn btn-primary m-2" onclick="confirmOrder()">Xác nhận đơn hàng</button>
                  <button class="btn btn-danger m-2 mx-4" onclick="cancelOrder()">Hủy đơn hàng</button>
                </div>
                ';
              }
              ?>
            </div>
            <!-- <div class="order-transport">
              <?php
              if(!$orders){
                echo
                '
                <div class="d-flex flex-column justify-content-center align-items-center">
                  <img src="https://meetanshi.com/media/catalog/product/cache/ccb305b1061c785de33da9c79e0526ce/m/2/m2-missing-orders-product-image-380x410.png" width="300px"></img>
                  <h4 class="text-center">Chưa có đơn hàng nào đang chờ xác nhận!</h4>
                </div>
                ';
              }else{
                echo
                '
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col"> <input type="checkbox" id="check-all"> Tất cả</th>
                      <th scope="col">Mã đơn</th>
                      <th scope="col">Khách hàng</th>
                      <th scope="col">Ngày đặt</th>
                      <th scope="col">SĐT</th>
                      <th scope="col">Địa chỉ</th>
                      <th scope="col">Đơn giá</th>
                      <th scope="col">Chi tiết</th>
                    </tr>
                  </thead>
                  <tbody class="list-order">
                ';
                foreach($orders as $order){
                  extract($order);
                  $fullname = $name;
                  $details = getOrder_detail($id_order);
                  $total = adddotstring($total_price);
                  $arr1 = json_encode($details);
                  $arr2 = array();
                  foreach($details as $index => $detail){
                    extract($detail);
                    $product = getProductById($id_product);
                    extract($product[0]);
                    $a = array('name' => $name,'img' => $image);
                    $arr2 = array_merge($arr2, $a);
                  }
                  $arr2 = json_encode($arr2);
                  $date = substr($date_create, 0, 10);
                  $price = adddotstring($total_price);
                  echo
                  "
                  <tr class='order-item'>
                    <td><input type='checkbox' class='check-item' value='$id_order'></td>
                    <td><span class='id_order'>$id_order</span></td>
                    <td><span class='name'>$name</span></td>
                    <td><span class='date_create'>$date</span></td>
                    <td><span class='telephone'>$telephone</span></td>
                    <td><span class='address'>$address</span></td>
                    <td><span class='price text-danger'>$price đ</span></td>
                    <td><button onclick='handleModal($arr1, $arr2, \"$fullname\", \"$telephone\", \"$date_create\", \"$total\", \"$address\", \"$address_detail\", \"$note\")' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#exampleModal'>Xem</button></td>
                  </tr>
                  ";
                }
                echo
                '
                    </tbody>
                  </table>
                ';
              }
              ?>
        
              <?php
              if($orders){
                echo
                '
                <div class="order-footer d-flex justify-content-center">
                  <button class="btn btn-primary m-2" onclick="confirmOrder()">Xác nhận đơn hàng</button>
                  <button class="btn btn-danger m-2 mx-4" onclick="cancelOrder()">Hủy đơn hàng</button>
                </div>
                ';
              }
              ?>
            </div> -->
          </div>
         
        </div>
      </div>
    </div>
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-info d-flex justify-content-center">
            <h4 class="modal-title text-light" id="exampleModalLabel">Chi tiết đơn hàng</h4>
          </div>
          <div class="modal-body">
            <table id="modal-table" class="table">
              <thead>
                  <tr>
                  <th scope="col">Ảnh</th>
                  <th scope="col">Tên</th>
                  <th scope="col">Màu</th>
                  <th scope="col">Size</th>
                  <th scope="col">SL</th>
                  <th scope="col">Tổng</th>
                  </tr>
              </thead>
              <tbody class="modal-list-item">
                  
              </tbody>
            </table>
            <div class="infor-order">
              <div class="infor-order_item p-2 ">
                  <p class="py-1">Phí vận chuyển: <span class="transfer text-danger">50.000đ</span></p>
                  <p class="py-1">Tổng đơn hàng: <span id="total-price" class=" text-danger">190.000đ</span></p>
                  <p class="py-1">Thời gian đặt hàng: <span id="date-create" class=" text-danger">2022-04-12 02:25:06</span></p>
              
              </div>
              <div class="infor-order_item d-flex p-2">
                  <span class=" control-label col-4">Tên Khách hàng:</span>
                  <input id="name" disabled value="Chung Phát Tiên" type="text" class="form-control" name="name" />
              </div>
              <div class="infor-order_item d-flex p-2">
                  <span class=" control-label col-4">Số điện thoại:</span>
                  <input id="telephone" disabled value="09090909" type="text" class="form-control" name="telephone" />
              </div>
              <div class="infor-order_item d-flex p-2">
                  <span class=" control-label col-4">Địa chỉ giao hàng:</span>
                  <input id="address1" disabled value="Phú Tân An Giang" type="text" class="form-control" name="address1" />
              </div>
              <div class="infor-order_item d-flex p-2">
                  <span class=" control-label col-4">Địa chỉ cụ thể:</span>
                  <input id="address2" disabled value="Trọ mười Tam" type="text" class="form-control" name="address2" />
              </div>
              <div class="infor-order_item d-flex p-2">
                  <span class=" control-label col-4">Ghi chú khách hàng:</span>
                  <input id="note" disabled value="Giao hàng cẩn thận" type="text" class="form-control" name="note"/>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
  $("#check-all").change(function(e){
    if(this.checked){
      $(".check-item").prop('checked', true);
    }else{
      $(".check-item").prop('checked', false);
    }
  })

  function confirmOrder(){
    const items = document.querySelectorAll('.check-item:checked');
    var arr = [];
    items.forEach(function(item){
      arr.push(parseInt(item.value));
    })
    $.ajax({
      url: "../../views/admin/index.php?act=confirmOrder",
      method: "POST",
      data: { id_orders: arr },
      cache: false,
      error: function(xhr ,text){
          alert('Đã có lỗi: ' + text);
      }
    });
    alert("Đã xác nhận " + (items.length) + " đơn hàng !");
    location.reload();
  }
  function cancelOrder(){
    const items = document.querySelectorAll('.check-item:checked');
    var arr = [];
    items.forEach(function(item){
      arr.push(parseInt(item.value));
    })
    $.ajax({
      url: "../../views/admin/index.php?act=cancelOrder",
      method: "POST",
      data: { id_orders: arr },
      cache: false,
      error: function(xhr ,text){
          alert('Đã có lỗi: ' + text);
      }
    });
    alert("Đã hủy " + (items.length) + " đơn hàng !");
    location.reload();
  }

  function handleModal(arr, arr2, name, telephone, date, total_price, address1, address2,  note){
    const body = $('.modal-list-item')[0];
    body.innerHTML = '';
    arr.forEach(function(item){
      body.innerHTML +=
      `
      <tr>
        <td><img src="${arr2.img}" alt="" width="60px"></td>
        <td><span>${arr2.name}</span></td>
        <td><span>${item.color}</span></td>
        <td><span>${item.size}</span></td>
        <td><span>${item.quantity}</span></td>
        <td><span class="text-danger">${formatNumber(item.total)}đ</span></td>
      </tr>
      `;
    })
    $("#name").val(name);
    $("#telephone").val(telephone);
    $("#total-price").html(formatNumber(total_price) + 'đ');
    $("#date-create").html(date)
    $("#address1").val(address1);
    $("#address2").val(address2);
    $("#note").val(note);
    return false;
  }
  function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
  }
</script>