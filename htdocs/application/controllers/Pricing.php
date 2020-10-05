<?
class Pricing extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $data['page_code'] = "price";
        $this->page('index/price',$data);
    }
}