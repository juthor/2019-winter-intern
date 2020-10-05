<style>
    #table-requests{}
    #table-requests .td-type{width:60px;}
</style>

<table class="table table-v" id="table-requests">
    <thead>
    <tr>
        <th class="td-num"></th>
        <th class="td-status">상태</th>
        <th class="td-type">구분</th>
        <th class="td-name">요청자</th>
        <th class="td-data">나이</th>
        <th class="td-data">주발</th>
        <th class="td-position">포지션</th>
        <th class="td-salary">연봉</th>
        <th class="td-data">병역</th>
        <th class="td-data">최종경력</th>
        <th class="td-data">최종학력</th>
        <th class="td-btns"></th>
    </tr>
    </thead>

    <tbody>
    <?foreach($requests as $req):?>
    <tr>
        <td class="td-num"></td>
        <td class="td-status"><?=$this->headhunt_status[$req['status']]?></td>
        <td class="td-type"><?=($req['member_type']==1)?'선수':'기업'?></td>
        <td class="td-name"><?=($req['member_type']==1)?$req['name']:$req['b_corp_name']?></td>
        <td class="td-data"><?
            switch($req['member_type']){
                case 1: echo $req['member_age']; break;
                case 2: echo ($req['age']>0)?$this->data_ages[$req['age']]['name']:''; break;
            }
            ?></td>
        <td class="td-data"><?=$this->data_main_foot[$req['member_type']]?></td>
        <td class="td-position">
            <?
            $positions = [];
            if(is_array($req['positions']) && count($req['positions'])>0){
                foreach($req['positions'] as $pos){
                    $prefix = substr($pos,0,1);
                    $positions[] = $this->member_position[$prefix]['list'][$pos];
                }
            }

            echo implode(",",$positions);
            ?>
        </td>
        <td class="td-salary"><?=($req['salary']>0)?number_format($req['salary']).'원':'협의'?></td>
        <td class="td-data">
            <?
            switch($req['military']){
                case 1: echo "필"; break;
                case 2: echo "미필"; break;
                default: echo "무관";
            }
            ?>
        </td>
        <td class="td-data"><?=($req['career'])?$this->data_career[$req['career']]:'무관'?></td>
        <td class="td-data"><?=($req['edu'])?$this->data_edu[$req['edu']]:'무관'?></td>
        <td class="td-btns">
            <a href="<?=base_url()?>admin/headhunt/view/<?=$req['idx']?>" class="btn btn-primary">보기</a>
        </td>
    </tr>
    <?endforeach?>
    </tbody>
</table>
