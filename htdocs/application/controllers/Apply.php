<?php
/**
 * Created by PhpStorm.
 * User: chocopie
 * Date: 2019-02-11
 * Time: 15:10
 */
class Apply extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $data['page_code'] = "apply";
        $this->page('index/apply',$data);
    }
}