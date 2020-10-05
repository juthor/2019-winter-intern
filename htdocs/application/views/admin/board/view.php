<style>
    h2.board-title{margin:0 0 30px 0;}
    .title{border-bottom:1px solid #e1e1e1;border-top:2px solid #ec7a8f;margin-bottom:30px;padding:30px 0;}
    .title>strong{display:block;font-size:1.4em;font-weight:700;margin-bottom:12px;}
    .title>small{margin-right:12px;}
    .article{margin-bottom:60px;}
    .article img{max-width:100%;}

    .reply-list{margin-bottom:10px;border-top:2px solid #e1e1e1;}
    .reply-list>li{background-color:#fff;border-bottom:1px solid #e1e1e1;padding:15px 10px;}
    .reply-list>li>.info{margin-bottom:10px;}
    .reply-list>li>.info>.btn-manage{font-size:0.85em;margin-left:10px;}
    .reply-list>li>.content{color:#666;}
    .reply-list>li.empty{text-align:center;}

    .reply-write{background-color:#fff;border:1px solid #e1e1e1;margin-bottom:40px;}
    .reply-write>strong{display:block;padding:0 10px;margin-top:10px;}
    .reply-write>textarea{width:100%;height:100px;border:0;padding:10px;resize:none;}
    .reply-write textarea[readonly]{cursor:pointer;}
    .reply-write>.btn-area{text-align:right;padding:0 10px;margin-bottom:10px;}

    .btn-articles{margin-bottom:60px;}

    #modal-reply-manage{}
    #modal-reply-manage .modal-body{padding:0;}
    #modal-reply-manage .modal-body>form>textarea{width:100%;height:100px;border:0;padding:10px;resize:none;}
</style>

<h2 class="board-title"><?=$board['name']?></h2>
<div class="title">
    <strong><?=$article['title']?></strong>
    <small class="name"><?=($article['admin_idx'])?'<strong style="color:#ec7a8f;">관리자</strong>':$article['name']?></small> <small class="date"><?=date('Y.m.d H:i:s',$article['regdate'])?></small>
</div>

<div class="article">
    <?=$article['content']?>
</div>

<!-- 댓글 -->
<ul class="reply-list"></ul>

<form name="frm-reply" class="reply-write">
    <strong>관리자</strong>
    <textarea name="content" <?=($this->sess_member)?' placeholder="내용을 입력하세요" ':' placeholder="로그인 후 작성가능합니다" readonly '?>></textarea>
    <div class="btn-area">
        <a href="javascript:save_reply()" class="btn btn-primary btn-sm">댓글 작성</a>
    </div>
    <input type="hidden" name="article_idx" value="<?=$article['idx']?>">
</form>

<div class="btn-articles">
    <a href="<?=base_url()?>admin/board/<?=$board['id']?>" class="btn btn-default">목록</a>
    <a href="<?=base_url()?>admin/board/<?=$board['id']?>/manage/<?=$article['idx']?>" class="btn btn-default">수정</a>
    <a href="javascript:remove_article();" class="btn btn-default">삭제</a>
</div>

<div class="modal" id="modal-reply-manage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">댓글 수정</div>
            <div class="modal-body">
                <form name="frm-reply-manage">

                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:update_reply()" class="btn btn-primary">저장</a>
                <a data-dismiss="modal" class="btn btn-default">취소</a>
            </div>
        </div>
    </div>
</div>

<script>
    var article_idx = '<?=$article['idx']?>';

    $(function(){
        load_reply();
    });

    function load_reply(){
        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/board/ajax/load_reply',
            data:{article_idx:article_idx},
            dataType:'json',
            success:function(res){
                $('.reply-list').html(res.html);
            },
            error:function(){
                alert('error');
            }
        });
    }

    function save_reply(){
        var form = $('form[name="frm-reply"]');
        var i_content = form.find('textarea[name="content"]');

        if(!i_content.val()){
            alert('내용을 입력하세요');
            i_content.focus();
            return;
        }

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/board/ajax/save_reply',
            data:form.serialize(),
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    i_content.val('');
                    load_reply();
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
                alert('error');
            }
        });
    }

    function remove_reply(idx){
        if(!confirm('댓글을 삭제하시겠습니까?')) return;

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/board/ajax/remove_reply',
            data:{idx:idx},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    load_reply();
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
                alert('error');
            }
        });
    }

    function open_reply_update(idx){
        $.ajax({
            type:'post',
            url:'<?=base_url()?>board/ajax/open_reply_update',
            data:{idx:idx},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    var modal = $('#modal-reply-manage');
                    modal.find('.modal-body>form').html(res.html);
                    modal.modal({
                        keyboard:false,
                        backdrop:'static'
                    })
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
                alert('error');
            }
        });


    }

    function update_reply(){
        var form = $('form[name="frm-reply-manage"]');
        var i_content = form.find('textarea[name="content"]');

        if(!i_content.val()){
            alert('내용을 입력하세요');
            i_content.focus();
            return;
        }

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/board/ajax/save_reply',
            data:form.serialize(),
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    var modal = $('#modal-reply-manage');

                    alert('댓글이 수정되었습니다');
                    i_content.val('');
                    load_reply();
                    modal.modal('hide');
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
                alert('error');
            }
        });
    }

    function remove_article(){
        if(!confirm('게시글을 삭제하시겠습니까?')) return;

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/board/ajax/remove_article',
            data:{idx:article_idx},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('게시글이 삭제되었습니다');
                    location.replace('<?=base_url()?>admin/board/<?=$board['id']?>');
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