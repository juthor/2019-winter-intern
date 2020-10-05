<div class="text-center">
    <?
    if($data['code']==1){
        ?><p style="font-size:1.2em;text-align:center;margin:40px 0;">잔여 포인트는 <strong style="font-weight:700;color:#ec7a8f;"><?=number_format($data['balance'])?></strong>원 입니다</p><?
    }else{
        ?><p style="font-size:1.2em;text-align:center;margin:40px 0;"><?=$data['msg']?></p><?
    }
    ?>

</div>