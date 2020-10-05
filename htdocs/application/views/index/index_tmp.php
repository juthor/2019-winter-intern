<link rel="stylesheet" href="<?=base_url()?>css/lightslider.css"/>
<style>
    body{}
    #header{position:relative;}

    .index-slider-wrap{position:fixed;left:0;top:0;width:100%;height:100%;z-index:-1;}
    .index-slider .slide{height:calc(100vh);background-size:cover;background-position:center;background-repeat:no-repeat;}
    #index-wrap{width:100%;height:calc(100vh);z-index:100;display:table;}
    #index-wrap>.inner{display:table-cell;vertical-align:middle;}
    #index-wrap>.inner.copyright{padding-left:30px;position:relative;width:100px;}
    #index-wrap>.inner.copyright>p{margin:0;transform:rotate(270deg);text-align:center;width:600px;position:absolute;left:-265px;}
    #index-wrap>.inner.copyright>p>span{display:inline-block;padding-left:90px;position:relative;color:#fff;}
    #index-wrap>.inner.copyright>p>span:after{display:block;content:'';width:80px;height:2px;background-color:#fff;position:absolute;left:0;top:50%;margin-top:-1px;}
    #index-wrap>.inner.main-nav{padding-right:30px;text-align:right;}
    #index-wrap>.inner.main-nav>#main-nav{display:inline-block;}
    #index-wrap>.inner>.container{position:relative;}
    #index-wrap .slogan h2{font-size:4em;font-weight:100;color:#fa7bff;margin:0;}
    #index-wrap .slogan p{margin:40px 0;color:#fff;opacity:0.7;line-height:27px;width:460px;word-break:keep-all;}
    #index-wrap .slogan .lang{display:inline-block;color:#fff;padding-right:140px;background-image:url('<?=IMAGEPATH?>assets/img_index_lang_arrow.png');background-position:right 8px;background-repeat:no-repeat;}
    #index-wrap .slogan .lang>a{display:inline-block;font-size:1.2em;color:#fff;opacity:0.5;}
    #index-wrap .slogan .lang>a.active{opacity:1;}
        /*#index-wrap #main-nav{position:absolute;right:0;top:0;}*/
    #index-wrap #main-nav>li{margin:30px 0;}
    #index-wrap #main-nav>li>a{display:block;border-right:3px solid #fff;padding:20px 15px;color:#fff;transition:opacity 0.5s,color 0.5s,border-color 0.5s;text-align:right;}
    #index-wrap #main-nav>li:hover>a{color:#f729ff;opacity:1!important;border-color:#f729ff;font-weight:700;}
    #index-wrap #main-nav:hover>li>a{opacity:0.7;}
</style>

<div id="body">
    <div id="index-wrap">
        <div class="inner copyright">
            <p><span>&copy; COPYRIGHT ALL RESERVED BY TENWONDERS</span></p>
        </div>
        <div class="inner slogan">
            <h2>Be with<br>cellystory<br>to write your<br>special story</h2>
            <p>셀리스토리는 새로운 트렌드를 만드는 크리에이터들이 활발히 활동할 수 있도록 영상컨텐츠 제작 및 브랜드 협찬을 진행하고 있습니다. 셀리스토리만의 노하우를 바탕으로 크리에이터들에게 최적의 서포트를 제공할 것을 약속합니다.</p>
            <div class="lang">
                <a href="#" data-id="kor" class="active">Kor</a> / <a href="#" data-id="kor">Eng</a>
            </div>
        </div>
        <div class="inner main-nav">
            <ul id="main-nav">
                <li><a href="#">Celly Shop</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Apply</a></li>
                <li><a href="#">Creator</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </div>
    </div>
    <div class="index-slider-wrap">
        <div class="index-slider">
            <div class="slide" style="background-image:url('<?=IMAGEPATH?>assets/bg_index.jpg');"></div>
            <div class="slide" style="background-image:url('<?=IMAGEPATH?>assets/bg_index.jpg');"></div>
            <div class="slide" style="background-image:url('<?=IMAGEPATH?>assets/bg_index.jpg');"></div>
        </div>
    </div>
</div>

