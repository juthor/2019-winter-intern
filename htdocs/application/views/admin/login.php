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

    <title>로그인</title>
    <link rel="canonical" href="">
    <link rel="stylesheet" href="<?=base_url()?>css/old/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/old/font.css">
    <link rel="stylesheet" href="<?=base_url()?>css/old/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?=base_url()?>css/old/common.css?<?=date('YmdHis')?>">

    <script src="<?=base_url()?>js/old/jquery.js"></script>
    <script src="<?=base_url()?>js/old/bootstrap.min.js"></script>
    <script src="<?=base_url()?>js/old/rachel.js"></script>

    <style>
        html,body{width:100%;height:100%;}
        body{display:table;}

        #box-login{width:100%;display:table-cell;vertical-align:middle;background-color:#DAD2C7;text-align:center;}
        #box-login>form{width:300px;margin:0 auto;}
        #box-login>form>input{width:100%;box-shadow:none;border:0;padding:10px 15px;outline:0;}
        #box-login>form>input:first-child{border-bottom:1px solid #ddd;border-radius:10px 0 0 0;}
        #box-login>form>#btn-login{display:block;width:100%;padding:10px 15px;background-color:#5A8DAB;color:#fff;border-radius:0 0 10px 0;}
    </style>
</head>
<body>

    <div id="box-login">
        <form name="frm-login" method="post">
            <input type="text" name="id" placeholder="아이디">
            <input type="password" name="passwd" placeholder="비밀번호">
            <a href="javascript:login()" id="btn-login">로그인</a>
        </form>
    </div>

    <script>
        var referer = '<?=urldecode($this->input->get('referer'))?>';
        $(function(){
            $('#box-login>form input[name="admin_id"]').focus();

            $('form[name="frm-login"]').keypress(function(e) { if (e.keyCode == 13) login(); });
        });

        function login(){
            var form = $('form[name="frm-login"]');

            var i_id = form.find('input[name="id"]');
            var i_passwd = form.find('input[name="passwd"]');

            $.ajax({
                type:'post',
                data:form.serialize(),
                dataType:'json',
                success:function(res){
                    if(res.code==1){
                        if(referer){
                            location.replace(referer);
                        }else{
                            location.replace('<?=base_url()?>admin?nr');
                        }

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

</body>
</html>