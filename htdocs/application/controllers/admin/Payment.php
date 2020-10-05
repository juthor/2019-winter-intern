<?
class Payment extends MY_Controller{
    public function __construct()
    {
        parent::__construct();

        $this->admin_check();

        $this->load->model('payment_model');
    }

    public function ajax(){
        switch($this->uri->segment(4)){
            case 'view':
                $idx = $this->input->post('idx');

                $payment = $this->payment_model->getPayment(['payment.idx'=>$idx]);

                // Bootpay 데이터
                if(in_array($payment['pay_method'],['card','vbank','card_rebill'])){
                    $token = json_decode($this->CallAPI('POST','https://api.bootpay.co.kr/request/token',['application_id'=>BP_REST_KEY,'private_key'=>BP_PRIVATE_KEY],['Content-Type: application/json']),true);
                    $pay = json_decode($this->CallAPI('GET','https://api.bootpay.co.kr/receipt/'.$payment['receipt_id'],false,['Authorization: '.$token['data']['token']]),true);
                }

                $ret['html'] = $this->load->view('admin/payment/ajax-view',['payment'=>$payment,'pay'=>@$pay],true);
                echo json_encode($ret);
                break;

            case 'save_unitcost':
                $data = $this->input->post();

                switch($data['type']){
                    case 'item':
                        $this->db->trans_begin();
                        foreach($data['item'] as $idx=>$value){
                            $this->db->set('price',$value['price']);
                            $this->db->set('price_usd',$value['price_usd']);
                            $this->db->set('remarks',$value['remarks']);
                            if(@$value['point']) $this->db->set('point',$value['point']);
                            if(@$value['period']) $this->db->set('period',$value['period']);
                            $this->db->where('idx',$idx);
                            if(!$this->db->update('data_payment_select')){
                                $this->print_json(-1,'DB Error');
                                $this->db->trans_rollback();
                                exit();
                            }
                        }

                        $this->print_json(1);
                        $this->db->trans_complete();
                        break;

                    case 'point':
                        $this->db->trans_begin();
                        foreach($data['point'] as $idx=>$value){
                            $this->db->set('point',$value['point']);
                            if(@$value['period']) $this->db->set('period',$value['period']);
                            $this->db->where('idx',$idx);
                            if(!$this->db->update('data_point_policy')){
                                $this->print_json(-1,'DB Error');
                                $this->db->trans_rollback();
                                exit();
                            }
                        }

                        $this->print_json(1);
                        $this->db->trans_complete();
                        break;
                }
                break;

            case 'payment_cancel':
                $idx = $this->input->post('idx');
                if(!$idx){
                    $this->print_json(-1,'결제번호 없음');
                    exit();
                }

                $payment = $this->payment_model->getPayment(['payment.idx'=>$idx]);
                if($payment['pay_method'] != 'card'){
                    $this->print_json(-1,'카드결제만 결제취소 가능합니다');
                    exit();
                }

                if($payment['status'] != 200){
                    $this->print_json(-1,'결제완료된 결제만 취소가능합니다');
                    exit();
                }

                // Access Token
                $token = json_decode($this->CallAPI('POST','https://api.bootpay.co.kr/request/token',['application_id'=>BP_REST_KEY,'private_key'=>BP_PRIVATE_KEY],['Content-Type: application/json']),true);

                if($token['status']==200){
                    $this->db->trans_begin();
                    $this->db->set('status','999');
                    $this->db->where('idx',$payment['idx']);
                    if(!$this->db->update('payment')){
                        $this->print_json(-1,'DB Error');
                        exit();
                    }

                    $cancel_data = [
                        'receipt_id'=>$payment['receipt_id'],
                        'name'=>'관리자',
                        'reason'=>'취소',
                        'price'=>''
                    ];
                    $cancel = json_decode($this->CallAPI('POST','https://api.bootpay.co.kr/cancel',$cancel_data,['Authorization: '.$token['data']['token']],false),true);

                    if($cancel['status']==200){
                        $this->db->trans_complete();
                        $this->print_json(1,'결제취소 성공');
                    }else{
                        $this->db->trans_rollback();
                        $this->print_json(-1,'결제취소 실패 ('.$cancel['message'].')',['cancel'=>$cancel]);
                    }
                }else{
                    $this->print_json(-1,'Access Token 발급실패',['token'=>$token]);
                }
                break;
        }
    }

