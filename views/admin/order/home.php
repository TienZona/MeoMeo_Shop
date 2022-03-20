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
        <table class="table table-bordered table-striped text-center">
            <thead class="table-primary">
                <tr>
                    <th>STT</th>
                    <th>Mã đơn</th>
                    <th>Danh sách SP</th>
                    <th>Ngày bán</th>
                    <th>Tên người mua</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody class="table-light">
              <?php
                include '../../modal/category.php';
                $categorys = getAllCategory();
            
                foreach($categorys as $data){
                  extract($data);
                  $index = 1;
                  echo "
                    <tr>
                      <td>$index</td>
                      <td>$id_category</td>
                      <td>$name</td>
                      <td>
                        <form action='index.php?act=updateCate&id={$id_category}' method='post' onsubmit='return setAction($id_category);'>
                          <button type='submit' class='btn btn-success btn-update' data-bs-toggle='modal' data-bs-target='#update-modal'>Sửa</button>
                        </form>
                      </td>
                      <td>
                        <form action='index.php?act=deleteCate&id={$id_category}' method='post' onsubmit='return confirmDelete();'>
                          <button type='submit' class='btn btn-danger btn-delete'>Xóa</button>
                        </form>
                      </td>
                    </tr>
                  ";
                  $index++;
                }
              ?>
            </tbody>
        </table>
      </div>
    </div>
</div>