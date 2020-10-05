<?
class Operation extends MY_Controller{
    public function __construct()
    {
        parent::__construct();

        $this->admin_check();

        $this->load->model('operation_model');
    }

    public function ajax(){
        switch ($this->uri->segment(4)) {
            case 'open_voc_manage':
                $idx = $this->input->post('idx');

                $voc = [];
                if($idx) $voc = $this->operation_model->getVoc(['cs_voc.idx'=>$idx]);

                $ret['html'] = $this->load->view('admin/operation/voc/ajax-manage',['voc'=>$voc],true);
                echo json_encode($ret);
                break;

            case 'save_voc':
                $data = $this->input->post();

                $this->db->set('content_a',$data['content_a']);
                $this->db->set('a_admin',$this->admin_data['name']);
                $this->db->set('a_regdate',time());
                $this->db->where('idx',$data['idx']);
                $result = $this->db->update('cs_voc');

                if($result){
                    echo json_encode(['code'=>1]);
                }else{
                    echo json_encode(['code'=>-1,'msg'=>'DB저장 실패']);
                }
                break;

            case 'open_faq_manage':
                $idx = $this->input->post('idx');

                $faq = [];
                if($idx) $faq = $this->operation_model->getFaq(['cs_faq.idx'=>$idx]);

                $ret['html'] = $this->load->view('admin/operation/faq/ajax-manage',['faq'=>$faq],true);
                echo json_encode($ret);
                break;

            case 'save_faq':
                $data = $this->input->post();

                $dataset = [
                    'title'=>$data['title'],
                    'content'=>$data['content']
                ];

                if(@$data['idx']){
                    $this->db->where('idx',$data['idx']);
                    $result = $this->db->update('cs_faq',$dataset);
                }else{
                    $result = $this->db->insert('cs_faq',$dataset);
                }

                if($result){
                    echo json_encode(['code'=>1]);
                }else{
                    echo json_encode(['code'=>-1,'msg'=>'DB저장 실패']);
                }
                break;

            case 'remove_faq':
                $idx = $this->input->post('idx');

                $this->db->where('idx',$idx);
                if($this->db->delete('cs_faq')){
                    echo json_encode(['code'=>1]);
                }else{
                    echo json_encode(['code'=>-1,'msg'=>'DB삭제 실패']);
                }
                break;

            case 'save_popup':
                $data = $this->input->post();

                $dataset = [
                    'title'=>$data['title'],
                    'content'=>$data['content'],
                    'date_start'=>strtotime($data['date_start']),
                    'date_end'=>strtotime($data['date_end'])
                ];

                if(@$data['idx']){
                    $this->db->where('idx',$data['idx']);
                    $result = $this->db->update('popup',$dataset);
                    $idx = $data['idx'];
                }else{
                    $dataset['regdate'] = time();
                    $result = $this->db->insert('popup',$dataset);
                    $idx = $this->db->insert_id();
                }

                echo json_encode(['code'=>($result)?1:-1,'idx'=>$idx]);
                break;

            case 'remove_popup':
                $data = $this->input->post();

                $this->db->where('idx',$data['idx']);
                $result = $this->db->delete('popup');
                echo json_encode(['code'=>($result)?1:-1]);
                break;
        }
    }

    public function json(){
        switch ($this->uri->segment(4)) {
            case 'get_popup':
                $idx = $this->input->post('idx');
                $data = [];

                if($idx){
                    $data['data'] = $this->operation_model->getPopup($idx);
                }

                $ret['html'] = $this->load->view('admin/operation/popup/ajax-manage',$data,true);
                echo json_encode($ret);
                break;
        }
    }

    public function index(){
        redirect('admin/operation/voc');
    }

    public function voc(){
        $page = $this->uri->segment(4);
        if(!$page) $page = 1;
        $per_page = 20;

        // 검색
        $searchs = [];

        // 페이지네이션
        $this->load->library('pagination');
        $config = $this->pagination_config;
        $config['base_url'] = base_url()."admin/operation/voc";
        $config['total_rows'] = $this->operation_model->getVocCnt($searchs);
        $config['cur_page'] = $page;
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $queries = ['limit'=>[$per_page,($page-1)*$per_page]];

        $data['display_num'] = $config['total_rows'] - (($page-1)*$per_page);

        $data['vocList'] = $this->operation_model->getVocList($searchs,$queries);
        $this->admin_page('operation/voc/index',$data);
    }

    public function faq(){
        $data['faqList'] = $this->operation_model->getFaqList();
        $this->admin_page('operation/faq/index',$data);
    }

    public function popup(){
        $data['popupList'] = $this->operation_model->getPopupList();
        $data['title'] = "팝업 관리";
        $this->admin_page('operation/popup/list',$data);
    }
}