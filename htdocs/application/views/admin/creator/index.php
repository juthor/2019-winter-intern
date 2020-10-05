<style>
    #table-creator-list{}
    #table-creator-list>tbody>tr>td:not(.no-click){cursor:pointer;}
    #table-creator-list .td-check{width:50px;}
    #table-creator-list .td-check>.rachel{margin:0;}

    .pagination{margin:0;}
</style>

<table class="table table-v" id="table-creator-list">
    <thead>
    <tr>
        <th class="td-check"><label class="rachel"><input type="checkbox" name="check_all" value="1"></label></th>
        <th>노출상태</th>
        <th>순번</th>
        <th>성별</th>
        <th>이름</th>
        <th>생년월일</th>
        <th>전화번호</th>
        <th>이메일</th>
        <th>주소</th>
        <th>활동채널</th>
        <th>조회수</th>
        <th>좋아요</th>
        <th>총 후원금액</th>
    </tr>
    </thead>

    <tbody>
    <?
    if(is_array($creatorList) && count($creatorList)>0){
        foreach($creatorList as $creator){
            ?>
            <tr data-idx="<?=$creator['idx']?>">
                <td class="td-check no-click"><label class="rachel"><input type="checkbox" name="idx[]" value="<?=$creator['idx']?>"></label></td>
                <td><?=($creator['is_display']==1)?'노출':'미노출'?></td>
                <td><?=$display_num--?></td>
                <td>
                    <?
                    switch($creator['gender']){
                        case 'm': echo "남"; break;
                        case 'f': echo "여"; break;
                        case 'e': echo "기타"; break;
                    }
                    ?>
                </td>
                <td><?=$creator['first_name']." ".$creator['last_name']?></td>
                <td><?=$creator['birth']?></td>
                <td><?=convert_phone($creator['phone'])?></td>
                <td><?=$creator['email']?></td>
                <td><?=$creator['addr']?></td>
                <td><?=$creator['active_channel']?></td>
                <td><?=$creator['views']?></td>
                <td><?=$creator['likes']?></td>
                <td><?=number_format($creator['sponsor_amount'])?>원</td>
            </tr>
            <?
        }
    }
    ?>
    </tbody>
</table>

<div class="row">
    <div class="col-sm-3">
        <!-- Single button -->
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                선택 노출변경 <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="javascript:set_display(1)">노출</a></li>
                <li><a href="javascript:set_display(0)">미노출</a></li>
            </ul>
        </div>
        <a href="javascript:rollback_confirm()" class="btn btn-default">선택 승인취소</a>
    </div>
    <div class="col-sm-6 text-center"><?=$pagination?></div>
    <div class="col-sm-3 text-right">
        <a href="javascript:open_xls_import()" class="btn btn-default">엑셀 업로드</a>
        <a href="<?=base_url()?>admin/creator/xls_export?<?=$_SERVER['QUERY_STRING']?>" class="btn btn-default">엑셀 다운로드</a>
    </div>
</div>

<div class="modal" id="modal-xls-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">엑셀파일 등록</div>
            <div class="modal-body">
                <form name="frm-xls-import" method="post" enctype="multipart/form-data" action="<?=base_url()?>admin/creator/xls_import">
                    <div class="input-group full">
                        <input type="file" name="upload" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:upload_xls_import()" class="btn btn-primary">업로드</a>
                <a href="<?=base_url()?>files/creator_import_sample.xlsx" class="btn btn-default" target="_blank">양식파일 다운로드</a>
                <a data-dismiss="modal" class="btn btn-default">닫기</a>
            </div>
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
            creator_view($(this).parents('tr').data('idx'));
        });
    });

    function creator_view(idx){
        location.href='<?=base_url()?>admin/creator/profile/'+idx;
    }

    function open_xls_import(){
        var modal = $('#modal-xls-import');
        modal.modal();
    }

    function upload_xls_import(){
        var form = $('form[name="frm-xls-import"]');
        form.submit();
    }

    function rollback_confirm(){
        var idxList = new Array();

        $('input[name="idx[]"]').each(function(){
            if($(this).prop('checked')){
                idxList.push($(this).val());
            }
        });

        if(idxList.length==0){
            alert('승인취소할 크리에이터가 선택되지 않았습니다.');
            return;
        }

        if(!confirm('선택하신 크리에이터를 승인취소하시겠습니까?')) return;

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/creator/ajax/rollback_confirm',
            data:{idxList:idxList},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('승인취소되었습니다');
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

    function set_display(disp){
        var idxList = new Array();

        $('input[name="idx[]"]').each(function(){
            if($(this).prop('checked')){
                idxList.push($(this).val());
            }
        });

        if(idxList.length==0){
            alert('노출상태를 변경할 크리에이터가 선택되지 않았습니다.');
            return;
        }

        if(!confirm('선택하신 크리에이터의 노출상태를 변경하시겠습니까?')) return;

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/creator/ajax/set_display',
            data:{idxList:idxList,disp:disp},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('노출상태가 변경되었습니다');
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
</script>