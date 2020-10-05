<link rel="stylesheet" href="<?=base_url()?>css/summernote.css"/>
<style>

</style>

<table class="table table-v">
    <thead>
    <tr>
        <th class="td-num"></th>
        <th class="td-title">제목</th>
        <th class="td-admin">작성자</th>
        <th class="td-expiredate">만료일</th>
        <th class="td-regdate">작성일</th>
        <th class="td-btn"></th>
    </tr>
    </thead>

    <tbody>
    <?foreach($eventList as $event):?>
    <tr>
        <td class="td-num"><?=$display_num--?></td>
        <td class="td-title"><?=$event['title']?></td>
        <td class="td-admin"><?=$event['admin_name']?></td>
        <td class="td-expiredate"><?=($event['expiredate'])?date('Y-m-d H:i:s',$event['expiredate']):''?></td>
        <td class="td-regdate"><?=date('Y-m-d H:i:s',$event['regdate'])?></td>
        <td class="td-btn">
            <a href="javascript:open_event_manage('<?=$event['idx']?>')" class="btn btn-default btn-sm">수정</a>
            <a href="javascript:remove_event('<?=$event['idx']?>')" class="btn btn-default btn-sm">삭제</a>
        </td>
    </tr>
    <?endforeach?>
    </tbody>
</table>

<a href="javascript:open_event_manage()" class="btn btn-primary">이벤트 등록</a>

<div class="modal" id="modal-event-manage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">이벤트 관리</div>
            <div class="modal-body">
                <form name="frm-event-manage"></form>
            </div>
            <div class="modal-footer">
                <a href="javascript:save_event_manage()" class="btn btn-primary">이벤트 저장</a>
                <a data-dismiss="modal" class="btn btn-default">닫기</a>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>js/summernote.js"></script>
<script>
    function open_event_manage(idx) {
        var modal = $('#modal-event-manage');

        $.ajax({
            type: 'post',
            url: '<?=base_url()?>admin/operation/ajax/open_event_manage',
            data: {idx: idx},
            dataType: 'json',
            success: function (res) {
                modal.find('.modal-body>form').html(res.html);
                modal.modal();

                modal.find('.summernote').summernote({
                    height:500,
                    lang:'ko-KR',
                    toolbar:[
                        ['font',['bold','italic','underline']],
                        ['color',['color']],
                        ['fontsize',['fontsize']],
                        ['picture',['picture']],
                        ['table',['table']]
                    ],
                    callbacks: {
                        onImageUpload: function(files) {

                            // upload image to server and create imgNode...
                            var data = new FormData();
                            data.append('uploadImage',files[0]);

                            $.ajax({
                                type:'post',
                                url:'<?=base_url()?>index/editorImageUpload',
                                data:data,
                                dataType:'json',
                                mime:'multipart/form-data',
                                processData:false,
                                contentType:false,
                                success:function(result){
                                    if(result.code==1){
                                        var imgNode = $('<img>').attr('src','<?=base_url()?>img/editor/'+result.fileName);
                                        $('form[name="frm-event-manage"]').find('.summernote').summernote('insertNode', imgNode[0]);
                                    }else{
                                        alert(result.msg);
                                    }
                                },
                                error:function(){
                                    alert('error');
                                }
                            });
                        }
                    }
                });

                modal.find('.rachel').rachel();
            },
            error: function () {
                alert('error');
            }
        });
    }

    function save_event_manage(){
        var form = $('form[name="frm-event-manage"]');
        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/operation/ajax/save_event_manage',
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