
<div id="header" class="container-fruid">
    <nav class="navbar navbar-expand-lg navbar-dark header-navbar">
        <div class="container">
          <a class="navbar-brand d-flex" href="/MeoMeo_Shop/views/home/index.php?act=home">
            <img src="/MeoMeo_Shop/img/logo_meomeo.png" alt="" width="160">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form id="search-form" class="d-flex navbar-search" action="../../views/product/index.php?" method="get">
              <input class="form-control me-2 navbar-search-input" name="search" type="search" placeholder="Tìm sản phẩm" aria-label="Search">
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
                              <a href='../profile/index.php?act=profile' class='user-box__content-item'>
                                <i class='fas fa-user-circle'></i>
                                <span>Tài khoản </span>
                              </a>
                           
                              <a href='../order/index.php?act=order' class='user-box__content-item'>
                                <i class='fas fa-box'></i>
                                <span>Đơn hàng </span>
                              </a>
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
            <style> 
              /* .navbar-item--notify:hover .notify-box{
                display: block;
              } */
            </style>
            <div class="navbar-item navbar-item--notify">
              <i class="fas fa-bell"><span class="navbar-item-name">notify</span></i>
              <div class="box-notify">
                <div class="box-notify__header text-center p-2 bg-info rounded-top rounded-2">
                  <span class="text-light">Thông báo mới nhận</span>
                </div>
                <div class="box-notify__container p-2">
                  <div class="box-notify__item d-flex bg-secondary bg-opacity-10">
                    <img src="./img/girl.jpg" alt="" width="60px">
                    <div class="box-notify__item-content d-flex flex-column mx-2">
                      <span class="fw-bold fs-6">Tên sản phẩm</span>
                      <span class="text-secondary an-2 m-0">Thong tin chi tietThong tin chi tietThong tin chi tietThong tin chi tiet</span>
                    </div>
                  </div>
                </div>
                <div class="box-notify__footer text-center p-2">
                  <a class="text-dark text-decoration-none">Xem tất cả</a>
                </div>
              </div>
            </div>
            <div class="navbar-item navbar-item--bag">
              <i class="fas fa-shopping-bag"><span class="navbar-item-name">cart</span></i>
              <div class='bag-box'>
                  <div id="bag-box__list" class="bag-box__container">
                  <img src="../../img/empty-cart.jpg" alt="" width="320px">
                  </div>
                  <div class="bag-box__footer">
                    <a href="../../views/cart/index.php?act=home&id=<?= $id_user ?>" class="btn btn-danger">Xem vỏ hàng</a>
                  </div>
              </div>
              <div class="navbar-item__box d-none">
                <span class="navbar-item__quantity"></span>
              </div>
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

  <script type="text/javascript">
    const id_user = <?= $id_user; ?>;    
      showCart(id_user);
      function showCart(id_user) {
          if (id_user == "") {
              document.getElementById("bag-box__list").innerHTML = '<img src="../../img/empty-cart.jpg" alt="" width="320px">';
              return;
          }
          const xhttp = new XMLHttpRequest();
          xhttp.onload = function() {
              document.getElementById("bag-box__list").innerHTML = this.responseText;
              const number = this.responseText.split('bag-item d-flex justify-content-between align-items-center mb-2').length - 1;
              if(number > 0){
                const element = document.querySelector('.navbar-item__quantity');
                element.innerHTML = number;
                document.querySelector('.navbar-item__box').classList.remove('d-none');
              }else{
                document.querySelector('.navbar-item__box').classList.add('d-none');
              }
            }
          xhttp.open("GET", "../../views/layouts/index.php?getCart="+id_user);
          xhttp.send();
      }

      function deleteItem(id_user, id_product, color, size, quantity){
        $.ajax({
          url: "../../views/layouts/index.php",
          method: "POST",
          data: { id_user: id_user, id_product: id_product, color: color, size: size, quantity: quantity},
          cache: false,
          error: function(xhr ,text){
              alert('Đã có lỗi: ' + text);
          }
        });
        showCart(id_user);
        showItem(id_user);
      }
    
  </script>