<?php
$selectboxGroup = Helper::createSelectBox("form[group_id]","selected_box",$this->slbGroup,isset($this->dataForm["group_id"]) ? $this->dataForm["group_id"] : "");
$linkIndex = URL::createLink("admin","user","index");
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo $this->title;?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo $linkIndex;?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $this->title;?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->title;?></h3>
                        </div>
                        <form role="form" action="#" method="post">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Username *</label>
                                    <input class="form-control" placeholder="Nhập username" name="form[username]" value="<?php if(isset($this->dataForm['username'])) echo $this->dataForm['username'];?>">
                                    <span class="help-block"><?php echo isset($this->errors["username"]) ? $this->errors["username"] : "" ;?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email *</label>
                                    <input type="email" class="form-control" placeholder="Nhập email" name="form[email]" value="<?php if(isset($this->dataForm['email'])) echo $this->dataForm['email'];?>">
                                    <span class="help-block"><?php echo isset($this->errors["email"]) ? $this->errors["email"] : "" ;?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ Tên *</label>
                                    <input class="form-control" placeholder="Nhập họ tên" name="form[fullname]" value="<?php if(isset($this->dataForm['fullname'])) echo $this->dataForm['fullname'];?>">
                                    <span class="help-block"><?php echo isset($this->errors["fullname"]) ? $this->errors["fullname"] : "" ;?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password *</label>
                                    <input type="password" class="form-control" placeholder="Nhập password" name="form[password]" value="<?php if(isset($this->dataForm['password'])) echo $this->dataForm['password'];?>">
                                    <span class="help-block"><?php echo isset($this->errors["password"]) ? $this->errors["password"] : "" ;?></span>
                                </div>
                                <div class="form-group">
                                    <label>Trạng Thái</label>
                                    <div class="checkbox">
                                        <input type="radio" name="form[status]" value="0" checked="checked"> Ẩn &nbsp;
                                        <input type="radio" name="form[status]" value="1" <?php if(isset($this->dataForm['status']) && $this->dataForm['status']) echo 'checked="checked"'; ?> > Hiện
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thứ Tự</label>
                                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Nhập Thứ Tự" name="form[ordering]" value="<?php if(isset($this->dataForm['ordering'])) echo $this->dataForm['ordering'];?>">
                                    <span class="help-block"><?php echo isset($this->errors["ordering"]) ? $this->errors["ordering"] : "" ;?></span>
                                </div>
                                <div class="form-group">
                                    <label>Group *</label><br/>
                                    <?php echo $selectboxGroup; ?>
                                    <span class="help-block"><?php echo isset($this->errors["group_id"]) ? $this->errors["group_id"] : "" ;?></span>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" name="<?php if(isset($this->dataForm['id'])) {echo 'edit';} else echo 'add' ?>">Lưu</button>
                                <button type="reset" class="btn btn-primary">Làm Lại</button>
                            </div>
                            <input type="hidden" name="form[modified]" value="<?php if(isset($this->dataForm['modified'])) echo $this->dataForm['modified'];?>"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>