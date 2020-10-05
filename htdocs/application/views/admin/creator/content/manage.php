<style>
    #tab-type{margin-bottom:20px;}

    #btn-save{}
    #btn-save>.loading{display:none;}
    #btn-save.uploading{cursor:not-allowed;background-color:#777;border-color:#333;color:#aaa;}
    #btn-save.uploading>.ready{display:none;}
    #btn-save.uploading>.loading{display:inline;}
</style>

<ul class="nav nav-tabs" id="tab-type">
    <li class="<?=($type=='insfa')?' active ':''?>"><a href="<?=base_url()?>admin/creator/content_manage/<?=$creator_idx?>/insfa">인스타/페이스북</a></li>
    <li class="<?=($type=='nblog')?' active ':''?>"><a href="<?=base_url()?>admin/creator/content_manage/<?=$creator_idx?>/nblog">네이버블로그</a></li>
    <li class="<?=($type=='youtube')?' active ':''?>"><a href="<?=base_url()?>admin/creator/content_manage/<?=$creator_idx?>/youtube">유튜브</a></li>
</ul>

<form name="frm-content" method="post" enctype="multipart/form-data">
    <table class="table table-default">
        <tbody>
        <tr>
            <th>대표사진</th>
            <td>
                <div class="input-group">
                    <input type="file" name="image" class="form-control">
                </div>
            </td>
        </tr>

        <tr>
            <th>제목</th>
            <td>
                <div class="input-group full">
                    <input type="text" name="title" class="form-control" value="<?=@$content['title']?>">
                </div>
            </td>
        </tr>

        <tr>
            <th>연도</th>
            <td>
                <div class="input-group">
                    <input type="text" name="year" class="form-control" value="<?=@$content['year']?>">
                </div>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="table table-v" id="table-content">
        <thead>
        <tr>
            <th class="td-title">제목</th>
            <th class="td-content">내용</th>
            <th class="td-file"><?=($type=='youtube')?'비디오ID':'이미지'?></th>
            <th class="td-btn">
                <a href="javascript:add_content_row()" class="btn-content-row"><span class="fas fa-plus"></span></a>
            </th>
        </tr>
        </thead>

        <tbody>
        <?
        $content_i = 0;
        if(is_array(@$content['list']) && count($content['list'])>0){
            foreach($content['list'] as $list_data){
                ?>
                <tr data-row="<?=$content_i?>" data-idx="<?=$list_data['idx']?>">
                    <td class="td-title">
                        <input type="hidden" name="content[<?=$content_i?>][idx]" value="<?=$list_data['idx']?>">
                        <div class="input-group full">
                            <input type="text" name="content[<?=$content_i?>][title]" class="form-control" value="<?=$list_data['title']?>">
                        </div>
                    </td>
                    <td class="td-content">
                        <div class="input-group full">
                            <input type="text" name="content[<?=$content_i?>][content]" class="form-control" value="<?=$list_data['content']?>">
                        </div>
                    </td>
                    <td class="td-file">
                        <img src="<?=IMAGEPATH?>creator/content/<?=$list_data['image']?>" style="max-width:150px;">
                        <div class="input-group full">
                            <?
                            if($type=='youtube'){
                                ?><input type="text" name="content[<?=$content_i?>][youtube_id]" class="form-control"><?
                            }else{
                                ?><input type="file" name="content[<?=$content_i?>][image]" class="form-control"><?
                            }
                            ?>
                        </div>
                    </td>
                    <td class="td-btn">
                        <a href="javascript:remove_content_row('<?=$content_i?>')" class="btn-content-row"><span class="fas fa-minus"></span></a>
                    </td>
                </tr>
                <?
                $content_i++;
            }
        }
        ?>
        </tbody>
    </table>

    <input type="hidden" name="idx" value="<?=@$content['idx']?>">
    <input type="hidden" name="creator_idx" value="<?=$creator_idx?>">
    <input type="hidden" name="type" value="<?=$type?>">

    <div class="remove-contents"></div>
</form>

<div class="text-center">
    <a href="javascript:save()" class="btn btn-primary btn-lg">저장</a>
</div>

<script src="<?=base_url()?>js/jquery.form.js"></script>
<script>
    var content_type = '<?=$type?>';
    var content_row = Number('<?=$content_i?>');
    function add_content_row(){
        var append;
        if(content_type=='youtube'){
            append = '<tr data-row="'+content_row+'"><td class="td-title"><div class="input-group full"><input type="text" name="content['+content_row+'][title]" class="form-control"></div></td><td class="td-content"><div class="input-group full"><input type="text" name="content['+content_row+'][content]" class="form-control"></div></td><td class="td-file"><div class="input-group full"><input type="text" name="content['+content_row+'][youtube_id]" class="form-control"></div></td><td class="td-btn"><a href="javascript:remove_content_row('+content_row+')" class="btn-content-row"><span class="fas fa-minus"></span></a></td></tr>';
        }else{
            append = '<tr data-row="'+content_row+'"><td class="td-title"><div class="input-group full"><input type="text" name="content['+content_row+'][title]" class="form-control"></div></td><td class="td-content"><div class="input-group full"><input type="text" name="content['+content_row+'][content]" class="form-control"></div></td><td class="td-file"><div class="input-group full"><input type="file" name="content['+content_row+'][image]" class="form-control"></div></td><td class="td-btn"><a href="javascript:remove_content_row('+content_row+')" class="btn-content-row"><span class="fas fa-minus"></span></a></td></tr>';
        }
        $('#table-content>tbody').append(append);
        content_row++;
    }

    function remove_content_row(row){
        var tr = $('#table-content>tbody>tr[data-row="'+row+'"]');
        tr.remove();

        if(tr.data('idx')){
            $('.remove-contents').append('<input type="hidden" name="remove_content[]" value="'+tr.data('idx')+'">');
        }
    }

    function save(){
        var form = $('form[name="frm-content"]');

        var i_title = form.find('input[name="title"]');
        var i_year = form.find('input[name="year"]');

        if(!i_title.val()){
            alert('제목을 입력하세요');
            i_title.focus();
            return;
        }

        if(!i_year.val()){
            alert('연도를 입력하세요');
            i_year.focus();
            return;
        }

        form.ajaxForm({
            enctype: "multipart/form-data",
            dataType:'json',
            beforeSend:function(){
                isUploading = true;
                $('#btn-save').addClass('uploading');
            },
            success:function(res){
                if(res.code==1){
                    alert('저장되었습니다');
                    location.replace('<?=base_url()?>admin/creator/content/<?=$creator_idx?>/'+content_type);
                    $('#btn-save').removeClass('uploading');
                }else{
                    alert(res.msg);
                    $('#btn-save').removeClass('uploading');
                }
            },
            error:function(e){
                alert('save error:'+e.responseText);
                $('#btn-save').removeClass('uploading');
            }
        });

        form.submit();
    }
</script>

