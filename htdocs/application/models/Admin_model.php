<?php
class Admin_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    function searchs($searchs){
        foreach($searchs as $key=>$value){
            switch($key){
                default:
                    $this->db->where($key,$value);
            }
        }
    }

    public function getAdmin($searchs){
        $this->searchs($searchs);
        $admin = $this->db->get('admin')->row_array();
        return $admin;
    }

    public function getAdminList(){
        $adminList = $this->db->get('admin')->result_array();

        foreach($adminList as $i=>$admin){
            $level_text = "";
            switch($admin['level']){
                case 1: $level_text = "최고관리자"; break;
                case 9: $level_text = "일반관리자"; break;
            }
            $adminList[$i]['level_text'] = $level_text;
        }

        return $adminList;
    }
}