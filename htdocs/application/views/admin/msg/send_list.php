<table class="table table-v">
    <thead>
    <tr>
        <th>구분</th>
        <th>제목</th>
        <th>SMS발송</th>
        <th>이메일발송</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <?foreach($msg_list as $msg):?>
    <tr>
        <td>
            <?
            switch($msg['msg_group']){
                case 'order': echo "주문"; break;
                case 'member': echo "회원"; break;
            }
            ?>
        </td>
        <td><?=$msg['title']?></td>
        <td>
            <?
            if($msg['sms_user']) echo '<span class="label label-info">고객</span>';
            if($msg['sms_admin']) echo '<span class="label label-default">관리자</span>';
            ?>
        </td>
        <td>
            <?
            if($msg['email_user']) echo '<span class="label label-info">고객</span>';
            if($msg['email_admin']) echo '<span class="label label-default">관리자</span>';
            ?>
        </td>
        <td>
            <a href="<?=base_url()?>admin/msg/msg_view/<?=$msg['idx']?>" class="btn btn-default btn-sm">수정</a>
        </td>
    </tr>
    <?endforeach?>
    </tbody>
</table>