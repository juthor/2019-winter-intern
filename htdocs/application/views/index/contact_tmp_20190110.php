<style>
    .head-title{display:table;width:100%;height:calc(100vh);background-image:url('<?=IMAGEPATH?>assets/bg_contact_01.jpg');background-size:cover;background-position:center;}
    .head-title>.inner{display:table-cell;vertical-align:middle;}
    .head-title h2{margin:0 0 70px 0;height:80px;background-image:url('<?=IMAGEPATH?>assets/text_contact_head.png');background-size:auto 80px;background-position:center;background-repeat:no-repeat;}
    .head-title p{width:400px;line-height:40px;margin:0 auto;word-break:keep-all;text-align:center;color:#fff;}
    .head-title .info-circle{text-align:center;margin-top:100px;}
    .head-title .info-circle>div{display:inline-block;margin:0 60px;width:240px;height:240px;border-radius:120px;line-height:240px;text-align:center;color:#fff;border:1px solid #fff;font-size:1.4em;}

    .location{padding-top:80px;background-color:#4923eb;}
    .location h2{height:28px;margin:0 0 80px 0;background-image:url('<?=IMAGEPATH?>assets/text_contact_location.png');background-size:auto 28px;background-position:center;background-repeat:no-repeat;}
    .location h2>span{display:none;}
    .location #location-map{width:100%;height:600px;background-color:#999;}

    .contact-us{padding-top:80px;padding-bottom:80px;background-color:#4923eb;}
    .contact-us h2{height:28px;margin:0 0 80px 0;background-image:url('<?=IMAGEPATH?>assets/text_contact_contactus.png');background-size:auto 28px;background-position:center;background-repeat:no-repeat;}
    .contact-us h2>span{display:none;}
</style>

<div id="body">
    <div class="head-title">
        <div class="inner">
            <h2></h2>
            <p>Join the Cellystory to make the best choice for you brand. Celebrities and celistories in various fields are doing their best to imporve the value of the company.</p>
            <div class="info-circle">
                <div>Client</div>
                <div>Celeb</div>
                <div>Brand</div>
            </div>
        </div>
    </div>

    <div class="location">
        <h2><span>LOCATION</span></h2>
        <div id="location-map"></div>
    </div>

    <div class="contact-us">
        <h2><span>CONTACT US</span></h2>

        <style>
            #locations{}
            #locations .panel{border-radius:0;background-color:transparent;border:0;margin-bottom:40px;}
            #locations .panel-heading{padding:0;border-radius:0;background-color:transparent;border-bottom:1px solid #fff;}
            #locations .panel-title>a{display:block;padding:10px 0;color:#fff;}
            #locations .panel-body{padding:15px 0;color:#fff;}

            .contact-us{}
            .contact-us .input-group{border:1px solid #dbd3fb;margin-bottom:10px;}
            .contact-us .input-group>input,
            .contact-us .input-group>textarea{background-color:transparent;color:#dbd3fb;}
            .contact-us .bootstrap-select{width:100%!important;margin-bottom:10px;}
            .contact-us .bootstrap-select>button{border-radius:0;background-color:transparent;color:#dbd3fb;}
            .contact-us #btn-contact-send{display:inline-block;background-color:#fff;color:#333;padding:10px 30px;}
        </style>

        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel-group" id="locations" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#locations" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        KOREA
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    07326 서울특별시 영등포구 여의도동 23 Two IFC 16층<br>16th floor,10,Gukjegeumyung-ro,Yeongdeungpo-gu,Seoul,Republic of Korea
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#locations" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        AMERICA
                                    </a>
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
                    <select name="type" class="selectpicker">
                        <option value="1">AA</option>
                        <option value="1">AA</option>
                        <option value="1">AA</option>
                    </select>

                    <div class="input-group full">
                        <input type="text" name="title" class="form-control" placeholder="Title">
                    </div>

                    <div class="input-group full">
                        <input type="text" name="contact" class="form-control" placeholder="E-mail or phone number">
                    </div>

                    <div class="input-group full">
                        <textarea name="content" class="form-control" placeholder="Please enter the contents"></textarea>
                    </div>

                    <a href="#" id="btn-contact-send">SEND</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDE6JMK5-dgkTKY5WmUnEE34c4_kQppsYQ&callback=initMap" async defer></script>
<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('location-map'), {
            center: {lat: 37.525039, lng: 126.925285},
            zoom:16
        });

        var marker = new google.maps.Marker({
            position: {lat: 37.525039, lng: 126.925285},
            map: map,
            title: 'Hello World!'
        });
    }
</script>