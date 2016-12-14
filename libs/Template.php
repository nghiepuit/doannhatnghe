<?php

class Template{

    private $fileConfig; // (admin/main/template.ini)
    private $fileTemplate; // (admin/main/index.php)
    private $folderTemplate; // (admin/main/)
    private $controller;

    public function __construct($controller){
        $this->controller = $controller;
    }

    public function load(){
        $pathFileConfig = TEMPLATE_PATH.$this->getFolderTemplate().$this->getFileConfig();
        if(file_exists($pathFileConfig)){
            $arrConfig = parse_ini_file($pathFileConfig);
            $view = $this->controller->getView();
            $view->title = $view->createTitle($arrConfig["title"]);
            $view->meta = $view->createMeta($arrConfig["metaHTTP"],"http-equiv");
            $view->css = $view->createLinkCSSJS($this->folderTemplate.$arrConfig["dirCSS"],$arrConfig["fileCSS"],"css");
            $view->js = $view->createLinkCSSJS($this->folderTemplate.$arrConfig["dirJS"],$arrConfig["fileJS"],"js");
            $view->setTemplatePath(TEMPLATE_PATH.$this->getFolderTemplate().$this->getFileTemplate());
        }
    }

    public function setFolderTemplate($folderTemplate = "default/main"){
        $this->folderTemplate = $folderTemplate;
    }

    public function getFolderTemplate(){
        return $this->folderTemplate;
    }

    public function setFileTemplate($fileTemplate = "index.php"){
        $this->fileTemplate = $fileTemplate;
    }

    public function getFileTemplate(){
        return $this->fileTemplate;
    }

    public function setFileConfig($fileConfig = "template.ini"){
        $this->fileConfig = $fileConfig;
    }

    public function getFileConfig(){
        return $this->fileConfig;
    }

}