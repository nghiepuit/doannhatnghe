<?php
class IndexModel extends Model {

    public function __construct(){
        parent::__construct();
        $this->setTable(TBL_PRODUCT);
    }

    public function listProducts($params,$option=null){
        $query[] = "SELECT `id`, `name`, `price`, `image`,`sale_off`";
        $query[] = "FROM `".TBL_PRODUCT."`";
        if($option["task"] == "sale"){
            $query[] = "WHERE `sale_off` > 0";
        }
        if($option["task"] == "special"){
            $query[] = "WHERE `special` = 1";
        }
        if($option["task"] == "best"){
            $query[] = "ORDER BY `purchase_count` DESC LIMIT 0,4";
        }else {
            $query[] = "ORDER BY `ordering`";
        }
        $query = implode(" ",$query);
        $result = $this->fetchAll($query);
        return $result;
    }

    public function saveItem($params,$option=null){
        if($option["task"] == "register"){
            $this->setTable(TBL_USER);
            $username = $params["form"]["username"];
            $email = $params["form"]["email"];
            $password = md5($params["form"]["password"]);
            $fullname = $params["form"]["fullname"];
            $created = date("Y-m-d",time());
            $modified = date("Y-m-d",time());
            $register_date = date("Y-m-d h:i:s",time());
            $register_ip = $_SERVER['SERVER_ADDR'];
            $status = 0;
            $data = array(
                "username" => $username,
                "email" => $email,
                "fullname" => $fullname,
                "password" => $password,
                "created" => $created,
                "modified" => $modified,
                "register_date" => $register_date ,
                "register_ip" => $register_ip,
                "status" => $status,
            );
            if($this->insert($data)){
                return $this->lastID();
            }else{
                return -1;
            }
        }
        $this->setTable(TBL_PRODUCT);
    }

    public function infoUser($params,$option=null){
        if($option == null){
            $username = $params["form"]["username"];
            $password = md5($params["form"]["password"]);
            $query[] = "SELECT `u`.`id`,`u`.`fullname`,`u`.`email`,`u`.`group_id`,`g`.`acp`";
            $query[] = "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
            $query[] = "WHERE `username` = '$username' AND `password` = '$password'";
            $query = implode(" ",$query);
            $result = $this->fetchOne($query);
            return $result;
        }
    }

}