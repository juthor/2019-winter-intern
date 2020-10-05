<link rel="stylesheet" href="<?=base_url()?>css/summernote.css"/>

<form name="frm-msg">
    <table class="table table-default">
        <tbody>
        <tr>
            <th>제목</th>
            <td><?=$msg['title']?></td>
        </tr>

        <tr>
            <th>SMS 내용</th>
            <td>
                <div class="input-group input-sms">
                    <textarea name="sms_content" class="form-control"><?=$msg['sms_content']?></textarea>
                </div>
            </td>
        </tr>

        <tr>
            <th>SMS 수신</th>
            <td>
                <label class="rachel"><input type="checkbox" name="sms_user" value="1" <?=(@$msg['sms_user'])?' checked="true" ':''?>> 사용자</label>
                <label class="rachel"><input type="checkbox" name="sms_admin" value="1" <?=(@$msg['sms_admin'])?' checked="true" ':''?>> 관리자</label>
            </td>
        </tr>

        <tr>
            <th>이메일 제목</th>
            <td>
                <div class="input-group full"><input type="text" name="email_title" class="form-control" value="<?=$msg['email_title']?>"</div>
            </td>
        </tr>

        <tr>
            <th>이메일 내용</th>
            <td>
                <textarea name="email_content" class="summernote"><?=$msg['email_content']?></textarea>
            </td>
        </tr>

        <tr>
            <th>이메일 수신</th>
            <td>
                <label class="rachel"><input type="checkbox" name="email_user" value="1" <?=(@$msg['email_user'])?' checked="true" ':''?>> 사용자</label>
                <label class="rachel"><input type="checkbox" name="email_admin" value="1" <?=(@$msg['email_admin'])?' checked="true" ':''?>> 관리자</label>
            </td>
        </tr>
        <tr>
            <th>변수 안내</th>
            <td>
                <ul>
                    <li><strong>#{site_name}</strong> 사이트명</li>
                    <li><strong>#{site_url}</strong> 사이트URL</li>
                    <li><strong>#{date}</strong> 오늘날짜</li>
                    <?
                    switch($msg['msg_group']){
                        case 'order':
                            ?>
                            <li><strong>#{oid}</strong> 주문번호</li>
                            <li><strong>#{ord_date}</strong> 주문일자</li>
                            <li><strong>#{ord_name}</strong> 주문자명</li>
                            <li><strong>#{rcv_name}</strong> 수령자명</li>
                            <li><strong>#{rcv_addr}</strong> 배송주소</li>
                            <?
                            break;

                        case 'member':
                            ?>
                            <li><strong>#{member_name}</strong> 회원명</li>
                            <li><strong>#{member_email}</strong> 회원이메일</li>
                            <?
                            break;
                    }
                    ?>
                </ul>
            </td>
        </tr>
        </tbody>
    </table>

    <input type="hidden" name="idx" value="<?=$msg['idx']?>">
</form>

<div class="text-center">
    <a href="javascript:save_msg()" class="btn btn-primary">저장</a>
</div>

<script src="<?=base_url()?>js/summernote.js"></script>
<script>
    $(function(){
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
                                //$('form[name="frm-manage"]').find('.summernote').summernote('insertNode', imgNode[0]);
                                $('.summernote').summernote('insertNode', imgNode[0]);
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
    });
    function save_msg(){
        var form = $('form[name="frm-msg"]');

        $.ajax({
            type:'post',
            data:form.serialize(),
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('저장되었습니다');
                    location.replace('<?=base_url()?>admin/msg');
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
                alert('error');
            }
        })
    }
</script>