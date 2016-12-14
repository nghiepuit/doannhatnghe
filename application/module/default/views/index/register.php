<?php include_once BLOCK_PATH."header.php"; ?>
<div class="clear"></div>
<div class="clear"></div>
<div class="wrapper">
    <div class="container">
        <div class="road-map">
            <span id="home">Trang Chủ</span>
            <span>Danh Mục</span>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="container" style="min-height: 400px;">
    <div class="register">
        <h1>Đăng Ký Tài Khoản</h1>
        <form method="POST" name="frmRegister">
            <?php echo isset($this->errors) ? $this->errors : "" ?>
            <div class="field">
                <label>Username *</label></br>
                <input value="<?php echo isset($this->dataForm["username"]) ? $this->dataForm["username"] : "" ; ?>" class="input-validate" type="text" name="form[username]" maxlength="255" placeholder="Nhập username">
                <div class="require" id="required-username">Vui lòng nhập username</div>
            </div>
            <div class="field">
                <label>Email *</label></br>
                <input value="<?php echo isset($this->dataForm["email"]) ? $this->dataForm["email"] : "" ; ?>" class="input-validate" type="text" name="form[email]" maxlength="255" placeholder="Nhập email">
                <div class="require" id="required-email">Vui lòng nhập email.</div>
            </div>
            <div class="field">
                <label>Fullname *</label></br>
                <input value="<?php echo isset($this->dataForm["fullname"]) ? $this->dataForm["fullname"] : "" ; ?>" type="text" name="form[fullname]" maxlength="255" placeholder="Nhập tên">
            </div>
            <div class="field">
                <label>Mật Khẩu *</label></br>
                <input id="password" value="<?php echo isset($this->dataForm["password"]) ? $this->dataForm["password"] : "" ; ?>" class="input-validate" type="password" name="form[password]" maxlength="255" placeholder="Nhập password">
                <div class="require" id="required-password">Vui lòng nhập password.</div>
            </div>
            <div class="field">
                <label>Nhập Lại Mật Khẩu *</label></br>
                <input id="input-repassword" value="<?php echo isset($this->dataForm["repassword"]) ? $this->dataForm["repassword"] : "" ; ?>"  class="input-validate" type="password" name="form[repassword]" maxlength="255" placeholder="Nhập lại password">
                <div class="require" id="required-password">Vui lòng nhập lại password.</div>
                <div class="required-repassword" id="required-repassword">Vui lòng nhập giống password.</div>
            </div>
            <div class="clear"></div>
            <input type="submit" class="button-medium" name="btnRegister" value="Đăng Ký"/>
        </form>
    </div>
</div>
<div class="clear50"></div>
