<?php
class Creator_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    function searchs($searchs){
        $db_enc = ['name','email','phone','addr'];

        foreach($searchs as $key=>$value){
            if($value!="0" && !$value) continue;
            $where_or = [];
            switch($key){

                case 'search_name':
                    $where_or[] = 'CAST(AES_DECRYPT(UNHEX(name),"'.DB_ENCKEY.'") as char) LIKE "%'.$value.'%"';
                    $where_or[] = 'b_corp_name LIKE "%'.$value.'%"';
                    $this->db->where("(".implode(' or ',$where_or).")");
                    break;

                case 'search_email':
                    $where_or[] = 'CAST(AES_DECRYPT(UNHEX(email),"'.DB_ENCKEY.'") as char) LIKE "%'.$value.'%"';
                    $this->db->where("(".implode(' or ',$where_or).")");
                    break;

                case 'search_keyword':
                    $where_or[] = 'CAST(AES_DECRYPT(UNHEX(member.name),"'.DB_ENCKEY.'") as char) LIKE "%'.$value.'%"';
                    //$where_or[] = 'corp_name LIKE "%'.$value.'%"';
                    $this->db->where("(".implode(' or ',$where_or).")");
                    break;

                default:
                    if(in_array($key,$db_enc)){
                        $this->db->where('AES_DECRYPT(UNHEX('.$key.'),"'.DB_ENCKEY.'") = ','"'.$value.'"',false);
                    }else{
                        $this->db->where($key,$value);
                    }
            }
        }
    }

    function queries($queries){
        foreach($queries as $key=>$value){
            switch($key){
                case 'orderby':
                    $this->db->order_by($value[0],$value[1]);
                    break;

                case 'limit':
                    $this->db->limit($value[0],$value[1]);
                    break;
            }
        }
    }

    public function getCreator($searchs){
        if($searchs) $this->searchs($searchs);

        $this->db->select('creator.*');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(name),"'.DB_ENCKEY.'") as char) as name');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(email),"'.DB_ENCKEY.'") as char) as email');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(phone),"'.DB_ENCKEY.'") as char) as phone');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(addr),"'.DB_ENCKEY.'") as char) as addr');
        $this->db->select('(select SUM(pay_amt) from payment where creator_idx = creator.idx and payment.status="200") as sponsor_amount');
        return $this->db->get('creator')->row_array();
    }

    public function getCreatorList($searchs=false,$queries=false){
        if($searchs) $this->searchs($searchs);
        if($queries) $this->queries($queries);

        $this->db->select('creator.*');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(name),"'.DB_ENCKEY.'") as char) as name');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(email),"'.DB_ENCKEY.'") as char) as email');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(phone),"'.DB_ENCKEY.'") as char) as phone');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(addr),"'.DB_ENCKEY.'") as char) as addr');
        $this->db->select('(select SUM(pay_amt) from payment where creator_idx = creator.idx and payment.status="200") as sponsor_amount');

        if(!@$queries['orderby']) $this->db->order_by('idx','desc');
        return $this->db->get('creator')->result_array();
    }

    public function getCreatorCnt($searchs=false){
        if($searchs) $this->searchs($searchs);
        return $this->db->count_all_results('creator');
    }

    public function getCreatorListByHashtag($hashtag,$queries=false){
        if($queries) $this->queries($queries);
        $this->db->select('creator.*');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(name),"'.DB_ENCKEY.'") as char) as name');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(email),"'.DB_ENCKEY.'") as char) as email');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(phone),"'.DB_ENCKEY.'") as char) as phone');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(addr),"'.DB_ENCKEY.'") as char) as addr');
        $this->db->select('(select SUM(pay_amt) from payment where creator_idx = creator.idx and payment.status="200") as sponsor_amount');

        $this->db->join('creator','creator.idx = creator_hashtag.creator_idx');

        $this->db->where('hashtag',$hashtag);
        $this->db->where('creator.is_confirm',1);
        $this->db->where('creator.is_display',1);
        return $this->db->get('creator_hashtag')->result_array();
    }

    public function getCreatorCntByHashtag($hashtag){
        $this->db->select('creator.*');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(name),"'.DB_ENCKEY.'") as char) as name');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(email),"'.DB_ENCKEY.'") as char) as email');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(phone),"'.DB_ENCKEY.'") as char) as phone');
        $this->db->select('CAST(AES_DECRYPT(UNHEX(addr),"'.DB_ENCKEY.'") as char) as addr');

        $this->db->join('creator','creator.idx = creator_hashtag.creator_idx');

        $this->db->where('hashtag',$hashtag);
        $this->db->where('creator.is_confirm',1);
        $this->db->where('creator.is_display',1);
        return $this->db->count_all_results('creator_hashtag');
    }

    public function getCreatorProfiles($creator_idx){
        $this->db->where('creator_idx',$creator_idx);
        return $this->db->get('creator_profile')->result_array();
    }

    public function getCreatorHashtags($creator_idx){
        $ret = [];
        $this->db->where('creator_idx',$creator_idx);
        $hashtags = $this->db->get('creator_hashtag')->result_array();
        if(is_array($hashtags) && count($hashtags)>0){
            foreach($hashtags as $hashtag){
                $ret[] = $hashtag['hashtag'];
            }
        }
        return $ret;
    }

    public function getCreatorContent($searchs){
        $this->searchs($searchs);
        $content = $this->db->get('creator_content')->row_array();

        if($content){
            $this->db->where('content_idx',$content['idx']);
            $content['list'] = $this->db->get('creator_content_list')->result_array();
        }

        return $content;
    }

    public function getCreatorContentList($searchs=false){
        if($searchs) $this->searchs($searchs);
        $this->db->order_by('idx','desc');
        $content = $this->db->get('creator_content')->result_array();

        if(is_array($content) && count($content)>0){
            foreach($content as $i => $cont){
                $this->db->where('content_idx',$cont['idx']);
                $content[$i]['list'] = $this->db->get('creator_content_list')->result_array();
            }
        }

        return $content;
    }

    public function getCreatorContentCnt($searchs=false){
        if($searchs) $this->searchs($searchs);
        return $this->db->count_all_results('creator_content');
    }

    public function getCreatorHit($searchs=false){
        if($searchs) $this->searchs($searchs);
        return $this->db->count_all_results('creator_hit');
    }
}