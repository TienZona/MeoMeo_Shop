
<div id="header" class="container-fruid">
    <nav class="navbar navbar-expand-lg navbar-dark header-navbar">
        <div class="container">
          <a class="navbar-brand" href="/MeoMeo_Shop/views/home/index.php?act=home">
            <img src="/MeoMeo_Shop/img/logo_meomeo.png" alt="" width="160">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex navbar-search">
              <input class="form-control me-2 navbar-search-input" type="search" placeholder="Tìm sản phẩm" aria-label="Search">
              <button class="btn btn-outline-success navbar-search-btn" type="submit"><i class="icon-search fas fa-search"></i></button>
            </form>
          </div>
          <div class="navbar-list">
            <div class="navbar-item navbar-item--user">
              <i class="fas fa-user"><span class="navbar-item-name">user</span></i>
              <?php
                  if (isset($_SESSION["user"]))
                  {
                      $user = $_SESSION["user"];
                      echo "
                        <div class='user-box'>
                          <div class='user-box__header'>
                            <span>$user</span> <span>|</span> <a href='../login/index.php?act=out'>Đăng xuất</a>
                            <i class='fas fa-times user-box__header-close'></i>
                          </div>
                          <div class='user-box__content'>
                            <div class='user-box__content-item'>
                              <i class='fas fa-user-circle'></i>
                              <span>Tài khoản </span>
                            </div>
                            <div class='user-box__content-item'>
                              <i class='fas fa-box'></i>
                              <span>Đơn hàng </span>
                            </div>
                          </div>
                        </div>
                      ";
                  }else
                  {
                      echo "
                      <div class='user-box'>
                        <div class='user-box__header'>
                          <a href='../login/index.php?act=log'>Đăng nhập</a> <span>|</span> <a href='../register/index.php?act=reg'>Đăng ký</a>
                          <i class='fas fa-times user-box__header-close'></i>
                        </div>
                        <div class='user-box__content'>
                          <div class='user-box__content-item'>
                            <i class='fas fa-user-circle'></i>
                            <span>Tài khoản </span>
                          </div>
                          <div class='user-box__content-item'>
                            <i class='fas fa-box'></i>
                            <span>Đơn hàng </span>
                          </div>
                        </div>
                      </div>
                    ";
            
                  }
                ?>
                
            </div>
            <div class="navbar-item">
              <i class="fas fa-bell"><span class="navbar-item-name">notify</span></i>
            </div>
            <div class="navbar-item">
              <i class="fas fa-shopping-bag"><span class="navbar-item-name">cart</span></i>
            </div>
          </div>
        </div>
    </nav>
    <ul class="nav nav-tabs navbar-dark header-nav-sub">
      <div class="container navbar-sub">
        <li class="nav-item">
          <a class="nav-link" href="/MeoMeo_Shop/views/product/index.php?act=home">Sản phẩm</a>
        </li>
        <?php
          if(isset($_SESSION['rule']) && $_SESSION['rule'] == 'admin'){
            echo '<li class="nav-item">
                    <a class="nav-link" href="/MeoMeo_Shop/views/admin/index.php?act=home">Quản trị</a>
                  </li>';
          }

        ?>
      </div>
    </ul>
  </div>