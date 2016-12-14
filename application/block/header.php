<?php
    $user = Session::get("user");
    if($user["login"] == false) {
        $linkRegister = URL::createLink("default", "index", "register");
        $linkLogin = URL::createLink("default", "index", "login");
    }else {
        $linkAccount = "#";
        $linkLogout = URL::createLink("default","index","logout");
        $linkAdmin = URL::createLink("admin","group","index");
        $linkHistory = URL::createLink("default","user","history");
    }
    $model = new Model();
    $query = "SELECT `id`, `name` FROM `".TBL_PARENT."` WHERE `status` = 1 ORDER BY `ordering`";
    $parents = $model->fetchAll($query);
    $xhtml = "";
    if(!empty($parents)){
        foreach ($parents as $keyParent => $valueParent){
            $parentLink = "#";
            $parentName = $valueParent["name"];
            $xhtml .= '<li class="li-menu-container"><a title="'.$parentName.'" class="a-li-menu-container" href="'.$parentLink.'">'.$parentName.'</a>';
            $query = "SELECT `id`,`name` FROM `".TBL_CATEGORY."` WHERE `parent_id` = ".$valueParent["id"]." AND `status` = 1 ORDER BY `ordering`";
            $categories = $model->fetchAll($query);
            if(!empty($categories)){
                $xhtml .= '<ul class="level2">';
                foreach ($categories as $keyCategory => $valueCategory){
                    $categoryLink = URL::createLink("default","product","list",array("category_id" => $valueCategory["id"]));
                    $categoryName = $valueCategory["name"];
                    $xhtml.= '<li class="li-level2"><a class="a-level2" href="'.$categoryLink.'">'.$categoryName.'</a></li>';
                }
                $xhtml .= '</ul>';
            }
        }
    }
    $inputModule = Helper::createInput("module","hidden","default");
    $inputController= Helper::createInput("controller","hidden","product");
    $inputAction = Helper::createInput("action","hidden","list");
    $linkOrder = URL::createLink("default","user","order");
?>
<div class="wrapper wrapper-top">
    <div class="container">
        <div class="top-left">
            <span class="current" style="background-image: url(&quot;http://magento1.emthemes.com/everything/skin/frontend/em0131/default/images/media/home/language/english.png&quot;); background-repeat: no-repeat;">English</span>
            <ul class="language">
                <li>
                    <a style="background-image:url(http://magento1.emthemes.com/everything/skin/frontend/em0131/default/images/media/home/language/english.png); background-repeat: no-repeat;" href="#">English</a>
                </li>
                <li>
                    <a style="background-image:url(http://magento1.emthemes.com/everything/skin/frontend/em0131/default/images/media/home/language/french.png); background-repeat: no-repeat;" href="#">French</a>
                </li>
            </ul>
        </div>
        <div class="top-right">
            <?php if($user["login"] == 1){ ?>
                <a href="<?php echo $linkLogout; ?>" class="logout">Logout</a>
                <a href="<?php echo $linkHistory; ?>" class="account"><?php echo "Xin chào ".$user["info"]["fullname"]; ?></a>
                <?php if($user["info"]["acp"] > 0){?>
                    <a href="<?php echo $linkAdmin; ?>" class="admin">Trang Quản Trị</a>
                <?php } ?>
            <?php }else{ ?>
                <a href="<?php echo $linkRegister; ?>" class="signup">Đăng Ký</a>
                <div id="login">
                    <a href="#" class="login">Đăng Nhập</a>
                    <div class="frm-login">
                        <form method="POST" action="<?php echo $linkLogin;?>">
                            <div class="block-content">
                                <ul>
                                    <li>
                                        <label>Username *</label>
                                        <input type="text" name="form[username]" id="Username" class="input-text"/>
                                    </li>
                                    <li>
                                        <label>Password *</label>
                                        <input type="password" name="form[password]" id="Password" class="input-text"//>
                                    </li>
                                    <li>
                                        <span>* Bắt Buộc</span><br/>
                                        <div class="required">
                                            <span class="fotgot">Quên Mật Khẩu</span></br>
                                            <span class="notacc">Bạn chưa có tài khoản? <a href="<?php echo $linkRegister; ?>">Đăng Ký</a></span><br/>
                                        </div>
                                        <button type="submit" name="btnLogin" class="button">Đăng Nhập</button>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="container">
    <div class="logo">
        <a href="index.php">
            <img  src="http://www.uit.edu.vn/sites/vi/files/banner_10.png"/>
        </a>
    </div>
    <div class="search">
        <div class="form-search">
            <form action="index.php">
                <input id="search" type="search" name="keyword" value="" maxlength="128" placeholder="Nhập từ khóa">
                <button type="submit" value="Search" class="btnSearch"/>
                <?php echo $inputModule;?>
                <?php echo $inputController;?>
                <?php echo $inputAction;?>
            </form>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="wrapper-nav">
    <div class="container">
        <div class="nav">
            <img class="logo-fixtop" src="http://tuoitre.uit.edu.vn/wp-content/uploads/2015/07/logo-uit.png"/>
            <ul class="ul-nav">
                <li id="category" class="category">
                    <a href="#" class="a-category">DANH MỤC SẢN PHẨM</a>
                    <ul class="menu-container">
                        <?php echo $xhtml;?>
                    </ul>
                </li>
                <li class="category"><a class="category-page" href="index.php">Trang Chủ</a></li>
                <li class="category"><a class="category-page" href="#">Giới Thiệu</a></li>
                <li class="category"><a class="category-page" href="#">Diễn Đàn</a></li>
                <li class="category"><a class="category-page" href="#">Liên Hệ</a></li>
                <a href="<?php echo $linkOrder; ?>" class="cart">
                    <i class="fa fa-shopping-bag" aria-hidden="true">
                        <span class="cart-quantity"><?php echo count(Session::get("cart")); ?></span>
                    </i>
                </a>
            </ul>
        </div>
    </div>
</div>