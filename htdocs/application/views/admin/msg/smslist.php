<table class="table table-v">
    <thead>
    <tr>
        <th class="td-num"></th>
        <th class="td-status">요청상태</th>
        <th class="td-status">구분</th>
        <th class="td-status">메시지</th>
        <th class="td-status">수신자</th>
        <th class="td-status">발송일시</th>
    </tr>
    </thead>

    <tbody>
    <?foreach($messages['messages'] as $msg):?>
        <tr>
            <td class="td-num"><?=$display_num--?></td>
            <td class="td-status">
                <?
                if($msg['status']==1){
                    echo "정상";
                }else{
                    echo "실패<br><small>".$msg['status_msg']."</small>";
                }
                ?>
            </td>
            <td class="td-status"><?=strtoupper($msg['msg_type'])?></td>
            <td class="td-status"><?=$msg['msg']?></td>
            <td class="td-status"><?=convert_phone($msg['receivers'][0]['receiver']).((count($msg['receivers'])>1)?' 외 '.(count($msg['receivers'])-1).'명':'')?></td>
            <td class="td-status"><?=date('Y-m-d H:i:s',$msg['regdate'])?></td>
        </tr>
    <?endforeach?>
    </tbody>
</table>

<div class="text-center"><?=$pagination?></div>