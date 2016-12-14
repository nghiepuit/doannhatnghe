<?php

class IndexController extends Controller{

    public function indexAction(){
        $this->view->render("index/index");
    }

    public function addAction(){
        echo "Add Admin Index";
    }

}