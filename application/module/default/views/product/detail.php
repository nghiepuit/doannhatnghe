<?php
    include_once BLOCK_PATH."header.php";
    $linkOrder = URL::createLink("default","user","order");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<div class="clear"></div>
<div class="wrapper">
    <div class="container">
        <div class="road-map">
            <span id="home">Trang Chủ</span>
            <span>Danh Mục</span>
        </div>
    </div>
</div>
<div class="container">
    <div class="product-detail">
        <form action="<?php echo $linkOrder; ?>" method="POST">
            <h2><?php echo $this->productInfo["name"]; ?></h2>
            <div class="product-detail-left">
                <p class="label-special" style="right: 15px;">-<?php echo $this->productInfo['sale_off'];?>%</p>
                <a href="#">
                    <img id="img-detail" src="<?php echo UPLOAD_URL . 'product' . DS . $this->productInfo['image']; ?>">
                </a>
                <div class="more-images">
                    <ul>
                        <li><img src="<?php echo UPLOAD_URL . 'product' . DS . $this->productInfo['image']; ?>"/></li>
                    </ul>
                </div>
            </div>
            <div class="product-detail-right">
                <div class="product-banner">
                    <div class="free-ship">
                        <p><em class="fa fa-fw"></em></p>
                        <p>GIAO HÀNG MIỄN PHÍ</p>
                    </div>
                    <div class="buy-online">
                        <p><em class="fa fa-fw"></em></p>
                        <p>MUA HÀNG TRỰC TUYẾN</p>
                    </div>
                </div>
                <h4>Trạng Thái : <span>Còn hàng</span></h4>
                <span class="price-product not-sale-off"><?php echo number_format($this->productInfo["price"]); ?> VNĐ</span>
                <span class="price-product"><?php echo number_format(($this->productInfo["price"]*(100-$this->productInfo["sale_off"]))/100); ?> VNĐ</span>
                <div class="quantity">
                    <button type="button" id="sub">-</button>
                    <input type="number" value="1" name="quantity" id="quantity" readonly="readonly"/>
                    <button type="button" id="plus">+</button>
                    <span><a href="#" class="add-to-wishlist"></a></span>
                </div>
                <div class="clear"></div>
                <input type="submit" class="buy-now" value="MUA NGAY" name="add-to-cart"/>
                <div class="product-social">
                    <a href="#"><span class="icon-facebook fa fa-facebook"></span></a>
                    <a href="#"><span class="icon-twitter fa fa-twitter"></span></a>
                    <a href="#"><span class="icon-pinterest fa fa-pinterest-square"></span></a>
                    <a href="#"><span class="icon-google fa fa-google-plus"></span></a>
                </div>
            </div>
            <input type="hidden" name="product_id" value="<?php echo $this->productInfo["id"];?>"/>
            <input type="hidden" name="product_name" value="<?php echo $this->productInfo["name"];?>"/>
            <input type="hidden" name="product_image" value="<?php echo $this->productInfo["image"];?>"/>
            <input type="hidden" name="product_price" value="<?php echo ($this->productInfo["price"]*(100-$this->productInfo["sale_off"]))/100;?>"/>
        </form>
    </div>
</div>
<div class="clear"></div>
<div class="container">
    <div class="tab-product">
        <ul class="tabs">
            <li class="tab-link current" data-tab="tab-1">Mô Tả Sản Phẩm</li>
            <li class="tab-link" data-tab="tab-2">Bình Luận</li>
            <li class="tab-link" data-tab="tab-3">Đánh Giá</li>
        </ul>

        <div id="tab-1" class="tab-content current">
            <?php echo $this->productInfo["description"]; ?>
        </div>
        <div id="tab-2" class="tab-content">
            Chưa có bình luận
        </div>
        <div id="tab-3" class="tab-content">
            Chưa có đánh giá
        </div>
    </div>
</div>
<div class="clear"></div>
<?php if(!empty($this->productRelate)){ ?>
<div class="container">
    <div class="spcl">
        <h2>SẢN PHẨM CÙNG LOẠI</h2>
        <div id="owl-product-spcl" class="owl-carousel">
            <?php $i=0; ?>
            <?php foreach ($this->productRelate as $product){ $link = URL::createLink("default","product","detail",array(("product_id") => $product["id"]));?>
                <form action="<?php echo $linkOrder; ?>" method="POST" name="frmProduct<?php echo $i;?>">
                    <div class="new-products-item product-spcl">
                        <div class="wrapper-top-image">
                            <a href="<?php echo $link; ?>" class="wrapper-img">
                                <img class="img-hover" src="<?php echo UPLOAD_URL.'product'.DS.$product['image'];?>" />
                                <img src="<?php echo UPLOAD_URL.'product'.DS.$product['image'];?>"/>
                            </a>
                            <div class="button-image-hover">
                                <a class="btn-hidden addcart" onclick="frmProduct<?php echo $i;?>.submit();"></a>
                                <a class="btn-hidden wishlist"></a>
                                <a class="btn-hidden compare"></a>
                                <a class="btn-hidden quickview"></a>
                            </div>
                        </div>
                        <div class="new-products-info">
                            <h3><?php echo strlen($product["name"]) > 20 ? substr($product["name"],0,20)."..." : $product["name"]; ?></h3>
                            <div class="rating">
                                <span>(0)</span>
                            </div>
                            <span class="price-new-products"><?php echo number_format(($product["price"]*(100-$product["sale_off"]))/100); ?> VNĐ</span>
                        </div>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>"/>
                    <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>"/>
                    <input type="hidden" name="product_image" value="<?php echo $product['image']; ?>"/>
                    <input type="hidden" name="product_price" value="<?php echo ($product["price"]*(100-$product["sale_off"]))/100; ?>"/>
                    <input type="hidden" name="quantity" value="1"/>
                    <input type="hidden" value="MUA NGAY" name="add-to-cart"/>
                </form>
            <?php $i++; } ?>
        </div>
    </div>
</div>
<?php } ?>
<div class="clear"></div>