    public function index(){

        // 검색
        $searchs = $this->input->get('searchs');
        $user_searchs = $searchs;
        $searchs['payment.status>'] = 1;
        $data['searchs'] = $user_searchs;

        // 페이지네이션
        $per_page = 20;
        $page = $this->uri->segment(4);
        if(!$page) $page = 1;
        $this->load->library('pagination');
        $config = $this->pagination_config;
        $config['base_url'] = base_url()."admin/payment/index/";
        $config['total_rows'] = $this->payment_model->getPaymentCnt($searchs);
        $config['cur_page'] = $page;
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $queries = ['limit'=>[$per_page,($page-1)*$per_page]];

        // 결제 최대값
        $this->db->select_max('pay_amt');
        $this->db->where('payment.status!=','0');
        $max_amt = $this->db->get('payment')->row();
        $data['max_amt'] = $max_amt->pay_amt;

        // payment 목록
        $data['paymentList'] = $this->payment_model->getPaymentList($searchs,$queries);
        $this->admin_page('payment/index',$data);
    }

    public function point(){
        // 검색
        $searchs = $this->input->get('searchs');
        $user_searchs = $searchs;
        $data['searchs'] = $user_searchs;

        if(!$searchs['payment_point_date_range']){
            $searchs['payment_point_date_range'] = date('Y-m-d',strtotime(date('Y-m-d') . ' - 90 days')).' - '.date('Y-m-d');
        }

        // 페이지네이션
        $per_page = 20;
        $page = $this->uri->segment(4);
        if(!$page) $page = 1;
        $this->load->library('pagination');
        $config = $this->pagination_config;
        $config['base_url'] = base_url()."admin/payment/point/";
        $config['total_rows'] = $this->payment_model->getPointCnt($searchs);
        $config['cur_page'] = $page;
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $queries = ['limit'=>[$per_page,($page-1)*$per_page]];
        $data['display_num'] = $config['total_rows'] - ($page-1)*$per_page;
        $data['pointList'] = $this->payment_model->getPointList($searchs,$queries);

        // 포인트 최대값
        $this->db->select_max('point');
        $max_amt = $this->db->get('member_point')->row();
        $data['max_amt'] = $max_amt->point;

        // 포인트 최소값
        $this->db->select_min('point');
        $min_amt = $this->db->get('member_point')->row();
        $data['min_amt'] = $min_amt->point;

        // 총 포인트
        $this->db->select('(select sum(point)) as sum');
        if(@$searchs['payment_point_date_range']){
            $dateset = explode(' - ',$searchs['payment_point_date_range']);
            $startdate = strtotime(str_replace(".","-",$dateset[0]));
            $enddate = strtotime(str_replace(".","-",$dateset[1]))+86400;
        }else{
            $startdate = strtotime(date('Y-m-d') . ' - 3 days');
            $enddate = strtotime(date('Y-m-d'));
        }

        $this->db->where('member_point.regdate>=',$startdate);
        $this->db->where('member_point.regdate<',$enddate);
        $total_point = $this->db->get('member_point')->row();
        $data['total_point'] = $total_point->sum;

        $this->admin_page('payment/point',$data);
    }

    public function unitcost(){
        // 상품
        $this->db->order_by('type','asc');
        $this->db->order_by('price','asc');
        $data['itemList'] = $this->db->get('data_payment_select')->result_array();

        // 포인트
        $this->db->order_by('group_code','asc');
        $this->db->order_by('point','asc');
        $data['pointList'] = $this->db->get('data_point_policy')->result_array();

        $this->admin_page('payment/unitcost',$data);
    }
}