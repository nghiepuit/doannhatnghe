<?php $linkOrder = URL::createLink("default","user","order"); ?>
<div class="new-products">
    <?php if(!empty($this->saleProducts)) { $i=0; ?>
        <div class="new-products-title">
            <h2>GIÁ KHÔNG TƯỞNG</h2>
        </div>
        <div id="owl-spcl" class="owl-carousel">
            <?php foreach ($this->saleProducts as $product){ $link = URL::createLink("default","product","detail",array(("product_id") => $product["id"]));?>
                <?php $i++; ?>
                <form action="<?php echo $linkOrder; ?>" method="POST" name="frmSaleProducts<?php echo $i;?>">
                    <div class="new-products-item">
                        <div class="wrapper-top-image">
                            <p class="label-special">-<?php echo $product["sale_off"]; ?>%</p>
                            <a href="<?php echo $link; ?>" class="wrapper-img">
                                <img class="img-hover" src="<?php echo UPLOAD_URL.'product'.DS.$product['image']; ?>"/>
                                <img src="<?php echo UPLOAD_URL.'product'.DS.$product['image']; ?>"/>
                            </a>
                            <div class="button-image-hover">
                                <a class="btn-hidden addcart" onclick="frmSaleProducts<?php echo $i;?>.submit();"></a>
                                <a class="btn-hidden wishlist"></a>
                                <a class="btn-hidden compare"></a>
                                <a class="btn-hidden quickview"></a>
                            </div>
                        </div>
                        <div class="new-products-info">
                            <h3><?php echo strlen($product["name"]) > 20 ? substr($product["name"],0,20)."..." : $product["name"];?></h3>
                            <div class="rating">
                                <span>(0)</span>
                            </div>
                            <span class="price-new-products"><?php echo number_format(($product["price"]*(100-$product["sale_off"]))/100); ?> VNĐ</span>
                        </div>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $product["id"];?>"/>
                    <input type="hidden" name="product_name" value="<?php echo $product["name"];?>"/>
                    <input type="hidden" name="product_image" value="<?php echo $product["image"];?>"/>
                    <input type="hidden" name="product_price" value="<?php echo ($product["price"]*(100-$product["sale_off"]))/100;?>"/>
                    <input type="hidden" name="quantity" value="1"/>
                    <input type="hidden" value="MUA NGAY" name="add-to-cart"/>
                </form>
            <?php } ?>
        </div>
        <?php } ?>
    <div class="thumb hover-summer-collection">
        <a href="#"><img src="http://magento1.emthemes.com/everything/media/wysiwyg/em0131/layout_smartphone/home/em_ads_06.jpg"></a>
        <div class="line-thumb"></div>
    </div>
    <div class="thumb hover-travel-love">
        <a href="#"><img src="http://magento1.emthemes.com/everything/media/wysiwyg/em0131/layout_smartphone/home/em_ads_07.jpg"></a>
        <div class="line-thumb"></div>
    </div>
    <div class="clear"></div>
    <?php if(!empty($this->saleProducts)) { ?>
    <div class="best-seller">
        <div class="best-seller-title">
            <h2>MUA NHIỀU</h2>
        </div>
        <?php if(isset($this->saleProducts[0])){ $link = URL::createLink("default","product","detail",array(("product_id") => $this->saleProducts[0]["id"]));?>
        <div class="product-large">
            <a href="<?php echo $link; ?>">
                <img class="product-large-img" src="<?php echo UPLOAD_URL.'product'.DS.$this->saleProducts[0]['image']; ?>" />
                <img class="product-large-hover" src="<?php echo UPLOAD_URL.'product'.DS.$this->saleProducts[0]['image']; ?>"/>
            </a>
            <div class="best-seller-info">
                <h3><?php echo strlen($this->saleProducts[0]["name"]) > 20 ? substr($this->saleProducts[0]["name"],0,20)."..." : $this->saleProducts[0]["name"];?></h3>
                <div class="rating">(0)</div>
                <span><?php echo number_format(($this->saleProducts[0]["price"]*(100-$this->saleProducts[0]["sale_off"]))/100); ?> VNĐ</span>
            </div>
        </div>
        <?php } ?>
        <div class="left-best-seller">
            <?php if(isset($this->saleProducts[1])){ $link = URL::createLink("default","product","detail",array(("product_id") => $this->saleProducts[1]["id"]));?>
            <div class="best-item">
                <a href="<?php echo $link; ?>" class="wrapper-img-best">
                    <img class="img-hover-best" src="<?php echo UPLOAD_URL.'product'.DS.$this->saleProducts[1]['image']; ?>" />
                    <img class="img-show-best" src="<?php echo UPLOAD_URL.'product'.DS.$this->saleProducts[1]['image']; ?>"/>
                </a>
                <div class="best-item-info">
                    <h3><?php echo strlen($this->saleProducts[1]["name"]) > 20 ? substr($this->saleProducts[1]["name"],0,20)."..." : $this->saleProducts[1]["name"];?></h3>
                    <div class="rating">(0)</div>
                    <span class="price"><?php echo number_format(($this->saleProducts[1]["price"]*(100-$this->saleProducts[1]["sale_off"]))/100);?> VNĐ</span>
                </div>
            </div>
            <?php } ?>
            <?php if(isset($this->saleProducts[2])){ $link = URL::createLink("default","product","detail",array(("product_id") => $this->saleProducts[2]["id"]));?>
                <div class="best-item">
                    <a href="<?php echo $link; ?>" class="wrapper-img-best">
                        <img class="img-hover-best" src="<?php echo UPLOAD_URL.'product'.DS.$this->saleProducts[2]['image']; ?>" />
                        <img class="img-show-best" src="<?php echo UPLOAD_URL.'product'.DS.$this->saleProducts[2]['image']; ?>"/>
                    </a>
                    <div class="best-item-info">
                        <h3><?php echo strlen($this->saleProducts[2]["name"]) > 20 ? substr($this->saleProducts[2]["name"],0,20)."..." : $this->saleProducts[2]["name"];?></h3>
                        <div class="rating">(0)</div>
                        <span class="price"><?php echo number_format(($this->saleProducts[2]["price"]*(100-$this->saleProducts[2]["sale_off"]))/100);?> VNĐ</span>
                    </div>
                </div>
            <?php } ?>
            <?php if(isset($this->saleProducts[3])){ $link = URL::createLink("default","product","detail",array(("product_id") => $this->saleProducts[3]["id"]));?>
                <div class="best-item" style="border: none;">
                    <a href="<?php echo $link; ?>" class="wrapper-img-best">
                        <img class="img-hover-best" src="<?php echo UPLOAD_URL.'product'.DS.$this->saleProducts[3]['image']; ?>" />
                        <img class="img-show-best" src="<?php echo UPLOAD_URL.'product'.DS.$this->saleProducts[3]['image']; ?>"/>
                    </a>
                    <div class="best-item-info">
                        <h3><?php echo strlen($this->saleProducts[3]["name"]) > 20 ? substr($this->saleProducts[3]["name"],0,20)."..." : $this->saleProducts[3]["name"];?></h3>
                        <div class="rating">(0)</div>
                        <span class="price"><?php echo number_format(($this->saleProducts[3]["price"]*(100-$this->saleProducts[3]["sale_off"]))/100); ?> VNĐ</span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <div class="clear"></div>
    <div class="new-collection">
        <a href="#">
            <img src="http://magento1.emthemes.com/everything/media/wysiwyg/em0131/layout_smartphone/home/em_ads_08.jpg">
        </a>
    </div>
</div>
<div id="myModal" class="modal">
    <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>