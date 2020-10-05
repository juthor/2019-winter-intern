<style>
    #table-member-list{margin-top:20px;}
    #table-member-list tbody>tr{cursor:pointer;}
    #table-member-list .td-name>small{display:block;margin-top:4px;color:#6c6c6c;font-weight:700;}
    #table-member-list .btn-best-player{color:#ccc;}
    #table-member-list .btn-best-player.active{color:#058f45;}
</style>

<h2 class="page-title">회원목록</h2>

<a href="javascript:open_search()" class="btn <?=(@$searchs)?' btn-info ':' btn-default '?>"><span class="fas fa-search"></span> 검색</a>
<?if(@$searchs){?><a href="<?=base_url()?>admin/member" class="btn btn-default">전체보기</a><?}?>

<table class="table table-v" id="table-member-list">
    <thead>
    <tr>
        <th class="td-idx"></th>
        <th class="td-type">구분</th>
        <th class="td-ticket">이용상품</th>
        <th class="td-name">이름</th>
        <th class="td-id">아이디</th>
        <th class="td-email">이메일</th>
        <th class="td-phone">휴대폰번호</th>
        <th class="td-regdate">가입일</th>
        <th class="td-lastvisit">마지막 방문</th>
        <th></th>
        <th class="">포인트</th>
        <?
        switch($type){
            case 1:
                ?>
                <th>베스트<br>플레이어</th>
                <?
                break;
        }
        ?>
    </tr>
    </thead>

    <tbody>
    <?
    if(is_array($memberList) && count($memberList)>0){
        foreach($memberList as $member){
            ?>
            <tr data-idx="<?=$member['idx']?>">
                <td class="td-idx"><?=$display_num--?></td>
                <td class="td-type"><?=($member['member_type']==2)?'구단':'선수'?></td>
                <td class="td-ticket">
                    <?if($member['isFreepass']){?><span class="label label-info">자유이용권</span><?}?>
                    <?if($member['isPlayer']){?><span class="label label-success">선수등록</span><?}?>
                </td>
                <td class="td-name"><?=$member['name'].(($member['member_type']==2)?'<small>'.$member['b_corp_name'].'</small>':'')?></td>
                <td class="td-id">
                    <?=$member['id']?>
                    <?if($member['s_kakao']){?><img src="<?=IMAGEPATH?>assets/icon_social_kakao_sm.jpg" style="width:20px;"><?}?>
                    <?if($member['s_naver']){?><img src="<?=IMAGEPATH?>assets/icon_social_naver_sm.jpg" style="width:20px;"><?}?>
                </td>
                <td class="td-email"><?=$member['email']?></td>
                <td class="td-phone"><?=convert_phone($member['phone'])?></td>
                <td class="td-regdate"><?=date('Y-m-d',$member['regdate'])?></td>
                <td class="td-lastvisit"><?=($member['last_visit'])?date('Y-m-d H:i:s',$member['last_visit']):''?></td>
                <td class="no-click">
                    <a href="<?=base_url()?>admin/member/manage/<?=$member['idx']?>" class="btn btn-default btn-sm">수정</a>
                    <a href="javascript:member_exit('<?=$member['idx']?>')" class="btn btn-default btn-sm">삭제</a>
                </td>
                <td class=""><?=number_format($member['charge_point'])?></td>
                <?
                switch($type){
                    case 1:
                        ?>
                        <td class="no-click"><a href="javascript:set_best_player('<?=$member['idx']?>')" class="btn-best-player <?=($member['is_best_player'])?' active ':''?>" data-idx="<?=$member['idx']?>"><span class="fas fa-user"></span></a></td>
                        <?
                        break;
                }
                ?>
            </tr>
            <?
        }

    }else{
        ?>
        <tr class="no-click">
            <td class="text-center" colspan="11">등록된 회원이 없습니다</td>
        </tr>
        <?
    }
    ?>
    </tbody>
</table>

<div class="text-center">
    <?=$pagination?>
</div>

<div class="modal" id="modal-search">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">회원 검색</div>
            <div class="modal-body">
                <form name="frm-search" action="<?=base_url()?>admin/member/index/<?=$type?>/1">
                    <table class="table table-default">
                        <tbody>
                        <tr>
                            <th>검색조건</th>
                            <td>
                                <label class="rachel"><input type="checkbox" name="searchs[is_freepass]" value="1" <?=(@$searchs['is_freepass'])?' checked="true" ':''?>> 자유이용권</label>
                                <?
                                switch($type){
                                    case 1:
                                        ?>
                                        <label class="rachel"><input type="checkbox" name="searchs[is_player]" value="1" <?=(@$searchs['is_player'])?' checked="true" ':''?>> 선수등록</label>
                                        <label class="rachel"><input type="checkbox" name="searchs[is_best_player]" value="1" <?=(@$searchs['is_best_player'])?' checked="true" ':''?>> 베스트 플레이어</label>
                                        <?
                                        break;
                                }
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <th>이름/닉네임</th>
                            <td>
                                <div class="input-group full">
                                    <input type="text" name="searchs[search_name]" class="form-control" value="<?=@$searchs['search_name']?>">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>연락처</th>
                            <td>
                                <div class="input-group full">
                                    <input type="text" name="searchs[search_phone]" class="form-control" value="<?=@$searchs['search_phone']?>">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>이메일</th>
                            <td>
                                <div class="input-group full">
                                    <input type="text" name="searchs[search_email]" class="form-control" value="<?=@$searchs['search_email']?>">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>아이디</th>
                            <td>
                                <div class="input-group full">
                                    <input type="text" name="searchs[id]" class="form-control" value="<?=@$searchs['id']?>">
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:do_search()" class="btn btn-primary">검색</a>
                <a data-dismiss="modal" class="btn btn-default">닫기</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#table-member-list>tbody>tr>td:not(.no-click)').click(function(){
            location.href='<?=base_url()?>admin/member/view/'+$(this).parents('tr').data('idx');
        });
    });

    function open_search(){
        var modal = $('#modal-search');
        modal.modal();
    }

    function do_search(){
        var form = $('form[name="frm-search"]');
        form.submit();
    }

    function member_exit(idx){
        if(!confirm('정말 탈퇴처리하시겠습니까?')) return;

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/member/ajax/member_exit',
            data:{idx:idx},
            dataType:'json',
            success:function(res){
                console.log(res);
                if(res.code==1){
                    alert('탈퇴처리되었습니다.');
                    location.reload();
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
                alert('error');
            }
        });
    }

    function set_best_player(idx){
        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/member/ajax/set_best_player',
            data:{player_idx:idx},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    if(res.toggle=='on'){
                        $('.btn-best-player[data-idx="'+idx+'"]').addClass('active');
                    }else{
                        $('.btn-best-player[data-idx="'+idx+'"]').removeClass('active');
                    }
                }else{
                    alert(res.msg);
                }
            }
        });
    }
</script>