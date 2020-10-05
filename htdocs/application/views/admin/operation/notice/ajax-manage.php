<div class="input-group input-group-b full" data-name="name">
    <span class="input-group-addon">제목</span>
    <input type="text" name="title" class="form-control" value="<?=@$notice['title']?>">
</div>

<textarea name="content" class="summernote"><?=@$notice['content']?></textarea>

<input type="hidden" name="idx" value="<?=@$notice['idx']?>">