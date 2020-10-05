<?
class Member extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->admin_check();

        $this->load->model('member_model');
    }

    public function ajax(){
        switch ($this->uri->segment(4)) {
            case 'save_memo':
                $data = $this->input->post();
                $this->db->set('memo',$data['memo']);
                $this->db->where('idx',$data['idx']);
                if(!$this->db->update('member')){
                    echo json_encode(['code'=>-1,'msg'=>'dB Error']);
                    exit();
                }

                echo json_encode(['code'=>1]);
                break;

            case 'open_member_manage':
                $idx = $this->input->post('idx');
                $member = $this->member_model->getMember(['idx'=>$idx]);
                $ret['html'] = $this->load->view('admin/member/ajax-manage-member',['member'=>$member],true);
                echo json_encode($ret);
                break;

            case 'save_member_manage':
                $data = $this->input->post();

                // 아이디 중복확인
                $check_id = $this->member_model->getMember(['id'=>$data['id'],'idx!='=>$data['idx']]);
                if($check_id){
                    echo json_encode(['code'=>-105,'msg'=>'이미 사용중인 아이디입니다']);
                    exit();
                }

                if(@$data['passwd']){
                    // 비밀번호확인
                    if(strlen($data['passwd'])<6){
                        echo json_encode(['code'=>-102,'msg'=>'비밀번호를 6자 이상 입력하세요']);
                        exit();
                    }

                    $this->db->set('passwd',md5($data['passwd']));
                }

                $this->db->set('id',trim(strip_tags($data['id'])));

                //$this->db->set('name', 'HEX(AES_ENCRYPT("' . trim(strip_tags($data['name'])) . '","' . DB_ENCKEY . '"))', false);
                //$this->db->set('phone', 'HEX(AES_ENCRYPT("' . trim(strip_tags($data['phone'])) . '","' . DB_ENCKEY . '"))', false);
                $this->db->set('email', 'HEX(AES_ENCRYPT("' . trim(strip_tags($data['email'])) . '","' . DB_ENCKEY . '"))', false);
                //$this->db->set('nickname',trim(strip_tags($data['nickname'])));
                $this->db->where('idx',$data['idx']);
                $result = $this->db->update('member');

                if($result){
                    echo json_encode(['code'=>1]);
                }else{
                    echo json_encode(['code'=>-1,'msg'=>'회원가입 실패']);
                }
                break;

            case 'check_id':
                $id = $this->input->post('id');
                $idx = $this->input->post('idx');

                $member = $this->member_model->getMember(['id'=>$id,'idx!='=>$idx]);

                if($member){
                    echo json_encode(['code'=>-1]);
                }else{
                    echo json_encode(['code'=>1]);
                }
                break;

            case 'check_nickname':
                $nickname = $this->input->post('nickname');
                $idx = $this->input->post('idx');

                $member = $this->member_model->getMember(['nickname'=>$nickname,'idx!='=>$idx]);

                if($member){
                    echo json_encode(['code'=>-1]);
                }else{
                    echo json_encode(['code'=>1]);
                }
                break;

            case 'member_exit':
                $idx = $this->input->post('idx');

                $this->db->trans_begin();

                $this->db->where('idx',$idx);
                if(!$this->db->delete('member')){
                    echo json_encode(['code'=>-1,'msg'=>'DB Error']);
                    exit();
                }

                $this->db->trans_complete();
                echo json_encode(['code'=>1]);
                break;

            case 'save_youtube_code':
                $data = $this->input->post();

                $this->db->set('m_video_youtube',$data['youtube_code']);
                $this->db->where('idx',$data['member_idx']);
                if(!$this->db->update('member')){
                    $this->print_json(-1,'DB Error');
                    exit();
                }
                
                $this->print_json(1);
                break;

            case 'set_best_player':
                $player_idx = $this->input->post('player_idx');

                $this->db->where('idx',$player_idx);
                $this->db->where('is_best_player','1');
                $check = $this->db->count_all_results('member');

                if($check){
                    $this->db->set('is_best_player','0');
                    $toggle = 'off';
                }else{
                    $this->db->set('is_best_player','1');
                    $toggle = 'on';
                }

                $this->db->where('idx',$player_idx);
                if(!$this->db->update('member')){
                    $this->print_json(-1,'DB Error');
                    exit();
                }

                $this->print_json(1,false,['toggle'=>$toggle]);
                break;

            case 'save_set_point':
                $data = $this->input->post();

                if(!$this->payment_model->usePoint($data['member_idx'],$data['point'],@$data['remarks'])){
                    $this->print_json(-1,'DB Error');
                    exit();
                }

                $this->print_json(1);
                break;
        }
    }

    public function index(){
        $page = $this->uri->segment(5);
        if(!$page) $page = 1;
        $per_page = 20;

        $type = $this->uri->segment(4);
        if(!$type) redirect('admin/member/index/1');;
        $data['type'] = $type;

        // 검색
        $searchs = $this->input->get('searchs');
        $data['searchs'] = $searchs;

        $searchs['member_type'] = $type;

        // 페이지네이션
        $this->load->library('pagination');
        $config = $this->pagination_config;
        $config['base_url'] = base_url()."admin/member/index/".$type."/";
        $config['total_rows'] = $this->member_model->getMemberCnt($searchs);
        $config['cur_page'] = $page;
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $queries = ['limit'=>[$per_page,($page-1)*$per_page]];
        $data['display_num'] = $config['total_rows'] - ($page-1)*$per_page;

        $data['memberList'] = $this->member_model->getMemberList($searchs,$queries);
        $this->admin_page('member/index',$data);
    }

    public function view(){
        $idx = $this->uri->segment(4);

        // 회원 정보
        $member = $this->member_model->getMember(['member.idx'=>$idx]);
        if(!$member) show_404();
        $data['member'] = $member;

        // 결제내역
        $data['paymentList'] = $this->payment_model->getPaymentList(['payment.member_idx'=>$member['idx'],'payment.status'=>200],['limit'=>[5,0]]);

        // 포인트내역
        $data['pointList'] = $this->payment_model->getPointList(['member_point.member_idx'=>$member['idx']],['limit'=>[5,0]]);

        // 이용상품 - 자유이용권
        if($member['isFreepass']){
            $data['item']['freepass'] = $this->payment_model->getPayment(['member_idx'=>$member['idx'],'payment.status'=>200,'pay_type'=>'freepass','date_start<='=>time(),'date_end>='=>time()]);
        }

        // 이용상품 - 선수등록
        if($member['isPlayer']){
            $this->db->where('member_idx',$member['idx']);
            $this->db->where('date_start<=',time());
            $this->db->where('date_end>=',time());
            $data['item']['player'] = $this->db->get('payment_player')->row_array();
        }

        $this->admin_page('member/view',$data);
    }

    public function manage(){



        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','name','required');
        if(!$this->form_validation->run()){
            $idx = $this->uri->segment(4);

            $member = $this->member_model->getMember(['member.idx'=>$idx]);
            $this->admin_page('member/manage',['member'=>$member]);
        }else{
            $data = $this->input->post();

            if(@$data['passwd']){
                // 비밀번호확인
                if(strlen($data['passwd'])<6){
                    echo json_encode(['code'=>-102,'msg'=>'비밀번호를 6자 이상 입력하세요']);
                    exit();
                }

                if($data['passwd'] != $data['passwd_confirm']){
                    echo json_encode(['code'=>-103,'msg'=>'비밀번호 확인을 다시 하세요']);
                    exit();
                }

                $this->db->set('passwd',md5($data['passwd']));
            }

            $member = $this->member_model->getMember(['member.idx'=>$data['idx']]);

            // DB 변경
            $this->db->trans_begin();

            if($member['type']==2){
                // URL 체크
                if(@$data['corp_url'] && substr($data['corp_url'],0,4)!='http'){
                    $data['corp_url'] = 'http://'.$data['corp_url'];
                }

                $data['corp_url_introduce'] = trim(strip_tags(@$data['corp_url_introduce']));
                if(@$data['corp_url_introduce'] && substr($data['corp_url_introduce'],0,4)!='http'){
                    $data['corp_url_introduce'] = 'http://'.$data['corp_url_introduce'];
                }



                $this->db->set('corp_name',trim(strip_tags($data['corp_name'])));
                $this->db->set('corp_num',trim(strip_tags(preg_replace("/[^0-9]*/s", "", $data['corp_num']))));
                $this->db->set('corp_ceo',trim(strip_tags($data['corp_ceo'])));
                $this->db->set('corp_addr',trim(strip_tags($data['corp_addr'])));
                $this->db->set('corp_bizClass',trim(strip_tags($data['corp_bizClass'])));
                $this->db->set('corp_bizType',trim(strip_tags($data['corp_bizType'])));
                $this->db->set('corp_url',trim(strip_tags($data['corp_url'])));
                $this->db->set('corp_url_introduce',((@$data['corp_url_introduce'])?$data['corp_url_introduce']:''));
                $this->db->set('corp_summary',trim(strip_tags($data['corp_summary'])));
                $this->db->set('corp_tel',trim(strip_tags(preg_replace("/[^0-9]*/s", "", $data['corp_tel']))));
            }

            $this->db->set('name', 'HEX(AES_ENCRYPT("' . trim(strip_tags($data['name'])) . '","' . DB_ENCKEY . '"))', false);
            $this->db->set('phone', 'HEX(AES_ENCRYPT("' . trim(strip_tags(preg_replace("/[^0-9]*/s", "", $data['phone']))) . '","' . DB_ENCKEY . '"))', false);
            $this->db->set('email', 'HEX(AES_ENCRYPT("' . trim(strip_tags($data['email'])) . '","' . DB_ENCKEY . '"))', false);
            $this->db->where('idx',$data['idx']);
            if(!$this->db->update('member')){
                echo json_encode(['code'=>-1,'msg'=>'정보수정 실패']);
                $this->db->trans_rollback();
                exit();
            }

            // 로고
            if(@$_FILES['corp_logo']){
                $config['upload_path'] = realpath(APPPATH.'../img/member/logo');
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 5*1024;
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload',$config);
                $this->load->library('image_lib');

                $this->upload->initialize($config);

                if(!$this->upload->do_upload('corp_logo')){
                    $error = $this->upload->display_errors();

                    echo json_encode(['code'=>-1,'msg'=>'썸네일 등록실패 ('.$error.')']);
                    $this->db->trans_rollback();
                    exit();
                }else {
                    $image_data = $this->upload->data();

                    $this->db->where('idx',$data['idx']);
                    $this->db->set('corp_logo',$image_data['file_name']);
                    if(!$this->db->update('member')){
                        echo json_encode(['code'=>-1,'msg'=>'썸네일 정보등록 실패']);
                        $this->db->trans_rollback();
                        exit();
                    }
                }
            }

            echo json_encode(['code'=>1]);
            $this->db->trans_complete();
        }
    }

    public function request(){
        $this->db->select('player_request.*');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(m1.name),"'.DB_ENCKEY.'") as char) as player_name');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(m1.phone),"'.DB_ENCKEY.'") as char) as player_phone');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(m2.name),"'.DB_ENCKEY.'") as char) as member_name');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(m2.phone),"'.DB_ENCKEY.'") as char) as member_phone');
        $this->db->select('m2.b_corp_name as member_corp_name');
        $this->db->join('member m1','m1.idx = player_request.player_idx');
        $this->db->join('member m2','m2.idx = player_request.member_idx');
        $this->db->order_by('regdate','desc');
        $requestList = $this->db->get('player_request')->result_array();
        $data['requestList'] = $requestList;
        $this->admin_page('member/request',$data);
    }
}