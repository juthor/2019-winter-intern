<link rel="stylesheet" href="<?=base_url()?>css/summernote.css"/>
<style>
    #table-popup .td-status{width:70px;}
    #table-popup .td-status>.label{font-weight:400;}
    #table-popup .td-date{width:160px;}
</style>

<table class="table" id="table-popup">
    <thead>
    <tr>
        <th class="td-status">상태</th>
        <th class="td-title"></th>
        <th class="td-date">시작일</th>
        <th class="td-date">종료일</th>
    </tr>
    </thead>

    <tbody>
    <?foreach($popupList as $pop):?>
    <tr>
        <td class="td-status"><?=($pop['date_start']<=time() && $pop['date_end']>=time())?'<span class="label label-primary">노출</span>':'<span class="label label-default">숨김</span>'?></td>
        <td class="td-title"><a href="javascript:open_manage('<?=$pop['idx']?>')"><?=$pop['title']?></a></td>
        <td class="td-date"><?=date('Y-m-d H:i:s',$pop['date_start'])?></td>
        <td class="td-date"><?=date('Y-m-d H:i:s',$pop['date_end'])?></td>
    </tr>
    <?endforeach?>
    </tbody>
</table>

<div class="row">
    <div class="col-md-3">

    </div>

    <div class="col-md-6 text-center">

    </div>

    <div class="col-md-3 text-right">
        <a href="javascript:open_manage()" class="btn btn-primary">팝업 등록</a>
    </div>
</div>

<div class="modal fade" id="modal-manage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">팝업 관리</div>
            <div class="panel-body">
                <form name="frm-popup-manage">

                </form>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="javascript:save_popup()" class="btn btn-primary">저장</a>
                        <a data-dismiss="modal" class="btn btn-default">닫기</a>
                    </div>

                    <div class="col-sm-6 text-right">
                        <a href="javascript:remove_popup()" class="btn btn-default">삭제</a>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>js/summernote.js"></script>
<script>
    function open_manage(idx){
        var modal = $('#modal-manage');

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/operation/json/get_popup',
            data:{idx:idx},
            dataType:'json',
            success:function(res){
                modal.find('form').html(res.html);
                modal.modal();
                // summernote
                $('.summernote').summernote({
                    height:400,
                    lang:'ko-KR',
                    toolbar:[
                        ['font',['bold','italic','underline','clear']],
                        ['fontSize',['fontsize']],
                        ['color',['color']],
                        ['para',['ul','ol','paragraph']],
                        ['height',['height']],
                        ['picture',['picture']],
                        ['table',['table']],
                        ['link',['link']],
                        ['misc',['codeview']]
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
                                        var imgNode = $('<img>').attr({src:'<?=IMAGEPATH?>editor/'+result.fileName,maxWidth:'100%'});
                                        $('form[name="frm-popup-manage"]').find('.summernote').summernote('insertNode', imgNode[0]);
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
            },
            error:function(){
                alert('error');
            }
        });
    }

    function save_popup(){
        var form = $('form[name="frm-popup-manage"]');

        var i_title = form.find('input[name="title"]');
        var i_content = form.find('textarea[name="content"]');
        var i_date_start = form.find('input[name="date_start"]');
        var i_date_end = form.find('input[name="date_end"]');

        if(!i_title.val()){
            alert('제목을 입력하세요');
            i_title.focus();
            return;
        }

        if(!i_content.val()){
            alert('내용을 입력하세요');
            i_content.focus();
            return;
        }

        if(!i_date_start.val()){
            alert('시작일시를 입력하세요');
            i_date_start.focus();
            return;
        }

        if(!i_date_end.val()){
            alert('종료일시를 입력하세요');
            i_date_end.focus();
            return;
        }

        if(i_date_start.val()>i_date_end.val()){
            alert('시작일시가 종료일시보다 늦습니다');
            i_date_start.focus();
            return;
        }

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/operation/ajax/save_popup',
            data:form.serialize(),
            dataType:'json',
            success:function(res){
                console.log(res);
                if(res.code==1){
                    alert('등록되었습니다');
                    location.reload();
                }else{
                    alert('error');
                }
            },
            error:function(){
                alert('error');
            }
        });
    }

    function remove_popup(){
        if(!confirm('삭제하시겠습니까?')) return;

        var form = $('form[name="frm-popup-manage"]');

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/operation/ajax/remove_popup',
            data:form.serialize(),
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('삭제되었습니다');
                    location.reload();
                }else{
                    alert('error');
                }
            },
            error:function(){
                alert('error');
            }
        });
    }
</script>