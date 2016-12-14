<?php

class URL{
    public static function createLink($module,$controller,$action,$params = null){
        $link = "";
        if(!empty($params)){
            foreach ($params as $key => $value){
                $link .= "&$key=$value";
            }
        }
        $url = "index.php?module=".$module."&controller=".$controller."&action=".$action.$link;
        return $url;
    }

    public static function redirect($link){
        header("location: ".$link);
        exit();
    }

}