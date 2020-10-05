<?
if(is_array($replyList) && count($replyList)>0){
    foreach($replyList as $reply){
        ?>
        <li>
            <div class="info">
                <strong><?=($reply['admin_idx'])?'<strong style="color:#ec7a8f;">관리자</strong>':$reply['name']?></strong>
                <small><?=date('y.m.d',$reply['regdate'])?></small>
                <a href="javascript:open_reply_update('<?=$reply['idx']?>')" class="btn-manage">수정</a>
                <a href="javascript:remove_reply('<?=$reply['idx']?>')" class="btn-manage">삭제</a>
            </div>

            <div class="content"><?=nl2br($reply['content'])?></div>
        </li>
        <?
    }
}else{
    ?><li class="empty">등록된 댓글이 없습니다</li><?
}
?>
