<?php

class IndexController extends Controller{

    public function __construct($params){
        parent::__construct($params);
        $this->template->setFolderTemplate("default/main/");
        $this->template->setFileTemplate("index.php");
        $this->template->setFileConfig("template.ini");
        $this->template->load();
    }

    public function indexAction(){
        $this->view->setTitle("Trang Chủ");
        $this->view->saleProducts = $this->model->listProducts($this->params,array("task" => "sale"));
        $this->view->specialProducts = $this->model->listProducts($this->params,array("task" => "special"));
        $this->view->bestsellerProducts = $this->model->listProducts($this->params,array("task" => "best"));
        $this->view->render("index/index");
    }

    public function registerAction(){
        $user = Session::get("user");
        if(!isset($user)) {
            $this->view->setTitle("Đăng Ký");
            if (isset($this->params["btnRegister"])) {
                $validate = new Validate($this->params["form"]);
                $queryUsername = "SELECT `id` FROM " . TBL_USER . " WHERE `username` = '" . $this->params["form"]["username"] . "'";
                $queryEmail = "SELECT `id` FROM " . TBL_USER . " WHERE `email` = '" . $this->params["form"]["email"] . "'";
                $validate->addRule("username", "stringNotExistRecord", array("database" => $this->model, "query" => $queryUsername, "min" => 5, "max" => 255));
                $validate->addRule("email", "emailNotExistRecord", array("database" => $this->model, "query" => $queryEmail));
                $validate->addRule("password", "string", array("min" => 5, "max" => 255));
                $validate->addRule("repassword", "stringSamePassword", array("min" => 5, "max" => 255, "password" => $this->params["form"]["password"]));
                $validate->run();
                $this->view->dataForm = $validate->getResult();
                if (!$validate->isValid()) {
                    $this->view->errors = $validate->showErrors();
                } else {
                    $id = $this->model->saveItem($this->params, array("task" => "register"));
                    if ($id > -1) {
                        $infoUser = $this->model->infoUser($this->params);
                        $arraySession = array(
                            "login" => true,
                            "info" => $infoUser,
                            "time" => time(),
                            "group_acp" => $infoUser["acp"]
                        );
                        Session::set("user", $arraySession);
                        $link = URL::createLink("default", "index", "notice", array("type" => "register-success"));
                        URL::redirect($link);
                    }
                }
            }
            $this->view->render("index/register");
        }else{
            URL::redirect(URL::createLink("default","index","index"));
        }
    }

    public function noticeAction(){
        $this->view->setTitle("Thông Báo");
        $this->view->render("index/notice");
    }

    public function logoutAction(){
        Session::delete("user");
        URL::redirect(URL::createLink("default","index","index"));
    }

    public function loginAction(){
        $userInfo = Session::get("user");
        if($userInfo["login"] && $userInfo["time"]+TIME_LOGIN >= time()){
            URL::redirect(URL::createLink("default","index","index"));
        }else{
            if (isset($this->params["btnLogin"])) {
                $infoUser = $this->model->infoUser($this->params);
                if(!empty($infoUser)){
                    if($infoUser["id"] > -1){
                        $arraySession = array(
                            "login" => true,
                            "info" => $infoUser,
                            "time" => time(),
                            "group_acp" => $infoUser["acp"]
                        );
                        Session::set("user", $arraySession);
                        $link = URL::createLink("default", "index", "index");
                        URL::redirect($link);
                    }
                }else{
                    URL::redirect(URL::createLink("default", "index", "notice", array("type" => "login-failed")));
                }
            }
        }
    }

}