<?php

class UserController extends Controller{

    public function __construct($params){
        parent::__construct($params);
        $this->template->setFolderTemplate("admin/main/");
        $this->template->setFileTemplate("index.php");
        $this->template->setFileConfig("template.ini");
        $this->template->load();
    }

    public function indexAction(){
        $this->view->setTitle("Quản Lý User");
        $totalItem = $this->model->count($this->params,null);
        $configPagination = array(
            "totalItemsPerPage" => 3,
            "totalPages" => 1
        );
        $this->setPagination($configPagination);
        $this->view->pagination = new Pagination($totalItem,$this->pagination);
        $this->view->slbGroup = $this->model->groupInSelectedBox($this->params,null);
        $this->view->users = $this->model->listItems($this->params,null);
        $this->view->render("user/index");
    }

    public function formAction(){
        $this->view->setTitle("Thêm Mới User");
        $this->view->slbGroup = $this->model->groupInSelectedBox($this->params,null);
        if(isset($this->params["add"])){
            $validate = new Validate($this->params["form"]);
            $queryUsername = "SELECT `id` FROM ".TBL_USER." WHERE `username` = '".$this->params["form"]["username"]."'";
            $queryEmail = "SELECT `id` FROM ".TBL_USER." WHERE `email` = '".$this->params["form"]["email"]."'";
            $validate->addRule("username","stringNotExistRecord",array("database" => $this->model, "query" => $queryUsername,"min" => 5, "max" => 255));
            $validate->addRule("password","string",array("min" => 5, "max" => 255));
            $validate->addRule("email","emailNotExistRecord",array("database" => $this->model, "query" => $queryEmail));
            $validate->addRule("ordering","int",array("min" => 1, "max" => 1000));
            $validate->addRule("group_id","status",array("deny" => array("default")));
            $validate->run();
            $this->view->dataForm = $validate->getResult();
            if(!$validate->isValid()){
                $this->view->errors = $validate->getError();
            }else{
                $this->model->saveItem($this->params,array("task" => "add"));
                URL::redirect(URL::createLink("admin","user","index"));
            }
        }
        if(isset($this->params["id"])){
            $this->view->setTitle("Chỉnh Sửa User");
            $this->view->dataForm = $this->model->infoItem($this->params);
            if(isset($this->params["edit"])){
                $validate = new Validate($this->params["form"]);
                $queryUsername = "SELECT `id` FROM ".TBL_USER." WHERE `username` = '".$this->params["form"]["username"]."' AND `id` != ".$this->params["id"];
                $queryEmail = "SELECT `id` FROM ".TBL_USER." WHERE `email` = '".$this->params["form"]["email"]."' AND `id` != ".$this->params["id"];
                $validate->addRule("username","stringNotExistRecord",array("database" => $this->model, "query" => $queryUsername,"min" => 5, "max" => 255));
                $validate->addRule("password","string",array("min" => 5, "max" => 255));
                $validate->addRule("email","emailNotExistRecord",array("database" => $this->model, "query" => $queryEmail));
                $validate->addRule("ordering","int",array("min" => 1, "max" => 1000));
                $validate->addRule("group_id","status",array("deny" => array("default")));
                $validate->run();
                if(!$validate->isValid()){
                    $this->view->errors = $validate->getError();
                }else{
                    $this->model->saveItem($this->params,array("task" => "edit"));
                    URL::redirect(URL::createLink("admin","user","index"));
                }
            }
        }
        $this->view->params = $this->params;
        $this->view->render("user/form");
    }

    public function deleteAction(){
        $this->model->deleteItem($this->params);
        URL::redirect(URL::createLink("admin","user","index"));
    }

    public function deleteSingleAction(){
        $this->model->deleteItem($this->params,array("task" => "single"));
        URL::redirect(URL::createLink("admin","user","index"));
    }

    public function ajaxStatusAction(){
        $result = $this->model->changeStatus($this->params,array("task" => "change-status-ajax"));
        echo json_encode($result);
    }

}