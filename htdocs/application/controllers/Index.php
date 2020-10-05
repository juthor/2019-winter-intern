<?
class Index extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $data['page_code'] = "about";
        $this->page('index/about',$data);
    }

    public function about(){
        $data['page_code'] = "about";
        $this->page('index/about',$data);
    }

    public function contact(){
        $data['page_code'] = "contact";
        $this->page('index/contact',$data);
    }

    public function contact_send(){
        $data = $this->input->post();

        if(!@$data['contact']){
            $this->print_json(-1,'Contact Value Required');
            exit();
        }

        if(!@$data['title']){
            $this->print_json(-1,'Title Value Required');
            exit();
        }


        $email_result = $this->send_email($this->cfg['corp_email'],"[홈페이지 문의접수] ".$data['title'],'contact',['content'=>$data['content'],'contact'=>$data['contact'],'type'=>$data['type']]);
        if(!$email_result['result']){
            $this->print_json(-1,$this->lang->line('alert_text2'));
            exit();
        }

        $this->print_json(1);
    }

    public function change_user_lang(){
        $lang = $this->input->post('lang');
        if(!in_array($lang,['kor','eng'])){
            $this->print_json(-1,'Not supported Language');
            exit();
        }

        $this->session->set_flashdata('change_lang', '1');

        $this->session->set_userdata('user_lang',$lang);
        $this->print_json(1);
    }

    public function set_user_lang(){
        $lang = $this->uri->segment(3);
        if(!in_array($lang,['kor','eng'])){
            $this->print_json(-1,'Not supported Language');
            exit();
        }

        $this->session->set_userdata('user_lang',$lang);
        redirect();
    }
}