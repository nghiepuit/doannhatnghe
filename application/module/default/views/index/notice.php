<?php include_once BLOCK_PATH."header.php"; ?>
<div class="clear"></div>
<div class="container" style="min-height: 400px;">
    <?php if(isset($this->params["type"])){ ?>
        <?php if($this->params["type"] == "login-failed"){?>
            <div class="notice notice-close">
                <i class="fa fa-close" aria-hidden="true"></i>
                <span>Tài khoản hoặc mật khẩu không chính xác</span>
            </div>
        <?php }else if($this->params["type"] == "checkout-success"){?>
            <div class="notice">
                <i class="fa fa-check" aria-hidden="true"></i>
                <span>Mua hàng thành công! Cám ơn bạn!</span>
            </div>
        <?php }else{ ?>
            <div class="notice">
                <i class="fa fa-check" aria-hidden="true"></i>
                <span>Đăng ký thành công</span>
            </div>
        <?php } ?>
    <?php } ?>
</div>
<div class="clear"></div>
