<link rel="stylesheet" href="<?=base_url()?>css/summernote.css"/>
<style>
    h2.board-title{margin:0 0 30px 0;}

    #table-manage{border-top:2px solid #ec7a8f;}
</style>

<h2 class="board-title"><?=$board['name']?></h2>

<form name="frm-manage">
    <table class="table table-default" id="table-manage">
        <tbody>
        <tr>
            <th>제목</th>
            <td>
                <div class="input-group full">
                    <input type="text" name="title" class="form-control" placeholder="제목을 입력하세요" value="<?=@$article['title']?>">
                </div>
            </td>
        </tr>

        <tr>
            <th>내용</th>
            <td>
                <textarea name="content" class="summernote" placeholder="내용을 입력하세"><?=@$article['content']?></textarea>
            </td>
        </tr>
        </tbody>
    </table>

    <input type="hidden" name="idx" value="<?=@$article['idx']?>">
</form>

<div class="text-center">
    <a href="javascript:save_article()" class="btn btn-primary">저장</a>
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
                                $('form[name="frm-manage"]').find('.summernote').summernote('insertNode', imgNode[0]);
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

    function save_article(){
        var form = $('form[name="frm-manage"]');

        $.ajax({
            type:'post',
            data:form.serialize(),
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    location.replace('<?=base_url()?>admin/board/<?=$board['id']?>/view/'+res.idx);
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