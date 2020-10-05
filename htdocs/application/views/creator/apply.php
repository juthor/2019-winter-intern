<link rel="stylesheet" href="<?=base_url()?>css/wow-alert.css"/>
<style>
    .apply-note{display:table;width:100%;height:calc(100vh);background-image:url('<?=IMAGEPATH?>assets/bg_apply_01.jpg');background-size:130%;background-position:center top;}
    .apply-note>.inner{width:50%;display:table-cell;vertical-align:middle;}
    .apply-note>.inner.slogan{text-align:right;padding-right:180px;}
    .apply-note>.inner.infos{padding-left:10px;}
    .apply-note>.inner.infos ul>li{margin-bottom:80px;opacity:0.6;transition:opacity 0.3s;color:#333;}
    .apply-note>.inner.infos ul>li:hover{opacity:1;}
    .apply-note>.inner.infos ul>li.last{margin-bottom:0;}
    .apply-note>.inner.infos ul>li>strong{display:block;font-size:2em;font-weight:400;margin-bottom:30px;padding-left:50px;background-size:auto 40px;background-repeat:no-repeat;background-position:left center;}
    .apply-note>.inner.infos ul>li>p{font-size:1.1em;margin:0;}

    .apply-do{display:table;width:100%;height:calc(100vh);background-image:url('<?=IMAGEPATH?>assets/bg_apply_02.jpg');background-size:130%;background-position:center top;}
    .apply-do>.inner{display:table-cell;vertical-align:middle;}
    .apply-do .head{text-align:center;margin-top:200px;}
    .apply-do .head p{margin:0 0 40px 0;font-size:15px;letter-spacing:5px;line-height:27px;}
    .apply-do .head #btn-open-apply{display:inline-block;padding:30px 0;width:400px;border:2px solid #ebced0;color:#333;font-weight:700;font-size:1.1em;margin-top:11px;}
    .apply-do .head #btn-open-apply:hover{background-color:#ebced0;}
    .apply-do .note{background:rgba(235,206,208,0.2);margin-top:50px;padding:40px 90px;font-size:1.2em;}
    .apply-do .note p{margin-bottom:20px;}
    .apply-do .note p.last{margin-bottom:0;}

    #modal-apply .modal-body{padding:0 50px;background-image:url('<?=IMAGEPATH?>assets/bg_apply_form.png');background-position:center;background-repeat:no-repeat;}
    #modal-apply h3{margin:0 0 35px 0;font-size:2em;font-weight:400;text-align:center;}
    #modal-apply .check-agree{margin:0 0 70px 0;}
    #modal-apply .btn-close{display:inline-block;width:22px;height:22px;margin:50px 0 10px 0;background-image:url('<?=IMAGEPATH?>assets/icon_close.png');background-size:contain;}
    #modal-apply .input-group{border:0;}
    #modal-apply .input-group>input{border:1px solid #333;border-radius:0;background-color:transparent;}
    #modal-apply .input-group>input.require::placeholder{color:red;}
    #modal-apply .input-group>input.require:-ms-input-placeholder{color:red;}
    #modal-apply #table-apply>tbody>tr>th{width:80px;}
    #modal-apply #input-group-name{border:0;}
    #modal-apply #input-group-name>input{}
    #modal-apply #input-group-name .btn-gender{border:1px solid #333;border-left:0;border-radius:0;padding:6px 45px;margin-left:-1px;}
    #modal-apply #input-group-name .btn-gender.active{background-color:#333;color:#fff;}
    #modal-apply #input-group-name .btn-gender.first{border-left:1px solid #333;}
    .input-group-birth{display:inline-block;}
    .input-group-birth>.input-group-addon{background:transparent;text-align:left;}
    .input-group-birth .bootstrap-select{width:193px;}
    .input-group-birth .bootstrap-select.btn-group .dropdown-toggle .filter-option{text-align:center;}
    .input-group-birth .bootstrap-select>button{border:1px solid #333!important;background:transparent;}

    #modal-apply #btn-apply{display:inline-block;border:1px solid #333;color:#333;padding:12px 100px;margin-bottom:50px;font-weight:700;}
    #modal-apply #btn-apply:hover{background-color:#333;color:#fff;}
    #modal-apply #table-platform{}
    #modal-apply #table-platform td.td-name{width:150px;}
    #modal-apply #table-platform td.td-btn{width:34px;}
    #modal-apply #table-platform .btn-row{display:inline-block;width:34px;height:34px;border-radius:17px;background-color:#333;background-size:20px;background-position:center;background-repeat:no-repeat;}
    #modal-apply #table-platform .btn-row.plus{background-image:url('<?=IMAGEPATH?>assets/icon_plus.png');}
    #modal-apply #table-platform .btn-row.minus{background-image:url('<?=IMAGEPATH?>assets/icon_minus.png');background-color:#fff;border:1px solid #333;}
    #modal-apply #table-platform .bootstrap-select{width:100%!important;}
    #modal-apply #table-platform .bootstrap-select>button{border:1px solid #333;border-radius:0;font-weight:300;}

    .wow-alert-content a{background:#ebced0;}
    .wow-alert-content a:hover{background: #bfa6a6;}

    @media screen and (max-width:1430px){
        .apply-note{display:block;background-size:cover;height:auto;padding-bottom:300px;}
        .apply-note>.inner{width:100%;display:block;padding:30px 10px!important;}
        .apply-note>.inner.infos ul>li{margin-bottom:40px;}
        .apply-note>.inner.infos ul>li>strong{margin-bottom:10px;font-size:1.4em;padding-top:10px;padding-bottom:10px;}
        .apply-note>.inner.infos ul>li>p{font-size:1em;}


        .apply-do{display:block;height:auto;padding:60px 0;background-size:auto 100%;background-position:center left;}
        .apply-do>.inner{display:block;}
        .apply-do .note{padding:50px 10px;font-size:0.85em;}
        .apply-do .head #btn-open-apply{width:200px;padding:15px 0;}

        #modal-apply .modal-body{padding:0 10px;}
        #modal-apply #input-group-name .btn-gender{padding:6px 10px;}
        #modal-apply .input-group-birth input{padding:6px 4px;}
        #modal-apply .input-group-birth .input-group-addon{padding:6px 4px;}

        #modal-terms .btn-agree{padding:15px 20px!important;}
    }
</style>

<div id="body">
    <div style="height: 75px;"></div>
    <div class="apply-note" id="section-apply-note">
        <div class="inner slogan motion-down">
            <h2 class="font-camelia title-black-center">Join the<br>Celly Story</h2>
        </div>

        <div class="inner infos motion-up">
            <ul>
                <li>
                    <strong style="background-image:url('<?=IMAGEPATH?>assets/icon_apply_info_01.png');"><?=$this->lang->line('apply_intro1_title')?></strong>
                    <p><?=$this->lang->line('apply_intro1_text')?></p>
                </li>

                <li>
                    <strong style="background-image:url('<?=IMAGEPATH?>assets/icon_apply_info_02.png');"><?=$this->lang->line('apply_intro2_title')?></strong>
                    <p><?=$this->lang->line('apply_intro2_text')?></p>
                </li>

                <li class="last">
                    <strong style="background-image:url('<?=IMAGEPATH?>assets/icon_apply_info_03.png');"><?=$this->lang->line('apply_intro3_title')?></strong>
                    <p><?=$this->lang->line('apply_intro3_text')?></p>
                </li>
            </ul>
        </div>
    </div>

    <div class="apply-do event" id="section-apply-do">
        <div class="inner">
            <div class="container">
                <div class="head">
                    <h2 class="motion-down title-black">Creator Apply</h2>
                    <p class="motion-up"><?=$this->lang->line('apply_text_creator_apply')?></p>
                    <a href="javascript:open_apply()" id="btn-open-apply"><?=$this->lang->line('apply_text_btn_apply')?></a>
                </div>

                <div class="note">
                    <p><?=$this->lang->line('apply_note_1')?></p>
                    <p><?=$this->lang->line('apply_note_2')?></p>
                    <p><?=$this->lang->line('apply_note_3')?></p>
                    <p><?=$this->lang->line('apply_note_4')?></p>
                    <p class="last"><?=$this->lang->line('apply_note_5')?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-apply">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form name="frm-apply">
                    <div class="text-right"><a data-dismiss="modal" class="btn-close"></a></div>
                    <h3><?=$this->lang->line('apply_modal_1')?></h3>

                    <div class="text-center">
                        <label class="rachel check-agree" onClick="open_apply_terms()"><input type="checkbox" name="agree" value="1" disabled> <?=$this->lang->line('apply_modal_2')?></label>
                    </div>

                    <table class="table" id="table-apply">
                        <tbody>
                        <tr>
                            <th><?=$this->lang->line('apply_modal_3')?></th>
                            <td>
                                <div class="input-group" id="input-group-name">
                                    <input type="text" name="name" class="form-control" placeholder="<?=$this->lang->line('apply_modal_name')?>">
                                    <span class="input-group-btn" style="padding-left:20px;"><a href="javascript:select_gender('m')" class="btn btn-gender first" data-id="m"><?=$this->lang->line('apply_modal_4_1')?></a></span>
                                    <span class="input-group-btn"><a href="javascript:select_gender('f')" class="btn btn-gender" data-id="f"><?=$this->lang->line('apply_modal_4_2')?></a></span>
                                </div>
                                <input type="hidden" name="gender">
                            </td>
                        </tr>
                        <tr>
                            <th><?=$this->lang->line('apply_modal_5')?></th>
                            <td>
                                <!--
                                <div class="input-group" id="input-group-birth">
                                    <input type="tel" name="birth_year" class="form-control">
                                    <span class="input-group-addon"><?=$this->lang->line('apply_modal_5_1')?></span>
                                    <input type="tel" name="birth_month" class="form-control">
                                    <span class="input-group-addon"><?=$this->lang->line('apply_modal_5_2')?></span>
                                    <input type="tel" name="birth_day" class="form-control">
                                    <span class="input-group-addon"><?=$this->lang->line('apply_modal_5_3')?></span>
                                </div>
                                -->

                                <div class="input-group input-group-birth">
                                    <select name="birth_year" class="selectpicker">
                                        <?for($i=1940;$i<=date('Y');$i++){?>
                                        <option value="<?=$i?>" <?=($i==2000)?' selected="true" ':''?>><?=$i?></option>
                                        <?}?>
                                    </select>
                                    <span class="input-group-addon"><?=$this->lang->line('apply_modal_5_1')?></span>
                                </div>
                                <div class="input-group input-group-birth">
                                    <select name="birth_month" class="selectpicker">
                                        <?for($i=1;$i<=12;$i++){?>
                                            <option value="<?=$i?>" <?=($i==1)?' selected="true" ':''?>><?=$i?></option>
                                        <?}?>
                                    </select>
                                    <span class="input-group-addon"><?=$this->lang->line('apply_modal_5_2')?></span>
                                </div>
                                <div class="input-group input-group-birth">
                                    <select name="birth_day" class="selectpicker">
                                        <?for($i=1;$i<=31;$i++){?>
                                            <option value="<?=$i?>" <?=($i==1)?' selected="true" ':''?>><?=$i?></option>
                                        <?}?>
                                    </select>
                                    <span class="input-group-addon"><?=$this->lang->line('apply_modal_5_3')?></span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?=$this->lang->line('apply_modal_6')?></th>
                            <td>
                                <div class="input-group full">
                                    <input type="tel" name="phone" class="form-control" placeholder="<?=$this->lang->line('apply_modal_9')?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>
                                <div class="input-group full">
                                    <input type="email" name="email" class="form-control" placeholder="<?=$this->lang->line('apply_modal_10')?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?=$this->lang->line('apply_modal_7')?></th>
                            <td>
                                <div class="input-group full">
                                    <input type="text" name="addr" class="form-control" placeholder="<?=$this->lang->line('apply_modal_11')?>">
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <table class="table" id="table-platform">
                        <tbody>
                        <tr data-id="0">
                            <td class="td-name">
                                <select name="platform[0][channel]" class="selectpicker select_platform_channel" title="<?=$this->lang->line('apply_modal_8_1')?>" data-dropupAuto="false">
                                    <option value="인스타그램"><?=$this->lang->line('apply_platform1')?></option>
                                    <option value="페이스북"><?=$this->lang->line('apply_platform2')?></option>
                                    <option value="유튜브"><?=$this->lang->line('apply_platform3')?></option>
                                    <option value="블로그"><?=$this->lang->line('apply_platform4')?></option>
                                    <option value="아프리카tv"><?=$this->lang->line('apply_platform5')?></option>
                                    <option value="기타"><?=$this->lang->line('apply_platform6')?></option>
                                </select>

                                <div class="input-group full hide input-group-platform-channel-etc">
                                    <input type="text" name="platform[0][channel_etc]" class="form-control" placeholder="<?=$this->lang->line('apply_modal_8_1')?>">
                                </div>
                            </td>

                            <td class="td-name">
                                <div class="input-group full">
                                    <input type="text" name="platform[0][area]" class="form-control input-platform-area" placeholder="<?=$this->lang->line('apply_modal_8_2')?>">
                                </div>
                            </td>

                            <td class="td-name">
                                <div class="input-group full">
                                    <input type="text" name="platform[0][name]" class="form-control input-platform-name" placeholder="<?=$this->lang->line('apply_modal_8_3')?>">
                                </div>
                            </td>

                            <td class="td-area">
                                <div class="input-group full">
                                    <input type="text" name="platform[0][account]" class="form-control" placeholder="<?=$this->lang->line('apply_modal_8_4')?>">
                                </div>
                            </td>
                            <td class="td-btn">
                                <a href="javascript:add_platform_row()" class="btn-row plus"></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>

                <div class="text-center">
                    <a href="javascript:save_apply()" id="btn-apply"><?=$this->lang->line('apply_text_btn_apply')?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #modal-terms{}
    #modal-terms .terms-title{font-size:1.2em;font-weight:700;}
    #modal-terms .terms{width:100%;height:150px;margin-bottom:30px;overflow-y:scroll;border:1px solid #e1e1e1;font-size:0.85em;padding:10px;}
    #modal-terms .btn-agree{display:inline-block;padding:15px 40px;border:1px solid #333;color:#fff;background-color:#333;}
    #modal-terms .btn-agree.disagree{background-color:transparent;color:#333;}
</style>

<div class="modal" id="modal-terms">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p class="terms-title"><?=$this->lang->line('apply_term_1_title')?></p>
                <div class="terms">
                    <?
                    switch($this->user_lang){
                        case 'kor': echo nl2br($this->cfg['terms_of_use']); break;
                        case 'eng': echo nl2br($this->cfg['terms_of_use_eng']); break;
                    }
                    ?>
                </div>

                <div class="text-center">
                    <a href="javascript:agree_apply_terms('agree')" class="btn-agree"><?=$this->lang->line('apply_term_text_1')?></a>
                    <a href="javascript:agree_apply_terms('disagree')" class="btn-agree disagree"><?=$this->lang->line('apply_term_text_2')?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>js/wow-alert.js"></script>
<script>
    $(function(){
        select_gender('m');

        $('input[name="phone"]').keyup(function(){
            $(this).val(convert_phone($(this).val()));
        });

        //$('#modal-apply').modal();

        $('.select_platform_channel').change(function(){
            console.log('ts');
            console.log($(this).val());

            if($(this).val()=='기타'){
                $(this).parents('td').find('.input-group-platform-channel-etc').removeClass('hide');
                $(this).parents('td').find('.input-group-platform-channel-etc').find('input').focus();
            }else{
                $(this).parents('td').find('.input-group-platform-channel-etc').addClass('hide');
            }
        });
    });

    var offset_section_apply_note = $('#section-apply-note').offset().top;
    var offset_section_apply_do = $('#section-apply-do').offset().top - ($(window).height()/2);

    $(window).scroll(function(){
        var cur_offset = $(window).scrollTop();

        if($(window).width()>767){
            if(cur_offset>=offset_section_apply_note - 0){
                if($('#section-apply-note').hasClass('event')){
                    $('#section-apply-note').removeClass('event');
                }
            }

            if(cur_offset>=offset_section_apply_do - 0){
                if($('#section-apply-do').hasClass('event')){
                    $('#section-apply-do').removeClass('event');
                }
            }
        }else{
            if(cur_offset>=offset_section_apply_note - 0){
                if($('#section-apply-note').hasClass('event')){
                    $('#section-apply-note').removeClass('event');
                }
            }

            if(cur_offset>=offset_section_apply_do - 0){
                if($('#section-apply-do').hasClass('event')){
                    $('#section-apply-do').removeClass('event');
                }
            }
        }
    });

    function select_gender(svalue){
        $('input[name="gender"]').val(svalue);
        $('.btn-gender').removeClass('active');
        $('.btn-gender[data-id="'+svalue+'"]').addClass('active');
    }

    function open_apply(){
        var modal = $('#modal-apply');
        modal.modal({
            backdrop:'static',
            keyboard:false
        });
    }

    function save_apply(){
        var form = $('form[name="frm-apply"]');
        var i_name = form.find('input[name="name"]');
        var i_birth_year = form.find('select[name="birth_year"]');
        var i_birth_month = form.find('select[name="birth_month"]');
        var i_birth_day = form.find('select[name="birth_day"]');
        var i_phone = form.find('input[name="phone"]');
        var i_email = form.find('input[name="email"]');
        var i_addr = form.find('input[name="addr"]');

        if(!$('input[name="agree"]').prop('checked')){
            alert('<?=$this->lang->line('apply_alert_1')?>');
            return;
        }

        if(!i_name.val()){
            //alert('<?=$this->lang->line("apply_alert_2")?>');
            i_name.addClass('require');
            //i_name.focus();
            return;
        }

        if(!i_birth_year.val()){
            alert('<?=$this->lang->line("apply_alert_3")?>');
            i_birth_year.focus();
            return;
        }

        if(!i_birth_month.val()){
            alert('<?=$this->lang->line("apply_alert_3")?>');
            i_birth_month.focus();
            return;
        }

        if(!i_birth_day.val()){
            alert('<?=$this->lang->line("apply_alert_3")?>');
            i_birth_day.focus();
            return;
        }

        if(!i_phone.val()){
            //alert('<?=$this->lang->line("apply_alert_4")?>');
            i_phone.addClass('require');
            //i_phone.focus();
            return;
        }

        if(!i_email.val()){
            //alert('<?=$this->lang->line("apply_alert_5")?>');
            i_email.addClass('require');
            //i_email.focus();
            return;
        }

        if(!valid_email(i_email.val())){
            alert('<?=$this->lang->line("apply_alert_6")?>');
            //i_email.addClass('require');
            i_email.focus();
            return;
        }

        if(!i_addr.val()){
            //alert('<?=$this->lang->line("apply_alert_7")?>');
            i_addr.addClass('require');
            //i_addr.focus();
            return;
        }

        // 활동채널 등록
        var isInputPlatform = false;
        $('#table-platform>tbody>tr').each(function(){
            var platform_name = $(this).find('.input-platform-name');
            var platform_area = $(this).find('.input-platform-area');
            console.log('name:'+platform_name.val()+' area:'+platform_area.val());

            if(platform_name.val() && platform_area.val()){
                isInputPlatform = true;
            }
        });

        if(!isInputPlatform){
            alert('<?=$this->lang->line("apply_alert_8")?>');
            return;
        }

        //if(!confirm('<?=$this->lang->line("apply_alert_9")?>')) return;

        $.ajax({
            type:'post',
            data:form.serialize(),
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('<?=$this->lang->line("apply_alert_10")?>',{
                        label: "OK",
                        success: function () {
                            location.reload();
                        }
                    });
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
                alert('error');
            }
        });
    }

    function open_apply_terms(){
        var modal = $('#modal-terms');
        modal.modal();
    }

    function agree_apply_terms(rsp){
        var modal = $('#modal-terms');

        switch(rsp){
            case 'agree':
                $('input[name="agree"]').prop('checked',true);
                break;

            case 'disagree':
                $('input[name="agree"]').prop('checked',false);
                break;
        }

        $('.rachel').rachel();
        modal.modal('hide');
    }



    var platform_row = 1;
    function add_platform_row(){
        //var append = '<tr data-id="'+platform_row+'"> <td class="td-name"> <div class="input-group full"> <input type="text" name="platform['+platform_row+'][name]" class="form-control input-platform-name" placeholder="활동채널"> </div> </td> <td class="td-area"> <div class="input-group full"> <input type="text" name="platform['+platform_row+'][area]" class="form-control input-platform-area" placeholder="활동분야"> </div> </td> <td class="td-btn"> <a href="javascript:remove_platform_row('+platform_row+')" class="btn-row minus"></a> </td> </tr>';
        var append = '<tr data-id="'+platform_row+'"><td class="td-name"><select name="platform['+platform_row+'][channel]" class="selectpicker select_platform_channel" title="<?=$this->lang->line('apply_modal_8_1')?>"><option value="인스타그램"><?=$this->lang->line('apply_platform1')?></option><option value="페이스북"><?=$this->lang->line('apply_platform2')?></option><option value="유튜브"><?=$this->lang->line('apply_platform3')?></option><option value="블로그"><?=$this->lang->line('apply_platform4')?></option><option value="아프리카tv"><?=$this->lang->line('apply_platform5')?></option><option value="기타"><?=$this->lang->line('apply_platform6')?></option></select><div class="input-group full hide input-group-platform-channel-etc"><input type="text" name="platform['+platform_row+'][channel_etc]" class="form-control" placeholder="<?=$this->lang->line('apply_modal_8_1')?>"></div></td><td class="td-name"><div class="input-group full"><input type="text" name="platform['+platform_row+'][area]" class="form-control input-platform-area" placeholder="<?=$this->lang->line('apply_modal_8_2')?>"></div></td><td class="td-name"><div class="input-group full"><input type="text" name="platform['+platform_row+'][name]" class="form-control input-platform-name" placeholder="<?=$this->lang->line('apply_modal_8_3')?>"></div></td><td class="td-area"><div class="input-group full"><input type="text" name="platform['+platform_row+'][account]" class="form-control" placeholder="<?=$this->lang->line("apply_modal_8_4")?>"></div></td><td class="td-btn"><a href="javascript:remove_platform_row('+platform_row+')" class="btn-row minus"></a></td></tr>';
        $('#table-platform>tbody').append(append);
        $('#table-platform>tbody>tr[data-id="'+platform_row+'"]').find('.selectpicker').selectpicker({
            size:4
        });


        $('select[name="platform['+platform_row+'][channel]"]').change(function(){
            if($(this).val()=='기타'){
                $(this).parents('td').find('.input-group-platform-channel-etc').removeClass('hide');
                $(this).parents('td').find('.input-group-platform-channel-etc').find('input').focus();
            }else{
                $(this).parents('td').find('.input-group-platform-channel-etc').addClass('hide');
            }
        });

        platform_row++;
    }

    function remove_platform_row(id){
        $('#table-platform>tbody>tr[data-id="'+id+'"]').remove();
        $('#table-platform>tbody>tr[data-id="'+id+'"]')
    }
</script>