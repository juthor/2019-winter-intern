
<table class="table table-v">
    <thead>
    <tr>
        <th>요청구분</th>
        <th>요청일시</th>
        <th>구단명</th>
        <th>담당자 연락처</th>
        <th>선수명</th>
        <th>선수 연락처</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <?foreach($requestList as $req):?>
    <tr>
        <td>
            <?
            switch($req['type']){
                case 1: echo "입단 요청"; break;
                case 2: echo "테스트 요청"; break;
            }
            ?>
        </td>
        <td><?=date('Y-m-d H:i',$req['regdate'])?></td>
        <td><?=$req['member_corp_name']?><br><?=$req['member_name']?></td>
        <td><?=convert_phone($req['member_phone'])?></td>
        <td><?=$req['player_name']?></td>
        <td><?=convert_phone($req['player_phone'])?></td>
        <td>
            <a href="<?=base_url()?>admin/member/view/<?=$req['member_idx']?>" class="btn btn-default btn-sm">구단 정보</a>
            <a href="<?=base_url()?>admin/member/view/<?=$req['player_idx']?>" class="btn btn-default btn-sm">선수 정보</a>
        </td>
    </tr>
    <?endforeach?>
    </tbody>
</table>