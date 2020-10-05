<style>
    .panel.panel-default{margin-bottom:60px;}
    .panel.panel-default>.panel-body .table{margin:0;}
</style>

<div class="panel panel-default">
    <div class="panel-heading">판매 상품</div>
    <div class="panel-body">
        <form name="frm_unitcost_item">
            <table class="table table-v">
                <thead>
                <tr>
                    <th>구분</th>
                    <th>판매금액(KRW)</th>
                    <th>판매금액(USD)</th>
                    <th>충전포인트</th>
                    <th>이용기간</th>
                    <th>비고</th>
                </tr>
                </thead>

                <tbody>
                <?foreach($itemList as $item):?>
                    <tr>
                        <td>
                            <?
                            switch($item['type']){
                                case 'charge': echo "포인트충전"; break;
                                case 'freepass': echo "자유이용권"; break;
                            }
                            ?>
                        </td>
                        <td>
                            <div class="input-group full">
                                <input type="text" name="item[<?=$item['idx']?>][price]" value="<?=$item['price']?>" class="form-control">
                                <span class="input-group-addon">원</span>
                            </div>
                        </td>
                        <td>
                            <div class="input-group full">
                                <span class="input-group-addon">$</span>
                                <input type="text" name="item[<?=$item['idx']?>][price_usd]" value="<?=$item['price_usd']?>" class="form-control">
                            </div>
                        </td>
                        <td>
                            <?if($item['type']=='charge'){?>
                                <div class="input-group full">
                                    <input type="text" name="item[<?=$item['idx']?>][point]" value="<?=$item['point']?>" class="form-control">
                                    <span class="input-group-addon">포인트</span>
                                </div>
                            <?}?>
                        </td>
                        <td>
                            <?if($item['type']=='freepass'){?>
                                <div class="input-group full">
                                    <input type="text" name="item[<?=$item['idx']?>][period]" value="<?=$item['period']?>" class="form-control">
                                    <span class="input-group-addon">일</span>
                                </div>
                            <?}?>
                        </td>
                        <td>
                            <div class="input-group full">
                                <input type="text" name="item[<?=$item['idx']?>][remarks]" value="<?=$item['remarks']?>" class="form-control">
                            </div>
                        </td>
                    </tr>
                <?endforeach?>
                </tbody>
            </table>

            <input type="hidden" name="type" value="item">
        </form>
    </div>
    <div class="panel-footer">
        <a href="javascript:save_unitcost('item')" class="btn btn-primary">저장</a>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">포인트 정책</div>
    <div class="panel-body">
        <form name="frm_unitcost_point">
            <table class="table table-v">
                <thead>
                <tr>
                    <th>내용</th>
                    <th>사용포인트</th>
                    <th>이용기간</th>
                </tr>
                </thead>

                <tbody>
                <?foreach($pointList as $point):?>
                    <tr>
                        <td>
                            <?=$point['name']?>
                        </td>
                        <td>
                            <div class="input-group full">
                                <input type="text" name="point[<?=$point['idx']?>][point]" value="<?=$point['point']?>" class="form-control">
                                <span class="input-group-addon">포인트</span>
                            </div>
                        </td>
                        <td>
                            <?if($point['group_code']=='player'){?>
                                <div class="input-group full">
                                    <input type="text" name="point[<?=$point['idx']?>][period]" value="<?=$point['period']?>" class="form-control">
                                    <span class="input-group-addon">일</span>
                                </div>
                            <?}?>
                        </td>
                    </tr>
                <?endforeach?>
                </tbody>
            </table>

            <input type="hidden" name="type" value="point">
        </form>
    </div>
    <div class="panel-footer">
        <a href="javascript:save_unitcost('point')" class="btn btn-primary">저장</a>
    </div>
</div>

<script>
    function save_unitcost(type){
        if(!confirm('저장하시겠습니까?')) return;
        var form;
        switch(type){
            case 'item':
                form = $('form[name="frm_unitcost_item"]');
                break;

            case 'point':
                form = $('form[name="frm_unitcost_point"]');
                break;
        }

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/payment/ajax/save_unitcost',
            data:form.serialize(),
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('저장되었습니다');
                    location.reload();
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
                alert('error');
            }
        });
    }
</script>