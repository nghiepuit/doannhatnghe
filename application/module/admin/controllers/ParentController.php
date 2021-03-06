<?php

class ParentController extends Controller{

    public function __construct($params){
        parent::__construct($params);
        $this->template->setFolderTemplate("admin/main/");
        $this->template->setFileTemplate("index.php");
        $this->template->setFileConfig("template.ini");
        $this->template->load();
    }

    public function indexAction(){
        $this->view->setTitle("Quản Lý Chủng Loại");
        $totalItem = $this->model->count($this->params,null);
        $configPagination = array(
            "totalItemsPerPage" => 5,
            "totalPages" => 1
        );
        $this->setPagination($configPagination);
        $this->view->pagination = new Pagination($totalItem,$this->pagination);
        $this->view->parents = $this->model->listItems($this->params,null);
        $this->view->render("parent/index");
    }

    public function formAction(){
        $this->view->setTitle("Thêm Mới Chủng Loại");
        if(isset($this->params["add"])){
            $validate = new Validate($this->params["form"]);
            $validate->addRule("name","string",array("min" => 3, "max" => 255));
            $validate->addRule("ordering","int",array("min" => 1, "max" => 1000));
            $validate->run();
            $this->view->dataForm = $validate->getResult();
            if(!$validate->isValid()){
                $this->view->errors = $validate->getError();
            }else{
                $this->model->saveItem($this->params,array("task" => "add"));
                URL::redirect(URL::createLink("admin","parent","index"));
            }
        }
        if(isset($this->params["id"])){
            $this->view->setTitle("Chỉnh Sửa Chủng Loại");
            $this->view->dataForm = $this->model->infoItem($this->params);
            if(isset($this->params["edit"])){
                $validate = new Validate($this->params["form"]);
                $validate->addRule("name","string",array("min" => 3, "max" => 255));
                $validate->addRule("ordering","int",array("min" => 1, "max" => 1000));
                $validate->run();
                if(!$validate->isValid()){
                    $this->view->errors = $validate->getError();
                }else{
                    $this->model->saveItem($this->params,array("task" => "edit"));
                    URL::redirect(URL::createLink("admin","parent","index"));
                }
            }
        }
        $this->view->params = $this->params;
        $this->view->render("parent/form");
    }

    public function deleteAction(){
        $this->model->deleteItem($this->params);
        URL::redirect(URL::createLink("admin","parent","index"));
    }

    public function deleteSingleAction(){
        $this->model->deleteItem($this->params,array("task" => "single"));
        URL::redirect(URL::createLink("admin","parent","index"));
    }

    public function ajaxStatusAction(){
        $result = $this->model->changeStatus($this->params,array("task" => "change-status-ajax"));
        echo json_encode($result);
    }

}