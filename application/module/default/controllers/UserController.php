<?php

class UserController extends Controller{

    public function __construct($params){
        parent::__construct($params);
        $this->template->setFolderTemplate("default/main/");
        $this->template->setFileTemplate("index.php");
        $this->template->setFileConfig("template.ini");
        $this->template->load();
    }

    public function orderAction(){
        $this->view->setTitle("Giỏ Hàng");
        $cart = Session::get("cart");
        if(!isset($cart)){
            Session::set("cart",array());
        }
        if(isset($this->params['add-to-cart'])){
            $flag = false;
            for($i=0;$i<count($cart);$i++){
                if($this->params['product_id'] == $cart[$i]["product_id"]){
                    $cart[$i]["quantity"] += $this->params["quantity"];
                    $flag=true;
                    break;
                }
            }
            if(!$flag){
                $i = count(Session::get("cart"));
                $cart[$i]["product_id"] = $this->params["product_id"];
                $cart[$i]["quantity"] = $this->params["quantity"];
                $cart[$i]["product_name"] = $this->params["product_name"];
                $cart[$i]["product_image"] = UPLOAD_URL.'product'.DS.$this->params["product_image"];
                $cart[$i]["product_price"] = $this->params["product_price"];
            }
        }
        if(isset($this->params["pos_delete"])){
            $pos_delete = $this->params["pos_delete"];
            for($i=$pos_delete;$i<(count($cart)-1);$i++){
                $cart[$i] = $cart[$i+1];
            }
            $pos = count($cart)-1;
            unset($cart[$pos]);
        }
        Session::set("cart",$cart);
        $this->view->cart = $cart;
        $this->view->render("user/cart");
    }

    public function ajaxCartAction(){
        $cart = Session::get("cart");
        $i = $this->params["product_pos"];
        if($this->params["type"]){
            $cart[$i]["quantity"]+=1;
        }else{
            $cart[$i]["quantity"]-=1;
            if($cart[$i]["quantity"]<1)
                $cart[$i]["quantity"]=1;
        }
        $totalPrice = $cart[$i]["quantity"]*$cart[$i]["product_price"];
        $total = 0;
        for($j=0;$j<count($cart);$j++){
            $total += ($cart[$j]["quantity"]*$cart[$j]["product_price"]);
        }
        Session::set("cart",$cart);
        echo json_encode(array($i,$cart[$i]["quantity"],number_format($totalPrice),number_format($total)));
    }

    public function checkoutAction(){
        $cart = Session::get("cart");
        if(isset($cart) && count($cart) >0){
            $this->view->setTitle("Thanh Toán");
            if(isset($this->params["btnCheckout"])){
                $id = $this->model->saveItem($this->params,array("task" => "checkout"));
                if($id > -1){
                    Session::delete("cart");
                    URL::redirect(URL::createLink("default", "index", "notice", array("type" => "checkout-success")));
                }
            }
            $this->view->render("user/checkout");
        }else{
            URL::redirect(URL::createLink("default","user","order"));
        }
    }

    public function historyAction(){
        $user = Session::get("user");
        if(isset($user)){
            $this->view->setTitle("Lịch sử giao dịch");
            $this->view->histories = $this->model->getHistory($this->params);
            $this->view->render("user/history");
        }else{
            URL::redirect(URL::createLink("default","index","error"));
        }
    }

}