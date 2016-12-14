<?php

class ErrorController extends Controller {

    public function __construct($params){
        parent::__construct($params);
        $this->template->setFolderTemplate("default/main/");
        $this->template->setFileTemplate("index.php");
        $this->template->setFileConfig("template.ini");
        $this->template->load();
    }

    public function indexAction(){
        $this->view->setTitle("Không Tìm Thấy Trang");
        $this->view->render('error/index');
    }

}