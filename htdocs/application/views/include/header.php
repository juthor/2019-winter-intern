<!DOCTYPE html>
<html lang="ko">
<head>
    <script src="<?=base_url()?>js/jquery-3.3.1.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="<?=(@$meta['description'])?$meta['description']:$this->cfg['meta_description']?>">
    <meta name="keywords" content="<?=(@$meta['keyword'])?$meta['keyword']:$this->cfg['meta_keyword']?>">
    <meta property="og:title" content="<?=((@$meta['title'])?@$meta['title'].' - ':'').$this->cfg['site_name']?>" />
    <meta property="og:description" content="<?=(@$meta['description'])?$meta['description']:$this->cfg['meta_description']?>">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?=(@$meta['canonical'])?$meta['canonical']:((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on')?'https://':'http://').$_SERVER['SERVER_NAME'].site_url()?>" />
    <meta property="og:image" content="<?=(@$meta['image'])?$meta['image']:((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on')?'https://':'http://').$_SERVER['SERVER_NAME'].site_url().'img/cfg/'.$this->cfg['og_image']?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?=(@$meta['title'])?$meta['title'].' - ':''?>SNB" />
    <meta name="twitter:description" content="<?=(@$meta['description'])?$meta['description']:$this->cfg['meta_description']?>" />
    <meta name="twitter:image" content="<?=(@$meta['image'])?$meta['image']:((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on')?'https://':'http://').$_SERVER['SERVER_NAME'].site_url().'img/cfg/'.$this->cfg['og_image']?>" />
    <meta name="naver-site-verification" content="<?=@$this->cfg['site_veri_naver']?>">
    <meta name="google-site-verification" content="<?=@$this->cfg['site_veri_google']?>">
    <meta name="format-detection" content="telephone=no">

    <title><?=((@$meta['title'])?@$meta['title'].' - ':'').$this->cfg['site_name']?></title>
    <link rel="canonical" href="">

    <link rel="apple-touch-icon" sizes="57x57" href="<?=IMAGEPATH?>favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?=IMAGEPATH?>favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=IMAGEPATH?>favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?=IMAGEPATH?>favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=IMAGEPATH?>favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?=IMAGEPATH?>favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?=IMAGEPATH?>favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?=IMAGEPATH?>favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=IMAGEPATH?>favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?=IMAGEPATH?>favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=IMAGEPATH?>favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?=IMAGEPATH?>favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=IMAGEPATH?>favicon/favicon-16x16.png">
    <link rel="manifest" href="<?=IMAGEPATH?>favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?=IMAGEPATH?>favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>

<link rel="stylesheet" href="/css/bootstrap.min.css">

<script src="/js/bootstrap.js"></script>

<link rel="stylesheet" href="/css/header.css">
<header>
    <div class="navbar navbar-dark shadow-sm bg-dark">
        <div class="container d-flex justify-content-between">
            <a href="<?= base_url() ?>"><img
                            style="width: 50px; max-height: 100%; object-fit: contain;"
                            src="<?= IMAGEPATH ?>assets/logo.png" alt="CellyStory"></a>
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link" style="font-weight: normal" id="nav-creator" href="<?= base_url() ?>creator">Creator</a>
                <a class="nav-link" style="font-weight: normal" id="nav-apply" href="/apply">Apply</a>
                <a class="nav-link" style="font-weight: normal" id="nav-price" href="/pricing">Pricing</a>
                <a class="nav-link" style="font-weight: normal" id="nav-cellyshop" href="https://smartstore.naver.com/cellyshop" target="_blank">CellyShop</a>
                <a class="nav-link" style="font-weight: normal" id="nav-lang" href="javascript:change_user_lang('<?=$this->lang->line('title')?>')"><?=$this->lang->line('title')?></span></a>
            </nav>
        </div>
    </div>
</header>

