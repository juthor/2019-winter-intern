<link rel="stylesheet" href="<?=base_url()?>css/particles.css"/>
<!--<link href="https://vjs.zencdn.net/7.4.1/video-js.css" rel="stylesheet">-->
<style>
    .head-title{display:table;width:100%;height:calc(100vh);background-image:url('<?=IMAGEPATH?>header_bg/bg02.jpg');background-size:100%;background-size:cover;background-position:center top;}
    .head-title>.inner{display:table-cell;vertical-align:bottom;padding-bottom:160px;}

    #section-head .slogan .writeyour{letter-spacing:7px;}
    #section-head .slogan .specialstory{letter-spacing:6px;}
    #section-head .slogan p{color:#fff; line-height:40px;font-size:15px;margin:0;letter-spacing:1.1px;}


    #body>.about_contents_2{display:block;width:100%;height:calc(100vh);background-image:url('<?=IMAGEPATH?>assets/bg_about_01.jpg');background-size:cover;background-position:center;background-repeat:no-repeat;overflow: hidden;}
    #body>.about_contents_2>.container>.inner{vertical-align:top; padding-top: 100px;}

    #body>.content .videos{width:100%;height:calc(50vh);background-size:cover;background-position:center;background-repeat:no-repeat;align-content:center; display: block; padding-top: 100px;}
    #body>.content .videos .video-wrap{width:57%;float:left;margin-left:10%;position:relative;}
    #body>.content .videos .video-wrap .video{width:100%;}
    #body>.content .videos .video-wrap .video>video{width:100%;height:auto;}
    #body>.content .videos .video-nav{float:left;width:25%;position:relative;padding-bottom:240px;}
    #body>.content .videos .video-nav>ul{display:inline-block;}
    #body>.content .videos .video-nav>ul>li{position:relative;padding-left:180px;margin-bottom:50px;}
    #body>.content .videos .video-nav>ul>li:after{display:block;content:'';width:117px;height:3px;background-color:#707070;position:absolute;left:0;top:50%;margin-top:-1px;}
    #body>.content .videos .video-nav>ul>li>a{font-weight: bold; color:#575250;font-size:0.9em;padding-right:30px;background-image:url('<?=IMAGEPATH?>assets/icon_about_video_off.png');background-size:contain;background-position:right center;background-repeat:no-repeat;}
    #body>.content .videos .video-nav>ul>li.active>a{background-image:url('<?=IMAGEPATH?>assets/icon_about_video_on.png');}
    #body>.content .videos .video-wrap .b-text{position:absolute;right:-375px;bottom:0;margin:0;width:350px;word-break:keep-all;line-height:30px;font-weight:700;font-size:15px;}
    #body>.content .videos .video-wrap .b-text>.row2{letter-spacing:1.3px;}

    #body>.about_contents_3 {height:calc(100vh);text-align:center;padding:200px 0;background-image:url('<?=IMAGEPATH?>assets/bg_about_radius.png');background-size:1200px;background-position:center;background-repeat:no-repeat; display: block;}
    #body>.about_contents_3  h3{margin:0 0 80px 0;font-size:50px;}
    #body>.about_contents_3  p{margin-bottom:100px;}
    #body>.about_contents_3  #btn-redirect-cellyshop{display:inline-block;padding:30px 170px;background-color:#8a99e5;color:#fff;font-size:1.6em;}

    #body>.foot{width:100%;height:calc(100vh);display:table;background-image:url('<?=IMAGEPATH?>assets/bg_about_02.jpg');background-size:cover;background-position:center;background-repeat:no-repeat;}
    #body>.foot>.inner{display:table-cell;vertical-align:middle;padding-top:300px;}
    .location{}
    .location #location-map{width:100%;height:600px;background-color:#999;}

    .contact-us{padding-top:80px;}
    .contact-us>.container{position:relative;}
    .contact-us h2{font-size:5em;font-weight:100;margin:0;position:absolute;left:0;top:-120px;}
    @media screen and (max-width:1300px){
        #body>.content .videos{width:100%;height:calc(100vh);}
        #body>.content .videos .video-nav{text-align: right;}
        #body>.content .videos .video-wrap{float:none;width:100%;margin-left:0;}
        #body>.content .videos .video-wrap .b-text{right:0;position:relative;}
        #body>.content .videos .video-wrap .b-text{text-align: center; width: 100%;}
        #body>.content .videos .video-nav{float:none;width:100%;margin-top:30px;padding-bottom:0;}
        #body>.content .videos .video-nav>ul>li{margin-bottom:30px;}
    }
    @media screen and (max-width:1100px){
        #body>.about_contents_3 #btn-redirect-cellyshop{display:inline-block;padding:20px 150px;background-color:#8a99e5;color:#fff;font-size:1.2em;}
    }
    @media screen and (max-width:500px){
        #body>.about_contents_3 #btn-redirect-cellyshop{display:inline-block;padding:10px 120px;background-color:#8a99e5;color:#fff;font-size:1em;}
    }
