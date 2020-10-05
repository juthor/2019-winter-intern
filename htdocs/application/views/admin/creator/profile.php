<style>
    .table .input-group{display:inline-block;}

    #btn-save{}
    #btn-save>.loading{display:none;}
    #btn-save.uploading{cursor:not-allowed;background-color:#777;border-color:#333;color:#aaa;}
    #btn-save.uploading>.ready{display:none;}
    #btn-save.uploading>.loading{display:inline;}
</style>

<a href="<?=base_url()?>admin/creator/content/<?=$creator['idx']?>" class="btn btn-primary btn-sm" style="margin-bottom:20px;">컨텐츠 관리</a>

<div class="row">
    <div class="col-sm-6">
        <form name="frm-creator" method="post" enctype="multipart/form-data">
            <div class="panel panel-default">
                <div class="panel-heading">크리에이터 정보</div>
                <div class="panel-body">
                    <table class="table table-default">
                        <tbody>
                        <tr>
                            <th>사이트 노출</th>
                            <td>
                                <label class="rachel"><input type="radio" name="is_display" value="1" <?=($creator['is_display']==1)?' checked="true" ':''?>> 노출</label>
                                <label class="rachel"><input type="radio" name="is_display" value="0" <?=($creator['is_display']==0)?' checked="true" ':''?>> 비노출</label>
                            </td>
                        </tr>

                        <tr>
                            <th>배경 구분</th>
                            <td>
                                <label class="rachel"><input type="radio" name="bg_type" value="m" <?=($creator['bg_type']=='m')?' checked="" true':''?>"> 남</label>
                                <label class="rachel"><input type="radio" name="bg_type" value="f" <?=($creator['bg_type']=='f')?' checked="" true':''?>"> 여</label>
                                <label class="rachel"><input type="radio" name="bg_type" value="a" <?=($creator['bg_type']=='a')?' checked="" true':''?>"> 동물</label>
                            </td>
                        </tr>

                        <tr>
                            <th>이름</th>
                            <td>
                                <div class="input-group">
                                    <input type="text" name="first_name" class="form-control" placeholder="성" value="<?=$creator['first_name']?>">
                                </div>

                                <div class="input-group">
                                    <input type="text" name="last_name" class="form-control" placeholder="이름" value="<?=$creator['last_name']?>">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>해시태그</th>
                            <td>
                                <div class="input-group full">
                                    <input type="text" name="hashtag" class="form-control" placeholder="콤마(,)로 구분하여 입력하세요" value="<?=(is_array($hashtags))?implode(',',$hashtags):''?>">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>활동채널</th>
                            <td>
                                <div class="input-group full">
                                    <input type="text" name="active_channel" class="form-control" value="<?=$creator['active_channel']?>">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>활동분야</th>
                            <td>
                                <div class="input-group full">
                                    <input type="text" name="active_part" class="form-control" value="<?=$creator['active_part']?>">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>대표사진</th>
                            <td>
                                <?
                                if($creator['thumb_image']){
                                    ?><img src="<?=IMAGEPATH?>creator/<?=$creator['thumb_image']?>" style="max-width:150px;margin-bottom:15px;"><?
                                }
                                ?>
                                <div class="input-group full">
                                    <input type="file" name="thumb_image" class="form-control">
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-default" id="panel-profile">
                <div class="panel-heading">프로필 정보</div>
                <div class="panel-body">
                    <table class="table table-v">
                        <thead>
                        <tr>
                            <th class="td-title">소제목</th>
                            <th class="td-year">연도</th>
                            <th class="td-file">이미지</th>
                            <th class="td-btn">
                                <a href="javascript:add_profile_row()" class="btn-profile-row"><span class="fas fa-plus"></span></a>
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <?
                        $profile_i = 0;
                        if(is_array($profiles) && count($profiles)>0){
                            foreach($profiles as $profile){
                                ?>
                                <tr data-row="<?=$profile_i?>" data-idx="<?=$profile['idx']?>">
                                    <td class="td-title">
                                        <input type="hidden" name="profile[<?=$profile_i?>][idx]" value="<?=$profile['idx']?>">
                                        <div class="input-group full">
                                            <input type="text" name="profile[<?=$profile_i?>][title]" class="form-control" value="<?=$profile['title']?>">
                                        </div>
                                    </td>
                                    <td class="td-year">
                                        <div class="input-group full">
                                            <input type="text" name="profile[<?=$profile_i?>][year]" class="form-control" value="<?=$profile['year']?>">
                                        </div>
                                    </td>
                                    <td class="td-file">
                                        <img src="<?=IMAGEPATH?>creator/profile/<?=$profile['image']?>" style="max-width:150px;">
                                        <div class="input-group full">
                                            <input type="file" name="profile[<?=$profile_i?>][image]" class="form-control">
                                        </div>
                                    </td>
                                    <td class="td-btn">
                                        <a href="javascript:remove_profile_row('<?=$profile_i?>')" class="btn-profile-row"><span class="fas fa-minus"></span></a>
                                    </td>
                                </tr>
                                <?
                                $profile_i++;
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <input type="hidden" name="idx" value="<?=$creator['idx']?>">

            <div class="remove-profiles"></div>
        </form>

        <div class="text-center">
            <a href="javascript:save()" class="btn btn-primary btn-lg" id="btn-save">저장</a>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">지원 정보</div>
            <div class="panel-body">
                <table class="table table-default">
                    <tbody>
                    <tr>
                        <th>이름</th>
                        <td><?=$creator['name']?></td>
                    </tr>

                    <tr>
                        <th>성별</th>
                        <td>
                            <?
                            switch($creator['gender']){
                                case 'm': echo "남"; break;
                                case 'f': echo "여"; break;
                                case 'e': echo "기타"; break;
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <th>생년월일</th>
                        <td><?=$creator['birth']?></td>
                    </tr>

                    <tr>
                        <th>휴대폰번호</th>
                        <td><?=convert_phone($creator['phone'])?></td>
                    </tr>

                    <tr>
                        <th>E-mail</th>
                        <td><?=$creator['email']?></td>
                    </tr>

                    <tr>
                        <th>주소</th>
                        <td><?=$creator['addr']?></td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-v">
                    <thead>
                    <tr>
                        <th>활동 채널</th>
                        <th>활동 분야</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?
                    $platforms = json_decode($creator['apply_platform'],true);
                    if(is_array($platforms) && count($platforms)>0){
                        foreach($platforms as $platform){
                            ?>
                            <tr>
                                <td><?=$platform['name']?></td>
                                <td><?=$platform['area']?></td>
                            </tr>
                            <?
                        }
                    }else{
                        ?><tr><td colspan="2" class="text-center">등록된 데이터가 없습니다</td></tr><?
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>js/old/jquery.form.js"></script>
<script>
    var profile_row = Number('<?=$profile_i?>');
    function add_profile_row(){
        var append = '<tr data-row="'+profile_row+'"><td class="td-title"><div class="input-group full"><input type="text" name="profile['+profile_row+'][title]" class="form-control"></div></td><td class="td-year"><div class="input-group full"><input type="text" name="profile['+profile_row+'][year]" class="form-control"></div></td><td class="td-file"><div class="input-group full"><input type="file" name="profile['+profile_row+'][image]" class="form-control"></div></td><td class="td-btn"><a href="javascript:remove_profile_row('+profile_row+')" class="btn-profile-row"><span class="fas fa-minus"></span></a></td></tr>';
        $('#panel-profile .table>tbody').append(append);
        profile_row++;
    }

    function remove_profile_row(row){
        var tr = $('#panel-profile .table>tbody>tr[data-row="'+row+'"]');
        tr.remove();

        if(tr.data('idx')){
            $('.remove-profiles').append('<input type="hidden" name="remove_profile[]" value="'+tr.data('idx')+'">');
        }
    }

    function save(){
        var form = $('form[name="frm-creator"]');

        var i_first_name = form.find('input[name="first_name"]');
        var i_last_name = form.find('input[name="last_name"]');
        var i_active_channel = form.find('input[name="active_channel"]');
        var i_active_part = form.find('input[name="active_part"]');

        if(!i_first_name.val()){
            alert('이름-성을 입력하세요');
            i_first_name.focus();
            return;
        }

        if(!i_last_name.val()){
            alert('이름을 입력하세요');
            i_last_name.focus();
            return;
        }

        if($('input[name="bg_type"]:checked').length==0){
            alert('배경 구분을 선택하세요');
            return;
        }

        form.ajaxForm({
            enctype: "multipart/form-data",
            dataType:'json',
            beforeSend:function(){
                isUploading = true;
                $('#btn-save').addClass('uploading');
            },
            success:function(res){
                if(res.code==1){
                    alert('저장되었습니다');
                    location.replace('<?=base_url()?>admin/creator');
                }else{
                    alert(res.msg);
                    $('#btn-save').removeClass('uploading');
                }
            },
            error:function(e){
                alert('save error:'+e.responseText);
                $('#btn-save').removeClass('uploading');
            }
        });

        form.submit();
    }
</script>