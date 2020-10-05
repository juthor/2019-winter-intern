<!--상태	구단명	구장	일시	연령	유니폼색상	등록일-->

<table class="table table-default">
    <tbody>
    <tr>
        <th>구분</th>
        <td>
            <?
            switch($match['type']){
                case 1: echo "매치 등록"; break;
                case 2: echo "매치 헌팅"; break;
            }
            ?>
        </td>
    </tr>
    <tr>
        <th>진행상태</th>
        <td><?=$this->match_status[$match['status']]?></td>
    </tr>
    <tr>
        <th>등록구단</th>
        <td><?=$match['b_corp_name']?></td>
    </tr>
    <tr>
        <th>등록회원</th>
        <td>
            <?=$match['name']?>
        </td>
    </tr>
    <tr>
        <th>등록회원 연락처</th>
        <td><?=convert_phone($match['phone'])?></td>
    </tr>
    <tr>
        <th>구단명</th>
        <td><?=$match['team_name']?></td>
    </tr>

    <tr>
        <th>코칭스탭</th>
        <td><?=$match['staff_name']?></td>
    </tr>
    <tr>
        <th>코칭스탭 연락처</th>
        <td><?=convert_phone($match['staff_phone'])?></td>
    </tr>
    <tr>
        <th>구장</th>
        <td><?=($match['stadium'])?$match['stadium']:'협의'?></td>
    </tr>
    <tr>
        <th>일자</th>
        <td><?=($match['matchdate'])?date('y-m-d H:i',$match['matchdate']):'협의'?></td>
    </tr>
    <tr>
        <th>연령</th>
        <td><?=$this->data_ages[$match['age']]['name']?></td>
    </tr>
    <tr>
        <th>유니폼</th>
        <td>
            <p><small>상의:</small> <?=$match['uniform_top']?></p>
            <p><small>하의:</small> <?=$match['uniform_bottom']?></p>
        </td>
    </tr>
    </tbody>
</table>

<?
switch($match['type']){
    case 1:
        ?>
        <table class="table table-v">
            <caption>요청 목록</caption>
            <thead>
            <tr>
                <th>상태</th>
                <th>구단명</th>
                <th>담당자명</th>
                <th>연락처</th>
            </tr>
            </thead>
            <tbody>
            <?
            if(is_array($requestList) && count($requestList)>0){
                foreach($requestList as $req):?>
                    <tr>
                        <td>
                            <?
                            switch($req['match_result']){
                                case 1: echo "<strong>수락</strong>"; break;
                                case 9: echo "거절"; break;
                                default: echo "대기";
                            }
                            ?>
                        </td>
                        <td><?=$req['b_corp_name']?></td>
                        <td><?=$req['name']?></td>
                        <td><?=$req['phone']?></td>
                    </tr>
                <?
                endforeach;
            }else{
                ?><tr><td colspan="4" class="text-center">요청이 없습니다</td></tr><?
            }
            ?>

            </tbody>
        </table>
        <?
        break;

    case 2:
        ?>
        <div class="text-center">
            <a href="javascript:set_match_hunt_result('<?=$match['idx']?>','200')" class="btn btn-primary">성공</a>
            <a href="javascript:set_match_hunt_result('<?=$match['idx']?>','900')" class="btn btn-default">실패</a>
        </div>
        <?
        break;
}
?>