<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta property="og:title" content="" />
    <meta property="og:description" content="">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:image" content="" />
    <meta name="naver-site-verification" content="">
    <meta name="google-site-verification" content="">
    <meta name="format-detection" content="telephone=no">

    <title>관리자</title>
    <link rel="canonical" href="">
    <link rel="stylesheet" href="<?=base_url()?>css/old/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/old/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/old/rachel.css">
    <link rel="stylesheet" href="<?=base_url()?>css/old/font.css">
    <link rel="stylesheet" href="<?=base_url()?>css/old/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/old/common.css?<?=date('YmdHis')?>">

    <script src="<?=base_url()?>js/old/jquery.js"></script>
    <script src="<?=base_url()?>js/old/bootstrap.min.js"></script>
    <script src="<?=base_url()?>js/old/bootstrap-select.min.js"></script>
    <script src="<?=base_url()?>js/old/rachel.js"></script>
    <script src="<?=base_url()?>js/old/moment.js"></script>
    <script src="<?=base_url()?>js/old/moment-ko.js"></script>

    <style>
        body{}
        #header{position:fixed;z-index:999;left:0;top:0;width:200px;height:100%;z-index:999;background-color:#5A8DAB;}

        #header h1{margin:0;font-size:1.3em;}
        #header h1>a{display:block;width:100%;height:70px;line-height:70px;color:#fff;text-align:center;background-color:#283143;}

        #header #nav{list-style-type:none;padding:0;margin:20px 0 0 0;}
        #header #nav>li{position:relative;}
        #header #nav>li>a{position:relative;display:block;width:100%;padding:0 10px;height:40px;line-height:40px;color:#fff;font-weight:bold;}
        #header #nav>li>ul{display:none;list-style-type:none;padding:0;margin:0;position:absolute;left:200px;top:0;background-color: #5c85a9;}
        #header #nav>li>ul>li>a{display:block;width:200px;height:40px;line-height:40px;padding:0 10px;color:#eee;}
        #header #nav>li:hover>ul{display:block;}
        #header #nav>li:hover>a{background-color:#43617D;}

        #body{padding:90px 15px 15px 215px;}
        #body #body-bar{position:fixed;z-index:990;left:0;top:0;width:100%;height:70px;padding-left:215px;background-color:#283143;color:#fff;}
        #body #body-bar>.cur-time{padding-top:12px;float:left;}
        #body #body-bar>.cur-time>small{display:block;opacity:0.8;}
        #body #body-bar>.cur-time>span{display:block;font-size:1.4em;}
        #body #body-bar>.admin-menu{float:right;list-style-type:none;padding:0;margin:15px 10px 15px 0;}
        #body #body-bar>.admin-menu>li{float:left;}
        #body #body-bar>.admin-menu>li>a{padding:0 10px;height:40px;line-height:40px;color:#fff;}


    </style>
</head>

<!--https://color.adobe.com/ko/Copy-of-Site-color-theme-10976880/?showPublished=true-->
<!--https://color.adobe.com/ko/mike-kotsch-204198-unsplash-color-theme-10999842/?showPublished=true-->
<body>

<div id="header">
    <h1><a href="<?=base_url()?>admin"><span>ADMIN</span></a></h1>
    <ul id="nav">
        <li>
            <a href="<?=base_url()?>admin">DASHBOARD</a>
        </li>
        <li>
            <a href="<?=base_url()?>admin/creator/apply">APPLY</a>
        </li>
        <li>
            <a href="<?=base_url()?>admin/creator">CREATOR</a>
        </li>

        <li>
            <a href="<?=base_url()?>admin/payment">결제</a>
            <!--
            <ul>
                <li><a href="<?=base_url()?>admin/payment/index">결제 내역</a></li>
                <li><a href="<?=base_url()?>admin/payment/point">포인트 내역</a></li>
                <li><a href="<?=base_url()?>admin/payment/unitcost">단가 설정</a></li>
            </ul>
            -->
        </li>

        <!--
        <li>
            <a href="<?=base_url()?>admin/operation">운영</a>
            <ul>
                <li><a href="<?=base_url()?>admin/operation/voc">고객문의</a></li>
                <li><a href="<?=base_url()?>admin/operation/faq">FAQ</a></li>
                <li><a href="<?=base_url()?>admin/operation/popup">팝업</a></li>
            </ul>
        </li>
        -->

        <?if($this->admin_data['level']==1){?>
            <li>
                <a href="<?=base_url()?>admin/office">오피스</a>

                <ul>
                    <li><a href="<?=base_url()?>admin/office/admins">관리자 목록</a></li>
                    <li><a href="<?=base_url()?>admin/office/cfg">환경설정</a></li>
                </ul>
            </li>
        <?}?>
    </ul>
</div>

<div id="body">
    <div id="body-bar">
        <div class="cur-time">
            <small></small>
            <span></span>
        </div>

        <ul class="admin-menu">
            <li><a href="http://analytics.naver.com" target="_blank">애널리틱스</a></li>
            <li><a href="<?=base_url()?>admin/index/logout">로그아웃</a></li>
        </ul>

        <div class="clearfix"></div>
    </div>