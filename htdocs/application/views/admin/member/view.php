<link rel="stylesheet" href="<?=base_url()?>css/croppie.css"/>
<link href="https://vjs.zencdn.net/7.3.0/video-js.css" rel="stylesheet">
<style>
    #member-view .left{}
    #member-view .left .image{width:100%;margin-bottom:20px;padding-bottom:100%;border-radius:50%;background-position:center;background-size:cover;}
    #member-view .left h3{text-align:center;margin:0 0 20px 0;}
    #member-view .left #label-status{margin-bottom:20px;display:inline-block;padding:6px 9px;font-size:1em;}
    #member-view .left #label-status[data-status="0"]{background-color:#eee;color:#333;}

    #member-view .panel{margin-bottom:30px;}
    #member-view .panel .panel-heading{background-color:#555;color:#fff;border-color:#555;}
    #member-view .panel .panel-body .table{margin:0;}
</style>

<div class="row" id="member-view">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">회원정보</div>
            <div class="panel-body">
                <table class="table table-default">
                    <tbody>
                    <tr>
                        <th>회원고유번호</th>
                        <td><?=$member['idx']?></td>
                    </tr>

                    <tr>
                        <th>회원구분</th>
                        <td>
                            <?
                            switch($member['member_type']){
                                case 1: echo "선수"; break;
                                case 2: echo "기업"; break;
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <th>이름</th>
                        <td><?=$member['name']?></td>
                    </tr>

                    <?if($member['member_type']==2){?>
                        <tr>
                            <th>기업명</th>
                            <td><?=$member['b_corp_name']?></td>
                        </tr>
                    <?}?>

                    <tr>
                        <th>휴대폰</th>
                        <td><?=$member['phone']?></td>
                    </tr>

                    <tr>
                        <th>이메일</th>
                        <td><?=$member['email']?></td>
                    </tr>

                    <tr>
                        <th>아이디</th>
                        <td>
                            <?=$member['id']?>
                            <?if($member['s_kakao']){?><img src="<?=IMAGEPATH?>assets/icon_social_kakao_sm.jpg" style="width:20px;"><?}?>
                            <?if($member['s_naver']){?><img src="<?=IMAGEPATH?>assets/icon_social_naver_sm.jpg" style="width:20px;"><?}?>
                        </td>
                    </tr>

                    <tr>
                        <th>가입일</th>
                        <td><?=date('Y.m.d',$member['regdate'])?></td>
                    </tr>

                    <tr>
                        <th>최종접속일시</th>
                        <td><?=date('Y.m.d H:i:s',$member['last_visit'])?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <a href="javascript:open_manage_member()" class="btn btn-default btn-sm">회원정보 변경</a>
            </div>
        </div>

        <!-- 선수 프로필 -->
        <?if($member['member_type']==1){?>
        <div class="panel panel-default">
            <div class="panel-heading">프로필</div>
            <div class="panel-body">
                <table class="table table-default">
                    <tbody>
                    <tr>
                        <th>내 사진</th>
                        <td>
                            <img src="<?=IMAGEPATH?>member/<?=$member['thumb_image']?>" style="max-width:100%;">
                        </td>
                    </tr>

                    <tr>
                        <th>국가</th>
                        <td>
                            <?=$this->data_country[substr($member['m_country'],0,1)]['list'][$member['m_country']]?>
                        </td>
                    </tr>

                    <tr>
                        <th>병역여부</th>
                        <td>
                            <?=$this->data_military[$member['m_mil']]?>
                        </td>
                    </tr>

                    <tr>
                        <th>키</th>
                        <td>
                            <?=$member['m_body_height']?>cm
                        </td>
                    </tr>

                    <tr>
                        <th>몸무게</th>
                        <td>
                            <?=$member['m_body_weight']?>kg
                        </td>
                    </tr>

                    <tr data-id="affiliation">
                        <th>현재소속구단</th>
                        <td>
                            <?=($member['m_affiliation'])?$member['m_affiliation']:'미소속'?>
                        </td>
                    </tr>

                    <tr>
                        <th>선수경력</th>
                        <td>
                            <style>
                                #career-list{margin:0;}
                                #career-list>li>small{display:block;margin-bottom:7px;}
                            </style>

                            <?
                            if(is_array($member['careers']) && count($member['careers'])>0){
                                ?>
                                <ul class="list-group" id="career-list">
                                    <?foreach($member['careers'] as $cr):?>
                                    <li class="list-group-item">
                                        <small><?=date('Y-m-d',$cr['cdate'])?></small>
                                        <?=$cr['content']?>
                                    </li>
                                    <?endforeach?>
                                </ul>
                                <?
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <th>수상내역</th>
                        <td>
                            <style>
                                #award-list{margin:0;}
                                #award-list>li>small{display:block;margin-bottom:7px;}
                            </style>

                            <?
                            if(is_array($member['awards']) && count($member['awards'])>0){
                                ?>
                                <ul class="list-group" id="award-list">
                                    <?foreach($member['awards'] as $aw):?>
                                        <li class="list-group-item">
                                            <small><?=date('Y-m-d',$aw['cdate'])?></small>
                                            <?=$aw['content']?>
                                        </li>
                                    <?endforeach?>
                                </ul>
                                <?
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <th>주발</th>
                        <td>
                            <?=$this->data_main_foot[$member['m_mainfoot']]?> (<?=$this->data_main_foot_balance[$member['m_mainfoot_balance']]?>)
                        </td>
                    </tr>

                    <tr>
                        <th>학력</th>
                        <td>
                            <?=$member['m_edu']?>
                        </td>
                    </tr>

                    <tr>
                        <th>선호포지션</th>
                        <td>
                            <div class="box-field">
                                <div class="box p11">
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="11" <?=(in_array('11',$member['positions']))?' checked="true" ':''?> disabled>LW</label>
                                </div>

                                <div class="box p12">
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="12" <?=(in_array('12',$member['positions']))?' checked="true" ':''?> disabled>ST</label><br>
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="13" <?=(in_array('13',$member['positions']))?' checked="true" ':''?> disabled>CF</label><br>
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="14" <?=(in_array('14',$member['positions']))?' checked="true" ':''?> disabled>SS</label>
                                </div>

                                <div class="box p13">
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="15" <?=(in_array('15',$member['positions']))?' checked="true" ':''?> disabled>RW</label>
                                </div>

                                <div class="box p21">
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="21" <?=(in_array('21',$member['positions']))?' checked="true" ':''?> disabled>LM</label>
                                </div>

                                <div class="box p22">
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="22" <?=(in_array('22',$member['positions']))?' checked="true" ':''?> disabled>CAM</label><br><br>
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="23" <?=(in_array('23',$member['positions']))?' checked="true" ':''?> disabled>CM</label><br><br>
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="24" <?=(in_array('24',$member['positions']))?' checked="true" ':''?> disabled>CDM</label>
                                </div>

                                <div class="box p23">
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="25" <?=(in_array('25',$member['positions']))?' checked="true" ':''?> disabled>RM</label>
                                </div>

                                <div class="box p31">
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="31" <?=(in_array('31',$member['positions']))?' checked="true" ':''?> disabled>LWB</label><br>
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="32" <?=(in_array('32',$member['positions']))?' checked="true" ':''?> disabled>LB</label>
                                </div>

                                <div class="box p32">
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="33" <?=(in_array('33',$member['positions']))?' checked="true" ':''?> disabled>CB</label><br>
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="34" <?=(in_array('34',$member['positions']))?' checked="true" ':''?> disabled>SW</label><br><br>
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="41" <?=(in_array('41',$member['positions']))?' checked="true" ':''?> disabled>GK</label>
                                </div>

                                <div class="box p33">
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="35" <?=(in_array('35',$member['positions']))?' checked="true" ':''?> disabled>RWB</label><br>
                                    <label class="rachel"><input type="checkbox" name="m_position[]" value="36" <?=(in_array('36',$member['positions']))?' checked="true" ':''?> disabled>RB</label>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th>특기</th>
                        <td>
                            <div class="row">
                                <?foreach($this->member_speciality as $code=>$name):?>
                                    <div class="col-xs-6 col-sm-4">
                                        <label class="rachel" style="margin:0;"><input type="checkbox" name="m_speciality[]" value="<?=$code?>" <?=(in_array($code,$member['specs']))?' checked="true" ':''?> disabled> <?=$name?></label>
                                    </div>
                                <?endforeach?>
                            </div>

                            <?=(@$member['specs_etc'])?'기타 : '.$member['specs_etc']:''?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?}?>

        <!-- 기업 정보 -->
        <?if($member['member_type']==2){?>
        <div class="panel panel-default">
            <div class="panel-heading">구단정보</div>
            <div class="panel-body">
                <table class="table table-default">
                    <tbody>
                    <tr>
                        <th>기업명</th>
                        <td><?=$member['b_corp_name']?></td>
                    </tr>
                    <tr>
                        <th>사업자등록번호</th>
                        <td><?=$member['b_corp_num']?></td>
                    </tr>
                    <tr>
                        <th>전화번호</th>
                        <td><?=$member['tel']?></td>
                    </tr>
                    <tr>
                        <th>팩스</th>
                        <td><?=$member['fax']?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?}?>
    </div>

    <div class="col-sm-6">
        <?if($member['member_type']==1 && $member['m_video']){?>
        <div class="panel panel-default">
            <div class="panel-heading">선수 영상</div>
            <div class="panel-body">
                <style>
                    .video-js {
                        position: relative !important;
                        width: 100% !important;
                        height: auto !important;
                    }

                    .input-group-youtube .btn,
                    .input-group-youtube .btn:hover,
                    .input-group-youtube .btn:active,
                    .input-group-youtube .btn:focus{background-color:#058f45!important;}
                </style>
                <video id="my-video" class="video-js" controls preload="auto" poster="MY_VIDEO_POSTER.jpg">
                    <source src="<?=base_url()?>upload/member_video/<?=$member['m_video']?>" type='video/mp4'>
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
                </video>

                <form name="frm-youtube-code">
                    <div class="input-group input-group-youtube" style="margin-top:20px;">
                        <input type="text" name="youtube_code" class="form-control" value="<?=$member['m_video_youtube']?>">
                        <span class="input-group-btn"><a href="javascript:save_youtube_code()" class="btn btn-primary">유튜브 코드저장</a></span>
                    </div>
                    <input type="hidden" name="member_idx" value="<?=$member['idx']?>">
                </form>

                <script>
                    function save_youtube_code(){
                        var form = $('form[name="frm-youtube-code"]');

                        $.ajax({
                            type:'post',
                            url:'<?=base_url()?>admin/member/ajax/save_youtube_code',
                            data:form.serialize(),
                            dataType:'json',
                            success:function(res){
                                if(res.code==1){
                                    alert('정상적으로 저장되었습니다.');
                                }else{
                                    alert(res.msg);
                                }
                            },
                            error:function(){
                                alert('error');
                            }
                        });
                    }
                </script>
            </div>
        </div>
        <?}?>

        <div class="panel panel-default">
            <div class="panel-heading">이용중인 상품</div>
            <div class="panel-body">
                <table class="table table-v">
                    <thead>
                    <tr>
                        <th>상품</th>
                        <th>이용기간</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>자유이용권</td>
                        <td>
                            <?
                            if($member['isFreepass']){
                                echo date('Y-m-d H:i:s',$item['freepass']['date_start'])."~".date('Y-m-d H:i:s',$item['freepass']['date_end']);
                            }else{
                                echo "없음";
                            }
                            ?>
                        </td>
                    </tr>
                    <?if($member['member_type']==1){?>
                    <tr>
                        <td>선수등록</td>
                        <td>
                            <?
                            if($member['isPlayer']){
                                echo date('Y-m-d H:i:s',$item['player']['date_start'])." ~ ".date('Y-m-d H:i:s',$item['player']['date_end']);
                            }else{
                                echo "없음";
                            }
                            ?>
                        </td>
                    </tr>
                    <?}?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">최근 결제내역</div>
            <div class="panel-body">
                <table class="table table-v">
                    <thead>
                    <tr>
                       <th>결제수단</th>
                        <th>결제금액</th>
                        <th>결제일</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?
                    if(is_array($paymentList) && count($paymentList)>0){
                        foreach($paymentList as $payment){
                            ?>
                            <tr>
                                <td><?=$this->pay_method[$payment['pay_method']]?></td>
                                <td><?=number_format($payment['pay_amt'])?>원</td>
                                <td><?=date('Y.m.d',$payment['paydate'])?></td>
                            </tr>
                            <?
                        }
                    }else{
                        ?>
                        <tr>
                            <td colspan="3" class="text-center">최근 결제내역이 없습니다</td>
                        </tr>
                        <?
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <a href="<?=base_url()?>admin/payment/index/1?searchs%5Bsearch_id%5D=<?=$member['id']?>" class="btn btn-default btn-sm">더보기</a>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">최근 포인트내역</div>
            <div class="panel-body">
                <p class="text-center">보유포인트 <strong style="color:#058f45"><?=number_format($member['charge_point'])?>포인트</strong></p>

                <table class="table table-v">
                    <thead>
                    <tr>
                        <th>포인트</th>
                        <th>비고</th>
                        <th>일시</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?
                    if(is_array($pointList) && count($pointList)>0){
                        foreach($pointList as $point){
                            ?>
                            <tr>
                                <td><?=number_format($point['point'])?></td>
                                <td><?=$point['remarks']?></td>
                                <td><?=date('Y-m-d H:i:s',$point['regdate'])?></td>
                            </tr>
                            <?
                        }
                    }else{
                        ?><tr><td colspan="3" class="text-center">포인트내역이 없습니다.</td></tr><?
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <a href="javascript:open_set_point()" class="btn btn-primary btn-sm">포인트 조정</a>
                <a href="<?=base_url()?>admin/payment/point/1?searchs%5Bsearch_id%5D=<?=$member['id']?>" class="btn btn-default btn-sm">더보기</a>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-member-manage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">회원정보 수정</div>
            <div class="modal-body">
                <form name="frm-member-manage" method="post" action="<?=base_url()?>admin/member/ajax/save_member_manage"></form>
            </div>
            <div class="modal-footer">
                <a href="javascript:save_member_manage()" class="btn btn-primary">정보저장</a>
                <a data-dismiss="modal" class="btn btn-default">닫기</a>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-member-set-point">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">포인트 변경</div>
            <div class="modal-body">
                <form name="frm-set-point">
                    <div class="input-group full" style="margin-bottom:10px;">
                        <input type="number" name="point" class="form-control">
                        <span class="input-group-addon">포인트</span>
                    </div>

                    <div class="input-group full">
                        <input type="text" name="remarks" class="form-control" placeholder="비고 (선택입력)">
                    </div>

                    <input type="hidden" name="member_idx" value="<?=$member['idx']?>">
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:save_set_point()" class="btn btn-primary">포인트 적용</a>
                <a data-dismiss="modal" class="btn btn-default">닫기</a>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>js/croppie.js"></script>
<script src="<?=base_url()?>js/jquery.form.js"></script>
<script src="https://vjs.zencdn.net/7.3.0/video.js"></script>
<script>
    var memberIdx = '<?=$member['idx']?>';

    function save_memo(){
        var form = $('form[name="frm-memo"]');

        var i_memo = form.find('textarea[name="memo"]');
        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/member/ajax/save_memo',
            data:{idx:memberIdx,memo:i_memo.val()},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('저장되었습니다');
                }else{
                    alert(res.msg);
                }
            }
        });
    }

    function open_manage_member(){
        var modal = $('#modal-member-manage');

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/member/ajax/open_member_manage',
            data:{idx:memberIdx},
            dataType:'json',
            success:function(res){
                modal.find('.modal-body>form').html(res.html);
                modal.modal({
                    keyboard:false,
                    backdrop:'static'
                });



                $('.selectpicker').selectpicker();

                var exe_email_check;
                var exe_nickname_check;
                var exe_id_check;

                $('input[name="id"]').keyup(function(){
                    clearTimeout(exe_id_check);
                    exe_id_check = setTimeout(function(){
                        check_id();
                    },0);
                });

                $('input[name="email"]').keyup(function(){
                    clearTimeout(exe_email_check);
                    exe_email_check = setTimeout(function(){
                        check_email();
                    },0);
                });

                $('input[name="nickname"]').keyup(function(){
                    clearTimeout(exe_nickname_check);
                    exe_nickname_check = setTimeout(function(){
                        check_nickname();
                    },200);
                });

                $('input[name="passwd"]').keyup(function(){
                    check_passwd();
                });

                setTimeout(function(){
                    modal.find('input[name="passwd"]').val('');
                },500);
            },
            error:function(){
                alert('error');
            }
        });
    }

    function save_member_manage(){
        var form = $('form[name="frm-member-manage"]');
        var i_id = form.find('input[name="id"]');
        var i_email = form.find('input[name="email"]');
        var i_passwd = form.find('input[name="passwd"]');

        if(!check_id(true)){
            alert('아이디를 올바르게 입력하세요');
            i_id.focus();
            return;
        }

        if(i_passwd.val() && !check_passwd()){
            alert('비밀번호를 올바르게 입력하세요');
            i_passwd.focus();
            return;
        }

        if(!check_email()){
            alert('이메일을 올바르게 입력하세요');
            i_email.focus();
            return;
        }

        form.ajaxForm({
            enctype: "multipart/form-data",
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('저장되었습니다');
                    location.reload();
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
                alert('error');
            }
        });

        form.submit();
    }

    function set_member_status(status){
        $.ajax({
            type: 'post',
            url: '<?=base_url()?>admin/member/ajax/set_member_status',
            data: {status:status,idx:memberIdx},
            dataType: 'json',
            success: function (res) {
                if (res.code == 1) {
                    alert('설정되었습니다');
                    location.reload();
                } else {
                    alert(res.msg);
                }
            },
            error: function () {

            }
        });
    }

    function check_email(){
        var igroup = $('.input-group[data-name="email"]');
        var notice = igroup.find('.notice');
        var i_email = igroup.find('input[name="email"]');

        if(!i_email.val()){
            $('.check-email').attr('data-value','0');
            notice.addClass('hide');
            return false;
        }

        if(!valid_email(i_email.val())){
            $('.check-email').attr('data-value','1');
            notice.removeClass('hide');
            notice.text('올바른 이메일주소를 입력하세요');
            return false;
        }else{
            $('.check-email').attr('data-value','2');
            notice.addClass('hide');
            return true;
        }
    }

    function valid_email(email){
        var email_check = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return email_check.test(email);
    }

    function check_id(noAjax){
        var igroup = $('.input-group[data-name="id"]');
        var notice = igroup.find('.notice');
        var i_id = igroup.find('input[name="id"]');

        if(!i_id.val()){
            $('.check-id').attr('data-value','0');
            notice.addClass('hide');
            return false;
        }

        if(i_id.val().length<6 || i_id.val().length>20){
            $('.check-id').attr('data-value','1');
            notice.removeClass('hide');
            notice.text('아이디를 6자이상, 20자이하로 입력하세요');
            return false;
        }

        if(noAjax){
            return true;
        }else{
            $.ajax({
                type:'post',
                url:'<?=base_url()?>admin/member/ajax/check_id',
                data:{id:i_id.val(),idx:memberIdx},
                dataType:'json',
                success:function(res){
                    if(res.code==1){
                        $('.check-id').attr('data-value','2');
                        notice.addClass('hide');
                        return true;
                    }else{
                        $('.check-id').attr('data-value','1');
                        notice.removeClass('hide');
                        notice.text('이미 사용중인 아이디입니다');
                        return false;
                    }
                },
                error:function(){
                    console.log('error');
                    return false;
                }
            });
        }
    }

    function check_passwd(){
        var igroup = $('.input-group[data-name="passwd"]');
        var notice = igroup.find('.notice');
        var i_passwd = igroup.find('input[name="passwd"]');

        if(!i_passwd.val()){
            $('.check-passwd').attr('data-value','0');
            notice.addClass('hide');
            return false;
        }

        if(i_passwd.val().length<6){
            $('.check-passwd').attr('data-value','1');
            notice.removeClass('hide');
            notice.text('비밀번호를 6자이상 입력하세요');
            return false;
        }else{
            $('.check-passwd').attr('data-value','2');
            notice.addClass('hide');
            return true;
        }
    }

    var crp;
    function preview_image(input){
        var imageBox = $('#profile-image');
        var fileName = $('input[name="profile"]').val();

        imageBox.find('.croppie-container').remove();

        if(fileName){
            var fileExt;
            fileExt = fileName.substr(-3,3);
            fileExt = fileExt.toLowerCase();
            if(fileExt=='jpg' || fileExt=='png' || fileExt=='gif' || fileExt=='peg'){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        imageBox.append('<img>');
                        imageBox.find('img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);

                    reader.onloadend = (function () {
                        imageBox.find('img').croppie('destroy');
                        crp = imageBox.find('img').croppie({
                            viewport: {
                                width: 300,
                                height: 300
                            },
                            enableOrientation: true,
                            boundary: {height: 360 },
                            update: function (data) {
                                var crop = data.points;
                                $('input[name="image_thumb_data[x]"]').val(crop[0]);
                                $('input[name="image_thumb_data[y]"]').val(crop[1]);
                                $('input[name="image_thumb_data[width]"]').val(crop[2]);
                                $('input[name="image_thumb_data[height]"]').val(crop[3]);


                            }
                        });

                        $('#btn-image-thumb-rotate').on('click', function(ev) {
                            crp.croppie('rotate',90);

                            var i_rotate = $('input[name="image_thumb_data[rotate]"]');
                            var new_rotate = Number(i_rotate.val()) + 90;
                            if(new_rotate==360) new_rotate = 0;
                            i_rotate.val(new_rotate);
                        });

                        $('#btn-image-thumb-rotate').removeClass('hide');
                        $('#btn-image-thumb-remove').removeClass('hide');
                    });
                }else{

                }
            }else{
                alert('이미지 파일만 업로드 가능합니다 ('+fileExt+')');
                imageBox.find('input[type="file"]').val('');
            }
        }else{
            console.log('no fileName');
            imageBox.find('img').croppie('destroy');
            imageBox.find('img').remove();
            $('#btn-image-thumb-rotate').addClass('hide');
            $('#btn-image-thumb-remove').addClass('hide');
        }
    }

    function remove_thumb_crop(){
        $('#profile-image').find('img').croppie('destroy');
        $('#profile-image').find('img').remove();
        $('input[name="profile"]').val('');
        $('#btn-image-thumb-rotate').addClass('hide');
        $('#btn-image-thumb-remove').addClass('hide');
    }

    function open_set_point(){
        var modal = $('#modal-member-set-point');
        modal.modal();
    }

    function save_set_point(){
        var modal = $('#modal-member-set-point');
        var form = $('form[name="frm-set-point"]');
        var i_point = modal.find('input[name="point"]');

        if(!i_point.val()){
            alert('포인트를 입력하세요');
            return;
        }

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/member/ajax/save_set_point',
            data:form.serialize(),
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('반영되었습니다');
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
</script>