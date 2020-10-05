<style>
    #table-admins{}
    #table-admins>thead>tr>th{vertical-align:middle;text-align:center;}
    #table-admins>tbody>tr>td{vertical-align:middle;}
    #table-admins .td-auth{width:100px;}
    #table-admins .td-auth .label{font-weight:normal;}
    #table-admins .td-auth .label[data-value="0"]{background-color:#666;}
    #table-admins .td-auth .label[data-value="1"]{background-color: #69a1c3;}
    #table-admins .td-auth .label[data-value="2"]{background-color: #4d6c81;}
    #table-admins .td-auth .label[data-value="3"]{background-color: #0c1318;}
</style>

<table class="table table-v" id="table-admins">
    <thead>
    <tr>
        <th rowspan="2">이름</th>
        <th rowspan="2">아이디</th>
        <th rowspan="2">등급</th>
        <th rowspan="2"></th>
    </tr>
    </thead>

    <tbody>
    <?foreach($adminList as $admin):?>
    <tr>
        <td><?=$admin['name']?></td>
        <td><?=$admin['id']?></td>
        <td><?=$admin['level_text']?></td>
        <td class="text-center">
            <a href="javascript:open_admin_manage('<?=$admin['idx']?>')" class="btn btn-default btn-sm">수정</a>
            <a href="javascript:remove_admin('<?=$admin['idx']?>')" class="btn btn-default btn-sm">삭제</a>
        </td>
    </tr>
    <?endforeach?>
    </tbody>
</table>

<a href="javascript:open_admin_manage()" class="btn btn-default btn-sm">관리자 등록</a>

<div class="modal" id="modal-admin-manage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">관리자 관리</div>
            <div class="modal-body"><form name="frm-admin-manage"></form></div>
            <div class="modal-footer">
                <a href="javascript:save_admin()" class="btn btn-primary">저장</a>
                <a data-dismiss="modal" class="btn btn-default">닫기</a>
            </div>
        </div>
    </div>
</div>

<script>
    function open_admin_manage(idx){
        var modal = $('#modal-admin-manage');

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/office/ajax/open_admin_manage',
            data:{idx:idx},
            dataType:'json',
            success:function(res){
                modal.find('.modal-body>form').html(res.html);
                modal.modal();
                $('.rachel').rachel();
            },
            error:function(){
                alert('error');
            }
        })
    }

    function save_admin(){
        var modal = $('#modal-admin-manage');
        var form = modal.find('form[name="frm-admin-manage"]');

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/office/ajax/save_admin',
            data:form.serialize(),
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('저장되었습니다');
                    location.reload();
                }else{
                    alert('저장실패');
                }
            },
            error:function(){
                alert('error');
            }
        })
    }

    function remove_admin(idx){
        if(!confirm('정말 삭제하시겠습니까?')) return;

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/office/ajax/remove_admin',
            data:{idx:idx},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('관리자가 삭제되었습니다');
                    location.reload();
                }else{
                    alert('삭제실패');
                }
            },
            error:function(){
                alert('error');
            }
        });
    }
</script>