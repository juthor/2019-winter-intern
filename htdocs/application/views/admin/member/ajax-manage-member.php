<div class="input-group input-group-b full" data-name="passwd">
    <span class="input-group-addon">비밀번호</span>
    <input type="password" name="passwd" class="form-control" placeholder="변경시에만 입력">
    <div class="notice hide"></div>
</div>

<div class="input-group input-group-b full" data-name="id">
    <span class="input-group-addon">아이디</span>
    <input type="text" name="id" class="form-control" maxlength="20" value="<?=$member['id']?>">
    <div class="notice hide"></div>
</div>

<div class="input-group input-group-b full" data-name="email">
    <span class="input-group-addon">이메일</span>
    <input type="email" name="email" class="form-control" value="<?=$member['email']?>">
    <div class="notice hide"></div>
</div>



<input type="hidden" name="idx" value="<?=$member['idx']?>">