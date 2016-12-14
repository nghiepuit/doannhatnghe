<?php
	class Controller{

        protected $params;
        protected $view;
        protected $model;
        protected $template;
        protected $pagination = array(
            "totalItemsPerPage" => 3,
            "totalPages" => 1
        );

        public function __construct($params){
            $this->setModel($params["module"],$params["controller"]);
            $this->setView($params["module"]);
            $this->setTemplate();

            $this->pagination["currentPage"] = isset($params["filter_page"]) ? $params["filter_page"] : 1;
            $params["pagination"] = $this->pagination;
            $this->setParams($params);
            $this->view->params = $params;
        }

        public function setModel($moduleName,$modelName){
            $modelName = ucfirst($modelName)."Model";
            $path = MODULE_PATH.$moduleName.DS."models".DS.$modelName.".php";
            if(file_exists($path)){
                require_once($path);
                $this->model = new $modelName();
            }
        }

        public function getModel(){
            return $this->model;
        }

        public function setParams($params){
            $this->params = $params;
        }

        public function getParams(){
            return $this->params;
        }

        public function getView(){
            return $this->view;
        }

        public function setView($module){
            $this->view = new View($module);
        }

        public function setTemplate(){
            $this->template = new Template($this);
        }

        public function getTemplate(){
            return $this->template;
        }

        public function setPagination($config){
            $this->pagination["totalItemsPerPage"] = $config["totalItemsPerPage"];
            $this->pagination["totalPages"] = $config["totalPages"];
            $this->params["pagination"] = $this->pagination;
            $this->view->params = $this->params;
        }
		
	}
?>