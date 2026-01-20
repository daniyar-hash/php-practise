<?php

namespace myframew;

class Pagination
{
    public  $page_current = 1;

    public  $page_notes =1;
    public  $pages_count =1;
    public  $total_notes =1;
    public  $page = 1; //2
    public  $uri = '';


    public  $mid_size = 2;
    public  $all_pages = 10;
    

    public function __construct($total = 1, $count_notesPage = 1, $current_page = 1)
    {

        $this->total_notes = $total;
        $this->page_notes = $count_notesPage;
        $this->page = $current_page; 
        $this->pages_count = $this->getPagesCnt();
        $this->page_current = $this->getCurrentPage(); 
        $this->uri = $this->getParams(); 
        $this->mid_size = $this->getMidSize();     
    }


    public function getPagesCnt()
    {

        return ceil($this->total_notes/$this->page_notes);

        
    }


    public function getCurrentPage()
    {

        if($this->page < 1){
            $this->page = 1;
        }

        if($this->page > $this->pages_count){
            $this->page = $this->pages_count;
        }

        return $this->page;

    }


    public function getStart()
    {
        return ($this->page_current -1) * $this->page_notes;

    }

    private function getParams()
    {
        $url = $_SERVER['REQUEST_URI'];

        $url = explode('?', $url);

        $uri= $url[0];


        if(isset($url[1]) && $url[1] !=''){
          $uri .='?';
        
        $params = explode('&', $url[1]);
       
        foreach($params as $param){
            if(!preg_match('/^page=/',$param)){
                    $uri .= "{$param}&";
             }
          }

        }

        return $uri;

          

    }


    public function getHtml()
    {
        $back = ''; // link for back page
        $forward = ''; //link for next page
        $start_page = ''; // link for first page
        $end_page = ''; // link for end page
        $page_left =''; // output page number left side
        $page_right = '';// output page number right side 


        if($this->page_current > 1){
            $back = '<li class="page-item"><a href="' . $this->getLink($this->page_current - 1) . '"class="page-link">&lt</a></li>';
        }

        if($this->page_current < $this->pages_count){
             $forward = '<li class="page-item"><a href="'. $this->getLink($this->page_current + 1). '" class="page-link">&gt</a></li>';
        }

        if($this->page_current > $this->mid_size + 1){ //if($this->page_current -$this->mid_size >1)
            // 1-2-3-[4]-5-6
            $start_page = '<li class="page-item"><a href="'. $this->getLink(1). '" class="page-link">&laquo</a></li>';
        }

        if($this->page_current < $this->pages_count - $this->mid_size){ //if($this->page_current -$this->mid_size >1)
            // 1-2-3-4-5-6-[7]-8-9-10   
            $end_page = '<li class="page-item"><a href="'. $this->getLink($this->pages_count). '" class="page-link">&raquo</a></li>';
        }

        for($i = $this->mid_size; $i>0; $i--){  // midsize=10  //
            if($this->page_current - $i > 0){ // 3-1 >0
                $page_left .= '<li class="page-item"><a href="'. $this->getLink($this->page_current - $i) . '" class="page-link">'.($this->page_current - $i).'</a></li>';

            }
        }

        for($i = 1; $i <= $this->mid_size; $i++){
            if($this->page_current + $i <= $this->pages_count){
                $page_right .= '<li class="page-item"><a href="' . $this->getLink($this->page_current + $i). '" class="page-link">'.($this->page_current + $i).'</a></li>';

            }
        }

        return '<nav aria-label="Page navigation Example"><ul class="pagination"> ' 
        . $start_page . $back . $page_left .'<li class="page-item active"><a class="page-link">' .
         $this->page_current . '</a></li>' . $page_right . $forward . $end_page.'</ul></nav>';



    }


    private function getLink($page)
    {
        if($page ==1){
            return rtrim($this->uri, '?&');  // удаляет в конце строки символ
        }

        if(preg_match('/\?/', $this->uri) || preg_match('/\&/', $this->uri)){
            return "{$this->uri}page={$page}";
        }
        else{
            return "{$this->uri}?page={$page}";
        }
    }


    private function getMidSize()
    {
        return $this->pages_count <= $this->all_pages ? $this->pages_count : $this->mid_size;
    }

    public function __toString()
    {
        return $this->getHtml();
    }













}