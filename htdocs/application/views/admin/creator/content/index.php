<style>
    #tab-type{margin-bottom:20px;}
</style>

<ul class="nav nav-tabs" id="tab-type">
    <li class="<?=($type=='insfa')?' active ':''?>"><a href="<?=base_url()?>admin/creator/content/<?=$creator_idx?>/insfa">인스타/페이스북</a></li>
    <li class="<?=($type=='nblog')?' active ':''?>"><a href="<?=base_url()?>admin/creator/content/<?=$creator_idx?>/nblog">네이버블로그</a></li>
    <li class="<?=($type=='youtube')?' active ':''?>"><a href="<?=base_url()?>admin/creator/content/<?=$creator_idx?>/youtube">유튜브</a></li>
</ul>

<a href="<?=base_url()?>admin/creator/content_manage/<?=$creator_idx?>/<?=$type?>" class="btn btn-primary">등록</a>

<table class="table table-v">
    <thead>
    <tr>
        <th class="td-check"><label class="rachel"><input type="checkbox" name="check_all" value="1"></label></th>
        <th class="td-num"></th>
        <th class="td-date">연도</th>
        <th class="td-title">제목</th>
        <th class="td-btn"></th>
    </tr>
    </thead>

    <tbody>
    <?
    if(is_array($contentList) && count($contentList)>0){
        foreach($contentList as $content){
            ?>
            <tr>
                <td class="td-check"><label class="rachel"><input type="checkbox" name="idx[]" value="<?=$content['idx']?>"></label></td>
                <td class="td-num">1</td>
                <td class="td-date"><?=$content['year']?></td>
                <td class="td-title"><?=$content['title']?></td>
                <td class="td-btn">
                    <a href="<?=base_url()?>admin/creator/content_manage/<?=$creator_idx?>/<?=$type?>/<?=$content['idx']?>" class="btn btn-default btn-sm">수정</a>
                    <a href="javascript:remove_content('<?=$content['idx']?>')" class="btn btn-default btn-sm">삭제</a>
                </td>
            </tr>
            <?
        }
    }
    ?>
    </tbody>
</table>

<script>
    function remove_content(idx){
        if(!confirm('삭제하시겠습니까?')) return;

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/creator/ajax/remove_content',
            data:{idx:idx},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('삭제되었습니다');
                    location.reload();
                }else{
                    alert(res.msg);
                }
            }
        });
    }
</script>