<?php


class Helper{

    public static function createButton($icon,$link,$type="new"){
        if($type == "new"){
            $html = "<a href='$link'><i class='$icon'></i></a>";
        }else{
            $html = "<a href='#' onclick='javascript:submitForm(\"".$link."\");'><i class='$icon'></i></a>";
        }
        return $html;
    }

    public static function createStatus($value,$link,$id){
        $class = $value ? "fa fa-check-circle" : "fa fa-dot-circle-o";
        $html = "<a id='status-$id' href='javascript:changeStatus(\"".$link."\");'><i class='$class'></i></a>";
        return $html;
    }

    public static function createACP($value,$link,$id){
        $class = $value ? "fa fa-check-circle" : "fa fa-dot-circle-o";
        $html = "<a id='acp-$id' href='javascript:changeACP(\"".$link."\");'><i class='$class'></i></a>";
        return $html;
    }

    public static function createSelectBox($name,$class,$params,$keySelect = 'default'){
        $xhtml = '<select name="'.$name.'" class="'.$class.'" >';
        foreach($params as $key => $value){
            if($key == $keySelect && is_numeric($keySelect)){
                $xhtml .= '<option selected="selected" value = "'.$key.'">'.$value.'</option>';
            }else{
                $xhtml .= '<option value = "'.$key.'">'.$value.'</option>';
            }
        }
        $xhtml .= '</select>';
        return $xhtml;
    }

    public static function createSelectBoxLimit($name,$class,$keySelect = "12"){
        $xhtml = '<select name="'.$name.'" class="'.$class.'">';
        if($keySelect == "12") {
            $xhtml .= '<option selected="selected" value = "12">12</option>';
        }else{
            $xhtml .= '<option value = "12">12</option>';
        }
        if($keySelect == "24") {
            $xhtml .= '<option selected="selected" value = "24">24</option>';
        }else{
            $xhtml .= '<option value = "24">24</option>';
        }
        if($keySelect == "36") {
            $xhtml .= '<option selected="selected" value = "36">36</option>';
        }else{
            $xhtml .= '<option value = "36">36</option>';
        }
        $xhtml .= '</select>';
        return $xhtml;
    }

    public static function createSelectBoxSort($name,$class,$keySelect = "1"){
        $xhtml = '<select name="'.$name.'" class="'.$class.'">';
        if($keySelect == "1") {
            $xhtml .= '<option selected="selected" value = "1">Xem nhiều</option>';
        }else{
            $xhtml .= '<option value = "1">Xem nhiều</option>';
        }
        if($keySelect == "2") {
            $xhtml .= '<option selected="selected" value = "2">Giá tăng dần</option>';
        }else{
            $xhtml .= '<option value = "2">Giá tăng dần</option>';
        }
        if($keySelect == "3") {
            $xhtml .= '<option selected="selected" value = "3">Giá giảm dần</option>';
        }else{
            $xhtml .= '<option value = "3">Giá giảm dần</option>';
        }
        if($keySelect == "4") {
            $xhtml .= '<option selected="selected" value = "4">Từ A->Z</option>';
        }else{
            $xhtml .= '<option value = "4">Từ A->Z</option>';
        }
        if($keySelect == "5") {
            $xhtml .= '<option selected="selected" value = "5">Từ Z->A</option>';
        }else{
            $xhtml .= '<option value = "5">Từ Z->A</option>';
        }
        $xhtml .= '</select>';
        return $xhtml;
    }

    public static function formatDate($format,$value){
        $result = "";
        if(!empty($value) && $value != "0000-00-00"){
            $result = date($format,strtotime($value));
        }
        return $result;
    }

    public static function createMessage($message){
        $strMessage = "";
        if(!empty($message)){
            if($message["type"] == "error"){
                $strMessage = '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Lỗi!</h4>
                ' . $message["content"] . '
              </div>';
            } else {
                $strMessage = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Thông Báo!</h4>
                ' . $message["content"] . '
              </div>';
            }
        }
        return $strMessage;
    }

    public static function createInput($name,$type,$value){
        return '<input type="'.$type.'" name="'.$name.'" value="'.$value.'"/>';
    }

}