<?php
$linkAdd = URL::createLink("admin","group","form");
$btnAdd = Helper::createButton("fa fa-plus-square",$linkAdd);
$linkDelete = URL::createLink("admin","group","delete");
$btnDelete = Helper::createButton("fa fa-trash",$linkDelete,"submit");
$linkIndex = URL::createLink("admin","group","index");

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
                                <div class="input-group input-group-sm" style="width: 500px;">
                                    <input type="text" class="form-control pull-right" placeholder="Nhập từ khóa" name="keyword" value="<?php if(isset($this->params['keyword'])) echo $this->params['keyword'];?>">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default" name="submit-keyword"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div></br>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30"><input type="checkbox" name="checkall-group"/></th>
                                    <th style="width: 10px">STT</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>ACP</th>
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
                                if(!empty($this->groups)) {
                                    $i=0;
                                    foreach ($this->groups as $group) {
                                        $row = ($i%2 == 0)?"odd":"even";
                                        $status = Helper::createStatus($group["status"], URL::createLink("admin","group","ajaxStatus",array("id" => $group["id"],"status" => $group["status"])),$group["id"]);
                                        $acp = Helper::createACP($group["acp"], URL::createLink("admin","group","ajaxACP",array("id" => $group["id"],"acp" => $group["acp"])),$group["id"]);
                                        $created = Helper::formatDate("d-m-Y",$group["created"]);
                                        $modified = Helper::formatDate("d-m-Y",$group["modified"]);

                                        $linkEdit = URL::createLink("admin","group","form",array("id" => $group["id"]));
                                        $btnEdit = Helper::createButton("fa fa-edit",$linkEdit);
                                        $linkSingleDelete = URL::createLink("admin","group","deleteSingle",array("id" => $group["id"]));
                                        $btnSingleDelete = Helper::createButton("fa fa-trash",$linkSingleDelete);
                                        ?>
                                        <tr class="<?php echo $row;?>">
                                            <td><input type="checkbox" name="ids[]" value="<?php echo $group['id'];?>"/></td>
                                            <td><?php echo $group["ordering"]; ?></td>
                                            <td><a href="<?php echo $linkEdit;?>"><?php echo $group["name"]; ?></a></td>
                                            <td align="center">
                                                <?php echo $status;?>
                                            </td>
                                            <td align="center">
                                                <?php echo $acp;?>
                                            </td>
                                            <td><?php echo $created; ?></td>
                                            <td><?php echo $group["created_by"]; ?></td>
                                            <td><?php echo $modified; ?></td>
                                            <td><?php echo $group["modified_by"]; ?></td>
                                            <td><?php echo $group["id"]; ?></td>
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