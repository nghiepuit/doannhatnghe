<?php
class View{

    public $module;
    public $templatePath;
    public $title;
    public $meta;
    public $css;
    public $js;
    public $fileView;

    public function __construct($module){
        $this->module = $module;
    }

    public function render($fileInclude,$full = true){
        $path = MODULE_PATH.$this->module.DS."views".DS.$fileInclude.".php";
        if(file_exists($path)){
            if($full){
                $this->fileView = $fileInclude;
                require_once $this->templatePath;
            }else{
                require_once $path;
            }
        }else{
            echo "<h1>Tính Năng Đang Được Hoàn Thiện</h1>";
        }
    }

    public function setTemplatePath($templatePath){
        $this->templatePath = $templatePath;
    }

    public function createTitle($title){
        return "<title>".$title."</title>";
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function createMeta($arrMetaHTTP,$typeMeta="name"){
        $result = "";
        if(!empty($arrMetaHTTP)){
            foreach ($arrMetaHTTP as $meta){
                $temp = explode("|",$meta);
                $result .= "<meta $typeMeta='$temp[0]' content='$temp[1]' />";
            }
        }
        return $result;
    }

    public function createLinkCSSJS($path,$file,$type="css")
    {
        $result = "";
        if (!empty($file)) {
            $path = TEMPLATE_URL . $path;
            foreach ($file as $file) {
                if ($type == "css") {
                    $result .= '<link rel="stylesheet" type="text/css" href="' . $path . DS . $file . '"/>';
                } else {
                    $result .= '<script type="text/javascript" src="' . $path . DS . $file . '"></script>';
                }
            }
        }
        return $result;
    }

    public function appendCSS($arrCSS){
        if(!empty($arrCSS)){
            foreach ($arrCSS as $css){
                $file = APPLICATION_URL.$this->module.DS."views".DS.$css;
                $this->css .= '<link rel="stylesheet" type="text/css" href="' . $file . '"/>';
            }
        }
    }

    public function appendJS($arrJS){
        if(!empty($arrJS)){
            foreach ($arrJS as $js){
                $file = APPLICATION_URL.$this->module.DS."views".DS.$js;
                $this->js .= '<script type="text/javascript" src="'. $file . '"></script>';
            }
        }
    }

}