<?php
class UserModel extends Model{

    public function __construct(){
        parent::__construct();
        $this->setTable(TBL_USER);
    }

    public function saveItem($params,$option=null){
        if($option["task"] == "checkout"){
            $this->setTable(TBL_ORDER);
            $name = $params["form"]["name"];
            $email = $params["form"]["email"];
            $address = $params["form"]["address"];
            $phone = $params["form"]["phone"];
            $date = $params["form"]["date"];
            $note = $params["form"]["note"];
            $cart = Session::get("cart");
            $total = 0;
            for($i=0;$i<count($cart);$i++){
                $total += $cart[$i]["product_price"]*$cart[$i]["quantity"];
            }
            $user = Session::get("user");
            $data = array(
                "user_id" => isset($user) ? $user["info"]["id"] : "-1",
                "time" => $date,
                "name" => $name,
                "address" => $address,
                "email" => $email,
                "phone" => $phone,
                "note" => $note,
                "status" => 0,
                "total" => $total,
            );
            if($this->insert($data)){
                $this->setTable(TBL_ORDER_DETAIL);
                $idInsertOrder = $this->lastID();
                for($i=0;$i < count($cart);$i++) {
                    $data = array(
                        "order_id" => $idInsertOrder,
                        "product_id" => $cart[$i]["product_id"],
                        "quantity" => $cart[$i]["quantity"],
                        "price" => $cart[$i]["product_price"],
                        "total_price" => ($cart[$i]["quantity"]*$cart[$i]["product_price"]),
                    );
                    $this->insert($data);
                }
                for($i=0;$i < count($cart);$i++) {
                    $query = "UPDATE `".TBL_PRODUCT."` SET `purchase_count` = (`purchase_count`+1) WHERE `id` = ".$cart[$i]["product_id"];
                    $this->query($query);
                }
                return $this->lastID();
            }else{
                return -1;
            }
        }
        $this->setTable(TBL_USER);
    }

    public function getHistory($params,$option=null){
        if($option == null){
            $user = Session::get("user");
            if(isset($user)){
                $id = $user["info"]["id"];
                $query = "SELECT `id`, `time`, `name`, `address`, `email`, `phone`, `note`, `status`, `total` FROM `".TBL_ORDER."` WHERE `user_id` = ".$id;
                $result = $this->fetchAll($query);
                return $result;
            }
        }
    }

}