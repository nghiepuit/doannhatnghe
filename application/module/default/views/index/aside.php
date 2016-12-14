<div class="aside">
    <div class="sale-products">
        <?php if(!empty($this->saleProducts)) { ?>
        <div class="sale-title">
            <h2>Sản Phẩm Nổi Bật</h2>
        </div>
        <div id="owl-sale" class="owl-carousel">
            <?php for($i=0;$i<count($this->specialProducts);$i++){ ?>
            <div class="sale-products-item">
                <?php for($j=$i;$j<($i+3);$j++){ ?>
                    <?php if(isset($this->specialProducts[$j])) { $link = URL::createLink("default","product","detail",array(("product_id") => $this->specialProducts[$j]["id"]));?>
                        <div class="sale-item">
                            <a href="<?php echo $link; ?>" class="wrapper-img-sale">
                                <img class="img-hover-sale" src="<?php echo UPLOAD_URL.'product'.DS.$this->specialProducts[$j]['image']; ?>" />
                                <img class="img-show-sale" src="<?php echo UPLOAD_URL.'product'.DS.$this->specialProducts[$j]['image']; ?>"/>
                            </a>
                            <div class="sale-item-info">
                                <h3><?php echo strlen($this->specialProducts[$j]["name"]) > 20 ? substr($this->specialProducts[$j]["name"],0,20)."..." : $this->specialProducts[$i]["name"];?></h3>
                                <div class="rating">(0)</div>
                                <span class="price"><?php echo number_format( ($this->specialProducts[$j]["price"]*(100-$this->specialProducts[$j]["sale_off"]))/100 ); ?> VNĐ</span>
                            </div>
                        </div>
                    <?php } ?>
                <?php } $i+=2; ?>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
    <div class="thumb hover-sale-off">
        <a href="#"><img src="http://magento1.emthemes.com/everything/media/wysiwyg/em0131/layout_smartphone/home/em_ads_05.jpg"></a>
        <div class="line-thumb"></div>
    </div>
</div>