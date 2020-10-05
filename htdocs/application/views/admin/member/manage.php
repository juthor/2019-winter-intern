<link rel="stylesheet" href="<?=base_url()?>css/croppie.css"/>
<style>
    #box-signup .input-group>.input-group-addon>.fa-check{color:#aaa;}
    #box-signup .input-group>.input-group-addon>.fa-check[data-value="2"]{color:green;}
    #box-signup .input-group>.input-group-addon>.fa-check[data-value="1"]{color:red;}

    #box-signup .btn.btn-primary.btn-block{padding:0;height:50px;line-height:50px;border-radius:0;font-size:1.2em;font-weight:700;margin-top:6px;}
    #box-signup #btn-signup{background-color:#444;border-color:#333;color:#fff;}
    #box-signup h3{color:#e47127;margin:0 0 40px 0;text-align:center;}
</style><div class="col-md-4 col-md-offset-4" id="box-signup">
    <div class="inner">
        <form name="frm-signup" method="post">
            <?if($this->input->get('referer')){?>
                <h3>회원정보 입력 후 이용가능합니다</h3>
            <?}?>
            <div class="input-group input-group-b full" data-name="name">
                <span class="input-group-addon">이름</span>
                <input type="text" name="name" class="form-control" value="<?=@$member['name']?>">
            </div>

            <div class="input-group input-group-b full" data-name="name">
                <span class="input-group-addon">휴대폰번호</span>
                <input type="tel" name="phone" class="form-control" value="<?=@$member['phone']?>" placeholder="숫자만입력">
                <!--                        <span class="input-group-addon"><span class="fas fa-check check-phone" data-value="0"></span></span>-->
                <!--                        <div class="notice hide"></div>-->
            </div>

            <div class="input-group input-group-b full" data-name="email">
                <span class="input-group-addon">이메일</span>
                <input type="email" name="email" class="form-control" value="<?=@$member['email']?>">
                <span class="input-group-addon"><span class="fas fa-check check-email" data-value="0"></span></span>
                <div class="notice hide"></div>
            </div>


            <?if(@$member['type']=='2'){?>
                <div class="input-group input-group-b full input-group-biz">
                    <span class="input-group-addon">상호명</span>
                    <input type="text" name="corp_name" class="form-control" value="<?=@$member['corp_name']?>">
                </div>

                <div class="input-group input-group-b full input-group-biz">
                    <span class="input-group-addon">사업자등록번호</span>
                    <input type="text" name="corp_num" class="form-control" placeholder="사업자등록번호" value="<?=@$member['corp_num']?>">
                </div>

                <div class="input-group input-group-b full input-group-biz">
                    <span class="input-group-addon">대표자명</span>
                    <input type="text" name="corp_ceo" class="form-control" placeholder="대표자명" value="<?=@$member['corp_ceo']?>">
                </div>

                <div class="input-group input-group-b full input-group-biz">
                    <span class="input-group-addon">사업장주소</span>
                    <input type="text" name="corp_addr" class="form-control" placeholder="사업장주소" value="<?=@$member['corp_addr']?>">
                </div>

                <div class="input-group input-group-b full input-group-biz">
                    <span class="input-group-addon">업종</span>
                    <input type="text" name="corp_bizClass" class="form-control" placeholder="업종" value="<?=@$member['corp_bizClass']?>">
                </div>

                <div class="input-group input-group-b full input-group-biz">
                    <span class="input-group-addon">업태</span>
                    <input type="text" name="corp_bizType" class="form-control" placeholder="업태" value="<?=@$member['corp_bizType']?>">
                </div>

                <div class="input-group input-group-b full input-group-biz">
                    <span class="input-group-addon">전화번호</span>
                    <input type="text" name="corp_tel" class="form-control" value="<?=@$member['corp_tel']?>">
                </div>

                <div class="input-group input-group-b full input-group-biz">
                    <span class="input-group-addon">홈페이지 주소</span>
                    <input type="text" name="corp_url" class="form-control" value="<?=@$member['corp_url']?>">
                </div>

                <div class="input-group input-group-b full input-group-biz">
                    <span class="input-group-addon">회사소개 주소</span>
                    <input type="text" name="corp_url_introduce" class="form-control" value="<?=@$member['corp_url_introduce']?>">
                </div>

                <div class="input-group input-group-b full input-group-biz">
                    <span class="input-group-addon">회사간단소개</span>
                    <input type="text" name="corp_summary" class="form-control" value="<?=@$member['corp_summary']?>">
                </div>

                <div class="input-group input-group-b full input-group-biz">
                    <span class="input-group-addon">로고이미지</span>
                    <input type="file" name="corp_logo" class="form-control" <!--onChange="preview_image(this)-->">
                    <img src="<?=IMAGEPATH?>member/logo/<?=$member['corp_logo']?>" style="max-width:100%;">
                </div>

                <div id="profile-image">
                    <a id="btn-image-thumb-rotate" class="hide btn btn-default btn-sm btn-rotate btn-croppie" style="margin:15px 0;"><span class="fas fa-sync"></span> 회전</a>
                    <a href="javascript:remove_thumb_crop()" id="btn-image-thumb-remove" class="hide btn btn-default btn-sm btn-croppie" style="margin:15px 0;"><span class="far fa-trash-alt"></span> 삭제</a>
                </div>

                <input type="hidden" name="image_thumb_data[x]">
                <input type="hidden" name="image_thumb_data[y]">
                <input type="hidden" name="image_thumb_data[width]">
                <input type="hidden" name="image_thumb_data[height]">
                <input type="hidden" name="image_thumb_data[rotate]">
            <?}?>

            <hr>

            <?if(@$member['id']){?>
                <div class="input-group input-group-b full" data-name="passwd">
                    <span class="input-group-addon">비밀번호</span>
                    <input type="password" name="passwd" class="form-control" placeholder="변경시에만 입력">
                    <span class="input-group-addon"><span class="fas fa-check check-passwd" data-value="0"></span></span>
                    <div class="notice hide"></div>
                </div>

                <div class="input-group input-group-b full" data-name="passwd_confirm">
                    <span class="input-group-addon">비밀번호확인</span>
                    <input type="password" name="passwd_confirm" class="form-control">
                    <span class="input-group-addon"><span class="fas fa-check check-passwd-confirm" data-value="0"></span></span>
                    <div class="notice hide"></div>
                </div>
            <?}?>

            <input type="hidden" name="idx" value="<?=$member['idx']?>">
        </form>

        <a href="javascript:signup()" class="btn btn-block btn-primary" id="btn-signup">정보수정</a>
    </div>
