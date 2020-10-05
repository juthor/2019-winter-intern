<?
class Creator extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->admin_check();
        $this->load->model('creator_model');
    }

    public function ajax(){
        switch($this->uri->segment(4)){
            case 'apply_view':
                $idx = $this->input->post('idx');

                $apply = $this->creator_model->getCreator(['is_confirm'=>'0','creator.idx'=>$idx]);

                if(!$apply){
                    $this->print_json(-1,'지원정보가 없습니다');
                    exit();
                }

                $ret['code'] = 1;
                $ret['html'] = $this->load->view('admin/creator/ajax-apply-view',['apply'=>$apply],true);
                echo json_encode($ret);
                break;

            case 'set_apply_confirm':
                $idxList = $this->input->post('idxList');

                $this->db->trans_begin();

                if(is_array($idxList) && count($idxList)>0){
                    foreach($idxList as $set_idx){
                        $this->db->set('is_confirm','1');
                        $this->db->where('idx',$set_idx);
                        if(!$this->db->update('creator')){
                            $this->print_json(-1,'DB Error');
                            $this->db->trans_rollback();
                            exit();
                        }
                    }
                }

                $this->db->trans_complete();
                $this->print_json(1);
                break;

            case 'remove_apply':
                $idxList = $this->input->post('idxList');

                $this->db->trans_begin();

                if(is_array($idxList) && count($idxList)>0){
                    foreach($idxList as $set_idx){
                        $this->db->where('idx',$set_idx);
                        if(!$this->db->delete('creator')){
                            $this->print_json(-1,'DB Error');
                            $this->db->trans_rollback();
                            exit();
                        }
                    }
                }

                $this->db->trans_complete();
                $this->print_json(1);
                break;

            case 'rollback_confirm':
                $idxList = $this->input->post('idxList');

                $this->db->trans_begin();

                if(is_array($idxList) && count($idxList)>0){
                    foreach($idxList as $set_idx){
                        $this->db->set('is_confirm','0');
                        $this->db->set('is_display','0');
                        $this->db->where('idx',$set_idx);
                        if(!$this->db->update('creator')){
                            $this->print_json(-1,'DB Error');
                            $this->db->trans_rollback();
                            exit();
                        }
                    }
                }

                $this->db->trans_complete();
                $this->print_json(1);
                break;

            case 'set_display':
                $disp = $this->input->post('disp');
                $disp = ($disp==1)?1:0;
                $idxList = $this->input->post('idxList');

                $this->db->trans_begin();

                if(is_array($idxList) && count($idxList)>0){
                    foreach($idxList as $set_idx){
                        $this->db->set('is_display',$disp);
                        $this->db->where('idx',$set_idx);
                        if(!$this->db->update('creator')){
                            $this->print_json(-1,'DB Error');
                            $this->db->trans_rollback();
                            exit();
                        }
                    }
                }

                $this->db->trans_complete();
                $this->print_json(1);
                break;

            case 'remove_content':
                $idx = $this->input->post('idx');

                $this->db->trans_begin();

                $this->db->where('idx',$idx);
                if(!$this->db->delete('creator_content')){
                    $this->print_json(-1,'DB Error (1)');
                    exit();
                }

                $this->db->where('content_idx',$idx);
                if(!$this->db->delete('creator_content_list')){
                    $this->print_json(-1,'DB Error (2)');
                    $this->db->trans_rollback();
                    exit();
                }

                $this->print_json(1);
                $this->db->trans_complete();
                break;
        }
    }

    public function index(){
        $searchs = [
            'is_confirm'=>1
        ];

        // 페이지네이션
        $page = $this->uri->segment(4);
        if(!$page) $page = 1;
        $per_page = 30;

        $this->load->library('pagination');
        $config = $this->pagination_config;
        $config['base_url'] = base_url()."admin/creator/index/";
        $config['total_rows'] = $this->creator_model->getCreatorCnt($searchs);
        $config['cur_page'] = $page;
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $queries = ['limit'=>[$per_page,($page-1)*$per_page]];

        $data['display_num'] = $config['total_rows'] - (($page-1)*$per_page);

        $data['creatorList'] = $this->creator_model->getCreatorList($searchs,$queries);
        $this->admin_page('creator/index',$data);
    }

    public function view(){

    }

    public function profile(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name','first_name','required');
        if(!$this->form_validation->run()){
            $idx = $this->uri->segment(4);
            if(!$idx) show_404();

            $creator = $this->creator_model->getCreator(['creator.idx'=>$idx]);
            $data['creator'] = $creator;

            $data['profiles'] = $this->creator_model->getCreatorProfiles($creator['idx']);
            $data['hashtags'] = $this->creator_model->getCreatorHashtags($creator['idx']);

            $this->admin_page('creator/profile',$data);
        }else{
            $data = $this->input->post();

            $data['first_name'] = trim(strip_tags($data['first_name']));
            $data['last_name'] = trim(strip_tags($data['last_name']));
            $files = $_FILES;

            $dataset = [
                'is_display'=>(@$data['is_display'])?1:0,
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                'active_channel'=>$data['active_channel'],
                'active_part'=>$data['active_part'],
                'bg_type'=>$data['bg_type']
            ];

            // 대표사진 등록
            if(@$_FILES['thumb_image']){
                $config['upload_path'] = realpath(APPPATH.'../img/creator');
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 5*1024;
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload',$config);
                $this->load->library('image_lib');

                $this->upload->initialize($config);

                if(!$this->upload->do_upload('thumb_image')){
                    $error = $this->upload->display_errors();
                    echo json_encode(['code'=>-1,'msg'=>strip_tags($error)]);
                    exit();
                }else {
                    $image_data = $this->upload->data();

                    $dataset['thumb_image'] = $image_data['file_name'];

                    switch($image_data['image_type']){
                        case 'jpg': $realImages = imagecreatefromjpeg(APPPATH.'../img/creator/'.$image_data['file_name']); break;
                        case 'jpeg': $realImages = imagecreatefromjpeg(APPPATH.'../img/creator/'.$image_data['file_name']); break;
                        case 'png': $realImages = imagecreatefrompng(APPPATH.'../img/creator/'.$image_data['file_name']); break;
                        default:
                            $this->print_json(-1,'Image create error (type:'.$image_data['image_type'].')');
                    }


                    $gs_path = APPPATH.'../img/creator/grayscale/'.$image_data['file_name'];
//
                    imagefilter($realImages, IMG_FILTER_GRAYSCALE);
                    imagepng($realImages, $gs_path);
                }
            }

            $this->db->trans_begin();

            $this->db->where('idx',$data['idx']);
            if(!$this->db->update('creator',$dataset)){
                $this->print_json(-1,'DB Error');
                exit();
            }

            // 해시태그 삭제
            $this->db->where('creator_idx',$data['idx']);
            $this->db->delete('creator_hashtag');

            // 해시태그 등록
            if(@$data['hashtag']){
                $tags = explode(',',$data['hashtag']);
                if(is_array($tags) && count($tags)>0){
                    foreach($tags as $tag){
                        $hashtag = trim(str_replace(" ","",$tag));
                        $this->db->set('creator_idx',$data['idx']);
                        $this->db->set('hashtag',$hashtag);
                        if(!$this->db->insert('creator_hashtag')){
                            $this->print_json(-1,'Hash Tag Insert Error');
                            $this->db->trans_rollback();
                            exit();
                        }
                    }
                }
            }

            // 프로필 데이터 삭제
            if(is_array(@$data['remove_profile']) && count($data['remove_profile'])>0){
                foreach($data['remove_profile'] as $rmv_idx){
                    $this->db->where('idx',$rmv_idx);
                    if(!$this->db->delete('creator_profile')){
                        $this->print_json(-1,'Remove Creator Profile DB Error');
                        $this->db->trans_rollback();
                        exit();
                    }
                }
            }

            // 프로필 데이터 등록
            if(is_array(@$data['profile']) && count($data['profile'])>0){
                foreach($data['profile'] as $profile_i => $profile){
                    $dataset = [
                        'title'=>$profile['title'],
                        'year'=>$profile['year']
                    ];

                    if(@$profile['idx']){
                        $this->db->where('idx',$profile['idx']);
                        $profile_result = $this->db->update('creator_profile',$dataset);
                        $profile_idx = $profile['idx'];
                    }else{
                        $dataset['creator_idx'] = $data['idx'];
                        $profile_result = $this->db->insert('creator_profile',$dataset);
                        $profile_idx = $this->db->insert_id();
                    }

                    if(!$profile_result){
                        $this->print_json(-1,'Profile DB Error');
                        $this->db->trans_rollback();
                        exit();
                    }

                    // 프로필 이미지
                    if(@$files['profile']['name'][$profile_i]){
                        $_FILES['upload']['name'] = $files['profile']['name'][$profile_i]['image'];
                        $_FILES['upload']['type'] = $files['profile']['type'][$profile_i]['image'];
                        $_FILES['upload']['tmp_name'] = $files['profile']['tmp_name'][$profile_i]['image'];
                        $_FILES['upload']['error'] = $files['profile']['error'][$profile_i]['image'];
                        $_FILES['upload']['size'] = $files['profile']['size'][$profile_i]['image'];

                        $config['upload_path'] = realpath(APPPATH.'../img/creator/profile');
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
                            echo json_encode(['code'=>-1,'msg'=>strip_tags($error).', 크기:'.$_FILES['upload']['size']]);
                            exit();
                        }else {
                            $image_data = $this->upload->data();

                            $this->db->set('image',$image_data['file_name']);
                            $this->db->where('idx',$profile_idx);
                            if(!$this->db->update('creator_profile')){
                                $this->print_json(-1,'Profile Image Error');
                                $this->db->trans_rollback();
                                exit();
                            }
                        }
                    }
                }
            }

            $this->db->trans_complete();
            $this->print_json(1);
        }
    }

    public function content(){
        $creator_idx = $this->uri->segment(4);
        if(!$creator_idx) show_404();
        $data['creator_idx'] = $creator_idx;

        $type = $this->uri->segment(5);
        if(!$type) $type = 'insfa';
        if(!in_array($type,['insfa','nblog','youtube'])) show_404();
        $data['type'] = $type;

        $data['contentList'] = $this->creator_model->getCreatorContentList(['creator_idx'=>$creator_idx,'type'=>$type]);

        $this->admin_page('creator/content/index',$data);
    }

    public function content_manage(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title','title','required');
        if(!$this->form_validation->run()){
            $creator_idx = $this->uri->segment(4);
            if(!$creator_idx) show_404();
            $data['creator_idx'] = $creator_idx;

            $type = $this->uri->segment(5);
            if(!in_array($type,['insfa','nblog','youtube'])) show_404();
            $data['type'] = $type;

            $idx = $this->uri->segment(6);
            if($idx){
                $data['content'] = $this->creator_model->getCreatorContent(['creator_content.idx'=>$idx]);
            }

            $this->admin_page('creator/content/manage',$data);
        }else{
            $data = $this->input->post();

            $files = $_FILES;
            $dataset = [
                'creator_idx'=>$data['creator_idx'],
                'title'=>$data['title'],
                'year'=>$data['year'],
                'type'=>$data['type']
            ];

            // 대표사진 등록
            if(@$_FILES['image']){
                $config['upload_path'] = realpath(APPPATH.'../img/creator/content');
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
                    echo json_encode(['code'=>-1,'msg'=>strip_tags($error)]);
                    exit();
                }else {
                    $image_data = $this->upload->data();

                    $dataset['image'] = $image_data['file_name'];
                }
            }

            $this->db->trans_begin();

            if(@$data['idx']){
                $this->db->where('idx',$data['idx']);
                $result = $this->db->update('creator_content',$dataset);
                $content_idx = $data['idx'];
            }else{
                $dataset['regdate'] = time();
                $dataset['creator_idx'] = $data['creator_idx'];
                $result = $this->db->insert('creator_content',$dataset);
                $content_idx = $this->db->insert_id();
            }

            if(!$result){
                $this->print_json(-1,'DB Error');
                exit();
            }

            // 컨텐츠 데이터 등록
            if(is_array(@$data['remove_content']) && count($data['remove_content'])>0){
                foreach($data['remove_content'] as $rmv_idx){
                    $this->db->where('idx',$rmv_idx);
                    if(!$this->db->delete('creator_content_list')){
                        $this->print_json(-1,'Remove Creator Content DB Error');
                        $this->db->trans_rollback();
                        exit();
                    }
                }
            }

            // 컨텐츠 데이터 등록
            if(is_array(@$data['content']) && count($data['content'])>0){
                foreach($data['content'] as $content_i => $content){
                    $dataset = [
                        'title'=>$content['title'],
                        'content'=>$content['content'],
                    ];

                    if($data['type']=='youtube'){
                        $dataset['youtube_id'] = $content['youtube_id'];
                    }

                    if(@$content['idx']){
                        $this->db->where('idx',$content['idx']);
                        $content_result = $this->db->update('creator_content_list',$dataset);
                        $content_list_idx = $content['idx'];
                    }else{
                        $dataset['content_idx'] = $content_idx;
                        $content_result = $this->db->insert('creator_content_list',$dataset);
                        $content_list_idx = $this->db->insert_id();
                    }

                    if(!$content_result){
                        $this->print_json(-1,'Profile DB Error');
                        $this->db->trans_rollback();
                        exit();
                    }

                    // 프로필 이미지
                    if(@$files['content']['name'][$content_i]){
                        $_FILES['upload']['name'] = $files['content']['name'][$content_i]['image'];
                        $_FILES['upload']['type'] = $files['content']['type'][$content_i]['image'];
                        $_FILES['upload']['tmp_name'] = $files['content']['tmp_name'][$content_i]['image'];
                        $_FILES['upload']['error'] = $files['content']['error'][$content_i]['image'];
                        $_FILES['upload']['size'] = $files['content']['size'][$content_i]['image'];

                        $config['upload_path'] = realpath(APPPATH.'../img/creator/content');
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
                            echo json_encode(['code'=>-1,'msg'=>strip_tags($error).', 크기:'.$_FILES['upload']['size']]);
                            exit();
                        }else {
                            $image_data = $this->upload->data();

                            $this->db->set('image',$image_data['file_name']);
                            $this->db->where('idx',$content_list_idx);
                            if(!$this->db->update('creator_content_list')){
                                $this->print_json(-1,'Profile Image Error');
                                $this->db->trans_rollback();
                                exit();
                            }
                        }
                    }
                }
            }

            $this->db->trans_complete();
            $this->print_json(1);
        }
    }

    public function apply(){
        $searchs = [
            'is_confirm'=>0
        ];
        $data['applyList'] = $this->creator_model->getCreatorList($searchs);
        $this->admin_page('creator/apply',$data);
    }

    public function xls_export(){
        // 검색
        $searchs = $this->input->get('searchs');
        $searchs['is_confirm'] = 1;

        $creatorList = $this->creator_model->getCreatorList($searchs);

        //엑셀파일
        $xlsRows = 1;
        $num = $this->creator_model->getCreatorCnt($searchs);
        require_once APPPATH.'PHPExcel.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A1", "노출상태")
            ->setCellValue("B1", "성별")
            ->setCellValue("C1", "이름")
            ->setCellValue("D1", "영문이름")
            ->setCellValue("E1", "해시태그")
            ->setCellValue("F1", "생년월일")
            ->setCellValue("G1", "전화번호")
            ->setCellValue("H1", "이메일")
            ->setCellValue("I1", "주소")
            ->setCellValue("J1", "활동채널")
            ->setCellValue("K1", "활동분야")
            ->setCellValue("L1", "총 후원금액");



        foreach($creatorList as $creator){
            $hashtags = $this->creator_model->getCreatorHashtags($creator['idx']);

            $xlsRows++;
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("A".$xlsRows, ($creator['is_display'])?'노출':'미노출')
                ->setCellValue("B".$xlsRows, ($creator['gender']=='m')?'남':'여')
                ->setCellValue("C".$xlsRows, $creator['name'])
                ->setCellValue("D".$xlsRows, $creator['first_name']." ".$creator['last_name'])
                ->setCellValue("E".$xlsRows, implode(",",$hashtags))
                ->setCellValue("F".$xlsRows, $creator['birth'])
                ->setCellValue("G".$xlsRows, convert_phone($creator['phone']))
                ->setCellValue("H".$xlsRows, $creator['email'])
                ->setCellValue("I".$xlsRows, $creator['addr'])
                ->setCellValue("J".$xlsRows, $creator['active_channel'])
                ->setCellValue("K".$xlsRows, $creator['active_part'])
                ->setCellValue("L".$xlsRows, $creator['sponsor_amount']);
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('크리에이터 목록');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
        //$filename = iconv("UTF-8", "EUC-KR", "펫펫_배송준비중_".date('ymdHis'));
        $fileName = "셀리스토리_크리에이터_목록_".date('Y-m-d-His');

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=".$fileName.".xls");
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function xls_import(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('insert_data','insert_data','required');

        if(!$this->form_validation->run()){
            if(!$_FILES['upload']){
                echo "No file";
                exit;
            }

            require_once APPPATH.'PHPExcel.php';
            $objPHPExcel = new PHPExcel();

            require_once APPPATH.'PHPExcel/IOFactory.php';
            $fileName = $_FILES['upload']['tmp_name'];

            try {
                // 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.
                $objReader = PHPExcel_IOFactory::createReaderForFile($fileName);
                // 읽기전용으로 설정
                $objReader->setReadDataOnly(true);

                // 엑셀파일을 읽는다
                $objExcel = $objReader->load($fileName);

                // 첫번째 시트를 선택
                $objExcel->setActiveSheetIndex(0);
                $objWorksheet = $objExcel->getActiveSheet();
                $rowIterator = $objWorksheet->getRowIterator();

                foreach ($rowIterator as $row) { // 모든 행에 대해서
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);
                }

                $maxRow = $objWorksheet->getHighestRow();

                $dataList = [];

                for($i=2;$i<=$maxRow;$i++){
                    //$objWorksheet->setCellValueExplicit('A1', '0029', PHPExcel_Cell_DataType::TYPE_STRING);

                    $gender = $objWorksheet->getCell('A' . $i)->getValue();
                    $first_name = $objWorksheet->getCell('B' . $i)->getValue();
                    $last_name = $objWorksheet->getCell('C' . $i)->getValue();
                    $hashtag = $objWorksheet->getCell('D' . $i)->getValue();
                    $birth = $objWorksheet->getCell('E' . $i)->getValue();
                    $phone = $objWorksheet->getCell('F' . $i)->getValue();
                    $email = $objWorksheet->getCell('G' . $i)->getValue();
                    $addr = $objWorksheet->getCell('H' . $i)->getValue();
                    $active_channel = $objWorksheet->getCell('I' . $i)->getValue();
                    $active_part = $objWorksheet->getCell('J' . $i)->getValue();

                    $dataList[] = [
                        'gender'=>$gender,
                        'first_name'=>$first_name,
                        'last_name'=>$last_name,
                        'hashtag'=>$hashtag,
                        'birth'=>PHPExcel_Shared_Date::ExcelToPHP($birth) - 60*60*9,
                        'phone'=>$phone,
                        'email'=>$email,
                        'addr'=>$addr,
                        'active_channel'=>$active_channel,
                        'active_part'=>$active_part,



                        //'date_start'=>PHPExcel_Shared_Date::ExcelToPHP($date_start) - 60*60*9,
                        //'date_end'=>($date_end)?PHPExcel_Shared_Date::ExcelToPHP($date_end) - 60*60*9:''

                    ];
                }

                $data['dataList'] = $dataList;
                $this->admin_page('creator/xls_import',$data);
            }
            catch (exception $e) {
                $result['error'] = $e;
                $this->page_alert('엑셀파일 읽기실패');
            }
        }else{
            $dataList = $this->input->post('data');

            $this->db->trans_begin();

            foreach($dataList as $i=>$data){
                $dataset = [
                    'is_confirm'=>1,
                    'is_display'=>0,
                    'gender'=>$data['gender'],
                    'first_name'=>$data['first_name'],
                    'last_name'=>$data['last_name'],
                    'birth'=>$data['birth'],
                    'active_channel'=>$data['active_channel'],
                    'active_part'=>$data['active_part']
                ];

                $email = trim(strip_tags($data['email']));

                $this->db->set('phone', 'HEX(AES_ENCRYPT("' . trim(strip_tags(preg_replace("/[^0-9]*/s", "", $data['phone']))) . '","' . DB_ENCKEY . '"))', false);
                $this->db->set('email', 'HEX(AES_ENCRYPT("' . $email . '","' . DB_ENCKEY . '"))', false);
                $this->db->set('addr', 'HEX(AES_ENCRYPT("' . $data['addr'] . '","' . DB_ENCKEY . '"))', false);

                $dataset['regdate'] = time();
                $result = $this->db->insert('creator',$dataset);
                $idx = $this->db->insert_id();

                // 해시태그 등록
                if(@$data['hashtag']){
                    $tags = explode(',',$data['hashtag']);
                    if(is_array($tags) && count($tags)>0){
                        foreach($tags as $tag){
                            $hashtag = trim(str_replace(" ","",$tag));
                            $this->db->set('creator_idx',$idx);
                            $this->db->set('hashtag',$hashtag);
                            if(!$this->db->insert('creator_hashtag')){
                                $this->print_json(-1,'Hash Tag Insert Error');
                                $this->db->trans_rollback();
                                exit();
                            }
                        }
                    }
                }

                if(!$result){
                    $this->print_json('-1','DB Error');
                    $this->db->trans_rollback();
                    exit();
                }
            }

            $this->print_json(1);
            $this->db->trans_complete();
        }

    }
}