<?php
$linkAdd = URL::createLink("admin","category","form");
$btnAdd = Helper::createButton("fa fa-plus-square",$linkAdd);
$linkDelete = URL::createLink("admin","category","delete");
$btnDelete = Helper::createButton("fa fa-trash",$linkDelete,"submit");
$linkIndex = URL::createLink("admin","category","index");
$selectboxCategory = Helper::createSelectBox("parent_id","selected_box",$this->slbParent,isset($this->params["parent_id"]) ? $this->params["parent_id"] :"");

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
            <li><a href="index.php?module=admin&controller=category&action=index"><i class="fa fa-dashboard"></i> Home</a></li>
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
                                    <?php echo $selectboxCategory;?>
                                </div>
                            </div>

                            </br>
                            <table class="table table-bordered">
                                <tr>
                                    <th><input type="checkbox" name="checkall-group"/></th>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Chủng Loại</th>
                                    <th>Status</th>
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
                                <?php
                                if(!empty($this->categories)) {
                                    $i=0;
                                    foreach ($this->categories as $category) {
                                        $row = ($i%2 == 0)?"odd":"even";
                                        $status = Helper::createStatus($category["status"], URL::createLink("admin","category","ajaxStatus",array("id" => $category["id"],"status" => $category["status"])),$category["id"]);
                                        $created = Helper::formatDate("d-m-Y",$category["created"]);
                                        $modified = Helper::formatDate("d-m-Y",$category["modified"]);
                                        $linkEdit = URL::createLink("admin","category","form",array("id" => $category["id"]));
                                        $btnEdit = Helper::createButton("fa fa-edit",$linkEdit);
                                        $linkSingleDelete = URL::createLink("admin","category","deleteSingle",array("id" => $category["id"]));
                                        $btnSingleDelete = Helper::createButton("fa fa-trash",$linkSingleDelete);
                                        ?>
                                        <tr class="<?php echo $row;?>">
                                            <td><input type="checkbox" name="ids[]" value="<?php echo $category['id'];?>"/></td>
                                            <td align="center"><?php echo $category["ordering"]; ?></td>
                                            <td align="center"><?php echo $category["name"];?></td>
                                            <td align="center"><?php echo $category["parent_name"];?></td>
                                            <td align="center">
                                                <?php echo $status;?>
                                            </td>
                                            <td><?php echo $created; ?></td>
                                            <td align="center"><?php echo $category["created_by"]; ?></td>
                                            <td><?php echo $modified; ?></td>
                                            <td align="center"><?php echo $category["modified_by"]; ?></td>
                                            <td align="center"><?php echo $category["id"]; ?></td>
                                            <td>
                                                <?php echo $btnEdit;?>
                                                /
                                                <?php echo $btnSingleDelete;?>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </table>
                            <?php echo $this->pagination->showPaginationAdmin($linkIndex); ?>
                            <input type="hidden" name="filter_page" value="1" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>