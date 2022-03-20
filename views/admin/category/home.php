<div id="container" class="container" style="margin: 150px auto 100px">
    <div class="row">
      <div class="col-2 box-menu">
        <h3 class="box-menu__header">Quản lý</h3>
        <ul class="list-group">
          <a class="list-group-item" href="index.php?act=account">Tài khoản</a>
          <a class="list-group-item" href="index.php?act=user">Người dùng</a>
          <a class="list-group-item" href="index.php?act=product">Sản phẩm</a>
          <a class="list-group-item active" href="index.php?act=category">Danh mục</a>
          <a class="list-group-item" href="index.php?act=order">Đơn hàng</a>
          <a class="list-group-item" href="index.php?act=static">Thống kê</a>
        </ul>
      </div>
      <div class="col-10">
        <div class="admin-content__heading bg-secondary d-flex justify-content-md-around">
          <h3 class="display-7">Quản lý danh mục</h3>
          <button onclick="handleModalAdd()" class="btn btn-add btn-primary float-end m-3 col-2" data-bs-toggle='modal' data-bs-target='#modal-category'>Thêm</button>
        </div>
        <table class="table table-bordered table-striped text-center">
            <thead class="table-primary">
                <tr>
                    <th>STT</th>
                    <th>Mã Loại</th>
                    <th>Tên Loại</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php
                  $categorys = getAllCategory();
                  $index = 1;
                  foreach($categorys as $data){
                    extract($data);
                    echo "
                      <tr>
                        <td>$index</td>
                        <td>$id_category</td>
                        <td>$name</td>
                        <td>
                          <form action='index.php?act=updateCategory&id={$id_category}' method='post' onsubmit='return handleModalUpdate($id_category, \"$name\");'>
                            <button type='submit' class='btn btn-success btn-update' data-bs-toggle='modal' data-bs-target='#modal-category'>Sửa</button>
                          </form>
                        </td>
                        <td>
                          <form action='index.php?act=deleteCategory&id={$id_category}' method='post' onsubmit='return confirmDelete();'>
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
        <div id="modal-category" class="modal add-modal fade" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
            <form id="form-category" class="form-category" action="index.php?act=addCategory" method="post" enctype='multipart/form-data'>
              <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                  <div class="modal-header modal-update-header d-flex justify-content-center">
                    <h3 id="modal-name" class="modal-title modal-update-title" id="exampleModalLabel">Thêm loại sản phẩm</h3>
                  </div>
                  <div class="modal-body">
                    <div class="form-group mb-4">
                      <label for="name" class="cols-sm-2 control-label"><b>Điền tên loại:</b></label>
                      <div class="input-group">
                        <input id="name" type="text" class="form-control" name="name"  placeholder="Nhập tên danh mục"/>
                        <div id="errorMassage" class="text-center"></div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer modal-update-footer">
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Hủy</button>
                    <button id="btn-modal" type="submit" class="btn btn-submit-n">Thêm</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  function confirmDelete(){
    return confirm('Bạn có chắc muốn xóa! ');
  }
  function handleModalAdd(){
    $("#form-category").attr("action", `index.php?act=addCategory`);
    $("#modal-name")[0].innerHTML = 'Thêm loại sản phẩm';
    $("#btn-modal")[0].innerHTML = 'Thêm';
  }

  function handleModalUpdate(id, name){
    $("#form-category").attr("action", `index.php?act=updateCategory&id=${id}`);
    $("#modal-name")[0].innerHTML = 'Cập nhật loại sản phẩm';
    $("#btn-modal")[0].innerHTML = 'Cập nhật';
    $('#name').val(name);
    return false;
  }
  $(document).ready(function () {
      $(".form-category").validate({
          rules: {
              name: "required"
          },
          messages: {
            name: "Vui lòng nhập tên loại!",
          },
          errorElement: "div",
          errorPlacement: function (error, element) {
              error.addClass("invalid-feedback");
              if (element.prop("type") === "checkbox"){
                  error.insertAfter(element.siblings("label"));
              } else {
                  error.insertAfter(element);
              }
          },
          highlight: function(element, errorClass, validClass){
              $(element).addClass("is-invalid").removeClass("is-valid");
          },
          unhighlight: function(element, errorClass, validClass){
              $(element).addClass("is-valid").removeClass("is-invalid");
          },
      });
    });


  
</script> 