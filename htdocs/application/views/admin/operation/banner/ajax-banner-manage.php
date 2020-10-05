<style>
    .banner-image{width:100%;margin-bottom:10px;}
</style>

<table class="table table-default">
    <tbody>
    <tr>
        <th>배너명</th>
        <td>
            <div class="input-group full">
                <input type="text" name="title" class="form-control" value="<?=@$banner['title']?>">
            </div>
        </td>
    </tr>

    <tr>
        <th>연결링크 (PC)</th>
        <td>
            <div class="input-group full">
                <input type="text" name="link_pc" class="form-control" value="<?=@$banner['link_pc']?>">
            </div>
        </td>
    </tr>

    <tr>
        <th>연결링크 (모바일)</th>
        <td>
            <div class="input-group full">
                <input type="text" name="link_mobile" class="form-control" value="<?=@$banner['link_mobile']?>">
            </div>
        </td>
    </tr>

    <tr>
        <th>새창 열기</th>
        <td>
            <label class="rachel"><input type="checkbox" name="link_pop" value="1" <?=(@$banner['link_pop']==1)?' checked="true" ':''?>> 새창으로 링크열기</label>
        </td>
    </tr>

    <tr>
        <th>이미지 (PC)</th>
        <td>
            <?if(@$banner){?><img src="<?=IMAGEPATH?>banner/<?=$banner['image_pc']?>" class="banner-image"><?}?>
            <div class="input-group full">
                <input type="file" name="image_pc" class="form-control">
            </div>

            <?=(@$banner)?'<small>이미지 변경시에만 업로드하세요</small>':''?>
        </td>
    </tr>

    <tr>
        <th>이미지 (모바일)</th>
        <td>
            <?if(@$banner){?><img src="<?=IMAGEPATH?>banner/<?=$banner['image_mobile']?>" class="banner-image"><?}?>
            <div class="input-group full">
                <input type="file" name="image_mobile" class="form-control">
            </div>

            <?=(@$banner)?'<small>이미지 변경시에만 업로드하세요</small>':''?>
        </td>
    </tr>
    </tbody>
</table>

<input type="hidden" name="idx" value="<?=@$banner['idx']?>">