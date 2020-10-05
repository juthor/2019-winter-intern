<?php
class Office extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->admin_check();

        if($this->admin_data['level']!=1){
            echo "권한이 없습니다";
            exit();
        }

        $this->load->model('admin_model');
    }

    public function ajax(){
        switch($this->uri->segment(4)){
            case 'open_admin_manage':
                $idx = $this->input->post('idx');

                $data['admin'] = [];
                if($idx) $data['admin'] = $this->admin_model->getAdmin(['idx'=>$idx]);

                $ret['html'] = $this->load->view('admin/office/admins/ajax_open_admin_manage',$data,true);
                echo json_encode($ret);
                break;

            case 'save_admin':
                $data = $this->input->post();

                $dataset = [
                    'name'=>$data['name'],
                    'id'=>$data['id'],
                    'level'=>$data['level']
                ];

                if(@$data['idx']){
                    if(@$data['passwd']) $dataset['passwd'] = md5($data['passwd']);
                    $this->db->where('idx',$data['idx']);
                    $result = $this->db->update('admin',$dataset);
                }else{
                    $dataset['passwd'] = md5($data['passwd']);
                    $result = $this->db->insert('admin',$dataset);
                }

                echo json_encode(['code'=>($result)?1:-1]);
                break;

            case 'remove_admin':
                $idx = $this->input->post('idx');

                $this->db->where('idx',$idx);
                $result = $this->db->delete('admin');
                echo json_encode(['code'=>($result)?1:-1]);
                break;

            case 'open_patents_manage':
                $idx = $this->input->post('idx');
                $data = [];

                if($idx){
                    $this->db->where('idx',$idx);
                    $data['patents'] = $this->db->get('patents')->row_array();
                }

                $ret['html'] = $this->load->view('admin/office/patents/ajax-manage',$data,true);
                echo json_encode($ret);
                break;

            case 'save_patents':
                $data = $this->input->post();

                $dataset = ['title'=>$data['title']];

                $this->db->trans_begin();
                if(@$data['idx']){
                    $this->db->where('idx',$data['idx']);
                    $result = $this->db->update('patents',$dataset);
                    $idx = $data['idx'];
                }else{
                    $result = $this->db->insert('patents',$dataset);
                    $idx = $this->db->insert_id();
                }

                if(!$result){
                    echo json_encode(['code'=>-1,'msg'=>'DB Error']);
                    exit();
                }

                // 썸네일 업로드
                if(@$_FILES['image']){
                    $config['upload_path'] = realpath(APPPATH.'../img/patents');
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 5*1024;
                    $config['overwrite'] = FALSE;
                    $config['encrypt_name'] = TRUE;
                    $config['remove_spaces'] = TRUE;
                    $this->load->library('upload',$config);
                    $this->load->library('image_lib');

                    $this->upload->initialize($config);

                    if(!$this->upload->do_upload('image')){
                        $error = $this->upload->display_errors();
                        $this->db->trans_rollback();
                        echo json_encode(['code'=>-1,'msg'=>$error]);
                        exit();
                    }else {
                        $image_data = $this->upload->data();

                        $this->db->where('idx',$idx);
                        $this->db->set('image',$image_data['file_name']);
                        if(!$this->db->update('patents')){
                            $this->db->trans_rollback();
                            echo json_encode(['code'=>-1,'msg'=>'IMAGE UPLOAD ERROR']);
                            exit();
                        }

                        // 이미지 리사이즈
                        if($image_data['image_width']>1000){
                            $resize_config = [
                                'maintain_ratio'=>true,
                                'image_library'=>'gd2',
                                'source_image'=>realpath(APPPATH.'../img/patents/'.$image_data['file_name']),
                                'width'=>1000
                            ];
                            $this->image_lib->initialize($resize_config);
                            $this->image_lib->resize();
                        }
                    }
                }

                $this->db->trans_complete();
                echo json_encode(['code'=>1]);
                break;

            case 'remove_patents':
                $idx = $this->input->post('idx');
                $this->db->where('idx',$idx);
                if(!$this->db->delete('patents')){
                    echo json_encode(['code'=>-1,'msg'=>'DB Error']);
                    exit();
                }

                echo json_encode(['code'=>1]);
                break;
        }
    }

    public function index(){
        redirect('admin/office/admins');
    }

    public function admins(){
        $data['adminList'] = $this->admin_model->getAdminList();
        $this->admin_page('office/admins/index',$data);
    }

    public function cfg(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('submit_go','submit_go','required');

        if(!$this->form_validation->run()){
            $data['cfgList'] = $this->db->get('config')->result_array();
            $this->admin_page('office/cfg/index',$data);
        }else{
            $dataList = $this->input->post('cfg');

            foreach($dataList as $key=>$value){
                if(in_array($key,['og_image','logo_white','logo_color'])) continue;

                $this->db->where('cfg_key',$key);
                $this->db->set('cfg_value',$value);
                $this->db->update('config');
            }


            if(@$_FILES['cfg']['name']['og_image']){
                $files = $_FILES;
                $_FILES['upload']['name'] = $files['cfg']['name']['og_image'];
                $_FILES['upload']['type'] = $files['cfg']['type']['og_image'];
                $_FILES['upload']['tmp_name'] = $files['cfg']['tmp_name']['og_image'];
                $_FILES['upload']['error'] = $files['cfg']['error']['og_image'];
                $_FILES['upload']['size'] = $files['cfg']['size']['og_image'];

                $config['upload_path'] = realpath(APPPATH.'../img/cfg');
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 5*1024;
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload',$config);
                $this->load->library('image_lib');

                $this->upload->initialize($config);

                if(!$this->upload->do_upload('upload')){
                    $error = $this->upload->display_errors();
                }else {
                    $image_data = $this->upload->data();

                    $this->db->where('cfg_key','og_image');
                    $this->db->set('cfg_value',$image_data['file_name']);
                    $this->db->update('config');
                }
            }

            if(@$_FILES['cfg']['name']['logo_white']){
                $files = $_FILES;
                $_FILES['upload']['name'] = $files['cfg']['name']['logo_white'];
                $_FILES['upload']['type'] = $files['cfg']['type']['logo_white'];
                $_FILES['upload']['tmp_name'] = $files['cfg']['tmp_name']['logo_white'];
                $_FILES['upload']['error'] = $files['cfg']['error']['logo_white'];
                $_FILES['upload']['size'] = $files['cfg']['size']['logo_white'];

                $config['upload_path'] = realpath(APPPATH.'../img/cfg');
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 5*1024;
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload',$config);
                $this->load->library('image_lib');

                $this->upload->initialize($config);

                if(!$this->upload->do_upload('upload')){
                    $error = $this->upload->display_errors();
                }else {
                    $image_data = $this->upload->data();

                    $this->db->where('cfg_key','logo_white');
                    $this->db->set('cfg_value',$image_data['file_name']);
                    $this->db->update('config');
                }
            }

            if(@$_FILES['cfg']['name']['logo_color']){
                $files = $_FILES;
                $_FILES['upload']['name'] = $files['cfg']['name']['logo_color'];
                $_FILES['upload']['type'] = $files['cfg']['type']['logo_color'];
                $_FILES['upload']['tmp_name'] = $files['cfg']['tmp_name']['logo_color'];
                $_FILES['upload']['error'] = $files['cfg']['error']['logo_color'];
                $_FILES['upload']['size'] = $files['cfg']['size']['logo_color'];

                $config['upload_path'] = realpath(APPPATH.'../img/cfg');
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 5*1024;
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload',$config);
                $this->load->library('image_lib');

                $this->upload->initialize($config);

                if(!$this->upload->do_upload('upload')){
                    $error = $this->upload->display_errors();
                }else {
                    $image_data = $this->upload->data();

                    $this->db->where('cfg_key','logo_color');
                    $this->db->set('cfg_value',$image_data['file_name']);
                    $this->db->update('config');
                }
            }
        }
    }

    public function patents(){
        $data['patentsList'] = $this->db->get('patents')->result_array();

        $this->admin_page('office/patents/index',$data);
    }
}