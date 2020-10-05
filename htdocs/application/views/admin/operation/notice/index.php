<link rel="stylesheet" href="<?=base_url()?>css/summernote.css"/>
<style>
    #table-notice-list{}
    #table-notice-list .td-num{width:60px;text-align:center;}
    #table-notice-list .td-admin{width:120px;}
    #table-notice-list .td-regdate{width:120px;}
</style>

<a href="javascript:open_notice_manage()" class="btn btn-primary">공지사항 작성</a>

<table class="table table-v" id="table-notice-list">
    <thead>
    <tr>
        <th class="td-num"></th>
        <th class="td-title">제목</th>
        <th class="td-admin">작성자</th>
        <th class="td-regdate">등록일</th>
    </tr>
    </thead>

    <tbody>
    <?foreach($noticeList as $notice):?>
    <tr>
        <td class="td-num"><?=$display_num--?></td>
        <td class="td-title"><a href="javascript:open_notice_manage('<?=$notice['idx']?>')"><?=$notice['title']?></a></td>
        <td class="td-admin"><?=$notice['admin_name']?></td>
        <td class="td-regdate"><?=date('Y.m.d',$notice['regdate'])?></td>
    </tr>
    <?endforeach?>
    </tbody>
</table>

<div class="text-center">
    <?=$pagination?>
</div>

<div class="modal" id="modal-notice-manage">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">공지사항 관리</div>
            <div class="modal-body">
                <form name="frm-notice-manage"></form>
            </div>
            <div class="modal-footer">
                <a href="javascript:save_notice()" class="btn btn-primary">저장</a>
                <a data-dismiss="modal" class="btn btn-default">닫기</a>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>js/summernote.js"></script>
<script>
    function open_notice_manage(idx){
        var modal = $('#modal-notice-manage');

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/operation/ajax/open_notice_manage',
            data:{idx:idx},
            dataType:'json',
            success:function(res){
                modal.find('.modal-body>form').html(res.html);

                $('.summernote').summernote({
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
                                        $('form[name="frm-notice-manage"]').find('.summernote').summernote('insertNode', imgNode[0]);
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

                modal.modal({
                    keyboard:false,
                    backdrop:'static'
                });
            },
            error:function(){
                alert('error');
            }
        });
    }

    function save_notice(){
        var modal = $('#modal-notice-manage');
        var form = modal.find('form[name="frm-notice-manage"]');

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/operation/ajax/save_notice',
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