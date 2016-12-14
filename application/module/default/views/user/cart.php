<?php
include_once BLOCK_PATH."header.php";
$linkCheckout = URL::createLink("default","user","checkout");
if(isset($this->cart) && count($this->cart) >0 ){
    $total = 0;
    $xhtmlCart = "";
    for ($i=0;$i<count($this->cart);$i++){
        $linkProduct = URL::createLink("default","product","detail",array("product_id" => $this->cart[$i]["product_id"]));
        $total += $this->cart[$i]["product_price"]*$this->cart[$i]["quantity"];
        $linkAddAjaxCart = URL::createLink("default","user","ajaxCart",array("type" => 1, "product_pos" => $i));
        $linkMinusAjaxCart = URL::createLink("default","user","ajaxCart",array("type" => 0, "product_pos" => $i));
        $xhtmlCart .= '<tr>
                    <td width="140" align="center" class="image_cart"><a href="'.$linkProduct.'"><img src="'.$this->cart[$i]["product_image"].'" width="48" height="44" /></a></td>
                    <td width="260"><a href="'.$linkProduct.'"><span>'.$this->cart[$i]["product_name"].'</span></a></td>
                    <td width="110"><div class="cart_status">Còn hàng</div></td>
                    <td class="cart_price">'.number_format($this->cart[$i]["product_price"]).' VNĐ </th>
                    <td width="75" align="center">
                        <input type="text" value="'.$this->cart[$i]["quantity"].'" class="input_num_product" disabled="disabled"/>
                        <div>
                            <span class="btn_minus" onclick="ajaxCart(\''.$linkMinusAjaxCart.'\')"><i class="fa fa-minus"></i></span>
                            <span class="btn_plus" onclick="ajaxCart(\''.$linkAddAjaxCart.'\')"><i class="fa fa-plus"></i></span>
                        </div>
                    </td>
                    <form method="POST" name="frmRemove'.$i.'">
                        <td width="40" align="center"><a onclick="frmRemove'.$i.'.submit();">
                            <i class="fa fa-trash" id="trash"></i></a>
                            <input type="hidden" name="pos_delete" value="'.$i.'">
                        </td>
                    </form>
                    <td width="260" class="cart_total">'.number_format($this->cart[$i]["product_price"] * $this->cart[$i]["quantity"]).' VNĐ</td></tr>';
    }
}
?>
<div class="clear"></div>
<div class="wrapper">
    <div class="container">
        <div class="road-map">
            <span id="home">Trang Chủ</span>
            <span>Danh Mục</span>
        </div>
    </div>
</div>
<div class="clear10"></div>
<div class="container" style="min-height: 350px">
    <?php if(isset($xhtmlCart)){?>
        <div class="cart_detail">
            <table border="1" cellpadding="0" cellspacing="0">
                <tr bgcolor="white">
                    <th width="140">Sản phẩm</th>
                    <th width="300">Tên sản phẩm</th>
                    <th width="110">Trạng thái</th>
                    <th>Đơn giá</th>
                    <th width="100">Số lượng</th>
                    <th width="40"></th>
                    <th width="220">Thành tiền</th>
                </tr>
                <?php echo $xhtmlCart;?>
                <tr>
                    <td colspan="3">&nbsp;</td>
                    <td colspan="3" align="right"><b style="text-transform: uppercase;color: #555454;">Tổng tiền</b></td>
                    <td align="right" class="tongtien"><b><?php echo number_format($total)?> VNĐ</b></td>
                </tr>
            </table>
            <div class="btn-checkout-shopping">
                <a href="index.php"><i class="fa fa-chevron-left left"></i>Tiếp Tục Mua Hàng</a>
                <a href="<?php echo $linkCheckout; ?>">Thanh Toán<i class="fa fa-chevron-right right"></i></a>
            </div>
        </div>
    <?php }else{ ?>
        <div class="container">
            <div class="cart-empty">
                <h3>Chưa có sản phẩm trong giỏ hàng</h3>
            </div>
        </div>
    <?php } ?>
</div>
<div class="clear"></div>