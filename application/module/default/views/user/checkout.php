<?php
    include_once BLOCK_PATH."header.php";
    $user = Session::get("user");
?>
<div class="clear"></div>
<div class="container">
    <div class="checkout">
        <div class="checkout-title">
            <h2>Thông Tin Thanh Toán</h2>
        </div>
        <div class="checkout-step">
            <form method="POST">
                <div class="field-checkout">
                    <label>Họ tên *</label></br>
                    <input name="form[name]" type="text" placeholder="Vui lòng nhập họ tên" value="<?php echo isset($user) ? $user["info"]["fullname"] : "" ?>"/>
                </div>
                <div class="field-checkout">
                    <label>Email *</label></br>
                    <input name="form[email]" type="text" placeholder="Vui lòng nhập email" value="<?php echo isset($user) ? $user["info"]["email"] : "" ?>"/>
                </div>
                <div class="field-checkout">
                    <label>Địa chỉ *</label></br>
                    <input name="form[address]" type="text" placeholder="Vui lòng địa chỉ"/>
                </div>
                <div class="field-checkout">
                    <label>Số điện thoại *</label></br>
                    <input name="form[phone]" type="text" placeholder="Vui lòng nhập điện thoại"/>
                </div>
                <div class="field-checkout">
                    <label>Ngày giao hàng *</label></br>
                    <input name="form[date]" type="date" placeholder="Vui lòng nhập ngày giao hàng"/>
                </div>
                <div class="field-checkout">
                    <label>Thông tin khác</label></br>
                    <input name="form[note]" type="text" placeholder="Nhập thông tin khác"/>
                </div>
                <input type="submit" value="Gửi Thông Tin" class="button-medium" name="btnCheckout"/>
            </form>
        </div>
    </div>
</div>
<div class="clear"></div>
