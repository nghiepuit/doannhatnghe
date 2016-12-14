<?php include_once BLOCK_PATH."header.php" ?>
<?php
    $selectBoxLimit = Helper::createSelectBoxLimit("limit","",isset($this->params["limit"]) ? $this->params["limit"] :"");
    $selectBoxSort = Helper::createSelectBoxSort("sort","",isset($this->params["sort"]) ? $this->params["sort"] :"");
    $inputModule = Helper::createInput("module","hidden",$this->params["module"]);
    $inputController= Helper::createInput("controller","hidden",$this->params["controller"]);
    $inputAction = Helper::createInput("action","hidden",$this->params["action"]);
    $inputParent = null;
    $inputCategory = null;
    $inputKeyword = null;
    if(isset($this->params["category_id"]))
        $inputCategory = Helper::createInput("category_id","hidden",$this->params["category_id"]);
    if(isset($this->params["parent_id"]))
        $inputParent = Helper::createInput("parent_id","hidden",$this->params["parent_id"]);
    if(isset($this->params["keyword"]))
        $inputKeyword = Helper::createInput("keyword","hidden",$this->params["keyword"]);
    $xhtml = "";
    if(!empty($this->products)){
        $i=0;
        $linkOrder = URL::createLink("default","user","order");
        foreach ($this->products as $key => $value){
            $link = URL::createLink("default","product","detail",array(("product_id") => $value["id"]));
            $name = strlen($value["name"]) > 20 ? substr($value["name"],0,20)."..." : $value["name"];
            $price = $value["price"];
            $sale_off = (100-$value["sale_off"])/100;
            $image = $value["image"];
            $xhtml .= '<form action="'.$linkOrder.'" method="POST" name="frmProduct'.$i.'">
                            <div class="product">
                                <div class="wrapper-top-image">
                                    <a href="'.$link.'" class="wrapper-img">
                                        <img class="img-hover" src="'.UPLOAD_URL.'product'.DS.$image.'" />
                                        <img src="'.UPLOAD_URL.'product'.DS.$image.'"/>
                                    </a>
                                    <div class="button-image-hover">
                                        <a class="btn-hidden addcart" onclick="frmProduct'.$i.'.submit();"></a>
                                        <a class="btn-hidden wishlist"></a>
                                        <a class="btn-hidden compare"></a>
                                        <a class="btn-hidden quickview"></a>
                                    </div>
                                </div>
                                <div class="new-products-info">
                                    <h3>'.$name.'</h3>
                                    <div class="rating">
                                        <span>(0)</span>
                                    </div>
                                    <span class="price-new-products">'.number_format($price*$sale_off).' VNĐ</span>
                                </div>
                            </div>';
            $xhtml .= '<input type="hidden" name="product_id" value="'.$value["id"].'"/>
                    <input type="hidden" name="product_name" value="'.$value["name"].'"/>
                    <input type="hidden" name="product_image" value="'.$value["image"].'"/>
                    <input type="hidden" name="product_price" value="'.$price*$sale_off.'"/>
                    <input type="hidden" name="quantity" value="1"/>
                    <input type="hidden" value="MUA NGAY" name="add-to-cart"/>';
            $xhtml .= '</form>';
            $i++;
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
<div class="container">
    <?php include_once "aside.php"?>
    <div class="right">
        <div class="right-header">
            <h2>Điện Thoại Di Động</h2>
            <div class="view-as">
                <a class="grid"></a>
                <span>|</span>
                <a class="list"></a>
            </div>
            <form method="GET" action="index.php?module=module" name="frmFilter" id="frmFilter">
                <div class="num-show">
                    <label>Số Sản Phẩm</label>
                    <?php echo $selectBoxLimit;?>
                </div>
                <div class="sort-by">
                    <label>Sắp Xếp</label>
                    <?php echo $selectBoxSort;?>
                </div>
                <?php echo $inputModule;?>
                <?php echo $inputController;?>
                <?php echo $inputAction;?>
                <?php echo $inputParent;?>
                <?php echo $inputKeyword; ?>
                <?php echo $inputCategory;?>
            </form>
        </div>
        <div class="clear"></div>

        <?php echo $xhtml;?>
        <div class="clear"></div>
        <?php echo $this->pagination->showPaginationDefault($this->params); ?>
    </div>
</div>
<div class="clear"></div>