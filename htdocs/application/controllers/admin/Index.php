<?php
class Index extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        if(!in_array($this->uri->segment(3),['login','logout'])){
            $this->admin_check();
        }

        $this->load->model('admin_model');
    }

    public function index(){
        // 가장많은 링크클릭
        $this->db->select('count(*) as cnt');
        $this->db->select('creator.first_name,creator.last_name');
        $this->db->join('creator','creator.idx = creator_hit.creator_idx');
        $this->db->group_by('creator_idx');
        $this->db->order_by('cnt','desc');
        $this->db->limit(5,0);
        $rank_click = $this->db->get('creator_hit')->result_array();
        $data['rank_click'] = $rank_click;

        // 가장많은 후원수
        $this->db->select('count(*) as cnt');
        $this->db->select('creator.first_name,creator.last_name');
        $this->db->join('creator','creator.idx = payment.creator_idx');
        $this->db->group_by('creator_idx');
        $this->db->order_by('cnt','desc');
        $this->db->limit(5,0);
        $rank_payment = $this->db->get('payment')->result_array();
        $data['rank_payment'] = $rank_payment;

        // 포트폴리오 조회수
        $this->load->model('creator_model');
        $data['hits'] = [
            'daily'=>$this->creator_model->getCreatorHit(['regdate>='=>strtotime(date('Y-m-d'))]),
            'weekly'=>$this->creator_model->getCreatorHit(['regdate>='=>strtotime(date('Y-m-d').' - 7 days')]),
            'monthly'=>$this->creator_model->getCreatorHit(['regdate>='=>strtotime(date('Y-m-d').' - 30 days')])
        ];

        $this->admin_page('index',$data);
    }

    public function login(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id','id','required');
        if(!$this->form_validation->run()){
            $this->load->view('admin/login');
        }else{
            $data = $this->input->post();

            $admin = $this->admin_model->getAdmin(['id'=>$data['id']]);

            if(!$admin){
                echo json_encode(['code'=>-1,'msg'=>'존재하지 않는 관리자입니다']);
            }else{
                if($admin['passwd'] == md5($data['passwd'])){
                    echo json_encode(['code'=>1]);
                    $this->session->set_userdata('sess_admin',$admin['idx']);
                }else{
                    echo json_encode(['code'=>-1,'msg'=>'비밀번호가 일치하지 않습니다']);
                }
            }
        }
    }

    public function logout(){
        $this->session->unset_userdata('sess_admin');
        redirect('admin');
    }
}