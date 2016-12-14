<?php

class UserModel extends Model{


    public function __construct(){
        parent::__construct();
        $this->setTable(TBL_USER);
    }

    public function count($params,$option=null){
        $query[] = "SELECT count(`id`) AS `total`";
        $query[] = "FROM `$this->table`";
        if(!empty($params["keyword"])){
            $query[] = "WHERE `username` LIKE '%". $params["keyword"] ."%' OR `fullname` LIKE '%". $params["keyword"] ."%' ";
            if(isset($params["group_id"]) && $params["group_id"] != "default"){
                $query[] = "AND `group_id` = ".$params["group_id"];
            }
        }
        else if(isset($params["group_id"]) && $params["group_id"] != "default"){
            $query[] = "WHERE `group_id` = ".$params["group_id"];
        }
        $query = implode(" ",$query);
        $result = $this->fetchOne($query);
        return $result["total"];
    }

    public function listItems($params,$option=null){
        $query[] = "SELECT `u`.`id`, `u`.`ordering`, `u`.`username`, `u`.`email`, `u`.`fullname`, `g`.`name`, `u`.`status`, `u`.created, `u`.created_by, `u`.modified, `u`.modified_by";
        $query[] = "FROM `$this->table` AS `u`, `".TBL_GROUP."` as `g`";
        if(!empty($params["keyword"])){
            $query[] = "WHERE `u`.`group_id` = `g`.id AND ( `u`.`username` LIKE '%". $params["keyword"] ."%' OR `u`.`fullname` LIKE '%". $params["keyword"] ."%' OR `u`.`email` LIKE '%". $params["keyword"] ."%' ) ";
        }else{
            $query[] = "WHERE `u`.`group_id` = `g`.id";
        }
        if(isset($params["group_id"]) && $params["group_id"] != "default"){
            $query[] = "AND `u`.`group_id` = ".$params["group_id"];
        }
        $query[] = "ORDER BY `u`.`ordering`";
        $pagination = $params["pagination"];
        $position = ($pagination["currentPage"]-1)*$pagination["totalItemsPerPage"];
        $query[] = "LIMIT $position,".$pagination['totalItemsPerPage'];
        $query = implode(" ",$query);
        $result = $this->fetchAll($query);
        if(isset($params["keyword"])){
            Session::set("message",array("type" => "success","content" => "Có ".$this->affectedRows()." phần tử được tìm thấy"));
        }
        return $result;
    }

    public function changeStatus($params,$option=null){
        if($option["task"] == "change-status-ajax"){
            $status = ($params["status"] == 0) ? 1 : 0;
            $id = $params["id"];
            $query = "UPDATE `$this->table` SET `status` = $status WHERE `id` = $id";
            $this->query($query);
            return array($id,$status,URL::createLink("admin","user","ajaxStatus",array("id" => $id,"status" => $status)));
        }
    }

    public function saveItem($params,$option=null){
        if($option["task"] == "add"){
            if(!empty($params)){
                $username = $params["form"]["username"];
                $email = $params["form"]["email"];
                $fullname = $params["form"]["fullname"];
                $password = md5($params["form"]["password"]);
                $created = date("Y-m-d",time());
                $modified = date("Y-m-d",time());
                $created_by = 1;
                $modified_by = 1;
                $register_date = date("Y-m-d h:i:s",time());
                $status = $params["form"]["status"];
                $ordering = $params["form"]["ordering"];
                $group_id = $params["form"]["group_id"];
                $data = array(
                    "username" => $username,
                    "email" => $email,
                    "fullname" => $fullname,
                    "password" => $password,
                    "created" => $created,
                    "created_by" => $created_by,
                    "modified" => $modified,
                    "modified_by" => $modified_by,
                    "register_date" => $register_date ,
                    "register_ip" => NULL,
                    "status" => $status,
                    "ordering" => $ordering,
                    "group_id" => $group_id

                );
                $this->insert($data);
                Session::set("message",array("type" => "success","content" => "Có ".$this->affectedRows()." phần tử được thêm"));
            }
        }else{
            $id = $params["id"];
            $username = $params["form"]["username"];
            $email = $params["form"]["email"];
            $fullname = $params["form"]["fullname"];
            $password = md5($params["form"]["password"]);
            $modified = date("Y-m-d",time());
            $status = $params["form"]["status"];
            $ordering = $params["form"]["ordering"];
            $group_id = $params["form"]["group_id"];
            $data = array(
                "username" => $username,
                "email" => $email,
                "fullname" => $fullname,
                "password" => $password,
                "modified" => $modified,
                "status" => $status,
                "ordering" => $ordering,
                "group_id" => $group_id

            );
            $this->update($data,array(array("id", $id)));
            if($this->affectedRows() > 0) {
                Session::set("message", array("type" => "success", "content" => "Có " . $this->affectedRows() . " phần tử được chỉnh sửa"));
            }
        }
    }

    public function deleteItem($params,$option=null){
        if($option["task"] == "single"){
            if(!empty($params)){
                $id = $params["id"];
                $query = "DELETE FROM `$this->table` WHERE id = $id";
                $this->query($query);
                Session::set("message",array("type" => "success","content" => "Có ".$this->affectedRows()." phần tử được xóa"));
            }
        }else{
            if(!empty($params["ids"])){
                $ids = $this->createWhereDeleteSQL($params["ids"]);
                $query = "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
                $this->query($query);
                Session::set("message",array("type" => "success","content" => "Có ".$this->affectedRows()." phần tử được xóa"));
            }else{
                Session::set("message",array("type" => "error","content" => "Vui lòng chọn phần tử cần xóa"));
            }
        }
    }

    public function infoItem($params,$option=null){
        if(!$option){
            if(!empty($params)){
                $query[] = "SELECT `id`,`username`,`email`,`fullname`,`password`,`status`,`ordering`,`modified`,`group_id`";
                $query[] = "FROM `$this->table`";
                $query[] = "WHERE `id` = ".$params['id'];
                $query = implode(" ",$query);
                $result = $this->fetchOne($query);
                return $result;
            }
        }
    }

    public function groupInSelectedBox($params,$option=null){
        if($option == null){
            $query = "SELECT `id`, `name` FROM `".TBL_GROUP."`";
            $result = $this->fetchPairs($query);
            $result["default"] = "- Chọn Group -";
            ksort($result);
            return $result;
        }

    }

}