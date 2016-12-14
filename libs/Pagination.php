<?php

class Pagination{

    private $totalItems;
    private $totalItemsPerPage = 1;
    private $totalPages;
    private $currentPage;

    public function __construct($totalItems,$pagination){
        $this->totalItems = $totalItems;
        $this->totalItemsPerPage = $pagination["totalItemsPerPage"];
        $this->totalPages = ceil($totalItems/$pagination["totalItemsPerPage"]);
        $this->currentPage = $pagination["currentPage"];
    }

    public function showPaginationAdmin($link){
        $result = '<div class="box-footer clearfix">';
        $result .= '<ul class="pagination pagination-sm no-margin pull-right">';
        if($this->totalPages > 1){
            $result .= '<li><a href="#" onclick="javascript:changePage('. ( ($this->currentPage-1 > 1) ? ($this->currentPage-1) : 1 ) .')">&laquo;</a></li>';
            for($i=1;$i<=$this->totalPages;$i++){
                if($this->currentPage == $i){
                    $result .= '<li class="paginate_button active"><a>'. $i .'</a></li>';
                }else{
                    $result .= '<li><a onclick="javascript:changePage('.$i.'); frmAdmin.submit();" href="#">'. $i .'</a></li>';
                }
            }
            $result .= '<li><a href="#" onclick="javascript:changePage('. ( ($this->currentPage+1 > $this->totalPages) ? $this->totalPages : ($this->currentPage+1) ) .')">&raquo;</a></li>';
        }
        $result .= "</ul></div>";
        return $result;
    }

    public function showPaginationDefault($params){
        $result = '<div class="paging">';
        $result .= '<ul>';
        if($this->totalPages > 1){
            for($i=1;$i<=$this->totalPages;$i++){
                $link = URL::createLink($params["module"],$params["controller"],$params["action"],array("filter_page" => $i));
                $link .= isset($params["category_id"]) ? "&category_id=".$params["category_id"] : "";
                $link .= isset($params["parent_id"]) ? "&parent_id=".$params["parent_id"] : "";
                $link .= isset($params["keyword"]) ? "&keyword=".$params["keyword"] : "";
                $link .= isset($params["limit"]) ? "&limit=".$params["limit"] : "";
                $link .= isset($params["sort"]) ? "&sort=".$params["sort"] : "";
                if($this->currentPage == $i){
                    $result .= '<li><a href="'.$link.'" class="btn-active">'.$i.'</a></li>';
                }else{
                    $result .= '<li><a href="'.$link.'">'.$i.'</a></li>';
                }
            }
        }
        $result .= "</ul></div>";
        return $result;
    }

}

?>