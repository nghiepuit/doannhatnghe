<?php
$linkAdd = URL::createLink("admin","user","form");
$btnAdd = Helper::createButton("fa fa-plus-square",$linkAdd);
$linkDelete = URL::createLink("admin","user","delete");
$btnDelete = Helper::createButton("fa fa-trash",$linkDelete,"submit");
$linkIndex = URL::createLink("admin","user","index");
$selectboxGroup = Helper::createSelectBox("group_id","selected_box",$this->slbGroup,isset($this->params["group_id"]) ? $this->params["group_id"] :"");

$message = Session::get("message");
Session::delete("message");
$strMessage = Helper::createMessage($message);
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo $this->title?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php?module=admin&controller=group&action=index"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $this->title?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <?php echo $strMessage;?>
                        <form action="#" method="POST" id="frmAdmin" name="frmAdmin">
                            <div>
                                <div class="input-group input-group-sm search-bar">
                                    <input type="text" class="form-control pull-right" placeholder="Nhập từ khóa" name="keyword" value="<?php if(isset($this->params['keyword'])) echo $this->params['keyword'];?>">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default" name="submit-keyword"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                <div style=" float: right;text-align: right">
                                    <?php echo $selectboxGroup;?>
                                </div>
                            </div>

                            </br>
                            <table class="table table-bordered">
                                <tr>
                                    <th><input type="checkbox" name="checkall-group"/></th>
                                    <th width="3%">STT</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Fullname</th>
                                    <th  width="5%">Group</th>
                                    <th width="5%">Status</th>
                                    <th>Created</th>
                                    <th>Created By</th>
                                    <th>Modified</th>
                                    <th>Modified By</th>
                                    <th>ID</th>
                                    <th>
                                        <?php echo $btnAdd; ?>
                                        <?php echo $btnDelete; ?>
                                    </th>
                                </tr>

                            </table>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>