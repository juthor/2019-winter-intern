<?
class Board extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->admin_check();
        $this->load->model('board_model');
    }

    public function ajax(){
        switch($this->uri->segment(4)){
            case 'load_reply':
                $article_idx = $this->input->post('article_idx');

                $replyList = $this->board_model->getArticleReplyList(['board_reply.article_idx'=>$article_idx]);
                $ret['html'] = $this->load->view('admin/board/ajax-reply',['replyList'=>$replyList],true);
                echo json_encode($ret);
                break;

            case 'save_reply':
                $data = $this->input->post();

                $dataset = [
                    'content'=>$data['content']
                ];

                if(@$data['idx']){
                    $this->db->where('idx',$data['idx']);
                    $reply = $this->db->get('board_reply')->row_array();

                    $this->db->where('idx',$data['idx']);
                    $result = $this->db->update('board_reply',$dataset);
                }else{
                    $dataset['article_idx'] = $data['article_idx'];
                    $dataset['admin_idx'] = $this->sess_admin;
                    $dataset['regdate'] = time();
                    $result = $this->db->insert('board_reply',$dataset);
                }

                if(!$result){
                    $this->print_json(-1,'DB Error');
                    exit();
                }

                $this->print_json(1);
                break;

            case 'remove_reply':
                $idx = $this->input->post('idx');

                if(!$idx){
                    $this->print_json(-1,'인덱스값 없음');
                    exit();
                }

                $this->db->where('idx',$idx);
                $reply = $this->db->get('board_reply')->row_array();

                $this->db->where('idx',$idx);
                if(!$this->db->delete('board_reply')){
                    $this->print_json(-1,'DB Error');
                    exit();
                }
                $this->print_json(1);
                break;

            case 'open_reply_update':
                $idx = $this->input->post('idx');

                if(!$idx){
                    $this->print_json(-1,'인덱스값 없음');
                    exit();
                }

                $this->db->where('idx',$idx);
                $reply = $this->db->get('board_reply')->row_array();

                if($reply['member_idx'] != $this->sess_member){
                    $this->print_json(-1,'회원님이 작성한 댓글이 아닙니다');
                    exit();
                }

                $ret['code'] = 1;
                $ret['html'] = $this->load->view('board/ajax-reply-update',['reply'=>$reply],true);
                echo json_encode($ret);
                break;

            case 'remove_article':
                $idx = $this->input->post('idx');

                $article = $this->board_model->getArticle(['board_articles.idx'=>$idx]);

                $this->db->where('idx',$idx);
                if(!$this->db->delete('board_articles')){
                    $this->print_json(-1,'DB Error');
                    exit();
                }

                $this->db->where('article_idx',$idx);
                if(!$this->db->delete('board_reply')){
                    $this->print_json(-1,'DB Error (2)');
                    exit();
                }

                $this->print_json(1);
                break;
        }
    }

    public function index(){
        $boardId = $this->uri->segment(3);
        if(!$boardId) show_404();

        // 게시판 정보
        $board = $this->board_model->getBoard(['board.id'=>$boardId]);
        if(!$board) show_404();
        $data['board'] = $board;

        // 게시글 목록
        $searchs = $this->input->get('searchs');
        $data['searchs'] = $searchs;
        $searchs['board_articles.board_idx'] = $board['idx'];

        // 페이지네이션
        $page = $this->uri->segment(4);
        if(!$page) $page = 1;
        $per_page = 30;
        $this->load->library('pagination');
        $config = $this->pagination_config;
        $config['base_url'] = base_url()."board/".$board['id']."/";
        $config['total_rows'] = $this->board_model->getArticleCnt($searchs);
        $config['cur_page'] = $page;
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $queries = ['limit'=>[$per_page,($page-1)*$per_page]];
        $data['display_num'] = $config['total_rows'] - (($page-1)*$per_page);
        $data['articleList'] = $this->board_model->getArticleList($searchs,$queries);

        $this->admin_page('board/index',$data);
    }

    public function manage(){
        $boardId = $this->uri->segment(3);
        if(!$boardId) show_404();

        $board = $this->board_model->getBoard(['board.id'=>$boardId]);
        if(!$board) show_404();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('title','title','required');
        if(!$this->form_validation->run()){
            $article_idx = $this->uri->segment(5);
            if($article_idx){
                $article = $this->board_model->getArticle(['board_articles.idx'=>$article_idx]);
                $data['article'] = $article;
            }

            $data['board'] = $board;
            $this->admin_page('board/manage',$data);
        }else{
            $data = $this->input->post();

            $dataset = [
                'board_idx'=>$board['idx'],
                'title'=>strip_tags($data['title']),
                'content'=>$data['content']
            ];

            if(@$data['idx']){
                $this->db->where('idx',$data['idx']);
                $result = $this->db->update('board_articles',$dataset);
                $idx = $data['idx'];
            }else{
                $dataset['admin_idx'] = $this->sess_admin;
                $dataset['regdate'] = time();
                $result = $this->db->insert('board_articles',$dataset);
                $idx = $this->db->insert_id();
            }

            if(!$result){
                $this->print_json(-1,'DB Error');
            }

            $this->print_json(1,false,['idx'=>$idx]);
        }
    }

    public function view(){
        $boardId = $this->uri->segment(3);
        $idx = $this->uri->segment(5);

        // 게시판 정보
        $board = $this->board_model->getBoard(['board.id'=>$boardId]);
        if(!$board) show_404();
        $data['board'] = $board;

        // 게시글 정보
        $article = $this->board_model->getArticle(['board_articles.board_idx'=>$board['idx'],'board_articles.idx'=>$idx]);
        if(!$article) show_404();
        $data['article'] = $article;

        $this->admin_page('board/view',$data);
    }

}