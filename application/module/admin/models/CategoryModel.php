<?php

class CategoryModel extends Model{


    public function __construct(){
        parent::__construct();
        $this->setTable(TBL_CATEGORY);
    }

    public function count($params,$option=null){
        $query[] = "SELECT count(`id`) AS `total`";
        $query[] = "FROM `$this->table`";
        if(!empty($params["keyword"])){
            $query[] = "WHERE `name` LIKE '%". $params["keyword"] ."%'";
            if(isset($params["parent_id"]) && $params["parent_id"] != "default"){
                $query[] = "AND `parent_id` = ".$params["parent_id"];
            }
        }
        else if(isset($params["parent_id"]) && $params["parent_id"] != "default"){
            $query[] = "WHERE `parent_id` = ".$params["parent_id"];
        }
        $query = implode(" ",$query);
        $result = $this->fetchOne($query);
        return $result["total"];
    }

    public function listItems($params,$option=null){
            $query[] = "SELECT `c`.`id`, `c`.`ordering`, `c`.`name`, `p`.`name` AS `parent_name`, `c`.`status`, `c`.created, `c`.created_by, `c`.modified, `c`.modified_by";
        $query[] = "FROM `$this->table` AS `c`, `".TBL_PARENT."` as `p`";
        if(!empty($params["keyword"])){
            $query[] = "WHERE `c`.`parent_id` = `p`.id AND ( `c`.`name` LIKE '%". $params["keyword"] ."%') ";
        }else{
            $query[] = "WHERE `c`.`parent_id` = `p`.id";
        }
        if(isset($params["parent_id"]) && $params["parent_id"] != "default"){
            $query[] = "AND `c`.`parent_id` = ".$params["parent_id"];
        }
        $query[] = "ORDER BY `c`.`ordering`";
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
                $name = $params["form"]["name"];
                $created = date("Y-m-d",time());
                $modified = date("Y-m-d",time());
                $created_by = 1;
                $modified_by = 1;
                $status = $params["form"]["status"];
                $ordering = $params["form"]["ordering"];
                $parent_id = $params["form"]["parent_id"];
                $data = array(
                    "name" => $name,
                    "created" => $created,
                    "created_by" => $created_by,
                    "modified" => $modified,
                    "modified_by" => $modified_by,
                    "status" => $status,
                    "ordering" => $ordering,
                    "parent_id" => $parent_id

                );
                $this->insert($data);
                Session::set("message",array("type" => "success","content" => "Có ".$this->affectedRows()." phần tử được thêm"));
            }
        }else{
            $id = $params["id"];
            $name = $params["form"]["name"];
            $modified = date("Y-m-d",time());
            $status = $params["form"]["status"];
            $ordering = $params["form"]["ordering"];
            $parent_id = $params["form"]["parent_id"];
            $data = array(
                "name" => $name,
                "modified" => $modified,
                "status" => $status,
                "ordering" => $ordering,
                "parent_id" => $parent_id

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
                $query[] = "SELECT `id`,`name`,`status`,`ordering`,`modified`,`parent_id`";
                $query[] = "FROM `$this->table`";
                $query[] = "WHERE `id` = ".$params['id'];
                $query = implode(" ",$query);
                $result = $this->fetchOne($query);
                return $result;
            }
        }
    }

    public function parentInSelectedBox($params,$option=null){
        if($option == null){
            $query = "SELECT `id`, `name` FROM `".TBL_PARENT."`";
            $result = $this->fetchPairs($query);
            $result["default"] = "- Chọn Chủng Loại -";
            ksort($result);
            return $result;
        }

    }

}