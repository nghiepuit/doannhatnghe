<?php
    $linkHomePage = URL::createLink("default","index","index");
    $linkMnGroup = URL::createLink("admin","group","index");
    $linkMnUser = URL::createLink("admin","user","index");
    $linkMnParent = URL::createLink("admin","parent","index");
    $linkMnCategory = URL::createLink("admin","category","index");
    $linkMnProduct = URL::createLink("admin","product","index");
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="https://daa.uit.edu.vn/image.php?user=13520549&id=3321f42ef5" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Phan Phước Nghiệp</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="<?php echo $linkHomePage;?>">
                    <i class="fa fa-user"></i> <span>Trang người dùng</span>
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo $linkMnGroup;?>">
                    <i class="fa fa-table"></i> <span>Quản Lý Group</span>
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo $linkMnUser;?>">
                    <i class="fa fa-user"></i> <span>Quản Lý User</span>
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo $linkMnParent;?>">
                    <i class="fa fa-cubes" aria-hidden="true"></i> <span>Quản Lý Chủng Loại</span>
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo $linkMnCategory;?>">
                    <i class="fa fa-th" aria-hidden="true"></i>Quản Lý Loại</span>
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo $linkMnProduct;?>">
                    <i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Quản Lý Sản Phẩm</span>
                </a>
            </li>
        </ul>
    </section>
</aside>