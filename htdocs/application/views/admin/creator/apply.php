<style>
    #table-creator-list{}
    #table-creator-list>tbody>tr>td:not(.no-click){cursor:pointer;}
    #table-creator-list .td-check{width:50px;}
    #table-creator-list .td-check>.rachel{margin:0;}
</style>

<table class="table table-v" id="table-creator-list">
    <thead>
    <tr>
        <th class="td-check"><label class="rachel"><input type="checkbox" name="check_all" value="1"></label></th>
        <th>순번</th>
        <th>성별</th>
        <th>이름</th>
        <th>생년월일</th>
        <th>전화번호</th>
        <th>이메일</th>
        <th>주소</th>
        <th>플랫폼</th>
    </tr>
    </thead>

    <tbody>
    <?
    if(is_array($applyList) && count($applyList)>0){
        foreach($applyList as $apply){
            ?>
            <tr data-idx="<?=$apply['idx']?>">
                <td class="td-check no-click"><label class="rachel"><input type="checkbox" name="idx[]" value="<?=$apply['idx']?>"></label></td>
                <td>순번</td>
                <td>
                    <?
                    switch($apply['gender']){
                        case 'm': echo "남"; break;
                        case 'f': echo "여"; break;
                        case 'e': echo "기타"; break;
                    }
                    ?>
                </td>
                <td><?=$apply['name']?></td>
                <td><?=$apply['birth']?></td>
                <td><?=convert_phone($apply['phone'])?></td>
                <td><?=$apply['email']?></td>
                <td><?=$apply['addr']?></td>
                <td>
                    <?
                    $apply_platform = json_decode($apply['apply_platform'],true);
                    $platform_names = [];
                    if(is_array($apply_platform) && count($apply_platform)>0){
                        foreach($apply_platform as $plat){
                            $platform_names[] = $plat['channel'];
                        }
                    }

                    echo implode(',',$platform_names);
                    ?>
                </td>
            </tr>
            <?
        }
    }
    ?>
    </tbody>
</table>

<div class="row">
    <div class="col-sm-3">
        <a href="javascript:set_confirm()" class="btn btn-primary">선택 승인</a>
        <a href="javascript:remove_apply()" class="btn btn-default">선택 삭제</a>
    </div>

    <div class="col-sm-6 text-center">

    </div>

    <div class="col-sm-3 text-right">
<!--        <a href="#" class="btn btn-default">엑셀 내보내기</a>-->
    </div>
</div>

<!-- 지원내용 보기 -->
<div class="modal" id="modal-apply-view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">지원내용 보기</div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('input[name="check_all"]').change(function(){
            $('input[name="idx[]"]').prop('checked',$(this).prop('checked'));
            $('.rachel').rachel();
        });

        $('input[name="idx[]"]').change(function(){
            $('input[name="check_all"]').prop('checked',($('input[name="idx[]"]:checked').length == $('input[name="idx[]"]').length));
            $('.rachel').rachel();
        });

        $('#table-creator-list>tbody>tr>td:not(.no-click)').click(function(){
            apply_view($(this).parents('tr').data('idx'));
        });
    });

    function set_confirm(idx){
        var idxList = new Array();

        if(idx){
            idxList.push(idx);
        }else{
            $('input[name="idx[]"]').each(function(){
                if($(this).prop('checked')){
                    idxList.push($(this).val());
                }
            });
        }

        if(idxList.length==0){
            alert('승인할 지원서가 선택되지 않았습니다');
            return;
        }

        if(!confirm('선택하신 지원서를 승인하시겠습니까?')) return;

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/creator/ajax/set_apply_confirm',
            data:{idxList:idxList},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('승인되었습니다');
                    location.reload();
                }else{
                    alert(res.msg);
                }
            },
            error:function() {
                alert('error');
            }
        });
    }

    function remove_apply(idx){
        var idxList = new Array();

        if(idx){
            idxList.push(idx);
        }else{
            $('input[name="idx[]"]').each(function(){
                if($(this).prop('checked')){
                    idxList.push($(this).val());
                }
            });
        }

        if(idxList.length==0){
            alert('삭제할 지원서가 선택되지 않았습니다');
            return;
        }

        if(!confirm('선택하신 지원서를 삭제하시겠습니까?')) return;

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/creator/ajax/remove_apply',
            data:{idxList:idxList},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('삭제되었습니다');
                    location.reload();
                }else{
                    alert(res.msg);
                }
            },
            error:function() {
                alert('error');
            }
        });
    }

    function apply_view(idx){
        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/creator/ajax/apply_view',
            data:{idx:idx},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    $('#modal-apply-view').find('.modal-body').html(res.html);
                    $('#modal-apply-view').modal();
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
