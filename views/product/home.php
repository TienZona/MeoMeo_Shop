

<div  id="product-container" class="container" style="margin-top: 110px">
    <div class="row">
        <div class="col">
            <div id="product-container-navbar" class="d-flex justify-content-around align-items-center">
                
                <div id="menu-product" class="dropdown">
                <button class="btn btn-dark btn-menu-product">
                    <span class="name-type">
                        <?php 
                            if(isset($_GET['act']) && $_GET['act']=='category' && isset($_GET['id']))
                                echo getCategoryName($_GET['id']);
                            else echo 'Tất cả sản phẩm';
                        ?>
                    </span>
                    <div class="btn-icon">
                        <i class="fa-solid fa-caret-down mx-1 icon-down"></i>
                        <i class="fa-solid fa-caret-up mx-1 d-none icon-up"></i>
                    </div>
                </button>
                
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <?php
                        $categorys = getAllCategory();
                        echo '<li><a class="dropdown-item menu-product__item" href="index.php?act=category">Tất cả sản phẩm</a></li>';
                        foreach($categorys as $category){
                            extract($category);
                            echo '<li><a class="dropdown-item menu-product__item" href="index.php?act=category&id='.$id_category.'">'.$name.'</a></li>
                            ';
                        }
                    ?>
                </ul>
                </div>
                <div id="group-choice" class="btn-group" role="group" aria-label="Basic outlined example">
                <a href="index.php?act=search&tim=banchay" type="button" class="btn btn-light btn-item <?php if(isset($_GET['tim']) && $_GET['tim'] == 'banchay') echo 'active';?>">Bán chạy nhất</a>
                <a href="index.php?act=search&tim=giamgia" type="button" class="btn btn-light btn-item <?php if(isset($_GET['tim']) && $_GET['tim'] == 'giamgia') echo 'active';?>">Giảm giá</a>
                <a href="index.php?act=search&tim=giacao" type="button" class="btn btn-light btn-item <?php if(isset($_GET['tim']) && $_GET['tim'] == 'giacao') echo 'active';?>">Giá cao</a>
                <a href="index.php?act=search&tim=giathap" type="button" class="btn btn-light btn-item <?php if(isset($_GET['tim']) && $_GET['tim'] == 'giathap') echo 'active';?>">Giá thấp</a>
                </div>
                <div id="group-price" class="dropdown">
                <button class="btn btn-dark btn-menu-product">
                    <span class="name-price">Lọc giá sản phẩm</span>
                    <div class="btn-icon">
                    <i class="fa-solid fa-caret-down mx-1 icon-down"></i>
                    <i class="fa-solid fa-caret-up mx-1 d-none icon-up"></i>
                    </div>
                </button>
                
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item group-price__item" href="#">Dưới 100 ngàn</a></li>
                    <li><a class="dropdown-item group-price__item" href="#">100 - 200 ngàn</a></li>
                    <li><a class="dropdown-item group-price__item" href="#">200 - 300 ngàn</a></li>
                    <li><a class="dropdown-item group-price__item" href="#">300 - 400 ngàn</a></li>
                    <li><a class="dropdown-item group-price__item" href="#">400 - 500 ngàn</a></li>
                    <li><a class="dropdown-item group-price__item" href="#">Hơn 500 ngàn</a></li>
                </ul>
                </div>
            </div>
            
            <div id="product-container-content" class="container">
                <div class="row product-list gy-4" >
                    <?php 
                    
                        renderProductLimit($number, $page ,$listProduct);
                    ?>
                    
                </div>
                
                <?php
                // render pagination
                if($listProduct){
                    // render previous page
                    $previousPage = $_SERVER['REQUEST_URI'];
                    $maxPage = ceil(count($listProduct)/$number) - 1;
                    if(!isset($_GET['page'])){
                        $previousPage = $_SERVER['REQUEST_URI'] . '&page=' . $maxPage;
                    }
                    else{
                        $index = strpos($_SERVER['REQUEST_URI'], '&page');
                        $numberPrevious = $_GET['page'] - 1;
                        if($numberPrevious >= 0)
                            $previousPage = substr($_SERVER['REQUEST_URI'], 0 , $index) . '&page=' . $numberPrevious;
                        else
                            $previousPage = substr($_SERVER['REQUEST_URI'], 0 , $index) . '&page=' . $maxPage;
                    }
                    echo '
                    <nav class="d-flex justify-content-center" aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class=" page-item pagination-previous mx-3">
                            <a class="page-link" href="'.$previousPage.'" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                            </li>
                    ';
                    // render number page
                    $currentPage = 0;
                    for($i = 0; $i < count($listProduct)/$number; $i++){
                        $a = strpos($_SERVER['REQUEST_URI'], '&page');
                        $a == '' ? $link = $_SERVER['REQUEST_URI']: $link = substr($_SERVER['REQUEST_URI'], 0, $a); 
                        $link .= '&page=' . $i;
                        if(isset($_GET['page'])){
                            $currentPage = $_GET['page'];
                        }
                        if((!$currentPage && $i == 0) || $currentPage == $i)
                            echo '<li class="page-item pagination-item active"><a class="page-link" href="'.$link.'">'.($i + 1).'</a></li>';
                        else    
                            echo '<li class="page-item pagination-item"><a class="page-link" href="'.$link.'">'.($i + 1).'</a></li>';
                        
                    }
                    // render next page
                    $nextPage = $_SERVER['REQUEST_URI'];
                    if(!isset($_GET['page']))
                        $nextPage = $_SERVER['REQUEST_URI'] . '&page='. 1;
                    else{
                        $index = strpos($_SERVER['REQUEST_URI'], '&page');
                        $numberNext = $_GET['page'] + 1;
                        if($numberNext < count($listProduct)/$number)
                            $nextPage = substr($_SERVER['REQUEST_URI'], 0 , $index) . '&page=' . $numberNext;
                        else
                            $nextPage = substr($_SERVER['REQUEST_URI'], 0 , $index) . '&page=' . 0;
                    }
                    echo '
                                <li class="page-item pagination-next mx-3">
                            <a class="page-link" href="'.$nextPage.'" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                            </li>
                        </ul>
                    </nav>
                    ';
                }
                ?>        
            </div>
            
        </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

      // handle menu product
      $('.menu-product__item').click(function(e){
        $('.name-type').html(e.target.innerHTML);
      })

      // handle menu product
      $('.group-price__item').click(function(e){
        $('.name-price').html(e.target.innerHTML);
      })

      // handle group choice
      $('.btn-item').each(function(index, item){
        item.onclick = function(e){
          $('.btn-item.active').removeClass('active');
          e.target.classList.add('active');
        }
      })

      // handle product item heart
      $('.icon-heart').click(function(e){
          e.target.classList.contains('active') ? e.target.classList.remove('active') : e.target.classList.add('active');
      })

      // handle pagination
      $('.pagination-item').each(function(index, item){
        item.onclick = function(e){
          $('.pagination-item.active').removeClass('active');
          console.log($('.pagination-item.active'))
          e.target.parentElement.classList.add('active');
        }
      })
      
      // handle next page 
      $('.pagination-item').change(function(e){
          console.log(e.target);
      })
    });


  </script>