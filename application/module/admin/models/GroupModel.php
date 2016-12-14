<?php

class GroupModel extends Model{


    public function __construct(){
        parent::__construct();
        $this->setTable(TBL_GROUP);
    }

    public function count($params,$option=null){
        $query[] = "SELECT count(`id`) AS `total`";
        $query[] = "FROM `$this->table`";
        if(!empty($params["keyword"])){
            $query[] = "WHERE `name` LIKE '%". $params["keyword"] ."%'";
        }
        $query = implode(" ",$query);
        $result = $this->fetchOne($query);
        return $result["total"];
    }

    public function listItems($params,$option=null){
        $query[] = "SELECT *";
        $query[] = "FROM `$this->table`";
        if(!empty($params["keyword"])){
            $query[] = "WHERE `name` LIKE '%". $params["keyword"] ."%'";
        }
        $query[] = "ORDER BY `ordering`";

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
            return array($id,$status,URL::createLink("admin","group","ajaxStatus",array("id" => $id,"status" => $status)));
        }
        else if($option["task"] == "change-acp-ajax"){
            $acp = ($params["acp"] == 0) ? 1 : 0;
            $id = $params["id"];
            $query = "UPDATE `$this->table` SET `acp` = $acp WHERE `id` = $id";
            $this->query($query);
            return array($id,$acp,URL::createLink("admin","group","ajaxACP",array("id" => $id,"acp" => $acp)));
        }
    }

    public function saveItem($params,$option=null){
        if($option["task"] == "add"){
            if(!empty($params)){
                $name = $params["form"]["name"];
                $acp = $params["form"]["acp"];
                $created = date("Y-m-d",time());
                $modified = date("Y-m-d",time());
                $created_by = 1;
                $modified_by = 1;
                $status = $params["form"]["status"];
                $ordering = $params["form"]["ordering"];
                $data = array(
                    "name" => $name,
                    "acp" => $acp,
                    "created" => $created,
                    "created_by" => $created_by,
                    "modified" => $modified,
                    "modified_by" => $modified_by,
                    "status" => $status,
                    "ordering" => $ordering
                );
                $this->insert($data);
                Session::set("message",array("type" => "success","content" => "Có ".$this->affectedRows()." phần tử được thêm"));
            }
        }else{
            $id = $params["id"];
            $name = $params["form"]["name"];
            $acp = $params["form"]["acp"];
            $modified = date("Y-m-d",time());
            $status = $params["form"]["status"];
            $ordering = $params["form"]["ordering"];
            $data = array(
                "name" => $name,
                "acp" => $acp,
                "modified" => $modified,
                "status" => $status,
                "ordering" => $ordering
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
                $query[] = "SELECT `id`,`name`,`acp`,`status`,`ordering`,`modified`";
                $query[] = "FROM `$this->table`";
                $query[] = "WHERE `id` = ".$params['id'];
                $query = implode(" ",$query);
                $result = $this->fetchOne($query);
                return $result;
            }
        }
    }

}