<div class="container" style="margin: 100px auto">
    <div class="row main">
        <div class="main-login main-center">
        <form id="registerForm" class="form-horizontal" method="post" action="index.php?act=reg">
                <h1 id="header-form" class="header text-center"> Đăng ký</h1>
                <div class="main-login-content">
                    <div class="form-group">
                        <label for="fullname" class="cols-sm-2 control-label">Họ và tên:</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                          <input id="fullname" type="text" class="form-control" name="fullname" id="fullname"  placeholder="Nhập tên của bạn"/>
                          <div id="errorMassage-fullname" class="text-center err-fullname"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="cols-sm-2 control-label">Email:</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                          <input id="email" type="text" class="form-control" name="email" id="email"  placeholder="Nhập email"/>
                          <div id="errorMassage" class="text-center err-email"></div>
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="cols-sm-2 control-label">Tên tài khoản:</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                          <input id="username" type="text" class="form-control" name="username" id="username"  placeholder="Nhập tên tài khoản"/>
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
                <br/> <center><div style="border:1px solid black;height:1px;width:300px;"></div></center><br />
                <div class="form-group ">
                    <button type="submit" class="btn btn-primary btn-lg btn-block login-button btn-login p-0">Đăng ký</button>
                </div>
                <div class="login-register mb-5">
                    <p class="fs-5">Bạn đã có tài khoản! <a href="../../login/index.php?act=login">Đăng nhập</a></p>
                    </div>
            </form>
        </div>
    </div>
</div>
