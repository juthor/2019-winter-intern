<div class="input-group" style="margin-bottom:10px;">
    <span class="input-group-addon">제목</span>
    <input type="text" name="title" class="form-control" placeholder="팝업 제목을 입력하세요" value="<?=@$data['title']?>">
</div>
<textarea name="content" class="summernote"><?=@$data['content']?></textarea>

<div class="input-group" style="margin-bottom:10px;">
    <span class="input-group-addon">시작일시</span>
    <input type="datetime-local" name="date_start" class="form-control" value="<?=(@$data['date_start'])?date('Y-m-d',$data['date_start']).'T'.date('H:i:s',$data['date_start']):''?>">
</div>

<div class="input-group">
    <span class="input-group-addon">종료일시</span>
    <input type="datetime-local" name="date_end" class="form-control" value="<?=(@$data['date_end'])?date('Y-m-d',$data['date_end']).'T'.date('H:i:s',$data['date_end']):''?>">
</div>

<input type="hidden" name="idx" value="<?=@$data['idx']?>">