
<div id="container" class="container" style="margin: 150px auto 100px">
    <div class="row">
      <div class="col-2 box-menu">
        <h3 class="box-menu__header">Quản lý</h3>
        <ul class="list-group">
          <a class="list-group-item active" href="index.php?act=account">Tài khoản</a>
          <a class="list-group-item" href="index.php?act=user">Người dùng</a>
          <a class="list-group-item" href="index.php?act=product">Sản phẩm</a>
          <a class="list-group-item" href="index.php?act=category">Danh mục</a>
          <a class="list-group-item" href="index.php?act=order">Đơn hàng</a>
          <a class="list-group-item" href="index.php?act=static">Thống kê</a>
        </ul>
      </div>
      <div class="col-10">
      <div class="admin-content__heading bg-secondary d-flex justify-content-md-around">
          <h3 class="display-7">Quản lý tài khoản</h3>
        </div>
        <table class="table table-bordered table-striped text-center">
            <thead class="table-primary">
                <tr>
                    <th>STT</th>
                    <th>ID Account</th>
                    <th>ID User</th>
                    <th>Tên đăng nhập</th>
                    <th>Mật khẩu</th>
                    <th>Quyền</th>
                    <th>Ngày đăng ký</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody class="table-light">
              
                      <?php
                        $sql = "select * from account";
                        $accounts = pdo_query($sql);
                        $index = 1;
                        foreach ($accounts as $account){
                          extract($account);
                          echo "
                          <tr>
                              <td>$index</td>
                              <td class='id-account' name='id'>$id_account</td>
                              <td>$id_user</td>
                              <td>$username</td>
                              <td>*********</td>
                              <td>$rule</td>
                              <td>$date_create</td>
                              <td>
                                <form action='index.php?act=update&id={$id_account}' method='post' onsubmit='return handleModalUpdate($id_account, \"$username\");'>
                                  <button type='submit' class='btn btn-success btn-update' data-bs-toggle='modal' data-bs-target='#update-modal'>Sửa</button>
                                </form>
                              </td>
                              <td>
                                <form action='index.php?act=deleteAcc&id={$id_account}' method='post' onsubmit='return confirmDelete();'>
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
        <div class="row">
          <div id="update-modal" class="modal update-modal fade" tabindex="-1" aria-labelledby="exampleModalToggleLabel" aria-hidden="true">
            <form id="form-update" action="index.php?act=updateAcc" method="post" enctype='multipart/form-data'>
              <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                  <div class="modal-header modal-update-header">
                    <h3 class="modal-title modal-update-title" id="exampleModalLabel">Cập Nhật Tài Khoản</h3>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                          <label for="username" class="cols-sm-2 control-label">Tên tài khoản:</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                            <input id="username" disabled value="" type="text" class="form-control" name="username" id="username"  placeholder="Nhập tên tài khoản"/>
                            <div id="errorMassage" class="text-center err-username"></div>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="password" class="cols-sm-2 control-label">Mật khẩu:</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input id="password" type="password" class="form-control" name="password" id="password"  placeholder="Nhập mật khẩu"/>
                            <div id="errorMassage" class="text-center"></div>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="confirm" class="cols-sm-2 control-label">Xác nhận mật khẩu:</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input id="confirm" type="password" class="form-control" name="confirm" id="confirm"  placeholder="Nhập lại mật khẩu"/>
                            <div id="errorMassage" class="text-center"></div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer modal-update-footer">
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      
      </div>
    </div>
</div>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script type="text/javascript">
  const btnDeletes = $('.btn-delete');
  const form = $('#form-update');
 
  function confirmDelete(){
    return confirm('Bạn có chắc muốn xóa! ');
  }

  function handleModalUpdate(id, username){
    $("#form-update").attr("action", `index.php?act=updateAcc&id=${id}`);
    $('#username').val(username);
    alert(username)
    return false;
  }

  $.validator.setDefaults({
      submitHandler: function () { return true; }
      
  });


  $(document).ready(function () {
      $("#form-update").validate({
          rules: {
              username: "required",
              username: { required: true, minlength: 2 },
              password: { required: true, minlength: 5 },
              confirm: { required: true, minlength: 5, equalTo: "#password"}
          },
          messages: {
              username: {
                  required: "Bạn chưa nhập vào tên đăng nhập",
                  minlength: "Tên đăng nhập phải có ít nhất 2 ký tự"
              },
              password: {
                  required: "Bạn chưa nhập mật khẩu",
                  minlength: "Mật khẩu phải có ít nhất 5 ký tự"
              },
              confirm_password: {
                  required: "Bạn chưa nhập mật khẩu",
                  minlength: "Mật khẩu phải có ít nhất 5 ký tự",
                  equalTo: "Mật khẩu không trùng khớp với mật khẩu đã nhập"
              }
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

 