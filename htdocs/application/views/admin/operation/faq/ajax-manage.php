<div class="input-group input-group-b full" data-name="name">
    <span class="input-group-addon">제목</span>
    <input type="text" name="title" class="form-control" value="<?=@$faq['title']?>">
</div>

<textarea name="content" class="summernote"><?=@$faq['content']?></textarea>

<input type="hidden" name="idx" value="<?=@$faq['idx']?>">