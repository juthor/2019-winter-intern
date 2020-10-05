<link rel="stylesheet" href="<?=base_url()?>css/old/bootstrap-datetimepicker.css"/>

<style>
    .table.table-v{}
    .table.table-v .td-store{width:140px;}
    .table.table-v .td-store .bootstrap-select{width:100%!important;}
</style>

<form name="frm-manage">
    <table class="table table-v">
        <thead>
        <tr>
            <th class="td-">성별</th>
            <th class="td-">이름(성)</th>
            <th class="td-">이름(이름)</th>
            <th class="td-">해시태그</th>
            <th class="td-">생년월일</th>
            <th class="td-">전화번호</th>
            <th class="td-">이메일</th>
            <th class="td-">주소</th>
            <th class="td-">활동채널</th>
            <th class="td-">활동분야</th>
            <th class="td-btn"></th>
        </tr>
        </thead>

        <tbody>
        <?foreach($dataList as $i=>$data):?>
            <tr data-id="<?=$i?>">
                <td class="td-">
                    <label class="rachel"><input type="radio" name="data[<?=$i?>][gender]" value="m" <?=(@$data['gender']=='남')?' checked="true" ':''?>> 남</label>
                    <label class="rachel"><input type="radio" name="data[<?=$i?>][gender]" value="f" <?=(@$data['gender']=='여')?' checked="true" ':''?>> 여</label>
                    <label class="rachel"><input type="radio" name="data[<?=$i?>][gender]" value="f" <?=(@$data['gender']=='기타')?' checked="true" ':''?>> 기타</label>
                </td>
                <td class="td-">
                    <div class="input-group">
                        <input type="text" name="data[<?=$i?>][first_name]" class="form-control" value="<?=@$data['first_name']?>">
                    </div>
                </td>
                <td class="td-">
                    <div class="input-group">
                        <input type="text" name="data[<?=$i?>][last_name]" class="form-control" value="<?=@$data['last_name']?>">
                    </div>
                </td>
                <td class="td-">
                    <div class="input-group">
                        <input type="text" name="data[<?=$i?>][hashtag]" class="form-control" value="<?=@$data['hashtag']?>">
                    </div>
                </td>
                <td class="td-">
                    <div class="input-group">
                        <input type="text" name="data[<?=$i?>][birth]" class="form-control date" value="<?=(@$data['birth'])?date('Y-m-d',$data['birth']):''?>">
                    </div>
                </td>
                <td class="td-">
                    <div class="input-group">
                        <input type="text" name="data[<?=$i?>][phone]" class="form-control" value="<?=@$data['phone']?>">
                    </div>
                </td>
                <td class="td-">
                    <div class="input-group">
                        <input type="text" name="data[<?=$i?>][email]" class="form-control" value="<?=@$data['email']?>">
                    </div>
                </td>
                <td class="td-">
                    <div class="input-group">
                        <input type="text" name="data[<?=$i?>][addr]" class="form-control" value="<?=@$data['addr']?>">
                    </div>
                </td>
                <td class="td-">
                    <div class="input-group">
                        <input type="text" name="data[<?=$i?>][active_channel]" class="form-control" value="<?=@$data['active_channel']?>">
                    </div>
                </td>
                <td class="td-">
                    <div class="input-group">
                        <input type="text" name="data[<?=$i?>][active_part]" class="form-control" value="<?=@$data['active_part']?>">
                    </div>
                </td>

                <td class="td-btn">
                    <a href="javascript:remove_row('<?=$i?>')" class="btn btn-default btn-sm">삭제</a>
                </td>
            </tr>
        <?endforeach?>
        </tbody>
    </table>

    <input type="hidden" name="insert_data" value="1">
</form>

<div class="text-center">
    <a href="javascript:save_creators()" class="btn btn-primary">저장</a>
</div>

<script src="<?=base_url()?>js/bootstrap-datetimepicker.js"></script>
<script src="<?=base_url()?>js/locales/bootstrap-datetimepicker.ko.js"></script>
<script>
    $(function(){
        $('.date').datetimepicker({
            format: 'yyyy-mm-dd',
            minView:2,
            autoclose:true,
            fontAwesome:true,
            language:'ss'
        });
    });

    function remove_row(id){
        if(!confirm('삭제하시겠습니까?')) return;
        $('form>table>tbody>tr[data-id="'+id+'"]').remove();
    }

    function save_creators(){
        var form = $('form[name="frm-manage"]');

        $.ajax({
            type:'post',
            data:form.serialize(),
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('저장되었습니다');
                    location.replace('<?=base_url()?>admin/creator');
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