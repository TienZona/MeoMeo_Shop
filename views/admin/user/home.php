
<div id="container" class="container" style="margin: 150px auto 100px">
    <div class="row">
      <div class="col-2 box-menu">
        <h3 class="box-menu__header">Quản lý</h3>
        <ul class="list-group">
          <a class="list-group-item" href="index.php?act=account">Tài khoản</a>
          <a class="list-group-item active" href="index.php?act=user">Người dùng</a>
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
        <table class="table table-bordered table-striped text-center table-update">
            <thead class="table-primary">
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Địa chỉ</th>
                    <th>SĐT</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody class="table-light">
                      <?php
                        $sql = "select * from user";
                        $users = pdo_query($sql);
                        $index = 1;
                        foreach ($users as $user){
                          extract($user);
                          echo "
                          <tr>
                                <td>$index</td>
                                <td class='id-user'>$id_user</td>
                                <td><img width='50' src='https://banner2.cleanpng.com/20180603/jx/kisspng-user-interface-design-computer-icons-default-stephen-salazar-photography-5b1462e1b19d70.1261504615280626897275.jpg'></img></td>
                                <td>$fullname</td>
                                <td>$email</td>
                                <td>$gender</td>
                                <td>$birthdate</td>
                                <td>$address</td>
                                <td>$telephone</td>
                                <td>
                                    <form action='index.php?act=updateUser&id={$id_user}' method='post' onsubmit='return handleModalUpdate($id_user, \"$fullname\", \"$email\", \"$gender\", \"$birthdate\", \"$address\", $telephone);'>
                                    <button type='submit' class='btn btn-success btn-update' data-bs-toggle='modal' data-bs-target='#update-modal'>Sửa</button>
                                    </form>
                                </td>
                                <td>
                                    <form action='index.php?act=deleteUser&id={$id_user}' method='post' onsubmit='return confirmDelete();'>
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
          <div id="update-modal" class="modal update-modal fade" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
            <form id="form-update" action="index.php?act=updateUser" method="post" enctype='multipart/form-data'>
              <div class="modal-dialog modal-dialog-centered modal-lg" >
                <div class="modal-content">
                  <div class="modal-header modal-update-header d-flex justify-content-center">
                    <h3 class="modal-title modal-update-title" id="exampleModalLabel">Cập Nhật Thông Tin Người Dùng</h3>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                        <div class="col">
                          <div class="form-group mb-4 text-center">
                            <h5>Ảnh Đại Diện</h5>
                            <img width="300px" src="https://banner2.cleanpng.com/20180603/jx/kisspng-user-interface-design-computer-icons-default-stephen-salazar-photography-5b1462e1b19d70.1261504615280626897275.jpg" alt="">
                            <a href="#"><p>Thay đổi</p></a>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group mb-4">
                            <label for="fullname" class="cols-sm-2 control-label"><b>Họ và tên: *</b></label>
                            <div class="input-group">
                              <input id="fullname" type="fullname" class="form-control" name="fullname" id="fullname"  placeholder="Nhập họ và tên"/>
                              <div id="errorMassage" class="text-center"></div>
                            </div>
                          </div>
          
                          <div class="form-group mb-4">
                              <label for="email" class="cols-sm-2 control-label"><b>Email: *</b></label>
                              <div class="input-group">
                                <input id="email" type="email" class="form-control" name="email" id="email"  placeholder="Nhập email"/>
                                <div id="errorMassage" class="text-center"></div>
                              </div>
                          </div>
                          <div class="row">
                            <div class="form-group mb-4 col">
                              <label for="gender" class="cols-sm-2 control-label"><b>Giới tính:</b> </label>
                              <select class="d-block" name="gender" id="gender">
                                <option value="">--Chọn--</option>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Khác">Khác</option>
                              </select>
                            </div>
                            <div class="form-group mb-4 col">
                              <label for="birthdate" class="cols-sm-2 control-label" min="1997-01-01" max="2022-01-01"><b>Ngày sinh: </b></label>
                              <div class="input-group">
                                <input id="birthdate" type="date" class="form-control" name="birthdate" id="birthdate"  placeholder="Nhập lại mật khẩu"/>
                                <div id="errorMassage" class="text-center"></div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group mb-4 col">
                            <label for="address" class="cols-sm-2 control-label"><b>Địa chỉ: </b></label>
                            <div class="input-group">
                              <input id="address" type="text" class="form-control" name="address" id="address"  placeholder="Nhập địa chỉ"/>
                              <div id="errorMassage" class="text-center"></div>
                            </div>
                          </div>
                          <div class="form-group mb-4 col">
                            <label for="telephone" class="cols-sm-2 control-label"><b>Số điện thoại: </b></label>
                            <div class="input-group">
                              <input id="telephone" type="text" class="form-control" name="telephone" id="telephone"  placeholder="Nhập số điện thoại"/>
                              <div id="errorMassage" class="text-center"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                
                  </div>
                  <div class="modal-footer modal-update-footer">
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-submit-n">Cập nhật</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>


<script type="text/javascript">
  const btnDeletes = $('.btn-delete');

  function confirmDelete(){
    return confirm('Bạn có chắc muốn xóa! ');
  }

  function handleModalUpdate(id, fullname, email, gender, birthdate, address, telephone){
    $("#form-update").attr("action", `index.php?act=updateUser&id=${id}`);
    $("#fullname").val(fullname);
    $("#email").val(email);
    $("#gender").val(gender);
    $("#birthdate").val(birthdate);
    $("#address").val(address);
    $("#telephone").val(telephone === undefined ? '' : String(telephone));
    return false;
  }

  // const form = $('#form-update');
  // const btnUpdates = $('.btn-update');
  // for(let btn of btnUpdates){
  //   btn.onclick = function(){
  //     const id = parseInt(this.parentElement.parentElement.parentElement.querySelector('.id-user').innerHTML);
      
  //   }
  // }


  $.validator.setDefaults({
      submitHandler: function () { return true; }
      
  });


  $(document).ready(function () {
      $("#form-update").validate({
          rules: {
              fullname: "required",
              email: { required: true, email: true }
          },
          messages: {
            fullname: "Họ và tên không được rỗng",
            email: "Hộp thư điện tử không hợp lệ"
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