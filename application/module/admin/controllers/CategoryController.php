<?php

class CategoryController extends Controller{

    public function __construct($params){
        parent::__construct($params);
        $this->template->setFolderTemplate("admin/main/");
        $this->template->setFileTemplate("index.php");
        $this->template->setFileConfig("template.ini");
        $this->template->load();
    }

    public function indexAction(){
        $this->view->setTitle("Quản Lý Loại");
        $totalItem = $this->model->count($this->params,null);
        $configPagination = array(
            "totalItemsPerPage" => 5,
            "totalPages" => 1
        );
        $this->setPagination($configPagination);
        $this->view->pagination = new Pagination($totalItem,$this->pagination);
        $this->view->slbParent = $this->model->parentInSelectedBox($this->params,null);
        $this->view->categories = $this->model->listItems($this->params,null);
        $this->view->render("category/index");
    }

    public function formAction(){
        $this->view->setTitle("Thêm Mới Category");
        $this->view->slbParent = $this->model->parentInSelectedBox($this->params,null);
        if(isset($this->params["add"])){
            $validate = new Validate($this->params["form"]);
            $queryName = "SELECT `id` FROM ".TBL_CATEGORY." WHERE `name` = '".$this->params["form"]["name"]."'";
            $validate->addRule("name","stringNotExistRecord",array("database" => $this->model, "query" => $queryName,"min" => 5, "max" => 255));
            $validate->addRule("ordering","int",array("min" => 1, "max" => 1000));
            $validate->addRule("parent_id","status",array("deny" => array("default")));
            $validate->run();
            $this->view->dataForm = $validate->getResult();
            if(!$validate->isValid()){
                $this->view->errors = $validate->getError();
            }else{
                $this->model->saveItem($this->params,array("task" => "add"));
                URL::redirect(URL::createLink("admin","category","index"));
            }
        }
        if(isset($this->params["id"])){
            $this->view->setTitle("Chỉnh Sửa Category");
            $this->view->dataForm = $this->model->infoItem($this->params);
            if(isset($this->params["edit"])){
                $validate = new Validate($this->params["form"]);
                $queryName = "SELECT `id` FROM ".TBL_CATEGORY." WHERE `name` = '".$this->params["form"]["name"]."'". "AND `id` != ".$this->params["id"];
                $validate->addRule("name","stringNotExistRecord",array("database" => $this->model, "query" => $queryName,"min" => 3, "max" => 255));
                $validate->addRule("ordering","int",array("min" => 1, "max" => 1000));
                $validate->addRule("parent_id","status",array("deny" => array("default")));
                $validate->run();
                if(!$validate->isValid()){
                    $this->view->errors = $validate->getError();
                }else{
                    $this->model->saveItem($this->params,array("task" => "edit"));
                    URL::redirect(URL::createLink("admin","category","index"));
                }
            }
        }
        $this->view->params = $this->params;
        $this->view->render("category/form");
    }

    public function deleteAction(){
        $this->model->deleteItem($this->params);
        URL::redirect(URL::createLink("admin","category","index"));
    }

    public function deleteSingleAction(){
        $this->model->deleteItem($this->params,array("task" => "single"));
        URL::redirect(URL::createLink("admin","category","index"));
    }

    public function ajaxStatusAction(){
        $result = $this->model->changeStatus($this->params,array("task" => "change-status-ajax"));
        echo json_encode($result);
    }

}