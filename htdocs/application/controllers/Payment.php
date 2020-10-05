<?
class Payment extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payment_model');
    }

    public function ajax(){
        switch($this->uri->segment(3)){

        }
    }

    public function support_preload(){
        $data = $this->input->post();

        $this->db->trans_begin();

        $dataset = [
            'creator_idx'=>$data['creator_idx'],
            'user_name'=>$data['user_name'],
            'pay_pg'=>BP_PG,
            'pay_price'=>$data['amount'],
            'regdate'=>time()
        ];
        if(!$this->db->insert('payment',$dataset)){
            $this->print_json(-1,'DB Error');
            exit();
        }

        $payment_idx = $this->db->insert_id();
        $oid_suffix = "";
        for($i=0;$i<(8 - strlen($payment_idx));$i++){
            $oid_suffix .= "0";
        }
        $oid_suffix .= $payment_idx;
        $oid = date('Ymd').$oid_suffix;

        $this->db->set('oid',$oid);
        $this->db->where('idx',$payment_idx);
        if(!$this->db->update('payment')){
            $this->db->trans_rollback();
            $this->print_json(-1,'DB Error');
            exit();
        }

        $this->db->trans_complete();

        $pay_res = [
            'oid'=>$oid,
            'item_name'=>'CELLY STORY 후원',
            'user_name'=>$data['user_name'],
            'pay_pg'=>BP_PG,
            'pay_price'=>$data['amount']
        ];

        $this->print_json(1,false,$pay_res);
    }

    public function save_vbank(){
        $data = $this->input->post();
        $dataset = [
            'status'=>'100',
            'pay_method'=>'vbank',
            'vbank_acc_num'=>$data['account'],
            'vbank_acc_code'=>$data['bankcode'],
            'vbank_acc_username'=>$data['username'],
            'receipt_id'=>$data['receipt_id']
        ];
        $this->db->where('oid',$data['order_id']);
        if(!$this->db->update('payment',$dataset)){
            $this->print_json(-1,'DB Error');
            exit();
        }

        $this->print_json(1);
    }

    public function support_complete(){
        $data = $this->input->post();

        // Access Token
        $token = json_decode($this->CallAPI('POST','https://api.bootpay.co.kr/request/token',['application_id'=>BP_REST_KEY,'private_key'=>BP_PRIVATE_KEY],['Content-Type: application/json']),true);

        if($token['status']==200){
            $msg = "";

            // 결제정보
            $payment = $this->payment_model->getPayment(['payment.oid'=>$data['oid']]);
            $pay = json_decode($this->CallAPI('GET','https://api.bootpay.co.kr/receipt/'.$data['data']['receipt_id'],false,['Authorization: '.$token['data']['token']]),true);

            if($pay['status']==200 && $pay['data']['status']==1 && $pay['data']['price'] == $payment['pay_price']){
                $status = 200;
                $pay_amt = $pay['data']['price'];
            }else if($pay['data']['price'] != $payment['pay_price']){
                $msg = "결제금액 변조확인 (요청금액:".$payment['pay_price']."원, 결제금액:".$pay['data']['price']."원)";
                $status = -101;
                $pay_amt = 0;

                // 결제 취소
                $cancel = json_decode($this->CallAPI('POST','https://api.bootpay.co.kr/cancel',['receipt_id'=>$data['data']['receipt_id'],'price'=>'','name'=>'SYSTEM','reason'=>'결제금액 변조'],['Content-Type: application/json','Authorization: '.$token['data']['token']]),true);
                if($cancel['status']!=200){
                    $status = -700;
                }
            }else if($pay['data']['status']==-1){
                $status = -1;
                $msg = "결제가 실패되었습니다";
            }else{
                $status = -1;
                $msg = "오류";
            }

            $msg.="";

            $paydata = [
                'pay_method'=>$pay['data']['method'],
                'status'=>$status,
                'receipt_id'=>$pay['data']['receipt_id'],
                'pay_amt'=>@$pay_amt,
                'paydate'=>time(),
                'msg'=>$msg
            ];
            $this->db->where('idx',$payment['idx']);
            if(!$this->db->update('payment',$paydata)){
                $this->print_json(-1,'DB Error');
                exit();
            }

            echo json_encode(['code'=>($status==200)?1:-1,'msg'=>$msg,'pay'=>$pay]);
        }else{
            $this->print_json(-1,'Access Token 발급실패',['token'=>$token]);
        }
    }

    public function receive_feedback(){
        $data = $this->input->post();

        if($data['private_key'] != BP_PRIVATE_KEY){
            exit();
        }

        $payment = $this->payment_model->getPayment(['payment.oid'=>$data['order_id']]);
        if(!$payment) exit();

        if($data['status']==1){
            if($payment['status']==100){
                $this->db->set('status','200');
                $this->db->set('pay_amt',$data['price']);
                $this->db->set('paydate',time());
                $this->db->where('idx',$payment['idx']);
                if($this->db->update('payment')){
                    echo "ok";
                }
            }else{
                echo "ok";
            }
        }
    }
}