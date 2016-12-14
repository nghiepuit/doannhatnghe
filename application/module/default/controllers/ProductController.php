<?php

class ProductController extends Controller{

    public function __construct($params){
        parent::__construct($params);
        $this->template->setFolderTemplate("default/main/");
        $this->template->setFileTemplate("index.php");
        $this->template->setFileConfig("template.ini");
        $this->template->load();
    }

    public function listAction(){
        $this->view->setTitle("Danh Sách Sản Phẩm");
        $totalItem = $this->model->count($this->params,null);
        $configPagination = array(
            "totalItemsPerPage" => isset($this->params["limit"]) ? $this->params["limit"] : 12,
            "totalPages" => 1
        );
        $this->setPagination($configPagination);
        $this->view->pagination = new Pagination($totalItem,$this->pagination);
        $this->view->products = $this->model->listItem($this->params,null);
        $this->view->render("product/list");
    }

    public function detailAction(){
        $this->view->setTitle("Chi Tiết Sản Phẩm");
        $this->view->productInfo = $this->model->infoItem($this->params,array("task" => "product-info"));
        $this->view->productRelate = $this->model->listItem($this->params,array("task" => "product-relate"));
        $this->view->render("product/detail");
    }

}