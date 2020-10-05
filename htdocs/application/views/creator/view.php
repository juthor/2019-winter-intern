<link rel="stylesheet" href="<?=base_url()?>css/bootstrap-slider.css"/>
<link rel="stylesheet" href="<?=base_url()?>css/nanoscroller.css"/>
<!--<link rel="stylesheet" href="--><?//=base_url()?><!--css/demo.css"/>-->
<!--<link rel="stylesheet" href="--><?//=base_url()?><!--css/icons.css"/>-->
<style>
    <?
    switch($creator['bg_type']){
        case 'm': echo "body{background-image:url('".IMAGEPATH."assets/bg_creator_archives_2.jpg');}"; break;
        case 'f': echo "body{background-image:url('".IMAGEPATH."assets/bg_creator_archives_1.jpg');}"; break;
        case 'a': echo "body{background-image:url('".IMAGEPATH."assets/bg_creator_archives_3.jpg');}"; break;
    }
    ?>
    body{background-size:cover;background-position:center;background-attachment:fixed;}
    .info{display:table;width:100%;height:calc(100vh);background-color:#fff;}
    .info>.inner{display:table-cell;vertical-align:middle;}
    .info h2{margin:0;font-size:8em;line-height:125px;font-weight:100;}
    .info .info-wrap{margin-left:0;margin-right:0;}
    .info .info-wrap .chart{}
    .info .info-wrap .chart p.channel{font-size:17px;}
    .info .info-wrap .chart p.channel>span{display:inline-block;}
    .info .info-wrap .chart p.channel>span.first{margin-right:24px;}
    .info .info-wrap .chart #btn-open-support{display:block;text-align:center;padding:12px 0;border:1px solid #333;color:#333;margin-top:15px;}
    .info .info-wrap .chart #btn-open-support:hover{background-color:#333;color:#fff;}
    .info .info-wrap .profiles{padding-left:50px;padding-right:0;position:relative;}
    .info .info-wrap .profiles .profile{padding:0 5px;position:relative;}
    .info .info-wrap .profiles .profile .image{width:100%;padding-bottom:100%;margin-bottom:20px;background-size:cover;background-position:center;}
    /*.info .info-wrap .profiles .profile .bar{position:absolute;left:0;top:0;width:2px;height:100%;background-color:red;}*/
    .info .info-wrap .profiles .lSSlideWrapper{position:static;}
    .info .info-wrap .profiles .lSAction{position:absolute;left:0;top:50%;margin-top:-32px;}
    .info .info-wrap .profiles .lSAction>a{display:block;position:relative;left:0;top:0;bottom:0;right:0;margin:0;width:32px;height:32px;line-height:32px;text-align:center;}
    .info .info-wrap .profiles .lSAction>.lSPrev:before{display:inline;content:'\f053';font-family:Font Awesome\ 5 Free;font-weight:900;}
    .info .info-wrap .profiles .lSAction>.lSNext:before{display:inline;content:'\f054';font-family:Font Awesome\ 5 Free;font-weight:900;}

    .archives{padding:100px 0;}
    .archives .arc-category{}
    .archives .arc-category>li{float:left;}
    .archives .arc-category>li>a{display:block;font-size:13px;font-weight:700;color:#fff;border-bottom:2px solid #fff;padding-bottom:17px;}
    .archives .arc-category>li>a small{padding-left:9px;}
    .archives .arc-category:after{display:block;content:'';clear:both;}
    .archives .arc-type-wrap{text-align:right;}
    .archives .arc-type{display:inline-block;}
    .archives .arc-type:after{display:block;content:'';clear:both;}
    .archives .arc-type>li{float:left;margin-left:14px;}
    .archives .arc-type>li>a{display:block;color:#fff;font-weight:700;}
    .archives .arc-type>li>a[data-id="all"]{font-size:13px;width:34px;padding-bottom:10px;text-align:center;border-bottom:4px solid #fff;}
    .archives .arc-type>li>a[data-id="insfa"]{border:4px solid #fff;width:38px;height:38px;}
    .archives .arc-type>li>a[data-id="blog"]{border:4px solid #fff;width:37px;height:57px;}
    .archives .arc-type>li>a[data-id="youtube"]{border:4px solid #fff;width:47px;height:37px;}

    .archives .arc-list{margin-left:-10px;margin-right:-10px;}

    #modal-content-view{}
    #modal-content-view .modal-dialog{margin-top:50px;}
    #modal-content-view .modal-content{overflow:visible!important;}
    #modal-content-view .btn-close{position:absolute;right:-6px;top:-30px;display:block;width:30px;height:30px;line-height:30px;text-align:center;color:#fff;font-size:2em;}
    #modal-content-view .btn-close:before{display:inline;content:'\f00d';font-family:Font Awesome\ 5 Free;font-weight:900;}
    #modal-content-view .modal-body{background-color:#fff;}
    #modal-content-view .modal-body .table>tbody>tr>th{width:150px;vertical-align:top;font-weight:400;}
    #modal-content-view .modal-body .table>tbody>tr>th>strong{display:block;margin-bottom:10px;font-weight:700;}
    #modal-content-view .modal-body .table>tbody>tr>td img{width:100%;}

    #modal-support .modal-header{background-color:pink;border:0;}
    #modal-support .modal-header>.title{visibility: hidden;}
    #modal-support .modal-header>.btn-close{color:#333;font-size:2em;}
    #modal-support .modal-body{}
    #modal-support .modal-body .btn-close{display:inline-block;padding:12px;color:#333;}
    #modal-support .slider{width:100%;}
    #modal-support .slider-selection{background-color:yellow;}
    #modal-support .slider .tooltip{width:69px;}
    #modal-support .slider .tooltip-inner{background-color:#fff;color:#333;font-size:13pt;}
    #modal-support .slider .tooltip.top .tooltip-arrow{border-top-color:#fff;}
    #modal-support #btn-do-support{display:inline-block;padding:12px 20px;background-color:#f7f7f7;color:#333;}
    #modal-support .table>tbody>tr>th{}
    #modal-support .table>tbody>tr>th,
    #modal-support .table>tbody>tr>td{border:0;vertical-align:middle;}
    #modal-support .input-group{border:1px solid #333;}
    #modal-support .input-group>input{background-color:transparent;}

    #body[data-type="m"] .info h2{color:#8a99e5;}
    #body[data-type="m"] .info .info-wrap .chart #btn-open-support{border:1px solid #8a99e5;}
    #body[data-type="m"] .info .info-wrap .chart #btn-open-support:hover{background-color:#8a99e5;}
    #modal-support[data-type="m"] .modal-content{background-color:#8a99e5;}
    #modal-support[data-type="m"] .modal-header{background-color:#8a99e5;}
    #modal-support[data-type="m"] .modal-body{background-color:#8a99e5;}
    #modal-support[data-type="m"] .slider-handle{background-color:#2185c5;background-image:none;}
    #modal-support[data-type="m"] .modal-body .td-support-amount{color:#2185c5;}

    #body[data-type="f"] .info h2{color:#ffc2c6;}
    #body[data-type="f"] .info .info-wrap .chart #btn-open-support{border:1px solid #ebced0;}
    #body[data-type="f"] .info .info-wrap .chart #btn-open-support:hover{background-color:#ebced0;}
    #modal-support[data-type="f"] .modal-content{background-color:#ebced0;}
    #modal-support[data-type="f"] .modal-header{background-color:#ebced0;}
    #modal-support[data-type="f"] .modal-body{background-color:#ebced0;}
    #modal-support[data-type="f"] .slider-handle{background-color:#ee00c4;background-image:none;}
    #modal-support[data-type="f"] .modal-body .td-support-amount{color:#ee00c4;}

    #body[data-type="a"] .info h2{color:#b2eec3;}
    #body[data-type="a"] .info .info-wrap .chart #btn-open-support{border:1px solid #b2eec3;}
    #body[data-type="a"] .info .info-wrap .chart #btn-open-support:hover{background-color:#b2eec3;color:#333;}
    #modal-support[data-type="a"] .modal-content{background-color:#b2eec3;}
    #modal-support[data-type="a"] .modal-header{background-color:#b2eec3;}
    #modal-support[data-type="a"] .modal-body{background-color:#b2eec3;}
    #modal-support[data-type="a"] .slider-handle{background-color:#3db860;background-image:none;}
    #modal-support[data-type="a"] .modal-body .td-support-amount{color:#3db860;}

    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    #chartjs-tooltip {
        opacity: 1;
        position: absolute;
        background: rgba(0, 0, 0, .7);
        color: white;
        border-radius: 3px;
        -webkit-transition: all .1s ease;
        transition: all .1s ease;
        pointer-events: none;
        -webkit-transform: translate(-50%, 0);
        transform: translate(-50%, 0);
    }

    .chartjs-tooltip-key {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin-right: 10px;
    }

    .chart-scroll{width:100%;overflow-x:scroll;overflow-y:hidden;position:relative;}
    .chart-wrap{width:3000px;height:275px;/*padding:0 50px;*/}
    .chart-wrap #support_chart{}
    #chartjs-tooltip{width:100px;}

    .nano {width: 100%; height: 200px; position:relative;}
    .nano .nano-content {background-color:#fff;}
    .nano .nano-pane   { background: #efefef; border-radius:0;display:block!important;}
    .nano .nano-slider { background: #111; border-radius:0!important;}

    @media screen and (min-width:1200px){
        .archives>.container{width:100%;padding-left:308px;padding-right:308px;}
    }

    @media screen and (min-width:1300px){
        .info>.inner>.container{width:calc(100vw);padding:0 0 0 114px;}
        #modal-support .modal-dialog{width:1300px;}
        #modal-support .modal-body{padding:0 65px 42px 70px;}
        #modal-support .table{margin-top:10px;margin-bottom:100px;}
        #modal-support .table>tbody>tr>th{font-size:30px;font-weight:300;padding-left:0;padding-right:0;width:266px;}
        #modal-support .table>tbody>tr>td{font-size:30px;font-weight:700;}
        #modal-support .input-group{width:154px;}
        #modal-support .max-amount{margin-bottom:25px;}
        #modal-support .support-note{margin-top:20px;}
        #modal-support #btn-do-support{width:353px;height:58px;line-height:58px;text-align:center;padding:0;font-size:24px;font-weight:700;}

        .info .info-wrap .profile-wrap{position:absolute;left:0;top:0;width:100%;}
        .info .info-wrap .profiles .profile{height:calc((100vh - 723px)/2 + 441px);width:365px!important;}
        .info .info-wrap .profiles .profile:after{position:absolute;left:-2px;bottom:0;width:2px;height:60px;background-color:#e1e1e1;display:block;content:'';}
    }

    @media screen and (min-width:1800px){

        .info .info-wrap .chart{width:574px;padding-left:0;padding-right:0;}
        .info .info-wrap .chart p.channel{margin-bottom:73px;}
        .info .info-wrap .profiles{padding-left:98px;float:right;}
        .info .info-wrap .profiles .profile{padding:0;width:390px!important;height:calc((100vh - 723px)/2 + 474px);}
        .info .info-wrap .profiles .profile .data{font-size:20px;}

        .info .info-wrap .profile-wrap{position:absolute;left:0;top:0;width:100%;padding-left:100px;height:calc((100vh - 723px)/2 + 474px);}
        .info .info-wrap .profile-list{}
        .info .info-wrap .profiles .profile{height:calc((100vh - 723px)/2 + 474px);}
        .info .info-wrap .profiles .profile:after{position:absolute;left:-2px;bottom:0;width:2px;height:60px;background-color:#e1e1e1;display:block;content:'';}
        .info .info-wrap .profiles .profile .data p{margin:13px 0 0 0;}

        .info .info-wrap .profiles .lSAction>a{left:15px;}


        #modal-support #btn-do-support{height:59px;line-height:59px;}
    }

    @media screen and (max-width:767px){
        .archives .arc-type-wrap{text-align:left;margin-top:15px;}

        .info{display:block;height:auto;padding:60px 0;}
        .info h2{font-size:5em;}
        .info>.inner{display:block;}
        .info .info-wrap .chart{margin-bottom:30px;}
        .info .info-wrap .profiles{padding-left:0;}
        .info .info-wrap .profiles .lSSlideWrapper{position:relative;}
        /*.info .info-wrap .profiles .profile{width:300px!important;}*/
    }
</style>

<div id="body" data-type="<?=$creator['bg_type']?>">
    <style>
        .grid{font-size:19px;display:block;position:relative;list-style-type:none;margin-bottom:40px;}
        .grid:after{display:block;content:'';clear:both;}
        .grid>li{position:absolute;top:0;}
        .grid>li.view{right:70px;color: rgb(192, 193, 195);}
        .grid>li.like{right:0;}
        .grid>li>button{background-color:transparent;border:0;outline:none;color: rgb(192, 193, 195);padding-right:0;}
        .grid>li>button[isactive="1"]{color: rgb(243, 81, 133);}
    </style>




    <div class="info">
        <div class="inner">
            <div class="container">
                <h2 class="font-camelia"><?=$creator['first_name']?><?=$creator['last_name']?></h2>

                <div class="row info-wrap">
                    <div class="col-sm-4 col-xs-12 chart">
                        <?
                        $likes = json_decode(get_cookie('creator_likes'));
                        ?>
                        <ol class="grid">
                            <li class="grid__item view">
                                <span class="far fa-eye"></span> <?=$creator['views']?>
                            </li>
                            <li class="grid__item like">
                                <button class="icobutton icobutton--heart active" isactive="<?=(is_array($likes) && in_array($creator['idx'],$likes))?'1':'0'?>" onClick="set_likes()"><span class="fa fa-heart"></span><span class="icobutton__text icobutton__text--side"> <?=$creator['likes']?></span></button>
                            </li>
                        </ol>

                        <p class="channel text-right"><span class="first"><?=$this->lang->line('creator_text1')?>:<?=$creator['active_channel']?></span><span><?=$this->lang->line('creator_text2')?>:<?=$creator['active_part']?></span></p>
                        <!--
                        <div class="nano chart-scroll">
                            <div class="nano-content">
                                <canvas id="support_chart"></canvas>
                            </div>
                        </div>
                        -->

                        <div class="chart-scroll">
                            <div class="chart-wrap">
                                <canvas id="support_chart"></canvas>
                            </div>
                        </div>

                        <a href="javascript:open_support()" id="btn-open-support"><?=$this->lang->line('creator_text3')?></a>
                    </div>

                    <div class="col-sm-8 col-xs-12 profiles">
                        <div class="profile-wrap">
                            <div class="profile-list">
                                <?
                                if(is_array($profiles) && count($profiles)>0){
                                    foreach($profiles as $profile){
                                        ?>
                                        <div class="profile">
                                            <div class="image" style="background-image:url('<?=IMAGEPATH?>creator/profile/<?=$profile['image']?>');"></div>
                                            <div class="data">
                                                <strong><?=$profile['title']?></strong>
                                                <p><?=$profile['year']?></p>
                                            </div>
                                            <div class="bar"></div>
                                        </div>
                                        <?
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?=base_url()?>js/mo.min.js"></script>
    <script>
        function isIOSSafari() {
            var userAgent;
            userAgent = window.navigator.userAgent;
            return userAgent.match(/iPad/i) || userAgent.match(/iPhone/i);
        };

        // taken from mo.js demos
        function isTouch() {
            var isIETouch;
            isIETouch = navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
            return [].indexOf.call(window, 'ontouchstart') >= 0 || isIETouch;
        };

        // taken from mo.js demos
        var isIOS = isIOSSafari(),
            clickHandler = isIOS || isTouch() ? 'touchstart' : 'click';

        function extend( a, b ) {
            for( var key in b ) {
                if( b.hasOwnProperty( key ) ) {
                    a[key] = b[key];
                }
            }
            return a;
        }

        function Animocon(el, options) {
            this.el = el;
            this.options = extend( {}, this.options );
            extend( this.options, options );

            var isactive = el.getAttribute('isactive');
            console.log('isactive:'+isactive);
            if(isactive=="1"){
                this.checked = true;
            }else{
                this.checked = false;
            }


            this.timeline = new mojs.Timeline();

            for(var i = 0, len = this.options.tweens.length; i < len; ++i) {
                this.timeline.add(this.options.tweens[i]);
            }

            var self = this;
            this.el.addEventListener(clickHandler, function() {
                if( self.checked ) {
                    self.options.onUnCheck();
                }
                else {
                    self.options.onCheck();
                    self.timeline.replay();
                }
                self.checked = !self.checked;
            });
        }

        Animocon.prototype.options = {
            tweens : [
                new mojs.Burst({})
            ],
            onCheck : function() { return false; },
            onUnCheck : function() { return false; }
        };

        var items = [].slice.call(document.querySelectorAll('ol.grid > .grid__item'));
        var el14 = items[1].querySelector('button.icobutton');
        var el14span = el14.querySelector('span');
        var el14counter = el14.querySelector('span.icobutton__text');
        new Animocon(el14, {
            tweens : [
                // ring animation
                new mojs.Shape({
                    parent: el14,
                    duration: 750,
                    type: 'circle',
                    radius: {0: 40},
                    fill: 'transparent',
                    stroke: '#F35186',
                    strokeWidth: {35:0},
                    opacity: 0.2,
                    top: '45%',
                    easing: mojs.easing.bezier(0, 1, 0.5, 1)
                }),
                new mojs.Shape({
                    parent: el14,
                    duration: 500,
                    delay: 100,
                    type: 'circle',
                    radius: {0: 20},
                    fill: 'transparent',
                    stroke: '#F35186',
                    strokeWidth: {5:0},
                    opacity: 0.2,
                    x : 40,
                    y : -60,
                    easing: mojs.easing.sin.out
                }),
                new mojs.Shape({
                    parent: el14,
                    duration: 500,
                    delay: 180,
                    type: 'circle',
                    radius: {0: 10},
                    fill: 'transparent',
                    stroke: '#F35186',
                    strokeWidth: {5:0},
                    opacity: 0.5,
                    x: -10,
                    y: -80,
                    isRunLess: true,
                    easing: mojs.easing.sin.out
                }),
                new mojs.Shape({
                    parent: el14,
                    duration: 800,
                    delay: 240,
                    type: 'circle',
                    radius: {0: 20},
                    fill: 'transparent',
                    stroke: '#F35186',
                    strokeWidth: {5:0},
                    opacity: 0.3,
                    x: -70,
                    y: -10,
                    easing: mojs.easing.sin.out
                }),
                new mojs.Shape({
                    parent: el14,
                    duration: 800,
                    delay: 240,
                    type: 'circle',
                    radius: {0: 20},
                    fill: 'transparent',
                    stroke: '#F35186',
                    strokeWidth: {5:0},
                    opacity: 0.4,
                    x: 80,
                    y: -50,
                    easing: mojs.easing.sin.out
                }),
                new mojs.Shape({
                    parent: el14,
                    duration: 1000,
                    delay: 300,
                    type: 'circle',
                    radius: {0: 15},
                    fill: 'transparent',
                    stroke: '#F35186',
                    strokeWidth: {5:0},
                    opacity: 0.2,
                    x: 20,
                    y: -100,
                    easing: mojs.easing.sin.out
                }),
                new mojs.Shape({
                    parent: el14,
                    duration: 600,
                    delay: 330,
                    type: 'circle',
                    radius: {0: 25},
                    fill: 'transparent',
                    stroke: '#F35186',
                    strokeWidth: {5:0},
                    opacity: 0.4,
                    x: -40,
                    y: -90,
                    easing: mojs.easing.sin.out
                }),
                // icon scale animation
                new mojs.Tween({
                    duration : 1200,
                    easing: mojs.easing.ease.out,
                    onUpdate: function(progress) {
                        if(progress > 0.3) {
                            var elasticOutProgress = mojs.easing.elastic.out(1.43*progress-0.43);
                            el14span.style.WebkitTransform = el14span.style.transform = 'scale3d(' + elasticOutProgress + ',' + elasticOutProgress + ',1)';
                        }
                        else {
                            el14span.style.WebkitTransform = el14span.style.transform = 'scale3d(0,0,1)';
                        }
                    }
                })
            ],
            onCheck : function() {
                el14.style.color = '#F35186';
                el14counter.innerHTML = Number(el14counter.innerHTML) + 1;
            },
            onUnCheck : function() {
                el14.style.color = '#C0C1C3';
                var current = Number(el14counter.innerHTML);
                el14counter.innerHTML = current > 1 ? Number(el14counter.innerHTML) - 1 : '';
            }
        });
    </script>

    <?if($contents_cnt>0){?>
    <div class="archives">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <ul class="arc-category">
                        <li><a><span class="arc-type-text">PORTFOLIO</span> <small>(<span class="arc-type-cnt"><?=$contents_cnt?></span>)</small></a></li>
                    </ul>
                </div>

                <div class="col-sm-6 arc-type-wrap">
                    <ul class="arc-type">
                        <li><a href="javascript:get_arc('all')" data-id="all">ALL</a></li>
                        <li><a href="javascript:get_arc('insfa')" data-id="insfa"></a></li>
                        <li><a href="javascript:get_arc('nblog')" data-id="blog"></a></li>
                        <li><a href="javascript:get_arc('youtube')" data-id="youtube"></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <style>
            .arc-list .arc{width:25%;padding:20px 10px;}
            .arc-list .arc a{display:block;width:100%;}
            .arc-list .arc[data-type="1"] .image{width:100%;padding-bottom:100%;} /* 인스타 */
            .arc-list .arc[data-type="2"] .image{width:100%;padding-bottom:150%;} /* 블로그 */
            .arc-list .arc[data-type="3"] .image{width:100%;padding-bottom:50%;} /* 유튜브 */
            .arc-list .arc a .image{background-size:cover;background-position:center;box-shadow:0 3px 10px rgba(0,0,0,0.4);}
            .arc-list .arc a .data{padding:10px;}
            .arc-list .arc a .data>p{margin:0;color:#fff;}
            .arc-list .arc a .data>p>small{display:block;margin-top:13px;}

            @media screen and (max-width:767px){
                .arc-list .arc{width:50%;}
            }
        </style>

        <div class="container">
            <div class="arc-list"></div>
        </div>
    </div>
    <?}?>
</div>

<div class="modal" id="modal-content-view">
    <div class="modal-dialog">
        <div class="modal-content">
            <a data-dismiss="modal" class="btn-close"></a>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<div class="modal" id="modal-support" data-type="<?=$creator['bg_type']?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><span class="title"><?=$this->lang->line('creator_support_text1')?></span><a data-dismiss="modal" class="btn-close"></a></div>
            <div class="modal-body">
                <form name="frm-support">
                    <input type="hidden" name="creator_idx" value="<?=$creator['idx']?>">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th><?=$this->lang->line('creator_support_text2')?></th>
                            <td>
                                <div class="input-group">
                                    <input type="text" name="user_name" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><?=$this->lang->line('creator_support_text3')?></th>
                            <td class="td-support-amount">
                                <span id="support-amount">00,000</span><?=$this->lang->line('creator_support_text4')?>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="text-right max-amount">500,000</div>
                    <input type="hidden" name="amount">
                </form>

                <div class="text-right">
                    <ul class="support-note" style="margin:10px 0;">
                        <li>- <?=$this->lang->line('creator_support_text5')?></li>
                        <li>- <?=$this->lang->line('creator_support_text6')?></li>
                    </ul>

                    <a href="javascript:do_support()" id="btn-do-support"><?=$this->lang->line('creator_support_text1')?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>js/masonry.pkgd.min.js"></script>
<script src="<?=base_url()?>js/bootstrap-slider.js?v2"></script>
<script src="<?=base_url()?>js/jquery.number.min.js"></script>
<script src="<?=base_url()?>js/jquery.fitvids.js"></script>
<script src="<?=base_url()?>js/jquery.waitforimages.js"></script>
<script src="<?=base_url()?>js/jquery.prettyembed.js"></script>
<script src="<?=base_url()?>js/jquery.nanoscroller.min.js"></script>
<script src="//cdn.bootpay.co.kr/js/bootpay-2.0.12.min.js" type="application/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
<script>
    var creator_idx = '<?=$creator['idx']?>';

    var arc_masonry;

    $(function(){
        // arc_masonry = $('.arc-list').masonry({
        //     // options
        //     itemSelector: '.arc.show'
        // });

        get_arc('all');

        // $(".nano").nanoScroller({
        //     alwaysVisible: true
        // });

        $('.profile-list').lightSlider({
            item:3,
            loop:true,
            //auto:true,
            autoWidth:true,
            //pause:3000,
            slideMargin:85,
            speed:1500,
            pager:false,
            controls:true,
            responsive : [
                {
                    breakpoint:1299,
                    settings:{
                        item:3,
                        slideMove:1,
                        slideMargin:0,
                        autoWidth:false
                    }
                },
                {
                    breakpoint:767,
                    settings: {
                        autoWidth:false,
                        item:1,
                        slideMove:1,
                        slideMargin:0,
                        controls:false
                    }
                }
            ]
        });

        $('#modal-content-view').on('hide.bs.modal', function (e) {
            $('#modal-content-view').find('.modal-body').html('');
        });

        set_support_chart();

        $(window).load(function() {
            $(".chart-scroll").scrollLeft($(".chart-wrap").width());

            /*
            var $gal = $(".chart-scroll"),
                galW = $gal.outerWidth(true),
                galSW = $gal[0].scrollWidth,
                wDiff = (galSW / galW) - 1, // widths difference ratio
                mPadd = 60, // mousemove Padding
                damp = 20, // Mmusemove response softness
                mX = 0, // real mouse position
                //mX2 = $(".chart-wrap").width(), // modified mouse position
                //posX = $(".chart-wrap").width(),
                mX2 = 0, // modified mouse position
                posX = 0,
                mmAA = galW - (mPadd * 2), // the mousemove available area
                mmAAr = (galW / mmAA); // get available mousemove didderence ratio
            $gal.mousemove(function(e) {
                mX = e.pageX - $(this).parent().offset().left - this.offsetLeft;
                mX2 = Math.min(Math.max(0, mX - mPadd), mmAA) * mmAAr;
            });
            setInterval(function() {
                posX += (mX2 - posX) / damp; // zeno's paradox equation "catching delay"
                $gal.scrollLeft(posX * wDiff);
            }, 10);
            */
        });
    });

    function get_arc(type){
        $.ajax({
            type:'post',
            url:'<?=base_url()?>creator/ajax/get_arc_list',
            data:{idx:creator_idx,type:type},
            dataType:'json',
            success:function(res){
                console.log(res);
                $('.arc-list').html(res.html);

                if(arc_masonry){
                    arc_masonry.masonry('destroy');
                }

                arc_masonry = $('.arc-list').masonry({
                    // options
                    itemSelector: '.arc'
                });

                $('.arc-type .arc-type-text').text(res.type_text);
                $('.arc-type .arc-type-cnt').text(res.contents_cnt);
            },
            error:function(){
                alert('error');
            }
        });
    }

    function open_content_view(idx){
        $.ajax({
            type:'post',
            url:'<?=base_url()?>creator/ajax/open_content_view',
            data:{idx:idx},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    var modal = $('#modal-content-view');
                    modal.find('.modal-header>.title').text(res.title);
                    modal.find('.modal-body').html(res.html);
                    modal.modal();
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
                alert('error');
            }
        });
    }

    var support_data = $.parseJSON('<?=json_encode($support_data)?>');
    var support_chart_label = new Array();
    var support_chart_data = new Array();
    var support_tooltip = new Array();
    $.each(support_data,function(idx,val){
        support_chart_label.push(val.label);
        support_chart_data.push(val.sum);

        var ttip = new Array();

        $.each(val.supporters,function(si,sval){
            ttip.push({
                'user_name':sval.user_name,
                'amount':sval.amount,
            });
        });

        support_tooltip.push(ttip);
    });

    //support_chart_label.reverse();
    //support_chart_data.reverse();
    //support_tooltip.reverse();

    function set_support_chart(){
        var customTooltips = function(tooltip) {
            // Tooltip Element
            var tooltipEl = document.getElementById('chartjs-tooltip');

            if (!tooltipEl) {
                tooltipEl = document.createElement('div');
                tooltipEl.id = 'chartjs-tooltip';
                tooltipEl.innerHTML = '<table></table>';
                this._chart.canvas.parentNode.appendChild(tooltipEl);
            }

            // Hide if no tooltip
            if (tooltip.opacity === 0) {
                tooltipEl.style.opacity = 0;
                return;
            }

            // Set caret Position
            tooltipEl.classList.remove('above', 'below', 'no-transform');
            if (tooltip.yAlign) {
                tooltipEl.classList.add(tooltip.yAlign);
            } else {
                tooltipEl.classList.add('no-transform');
            }

            function getBody(bodyItem) {
                return bodyItem.lines;
            }

            // tooltip.afterBody = [[21,44],[33,55],[33,55],[33,55],[33,55],[33,55]];
            // var supdata = [[11,44],[233,55],[33,55,77,53],[43,55],[53,55],[63,55]];

            // Set Text
            if (tooltip.body) {
                var titleLines = tooltip.title || [];
                var bodyLines = tooltip.body.map(getBody);

                // console.log('datapoint');
                // console.log(tooltip.dataPoints[0].index);
                // console.log(supdata[tooltip.dataPoints[0].index]);

                var innerHtml = '<thead>';

                titleLines.forEach(function(title) {
                    innerHtml += '<tr><th>' + title + '</th></tr>';
                });
                innerHtml += '</thead><tbody>';

                // console.log(bodyLines);

                var isTooltip = false;
                bodyLines.forEach(function(body, i) {
                    // console.log('body'+body);
                    // console.log('i:'+i);
                    var colors = tooltip.labelColors[i];
                    var style = 'background:' + colors.backgroundColor;
                    //style += '; border-color:' + colors.borderColor;
                    style += '; border-color:rgba(33, 145, 81, 0.2)';
                    style += '; border-width: 2px';
                    var span = '<span class="chartjs-tooltip-key" style="' + style + '"></span>';
                    //innerHtml += '<tr><td>' + span + body + '</td></tr>';

                    var supdataset = support_tooltip[tooltip.dataPoints[0].index];
                    supdataset.forEach(function(i,val){
                        isTooltip = true;
                        innerHtml += '<tr><td>'+i.user_name+'</td><td class="text-right">' + $.number(i.amount) +'</td></tr>';
                    });
                });
                innerHtml += '</tbody>';

                var tableRoot = tooltipEl.querySelector('table');
                tableRoot.innerHTML = innerHtml;


            }

            var positionY = this._chart.canvas.offsetTop;
            var positionX = this._chart.canvas.offsetLeft;

            // Display, position, and set styles for font
            tooltipEl.style.opacity = 1;
            tooltipEl.style.left = positionX + tooltip.caretX + 'px';
            tooltipEl.style.top = positionY + tooltip.caretY + 'px';
            tooltipEl.style.fontFamily = tooltip._bodyFontFamily;
            tooltipEl.style.fontSize = tooltip.bodyFontSize + 'px';
            tooltipEl.style.fontStyle = tooltip._bodyFontStyle;
            tooltipEl.style.padding = tooltip.yPadding + 'px ' + tooltip.xPadding + 'px';
        };

        var ctx = document.getElementById("support_chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: support_chart_label,
                datasets: [{
                    //label: '# of Votes',
                    data: support_chart_data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        // 'rgb(54, 162, 235, 0.2)',
                        // 'rgb(255, 206, 86, 0.2)',
                        // 'rgb(75, 192, 192, 0.2)',
                        // 'rgb(153, 102, 255, 0.2)',
                        // 'rgb(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        // 'rgb(54, 162, 235, 1)',
                        // 'rgb(255, 206, 86, 1)',
                        // 'rgb(75, 192, 192, 1)',
                        // 'rgb(153, 102, 255, 1)',
                        // 'rgb(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    enabled: false,
                    mode: 'index',
                    position: 'nearest',
                    custom: customTooltips
                },
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            color: "rgba(0, 0, 0, 0)",
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            display: false,
                            suggestedMin: 0,
                            beginAtZero: true
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, 0)",
                        }
                    }]
                }
            }
        });
    }

    function open_support(){
        var modal = $('#modal-support');
        modal.modal({
            keyboard:false,
            backdrop:'static'
        });

        modal.find('input[name="amount"]').val(1000);
        set_amount(1000);
        var amount_slider = modal.find('input[name="amount"]').slider({
            min:1000,
            max:500000,
            step:1000,
            tooltip:'always'
        });

        amount_slider.on('change',function(e){
            set_amount(e.value.newValue);
        });
    }

    function do_support(){
        var form = $('form[name="frm-support"]');
        
        $.ajax({
            type:'post',
            url:'<?=base_url()?>payment/support_preload',
            data:form.serialize(),
            dataType:'json',
            success:function(pay_res){
                console.log(pay_res);
                if(pay_res.code==1){
                    BootPay.request({
                        price: pay_res.pay_price, //실제 결제되는 가격
                        application_id: "<?=BP_KEY?>",
                        name: pay_res.item_name, //결제창에서 보여질 이름
                        pg: pay_res.pay_pg,
                        //method: pay_res.pay_method, //결제수단, 입력하지 않으면 결제수단 선택부터 화면이 시작합니다.
                        show_agree_window: 0, // 부트페이 정보 동의 창 보이기 여부
                        user_info: {
                            username: pay_res.user_name,
                            email: pay_res.user_email,
                            addr: ' ',
                            phone: ' '
                        },
                        order_id: pay_res.oid, //고유 주문번호로, 생성하신 값을 보내주셔야 합니다.
                        params: {},
                        account_expire_at: '<?=date('Y-m-d',strtotime(date('Y-m-d').' + 3 days'))?>', // 가상계좌 입금기간 제한 ( yyyy-mm-dd 포멧으로 입력해주세요. 가상계좌만 적용됩니다. )
                        extra: {
                            expire_month: '12', // 정기걸제 시 사용됨, 정기결제가 적용되는 개월 수, 미설정시 12개월
                            vbank_result: 1, // 가상계좌 사용시 사용, 가상계좌 결과창을 볼지(1), 말지(0), 미설정시 봄(1)
                            quota: '0,2,3' // 결제금액이 5만원 이상시 할부개월 허용범위를 설정할 수 있음, [0(일시불), 2개월, 3개월] 허용, 미설정시 12개월까지 허용

                        }
                    }).error(function (data) {
                        //결제 진행시 에러가 발생하면 수행됩니다.
                        console.log(data);
                    }).cancel(function (data) {
                        //결제가 취소되면 수행됩니다.
                        console.log(data);
                    }).ready(function (data) {
                        // 가상계좌 입금 계좌번호가 발급되면 호출되는 함수입니다.
                        console.log(data);
                        $.ajax({
                            type:'post',
                            url:'<?=base_url()?>payment/save_vbank',
                            data:data,
                            dataType:'json',
                            success:function(vbank_db_res){
                                if(vbank_db_res.code!=1){
                                    alert(vbank_db_res.msg);
                                }
                            },
                            error:function(){
                                alert('계좌정보가 DB에 저장되지 못했습니다. 다시 주문해주세요.');
                            }
                        });
                    }).confirm(function (data) {
                        //결제가 실행되기 전에 수행되며, 주로 재고를 확인하는 로직이 들어갑니다.
                        //주의 - 카드 수기결제일 경우 이 부분이 실행되지 않습니다.
                        console.log(data);
                        this.transactionConfirm(data);
                        // this.removePaymentWindow();
                    }).close(function (data) {
                        // 결제창이 닫힐때 수행됩니다. (성공,실패,취소에 상관없이 모두 수행됨)
                        console.log(data);
                    }).done(function (data) {
                        //결제가 정상적으로 완료되면 수행됩니다
                        //비즈니스 로직을 수행하기 전에 결제 유효성 검증을 하시길 추천합니다.
                        console.log(data);
                        $.ajax({
                            type:'post',
                            url:'<?=base_url()?>payment/support_complete',
                            data:{oid:pay_res.oid,data:data},
                            dataType:'json',
                            success:function(c_res){
                                if(c_res.code==1){
                                    alert('결제가 완료되었습니다');
                                    //location.replace('<?=base_url()?>mypage/payment');
                                }else{
                                    alert(c_res.msg);
                                }
                            },
                            error:function(){
                                alert('error');
                            }
                        });
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

    function set_amount(amount){
        $('#support-amount').text($.number(amount));
        $('input[name="amount"]').val(amount);
    }

    function set_likes(){
        $.ajax({
            type:'post',
            url:'<?=base_url()?>creator/ajax/set_favorite',
            data:{idx:creator_idx},
            dataType:'json',
            success:function(res){
                if(res.code==1){

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