<div class="voc-wrap">
    <h3><?=$voc['title']?></h3>
    <h5><?=$voc['name']?> | <?=date('Y-m-d H:i:s',$voc['regdate'])?></h5>
    <hr>
    <div class="voc-content">
        <?=nl2br($voc['content'])?>
    </div>

    <textarea name="content_a" class="summernote"><?=@$voc['content_a']?></textarea>

    <input type="hidden" name="idx" value="<?=@$voc['idx']?>">
</div>