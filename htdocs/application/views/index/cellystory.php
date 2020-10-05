<link rel="stylesheet" href="/css/old/cellystory.css">
<?php $this->load->view('include/header'); ?>
<div class="banner-item">
    <img class="bd-placeholder-img" width="100%" height="100%" style="object-fit: contain" src="<?= IMAGEPATH ?>cellystory.png"
         style="object-fit: cover">
    <rect width="100%" height="100%" fill="#777"/>
    </img>
</div>
<div class="container marketing">
    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading"><span
                        class="text-muted">당신에게 추천하는 최고의 마케터</span></h2>
            <p class="lead">앱 출시 예정이신가요?<br>신제품이 나왔나요?<br>정말 좋은데, 어떻게 알릴 방법이 없으신가요?<br>최고의 팀원과 함께 당신의 제품을 홍보해 드릴게요!</p>
            <a class="btn btn-lg btn-primary" href="javascript:showModal();">서비스 이용하기</a>
        </div>
        <div class="col-md-5">
            <img class="bd-placeholder-img" width="370" height="370" style="object-fit: contain" src="<?= IMAGEPATH ?>marketing.jpg"
                 style="object-fit: cover">
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading"><span class="text-muted">당신과 함께 성장하는 최고의 파트너</span>
            </h2>
            <p class="lead">딱 맞는 컨텐츠를 연결하고,<br></p>
            <a class="btn btn-lg btn-primary" href="javascript:showModal();">지원하기</a>
        </div>
        <div class="col-md-5 order-md-1">
            <iframe width="370" height="370" src="https://www.youtube.com/embed/0UVz4AZFMeU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer'); ?>

<script>
    jQuery(document).ready(function ($) {
        //pevent();

        $('#nav-cellystory').addClass('active');
    });


</script>