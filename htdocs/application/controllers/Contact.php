<?php
/**
 * Created by PhpStorm.
 * User: chocopie
 * Date: 2019-02-11
 * Time: 15:10
 */
class Contact extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $this->load->view('index/contact');
    }

}