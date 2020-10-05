<table class="table table-default">
    <tbody>
    <tr>
        <th>아이디</th>
        <td>
            <div class="input-group full">
                <input type="text" name="id" class="form-control" value="<?=@$admin['id']?>">
            </div>
        </td>
    </tr>

    <tr>
        <th>비밀번호</th>
        <td>
            <div class="input-group full">
                <input type="text" name="passwd" class="form-control" value="">
            </div>
        </td>
    </tr>

    <tr>
        <th>이름</th>
        <td>
            <div class="input-group full">
                <input type="text" name="name" class="form-control" value="<?=@$admin['name']?>">
            </div>
        </td>
    </tr>

    <tr>
        <th>구분</th>
        <td>
            <label class="rachel"><input type="radio" name="level" value="9" <?=(!@$admin || @$admin['level']==9)?' checked="true" ':''?>> 일반관리자</label>
            <label class="rachel"><input type="radio" name="level" value="1" <?=(@$admin['level']==1)?' checked="true" ':''?>> 최고관리자</label>
        </td>
    </tr>
    </tbody>
</table>

<input type="hidden" name="idx" value="<?=@$admin['idx']?>">