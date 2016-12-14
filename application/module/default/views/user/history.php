<?php include_once BLOCK_PATH."header.php"; ?>
<div class="clear"></div>
<?php if(!empty($this->histories)){?>
    <div class="container" style="min-height: 500px;">
        <div class="cart_detail history">
            <table border="1" cellpadding="0" cellspacing="0">
                <tr bgcolor="white">
                    <th>Mã đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Số tiền</th>
                    <th>Thời gian</th>
                    <th>Địa chỉ</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Ghi chú</th>
                    <th>Trạng thái</th>
                </tr>
                <?php foreach ($this->histories as $history){ ?>
                    <tr>
                        <td>isbn<?php echo $history["id"]; ?></td>
                        <td><?php echo $history["name"]; ?></td>
                        <td><?php echo number_format($history["total"]); ?> VNĐ</td>
                        <td><?php echo date("d-m-Y",strtotime($history["time"])); ?></td>
                        <td><?php echo $history["address"]; ?></td>
                        <td><?php echo $history["email"]; ?></td>
                        <td><?php echo $history["phone"]; ?></td>
                        <td><?php echo $history["note"]; ?></td>
                        <td><?php if($history["status"]) {?><i class="fa fa-check-square-o" aria-hidden="true"></i><?php }else{ ?><i class="fa fa-dot-circle-o"></i><?php } ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
<?php }else{ ?>
    <div class="container" style="min-height: 500px;">
        <div class="cart-empty">
            <h3>Chưa có lịch sử mua hàng</h3>
        </div>
    </div>
<?php } ?>
<div class="clear"></div>
