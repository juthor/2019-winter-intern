<style>
    #body{padding-bottom:40px;}
    .head-title{display:table;width:100%;height:calc(100vh);background-image:url('<?=IMAGEPATH?>assets/bg_contact_02.jpg');background-size:cover;background-position:center;}
    .head-title>.inner{display:table-cell;vertical-align:bottom;padding-bottom:160px;}
    .head-title p{width:530px;line-height:40px;word-break:keep-all;color:#333;font-size:15px;margin:0;letter-spacing:1.1px;}
    .head-title p .row1{letter-spacing:1px;}

    .location{}
    .location #location-map{width:100%;height:600px;background-color:#999;}

    .contact-us{padding-top:80px;}
    .contact-us>.container{position:relative;}
    .contact-us h2{font-size:5em;font-weight:100;margin:0;position:absolute;left:0;top:-120px;}

    @media screen and (min-width:768px){
        .head-title>.inner>.container{width:100%;padding-left:140px;padding-right:140px;}
    }

    @media screen and (max-width:1430px){
        .contact-title h2{width:100%;font-size:3em;}
        .head-title p{width:100%;}
    }
</style>

<div id="body">
    <div style="height: 75px;"></div>
    <div class="head-title" id="section-head">
        <div class="inner">
            <div class="container">
                <h2 class="font-camelia motion-down title-black"><br>Make a fateful<br>encounter<br>in Celly Story</h2>
                <p class="motion-up"><?=$this->lang->line('contact_title1')?></p>
            </div>
        </div>
    </div>
    <div style="height: 75px;"></div>
    <div class="contact-us">
        <style>
            #locations{}
            #locations .panel{border-radius:0;background-color:transparent;border:0;margin-bottom:40px;box-shadow:none;}
            #locations .panel-heading{padding:0;border-radius:0;background-color:transparent;border-bottom:1px solid #858585;}
            #locations .panel-title>a{display:block;padding:10px 0;color:#333;}
            #locations .panel-body{padding:15px 0;color:#333;}

            .contact-us{}
            .contact-us .input-group{border:1px solid #5c5c5c;margin-bottom:10px;}
            .contact-us .input-group>input,
            .contact-us .input-group>textarea{background-color:transparent;color:#5c5c5c;}
            .contact-us .bootstrap-select{width:100%!important;margin-bottom:10px;}
            .contact-us .bootstrap-select>button{border-radius:0;background-color:transparent;color:#5c5c5c;border-color:#5c5c5c;}
            .contact-us #btn-contact-send{display:inline-block;background-color:#fff;color:#333;padding:10px 30px;border:1px solid #333;}
            .contact-us #btn-contact-send:hover{background-color:#333;color:#fff;}
        </style>

        <div class="container">
            <div class="row contact-title" style="display: inline-block;">
                <div style="float:left;">
                <h2 class="title-black">Contact us</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel-group" id="locations" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#locations" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        KOREA
                                    </a>
                                    <div class="map_wrap" style="float: right; background-color: #000000; bold; left:-20px; padding-top: 10px;padding-bottom: 10px;padding-left: 20px;padding-right: 20px; margin-bottom: 10px;">
                                        <div class="wid-01" style="float: right;">
                                            <div>
                                                <a href="http://naver.me/5yc7THCx" target="_blank" class="" style="color:white;">
                                                    <?=$this->lang->line('naver_map')?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    07326 서울특별시 영등포구 여의도동 23 Two IFC 16층<br>16th floor Two IFC, 10, Gukjegeumyung-ro, Yeongdeungpo-gu, Seoul, 07326, Republic of KOREA<br>+82.2.2088.1955
                                </div>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#locations" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        AMERICA
                                    </a>
                                    <div class="map_wrap" style="float: right; background-color: #000000; bold; left:-20px; padding-top: 10px;padding-bottom: 10px;padding-left: 20px;padding-right: 20px; margin-bottom: 10px;">
                                        <div class="wid-01" style="float: right;">
                                            <div>
                                                <a href="https://goo.gl/maps/fpeE5Ngf51N2" target="_blank" class="" style="color:white;">
                                                    <?=$this->lang->line('google_map')?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    1719 64th Street, STE 200, Emeryville, CA 94608, United States
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <form name="frm-contact">
                        <select name="type" class="selectpicker">
                            <option value="<?=$this->lang->line('contact_submit_type1')?>"><?=$this->lang->line('contact_submit_type1')?></option>
                            <option value="<?=$this->lang->line('contact_submit_type2')?>"><?=$this->lang->line('contact_submit_type2')?></option>
                            <option value="<?=$this->lang->line('contact_submit_type3')?>"><?=$this->lang->line('contact_submit_type3')?></option>
                        </select>

                        <div class="input-group full">
                            <input type="text" name="title" class="form-control" placeholder="<?=$this->lang->line('contact_text3')?>">
                        </div>

                        <div class="input-group full">
                            <input type="text" name="contact" class="form-control" placeholder="<?=$this->lang->line('contact_text4')?>">
                        </div>

                        <div class="input-group full">
                            <textarea name="content" class="form-control" placeholder="<?=$this->lang->line('contact_text5')?>"></textarea>
                        </div>
                    </form>

                    <a href="javascript:send_contact()" id="btn-contact-send">SEND</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var offset_section_head = $('#section-head').offset().top;

    $(window).scroll(function(){
        var cur_offset = $(window).scrollTop();

        if(cur_offset>offset_section_head-100){
            if($('#section-head').hasClass('event')){
                $('#section-head').removeClass('event');
            }
        }
    });


    function send_contact(){
        var form = $('form[name="frm-contact"]');

        if(!confirm('<?=$this->lang->line('contact_text1')?>')) return;

        $.ajax({
            type:'post',
            url:'<?=base_url()?>index/contact_send',
            data:form.serialize(),
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('<?=$this->lang->line('contact_text2')?>');
                    location.reload();
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
                alert('error');
            }
        })
    }
</script>