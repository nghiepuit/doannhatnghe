<?php
$linkIndex = URL::createLink("admin","group","index");
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
                                    <label for="exampleInputEmail1">Tên Group</label>
                                    <input class="form-control" placeholder="Nhập Tên Group" name="form[name]" value="<?php if(isset($this->dataForm['name'])) echo $this->dataForm['name'];?>">
                                    <span class="help-block"><?php echo isset($this->errors["name"]) ? $this->errors["name"] : "" ;?></span>
                                </div>
                                <div class="form-group">
                                    <label>Trạng Thái</label>
                                    <div class="checkbox">
                                        <input type="radio" name="form[status]" value="0" checked="checked"> Ẩn &nbsp;
                                        <input type="radio" name="form[status]" value="1" <?php if(isset($this->dataForm['status']) && $this->dataForm['status']) echo 'checked="checked"'; ?> > Hiện
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Group ACP</label>
                                    <select class="form-control" name="form[acp]">
                                        <option value="0" selected="selected">Ẩn</option>
                                        <option value="1" <?php if(isset($this->dataForm['acp']) && $this->dataForm['acp']) echo 'selected="selected"'; ?>>Hiện</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thứ Tự</label>
                                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Nhập Thứ Tự" name="form[ordering]" value="<?php if(isset($this->dataForm['ordering'])) echo $this->dataForm['ordering'];?>">
                                    <span class="help-block"><?php echo isset($this->errors["ordering"]) ? $this->errors["ordering"] : "" ;?></span>
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