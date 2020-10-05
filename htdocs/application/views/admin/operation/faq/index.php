<link rel="stylesheet" href="<?=base_url()?>css/summernote.css"/>
<style>
    #faq-list{margin-top:20px;}
    #faq-list .panel{margin:0;border-radius:0;box-shadow:none;border:0;}
    #faq-list .panel .panel-heading{background-color:transparent;border:0;border-bottom:1px solid #e1e1e1;padding:0;}
    #faq-list .panel .panel-heading a{display:block;padding:18px 15px;font-size:1.2em;}
    #faq-list .panel .panel-heading a>.fas{padding-right:15px;}
    #faq-list .panel .panel-body{background-color:#f1f1f1;}
    #faq-list .panel .panel-body p{margin-bottom:5px;}
    #faq-list .panel-body img{max-width:100%;}
</style>

<a href="javascript:open_faq_manage()" class="btn btn-primary">FAQ 등록</a>

<div class="panel-group" id="faq-list" role="tablist" aria-multiselectable="true">
    <?foreach($faqList as $faq):?>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#faq-list" href="#faq-<?=$faq['idx']?>" aria-expanded="true" aria-controls="collapseOne">
                    <?=$faq['title']?>
                </a>
            </h4>
        </div>
        <div id="faq-<?=$faq['idx']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <?=$faq['content']?>

                <hr>

                <a href="javascript:open_faq_manage('<?=$faq['idx']?>')" class="btn btn-default btn-sm">수정</a>
                <a href="javascript:remove_faq('<?=$faq['idx']?>')" class="btn btn-default btn-sm">삭제</a>
            </div>
        </div>
    </div>
    <?endforeach?>
</div>

<!-- modal > manage -->
<div class="modal" id="modal-faq-manage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">FAQ 관리</div>
            <div class="modal-body">
                <form name="frm-faq-manage"></form>
            </div>
            <div class="modal-footer">
                <a href="javascript:save_faq()" class="btn btn-primary">저장</a>
                <a data-dismiss="modal" class="btn btn-default">닫기</a>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>js/summernote.js"></script>
<script>
    function open_faq_manage(idx){
        var modal = $('#modal-faq-manage');

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/operation/ajax/open_faq_manage',
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
                                        $('form[name="frm-faq-manage"]').find('.summernote').summernote('insertNode', imgNode[0]);
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

    function save_faq(){
        var modal = $('#modal-faq-manage');
        var form = modal.find('form[name="frm-faq-manage"]');

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/operation/ajax/save_faq',
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

    function remove_faq(idx){
        if(!confirm('정말 삭제하시겠습니까?')) return;

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/operation/ajax/remove_faq',
            data:{idx:idx},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('삭제되었습니다');
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