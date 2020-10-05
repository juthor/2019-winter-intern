<?
class Payment_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    function searchs($searchs){
        $db_enc = [];

        foreach($searchs as $key=>$value){
            if(!$value) continue;
            $where_or = [];
            switch($key){
                case 'amt':
                    $this->db->where('pay_amt>=',$value['start']);
                    $this->db->where('pay_amt<=',$value['end']);
                    break;

                case 'search_id':
                    $this->db->where('member.id',$value);
                    break;

                case 'search_name':
                    //$where_or[] = 'CAST(AES_DECRYPT(UNHEX(name),"'.DB_ENCKEY.'") as char) LIKE "%'.$value.'%"';
                    $where_or[] = 'user_name LIKE "%'.$value.'%"';
                    $this->db->where("(".implode(' or ',$where_or).")");
                    break;

                case 'payment_point_date_range':
                    $dateset = explode(' - ',$value);
                    $startdate = strtotime(str_replace(".","-",$dateset[0]));
                    $enddate = strtotime(str_replace(".","-",$dateset[1]))+86400;
                    $this->db->where('member_point.regdate>=',$startdate);
                    $this->db->where('member_point.regdate<',$enddate);
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

    public function getPayment($searchs){
        $this->searchs($searchs);
        $this->db->select('payment.*');
        return $this->db->get('payment')->row_array();
    }

    public function getPaymentList($searchs=false,$queries=false){
        if($searchs) $this->searchs($searchs);
        if($queries) $this->queries($queries);
        $this->db->select('payment.*');
        $this->db->order_by('idx','desc');
        return $this->db->get('payment')->result_array();
    }

    public function getPaymentCnt($searchs=false){
        if($searchs) $this->searchs($searchs);
        return $this->db->count_all_results('payment');
    }
}