</style>
<div id="body">
    <div style="height: 75px;"></div>
    <div class="head-title">
        <div class="inner slogan">
            <div class="container">
                <h2 class="font-camelia motion-down title-colored"><br>With <span class="black_bg">Celly Story</span><br><span class="writeyour">Write your</span><br><span class="specialstory">special story</span></h2>
                <p class="motion-up text-white"><?=$this->lang->line('header_slogan_text')?></p>
            </div>
        </div>
    </div>
    <div id="index-wrap">

    </div>

    <div class="about_contents_2 event" id="section-head">
        <div class="container" style="height: 100%">
            <div class="inner" style="width: 100%;">
                    <h2 class="font-camelia motion-down title-white">The best<br>customized<br>solution for you</h2>
            </div>
            <div class="sub-text" style="margin-top: 100px;">
                <p class="motion-down text-black-right-bold"><?=$this->lang->line('about_text1')?></p>
                <p class="motion-up text-black-right"><?=$this->lang->line('about_text2')?></p>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="videos" id="section-video">
            <div class="container">
                <div class="video-wrap">
                    <div class="video hide" data-id="1">
                        <video class="video-js" poster="<?=base_url()?>video/v1_poster.jpg" autoplay="true" loop="" playsinline="" muted="" data-keepplaying>
                            <source src="<?=base_url()?>video/v1.mp4" type="video/mp4">
                        </video>
                    </div>

                    <div class="video hide" data-id="2">
                        <video class="video-js" poster="<?=base_url()?>video/v1_poster.jpg" autoplay="true" loop="" playsinline="" muted="" data-keepplaying>
                            <source src="<?=base_url()?>video/v2.mp4" type="video/mp4">
                        </video>
                    </div>

                    <div class="video hide" data-id="3">
                        <video class="video-js" poster="<?=base_url()?>video/v1_poster.jpg" autoplay="true" loop="" playsinline="" muted="" data-keepplaying>
                            <source src="<?=base_url()?>video/v3.mp4" type="video/mp4">
                        </video>
                    </div>

                    <div class="b-text">
                        <p class="text-black-center-bold"><?=$this->lang->line('about_text3')?></p>
                    </div>
                </div>

                <div class="video-nav"">
                    <ul>
                        <li data-id="1"><a class="video-text-black-center-bold" href="javascript:play_video(1)">Video 01</a></li>
                        <li data-id="2"><a class="video-text-black-center-bold" href="javascript:play_video(2)">Video 02</a></li>
                        <li data-id="3"><a class="video-text-black-center-bold" href="javascript:play_video(3)">Video 03</a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div></div>
<div style="height: 75px;"></div>
    <div class="about_contents_3 event" id="section-cellyshop">
        <h2 class="font-camelia motion-down title-black">What is Celly Shop?</h2>
        <p class="motion-up text-black-center"><?=$this->lang->line('about_text4')?></p>
        <a href="javascript:go_cellyshop()" id="btn-redirect-cellyshop">Celly shop</a>
    </div>
    <div class="foot event" id="section-foot" style="background-color: blue;">
        <div class="inner">
            <div class="container">
                <h2 class="font-camelia motion-down title-black">Your own<br>custom solution</h2>
                <p class="motion-up text-black"><?=$this->lang->line('about_text5')?></p>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>js/anime.min.js"></script>
<script src="<?=base_url()?>js/particles.js?v2"></script>
<script src="https://vjs.zencdn.net/7.4.1/video.js"></script>
<script>
    $(function(){
        play_video(1);
    });

    var offset_section_head = $('#section-head').offset().top;
    var offset_section_video = $('#section-video').offset().top;
    var offset_section_cellyshop = $('#section-cellyshop').offset().top - ($(window).height()/2);
    var offset_section_foot = $('#section-foot').offset().top - ($(window).height()/2);

    $(window).scroll(function(){
        var cur_offset = $(window).scrollTop();

        console.log('cur offset:'+cur_offset);
        console.log('offset_section_head:'+offset_section_head);

        if(cur_offset>=offset_section_head){
            if($('#section-head').hasClass('event')){
                $('#section-head').removeClass('event');
            }
        }

        if(cur_offset>=offset_section_cellyshop){
            if($('#section-cellyshop').hasClass('event')){
                $('#section-cellyshop').removeClass('event');
            }
        }

        if(cur_offset>=offset_section_foot){
            if($('#section-foot').hasClass('event')){
                $('#section-foot').removeClass('event');
            }
        }
    });

    function go_cellyshop(){
        var particles = new Particles('#btn-redirect-cellyshop');
        particles.disintegrate();
        setTimeout(function(){
            location.href='https://smartstore.naver.com/cellyshop';
        },1000);
    }

    function play_video(id){
        $('.video-wrap>.video').addClass('hide');
        $('.video-wrap>.video[data-id="'+id+'"]').removeClass('hide');

        $('.video-nav>ul>li').removeClass('active');
        $('.video-nav>ul>li[data-id="'+id+'"]').addClass('active');

        $('.video-wrap>.video>video').currentTime = 0;
        //$('.video-wrap>.video>video').pause();
    }
</script>