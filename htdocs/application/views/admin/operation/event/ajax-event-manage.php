<style>
    .banner-image{width:100%;margin-bottom:10px;}
</style>

<table class="table table-default">
    <tbody>
    <tr>
        <th>이벤트명</th>
        <td>
            <div class="input-group full">
                <input type="text" name="title" class="form-control" value="<?=@$event['title']?>">
            </div>
        </td>
    </tr>

    <tr>
        <th>종료일시</th>
        <td>
            <div class="input-group full">
                <input type="datetime-local" name="expiredate" class="form-control" value="<?=(@$event['expiredate'])?date('Y-m-d',$event['expiredate'])."T".date('H:i:s',$event['expiredate']):''?>">
            </div>
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <textarea name="content" class="summernote"><?=@$event['content']?></textarea>
        </td>
    </tr>

    </tbody>
</table>

<input type="hidden" name="idx" value="<?=@$event['idx']?>">