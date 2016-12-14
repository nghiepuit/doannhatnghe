<?php
class ProductModel extends Model {

    public function __construct(){
        parent::__construct();
        $this->setTable(TBL_PRODUCT);
    }

    public function count($params,$option=null){
        $query[] = "SELECT count(`id`) AS `total`";
        $query[] = "FROM `$this->table`";
        if (empty($params["keyword"]))
            $query[] = "WHERE `status` = 1";
        else
            $query[] = "WHERE `status` = 1 AND ( `name` LIKE '%" . $params["keyword"] . "%' OR `description` LIKE '%" . $params["keyword"] . "%') ";
        if (!empty($params["category_id"]))
            $query[] = "AND `category_id` = " . $params["category_id"];
        if (empty($params["sort"])) {
            $query[] = "ORDER BY `view_count`";
        } else {
            switch ($params["sort"]) {
                case 1:
                    $query[] = "ORDER BY `view_count` DESC";
                    break;
                case 2:
                    $query[] = "ORDER BY `price`";
                    break;
                case 3:
                    $query[] = "ORDER BY `price` DESC";
                    break;
                case 4:
                    $query[] = "ORDER BY `name`";
                    break;
                case 5:
                    $query[] = "ORDER BY `name` DESC";
                    break;
                default:
                    break;
            }
        }
        $query = implode(" ",$query);
        $result = $this->fetchOne($query);
        return $result["total"];
    }

    public function listItem($params,$option=null){
        if($option["task"] == "product-relate"){
            $queryCategory = "SELECT `category_id` FROM `$this->table` WHERE id = ".$params["product_id"];
            $resultCategory = $this->fetchOne($queryCategory);
            $category_id = $resultCategory["category_id"];

            $query[] = "SELECT `id`, `name`, `price`, `sale_off`, `image`, `description`";
            $query[] = "FROM `$this->table`";
            $query[] = "WHERE `status` = 1 AND `category_id` = $category_id AND `id` <> ".$params["product_id"];
            $query[] = "ORDER BY `ordering`";
            $query = implode(" ",$query);
            $result = $this->fetchAll($query);
            return $result;
        }else {
            $query[] = "SELECT `id`,`name`,`price`,`image`,`sale_off`";
            $query[] = "FROM `$this->table`";
            if (empty($params["keyword"]))
                $query[] = "WHERE `status` = 1";
            else
                $query[] = "WHERE `status` = 1 AND ( `name` LIKE '%" . $params["keyword"] . "%' OR `description` LIKE '%" . $params["keyword"] . "%') ";
            if (!empty($params["category_id"]))
                $query[] = "AND `category_id` = " . $params["category_id"];
            if (empty($params["sort"])) {
                $query[] = "ORDER BY `view_count`";
            } else {
                switch ($params["sort"]) {
                    case 1:
                        $query[] = "ORDER BY `view_count` DESC";
                        break;
                    case 2:
                        $query[] = "ORDER BY `price`";
                        break;
                    case 3:
                        $query[] = "ORDER BY `price` DESC";
                        break;
                    case 4:
                        $query[] = "ORDER BY `name`";
                        break;
                    case 5:
                        $query[] = "ORDER BY `name` DESC";
                        break;
                    default:
                        break;
                }
            }
            $pagination = $params["pagination"];
            $position = ($pagination["currentPage"] - 1) * $pagination["totalItemsPerPage"];
            $query[] = "LIMIT $position," . (isset($params["limit"]) ? $params["limit"] : $pagination['totalItemsPerPage']);
            $query = implode(" ", $query);
            $result = $this->fetchAll($query);
            return $result;
        }
    }

    public function infoItem($params,$option=null){
        $id = $params["product_id"];
        $query = "SELECT `id`, `name`, `price`, `sale_off`, `image`, `description`,`view_count` FROM `$this->table` WHERE `id` = ".$id;
        $result = $this->fetchOne($query);
        $data = array(
            "view_count" => ($result["view_count"] + 1),
        );
        $this->update($data,array(array("id", $id)));
        return $result;
    }

}