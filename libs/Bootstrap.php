<?php
	
class Bootstrap{

    private $params;
    private $controllerObject;

    public function init(){
        $this->setParams();
        $controllerName = ucfirst($this->params["controller"])."Controller";
        $filePath = MODULE_PATH.$this->params["module"].DS."controllers".DS.$controllerName.".php";
        if(file_exists($filePath)){
            $this->loadController($filePath,$controllerName);
            $this->callMethod();
        }else{
            $this->error();
        }
    }

    private function setParams(){
        $this->params = array_merge($_GET,$_POST);
        $this->params["module"] = isset($this->params["module"]) ? $this->params['module'] : DEFAULT_MODULE;
        $this->params["controller"] = isset($this->params["controller"]) ? $this->params["controller"] : DEFAULT_CONTROLLER;
        $this->params["action"] = isset($this->params["action"]) ? $this->params["action"] : DEFAULT_ACTION;
    }

    private function callMethod(){
        $actionName = $this->params["action"]."Action";
        if(method_exists($this->controllerObject,$actionName)){
            $module = $this->params["module"];
            $controller = $this->params["controller"];
            $action = $this->params["action"];
            if($module=="admin"){
                $userInfo = Session::get("user");
                $logged = ($userInfo["login"] && ($userInfo["time"] + TIME_LOGIN) >= time());
                $pageLogin = ($controller == "index") && ($action == "login");
                if($logged){
                    if($userInfo["group_acp"] == 1){
                        if($pageLogin){
                            URL::redirect(URL::createLink("admin","group","index"));
                        }else{
                            $this->controllerObject->$actionName();
                        }
                    }else{
                        URL::redirect(URL::createLink("default","index","error"));
                    }
                }else{
                    Session::delete("user");
                    if($pageLogin){
                        $this->controllerObject->$actionName();
                    }else{
                        URL::redirect(URL::createLink("default","index","error"));
                    }
                }
            }else{
                $this->controllerObject->$actionName();
            }
        }else{
            $this->error();
        }
    }

    private function loadController($filePath,$controllerName){
        require_once $filePath;
        $this->controllerObject = new $controllerName($this->params);
    }

    public function error(){
        require_once(MODULE_PATH."default".DS."controllers".DS."ErrorController.php");
        $errorController = new ErrorController($this->params);
        $errorController->indexAction();
    }
		
}
	
?>