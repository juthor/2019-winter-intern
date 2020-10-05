<?
class MY_Controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper(['url','cookie']);
        $this->load->library(['session']);

        // DB
        $this->db = $this->load->database('default',TRUE);

        // URL
        $this->domain = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on')?'https://':'http://').$_SERVER['SERVER_NAME'];
        $this->full_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on')?'https://':'http://').$_SERVER['SERVER_NAME'].site_url();

        $this->sess_admin = $this->session->userdata('sess_admin');
        if($this->sess_admin){
            $this->db->where('idx',$this->sess_admin);
            $this->admin_data = $this->db->get('admin')->row_array();
        }

        // 페이지네이션
        $this->pagination_config = [
            'num_links'=>4,
            'last_link'=>false,
            'prev_link'=>false,
            'next_link'=>false,
            'use_page_numbers'=>true,
            'full_tag_open'=>'<ul class="pagination">',
            'full_tag_close'=>'</ul>',
            'first_link'=>'1',
            'first_tag_open'=>'<li>',
            'first_tag_close'=>'</li>',
            'cur_tag_open'=>'<li class="active"><a>',
            'cur_tag_close'=>'</a></li>',
            'num_tag_open'=>'<li>',
            'num_tag_close'=>'</li>',
            'reuse_query_string'=>true
        ];

        // 설정값
        $cfgList = $this->db->get('config')->result_array();
        $this->cfg = [];
        foreach($cfgList as $cfg){
            $this->cfg[$cfg['cfg_key']] = $cfg['cfg_value'];
        }

        $this->pay_status = ['0'=>'-','-1'=>'에러','100'=>'입금대기','200'=>'결제완료','999'=>'취소완료','-101'=>'결제금액변조'];

        // 결제수단
        $this->pay_method = [
            'card'=>'카드결제',
            'vbank'=>'가상계좌',
            'card_rebill'=>'정기결제'
        ];

        // 국가 IP
        if(!$this->session->userdata('user_lang')){
            $ip = "175.117.39.180";
            $country = json_decode($this->CallAPI('GET', 'http://www.geoplugin.net/json.gp',['ip'=>$ip]),true);

            if($country['geoplugin_status']==200){
                if($country['geoplugin_countryCode']=="KR"){
                    $user_lang = "kor";
                }else{
                    $user_lang = "eng";
                }
            }else{
                $user_lang = "eng";
            }

            $this->session->set_userdata('user_lang',$user_lang);
        }

        $this->user_lang = $this->session->userdata('user_lang');
        $this->lang->load(['common'],$this->user_lang);

        // 전화번호 변환
        function convert_phone($num){
            $prefix_tel = ['02','031','032','033','041','042','043','044','051','052','053','054','055','061','062','063','064','070','080'];
            $prefix_phone = ['010','011','016','017','018','019'];
            $prefix_gen = ['1544','1588','1644','1661','1800','1833','1668','1666','1688','1599','1800','1811','1877','1855','1522','1811'];

            $phone1 = "";
            $phone1_remain = "";
            $phone2 = "";
            $phone3 = "";

            $type = "";
            if(substr($num,0,2)=='02'){
                $type = "tel";
                $phone1 = "02";
                $phone1_remain = substr($num,2);
            }else if(in_array(substr($num,0,3),$prefix_tel)){
                $type = "tel";
                $phone1 = substr($num,0,3);
                $phone1_remain = substr($num,3);
            }else if(in_array(substr($num,0,3),$prefix_phone)){
                $type = "phone";
                $phone1 = substr($num,0,3);
                $phone1_remain = substr($num,3);
            }else if(in_array(substr($num,0,4),$prefix_gen)){
                $type = "gen";
                $phone1 = substr($num,0,4);
                $phone1_remain = substr($num,4);
            }

            switch($type){
                case 'tel':
                    if(strlen($phone1_remain)==7){
                        $phone2 = substr($phone1_remain,0,3);
                        $phone3 = substr($phone1_remain,3,4);
                    }else{
                        $phone2 = substr($phone1_remain,0,4);
                        $phone3 = substr($phone1_remain,4,4);
                    }
                    break;

                case 'phone':
                    if(strlen($phone1_remain)==7){
                        $phone2 = substr($phone1_remain,0,3);
                        $phone3 = substr($phone1_remain,3,4);
                    }else{
                        $phone2 = substr($phone1_remain,0,4);
                        $phone3 = substr($phone1_remain,4,4);
                    }
                    break;

                case 'gen':
                    $phone2 = $phone1_remain;
                    break;

                default:
                    $phone1 = $num;
            }

            return $phone1.(($phone2)?'-'.$phone2:'').(($phone3)?'-'.$phone3:'');
        }
    }

    public function page($path,$data=false){
        // 인기검색어
        $this->db->select('hashtag');
        $this->db->select('count(*) as cnt');
        $this->db->group_by('hashtag');
        $this->db->order_by('cnt','desc');
        $this->db->limit(6,0);
        $popular_keyword = $this->db->get('search_log')->result_array();
        $data['popular_keyword'] = $popular_keyword;

        $data['is_change_lang'] = $this->session->flashdata('change_lang');

        $this->load->view('include/header',$data);
        $this->load->view($path,$data);
        $this->load->view('include/footer',$data);
    }

    public function admin_page($path,$data=false){
        $this->load->view('admin/include/header',$data);
        $this->load->view('admin/'.$path,$data);
        $this->load->view('admin/include/footer',$data);
    }

    function admin_check(){
        if(!$this->sess_admin){
            redirect('admin/index/login?referer='.urlencode($_SERVER['REQUEST_URI']));
        }

        $this->admin = $this->sess_admin;
        $this->db->where('idx',$this->sess_admin);
        $this->admin_data = $this->db->get('admin')->row_array();
    }

    function page_alert($msg,$redirect=false){
        ?><script>alert('<?=$msg?>');<?=($redirect)?'location.replace(\''.$redirect.'\')':'history.back();'?></script><?
    }

    function print_json($code,$msg=false,$data=false){
        $ret['code'] = $code;
        if($msg) $ret['msg'] = $msg;
        if(is_array($data) && count($data)>0){
            foreach($data as $code=>$value){
                $ret[$code] = $value;
            }
        }

        echo json_encode($ret);
    }

    public function CallAPI($method, $url, $data = false, $header = false, $json_encode=true)
    {
        $curl = curl_init();
        if($header){
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }


        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data){
                    if($json_encode){
                        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                    }else{
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    }

                }

                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    public function send_email($to,$subject,$template,$data){
        $this->load->library('email');
        $config['mailtype'] = 'html';

        //$from = ($from)?$from:'no-reply@'.$_SERVER['SERVER_NAME'];

        $this->email->initialize($config);

        $this->email->from('no-reply@'.$_SERVER['SERVER_NAME'], $this->cfg['site_name']);
        $this->email->to($to);

        $this->email->subject($subject);
        $this->email->message($this->load->view('email_template/'.$template,$data,true));


        if($this->email->send()){
            return ['result'=>true,'msg'=>$this->email->print_debugger()];
        }else{
            return ['result'=>false,'msg'=>$this->email->print_debugger()];
        }
    }
}