</div>



<script src="<?=base_url()?>js/jquery.form.js"></script>
<script src="<?=base_url()?>js/croppie.js"></script>
<script>
    $(function(){
        var exe_email_check;

        $('input[name="email"]').keyup(function(){
            clearTimeout(exe_email_check);
            exe_email_check = setTimeout(function(){
                check_email();
            },0);
        });

        $('input[name="passwd"]').keyup(function(){
            check_passwd();
        });

        $('input[name="passwd_confirm"]').keyup(function(){
            check_passwd_confirm();
        });

        $('input[name="phone"]').val(convert_phone($('input[name="phone"]').val()));
        $('input[name="phone"]').keyup(function(){
            $(this).val(convert_phone($(this).val()));
        });

        if($('input[name="corp_num"]').length>0) $('input[name="corp_num"]').val(autoHypenCorpNum($('input[name="corp_num"]').val()));
        $('input[name="corp_num"]').keyup(function(){
            $(this).val(autoHypenCorpNum($(this).val()));
        });

        if($('input[name="corp_tel"]').length>0) $('input[name="corp_tel"]').val(convert_phone($('input[name="corp_tel"]').val()));
        $('input[name="corp_tel"]').keyup(function(){
            $(this).val(convert_phone($(this).val()));
        });
    });

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

    function check_passwd_confirm(){
        var form = $('form[name="frm-signup"]');
        var igroup = $('.input-group[data-name="passwd_confirm"]');
        var notice = igroup.find('.notice');
        var i_passwd_confirm = igroup.find('input[name="passwd_confirm"]');
        var i_passwd = form.find('input[name="passwd"]');

        if(!i_passwd_confirm.val()){
            $('.check-passwd-confirm').attr('data-value','0');
            notice.addClass('hide');
            return false;
        }

        if(i_passwd.val() != i_passwd_confirm.val()){
            $('.check-passwd-confirm').attr('data-value','1');
            notice.removeClass('hide');
            notice.text('입력하신 비밀번호와 일치하지 않습니다');
            return false;
        }else{
            $('.check-passwd-confirm').attr('data-value','2');
            notice.addClass('hide');
            return true;
        }
    }

    function signup(){
        var form = $('form[name="frm-signup"]');
        var i_email = form.find('input[name="email"]');
        var i_passwd = form.find('input[name="passwd"]');
        var i_passwd_confirm = form.find('input[name="passwd_confirm"]');
        var referer = '<?=urldecode(@$this->input->get('referer'))?>';

        if(i_passwd.val() && !check_passwd()){
            alert('비밀번호를 올바르게 입력하세요');
            i_passwd.focus();
            return;
        }

        if(i_passwd.val() && !check_passwd_confirm()){
            alert('비밀번호 확인을 다시 하세요');
            i_passwd_confirm.focus();
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
                    alert('정상적으로 수정되었습니다');
                    location.replace('<?=base_url()?>admin/member');
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
            }
        });
        form.submit();
    }

    var crp;
    function preview_image(input){
        var imageBox = $('#profile-image');
        var fileName = $('input[name="corp_logo"]').val();

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
                                width: 200,
                                height: 100
                            },
                            enableOrientation: true,
                            boundary: {height: 200 },
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
        $('input[name="corp_logo"]').val('');
        $('#btn-image-thumb-rotate').addClass('hide');
        $('#btn-image-thumb-remove').addClass('hide');
    }


    /*
    function autoHypenPhone(str){
        str = str.replace(/[^0-9]/g, '');
        var tmp = '';
        if( str.length < 4){
            return str;
        }else if(str.length < 7){
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3);
            return tmp;
        }else if(str.length < 11){
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3, 3);
            tmp += '-';
            tmp += str.substr(6);
            return tmp;
        }else{
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3, 4);
            tmp += '-';
            tmp += str.substr(7,4);
            return tmp;
        }
        return str;
    }
    */

    function autoHypenCorpNum(str){
        str = str.replace(/[^0-9]/g, '');
        var tmp = '';
        if( str.length < 3){
            return str;
        }else if(str.length < 5){
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3);
            return tmp;
        }else if(str.length < 10){
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3, 2);
            tmp += '-';
            tmp += str.substr(5);
            return tmp;
        }else{
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3, 2);
            tmp += '-';
            tmp += str.substr(5,5);
            return tmp;
        }
        return str;
    }

    function member_exit(){
        if(!confirm('정말 삭제하시겠습니까?')) return;

        $.ajax({
            type:'post',
            url:'<?=base_url()?>member/ajax/member_exit',
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('탈퇴처리되었습니다. 이용해주셔서 감사합니다');
                    location.replace('<?=base_url()?>');
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