<table class="table table-default">
    <tr>
        <th>이름</th>
        <td><?=$apply['name']?></td>
    </tr>
    <tr>
        <th>생년월일</th>
        <td><?=$apply['birth']?></td>
    </tr>
    <tr>
        <th>전화번호</th>
        <td><?=convert_phone($apply['phone'])?></td>
    </tr>
    <tr>
        <th>E-mail</th>
        <td><?=$apply['email']?></td>
    </tr>
    <tr>
        <th>주소</th>
        <td><?=$apply['addr']?></td>
    </tr>
</table>

<table class="table table-v">
    <thead>
    <tr>
        <th>활동 채널</th>
        <th>활동 분야</th>
        <th>활동명</th>
        <th>계정주소</th>
    </tr>
    </thead>
    <tbody>
    <?
    $platforms = json_decode($apply['apply_platform'],true);
    foreach($platforms as $platform){
        ?>
        <tr>
            <td><?=@$platform['channel']?></td>
            <td><?=@$platform['area']?></td>
            <td><?=@$platform['name']?></td>
            <td><?=@$platform['account']?></td>
        </tr>
        <?
    }
    ?>
    </tbody>
</table>

<div class="text-center">
    <a href="javascript:set_confirm('<?=$apply['idx']?>')" class="btn btn-primary">승인</a>
    <a data-dismiss="modal" class="btn btn-default">닫기</a>
</div>