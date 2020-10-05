<?
class Creator extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('creator_model');
    }

    public function ajax(){
        switch($this->uri->segment(3)){
            case 'getSearchAutoComplete':
                $tags = [];

                // 해시태그 목록
                $this->db->select('creator_hashtag.*');
                $this->db->select('count(*) as cnt');
                $this->db->group_by('hashtag');
                $hashtags = $this->db->get('creator_hashtag')->result_array();

                if(is_array($hashtags) && count($hashtags)>0){
                    foreach($hashtags as $ht){
                        $tags[] = $ht['hashtag'];
                    }
                }

                echo json_encode($tags);
                break;

            case 'open_content_view':
                $idx = $this->input->post('idx');

                $content = $this->creator_model->getCreatorContent(['idx'=>$idx]);

                $creator = $this->creator_model->getCreator(['creator.idx'=>$content['creator_idx']]);

                /*
                if(!is_array($content['list']) || count($content['list'])==0){
                    $this->print_json(-1,$this->lang->line('alert_text1'),['content'=>$content]);
                    exit();
                }
                */

                $ret['code'] = 1;
                $ret['title'] = $content['title'];
                $ret['html'] = $this->load->view('creator/ajax-content-view',['content'=>$content,'creator'=>$creator],true);
                echo json_encode($ret);
                break;

            case 'set_favorite':
                $likes = json_decode(get_cookie('creator_likes'));
                if(!$likes) $likes = [];

                $creator_idx = $this->input->post('idx');
                $set = (in_array($creator_idx,$likes))?false:true;

                $new_likes = [];

                if(!$set){
                    if(is_array($likes) && count($likes)>0){
                        foreach($likes as $lk){
                            if($lk!=$creator_idx) $new_likes[] = $lk;
                        }
                    }
                    $this->db->set('likes','likes-1',false);
                }else{
                    $new_likes = $likes;
                    $new_likes[] = $creator_idx;
                    $this->db->set('likes','likes+1',false);
                }

                $this->db->where('idx',$creator_idx);
                if(!$this->db->update('creator')){
                    $this->print_json(-1,'DB Error');
                    exit();
                }

                set_cookie('creator_likes',json_encode($new_likes),86400*365);
                $this->print_json(1,false,['new_likes'=>$new_likes,'set'=>$set]);
                break;

            case 'get_list':
                // 검색어
                $keyword = $this->input->post('keyword');

                $searchs['is_display'] = 1;

                // 페이지
                $page = $this->input->post('page');
                $per_page = 16;
                $queries = ['limit'=>[$per_page,($page-1)*$per_page]];

                if($keyword){
                    // 검색로그
                    if(!$this->session->userdata('search_keyword')) $this->session->set_userdata('search_keyword',[]);
                    $sess_search = $this->session->userdata('search_keyword');
                    if(!in_array($keyword,$sess_search)){
                        $sess_search[] = $keyword;
                        $this->session->set_userdata('search_keyword',$sess_search);

                        $this->db->set('hashtag',$keyword);
                        $this->db->set('regdate',time());
                        $this->db->insert('search_log');
                    }

                    $data['creatorList'] = $this->creator_model->getCreatorListByHashtag($keyword,$queries);
                    $total_rows = $this->creator_model->getCreatorCntByHashtag($keyword);
                }else{
                    $data['creatorList'] = $this->creator_model->getCreatorList($searchs,$queries);
                    $total_rows = $this->creator_model->getCreatorCnt($searchs);
                }

                $is_last_page = ($total_rows<=$page*$per_page)?1:0;

                $ret['code'] = 1;
                $ret['html'] = $this->load->view('creator/ajax-list',$data,true);
                $ret['total_rows'] = $total_rows;
                $ret['is_last_page'] = $is_last_page;
                echo json_encode($ret);
                break;

            case 'get_arc_list':
                $idx = $this->input->post('idx');
                $type = $this->input->post('type');

                $searchs = ['creator_idx'=>$idx];
                if($type!='all'){
                    $searchs['type'] = $type;
                }

                $type_text = "";
                switch($type){
                    case 'all': $type_text = "ALL"; break;
                    case 'insfa': $type_text = "INSTAGRAM/FACEBOOK"; break;
                    case 'nblog': $type_text = "NAVER BLOG"; break;
                    case 'youtube': $type_text = "YOUTUBE"; break;
                }

                $contents = $this->creator_model->getCreatorContentList($searchs);
                $contents_cnt = $this->creator_model->getCreatorContentCnt($searchs);
                $ret['html'] = $this->load->view('creator/ajax-view-arc-list',['contents'=>$contents],true);
                $ret['contents'] = $contents;
                $ret['contents_cnt'] = $contents_cnt;
                $ret['type_text'] = $type_text;
                echo json_encode($ret);
                break;
        }
    }

    public function index(){
        $keyword = $this->input->get('search_keyword');
        $data['keyword'] = $keyword;

        $data['page_code'] = "creator";
        $this->page('creator/index',$data);
    }

    public function rm_cookie(){
        delete_cookie('creator_views');
    }

    public function view(){
        $idx = $this->uri->segment(3);
        if(!$idx) show_404();

        $creator = $this->creator_model->getCreator(['creator.idx'=>$idx]);
        if(!$creator) show_404();
        $data['creator'] = $creator;

        $data['profiles'] = $this->creator_model->getCreatorProfiles($creator['idx']);

        $data['contents_cnt'] = $this->creator_model->getCreatorContentCnt(['creator_idx'=>$creator['idx']]);

        // 조회수
        $view_cookie = json_decode(get_cookie('creator_views'));
        if(!$view_cookie) $view_cookie = [];
        if(!in_array($creator['idx'],$view_cookie)){
        //if(true){
            $this->db->set('views','views+1',false);
            $this->db->where('idx',$creator['idx']);
            if($this->db->update('creator')){
                $view_cookie[] = $creator['idx'];
                set_cookie('creator_views',json_encode($view_cookie),86400*365);
            }

            $this->db->set('creator_idx',$creator['idx']);
            $this->db->set('regdate',time());
            $this->db->set('user_ip',$_SERVER['REMOTE_ADDR']);
            $this->db->insert('creator_hit');
        }

        // 후원 데이터
        $support_data = [];

        $support_chart['labels'] = [];
        $support_chart['data'] = [];

        $days = 30;
        $today = strtotime(date('Y-m-d'));
        for($i=0;$i<$days;$i++){
            $timestamp = $today - (86400*$i);
            $support_data[date('Ymd',$timestamp)] = [
                'label'=>date('m-d',$timestamp),
                'sum'=>0,
                'supporters'=>[]
            ];

            $support_chart['labels'][] = date('m-d',$timestamp);
        }

        $this->load->model('payment_model');
        $support_list = $this->payment_model->getPaymentList(['payment.creator_idx'=>$creator['idx'],'payment.status'=>200,'payment.paydate>='=>$today-($days*86400)]);
        if(is_array($support_list) && count($support_list)>0){
            foreach($support_list as $paydata){
                $support_data[date('Ymd',$paydata['paydate'])]['sum'] += $paydata['pay_amt'];
                $support_data[date('Ymd',$paydata['paydate'])]['supporters'][] = ['user_name'=>$paydata['user_name'],'amount'=>$paydata['pay_amt']];
            }
        }

        $data['support_data'] = $support_data;

        $data['page_code'] = "creator";

        $this->page('creator/view',$data);
    }

    public function apply(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','name','required');
        if(!$this->form_validation->run()){
            $data['page_code'] = "apply";
            $this->page('creator/apply',$data);
        }else{
            $data = $this->input->post();

            $birth = $data['birth_year']."-".$data['birth_month']."-".$data['birth_day'];
            $email = trim(strip_tags($data['email']));

            $this->db->trans_begin();

            $dataset = [
                'gender'=>$data['gender'],
                'bg_type'=>$data['gender'],
                'birth'=>$birth,
                'regdate'=>time()
            ];

            // 활동분야
            $platform_array = [];
            if(is_array(@$data['platform']) && count($data['platform'])>0){
                foreach($data['platform'] as $platform){
                    $channel = ($platform['channel']=='기타')?'기타 ('.$platform['channel_etc'].')':$platform['channel'];
                    $platform_array[] = ['channel'=>$channel,'name'=>$platform['name'],'area'=>$platform['area'],'account'=>$platform['account']];
                }
            }

            $this->db->set('apply_platform',json_encode($platform_array));
            $this->db->set('name', 'HEX(AES_ENCRYPT("' . trim(strip_tags($data['name'])) . '","' . DB_ENCKEY . '"))', false);
            $this->db->set('phone', 'HEX(AES_ENCRYPT("' . trim(strip_tags(preg_replace("/[^0-9]*/s", "", $data['phone']))) . '","' . DB_ENCKEY . '"))', false);
            $this->db->set('email', 'HEX(AES_ENCRYPT("' . $email . '","' . DB_ENCKEY . '"))', false);
            $this->db->set('addr', 'HEX(AES_ENCRYPT("' . $data['addr'] . '","' . DB_ENCKEY . '"))', false);

            if(!$this->db->insert('creator',$dataset)){
                $this->print_json(-1,'DB Error');
                exit();
            }

            $apply_idx = $this->db->insert_id();




            $this->db->trans_complete();
            $this->print_json(1);
        }
    }

    public function grayscale(){

    }
}