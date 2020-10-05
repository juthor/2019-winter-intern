<style>
    #table-banner-list{}
    #table-banner-list .td-image{}
    #table-banner-list .td-image.pc{width:400px;}
    #table-banner-list .td-image.mobile{width:200px;}
    #table-banner-list .td-image>.image{width:100%;background-size:auto 80px;height:80px;background-position:center;background-repeat:no-repeat;}
    #table-banner-list .td-image>.image>img{display:none;}
</style>

<table class="table table-v" id="table-banner-list">
    <thead>
    <tr>
        <th class="td-check"></th>
        <th class="td-title">배너명</th>
        <th class="td-status">노출상태</th>
        <th class="td-image pc">이미지(PC)</th>
        <th class="td-image mobile">이미지(모바일)</th>
        <th class="td-regdate">등록일</th>
        <th class="td-btn"></th>
    </tr>
    </thead>

    <tbody>
    <?
    foreach($bannerList as $banner){
        ?>
        <tr>
            <td class="td-check"><label class="rachel"><input type="checkbox" name="idx[]" value="<?=$banner['idx']?>"></label></td>
            <td class="td-title"><?=$banner['title']?></td>
            <td class="td-status">노출상태</td>
            <td class="td-image pc"><div class="image pc" style="background-image:url('<?=IMAGEPATH?>banner/<?=$banner['image_pc']?>');"><img src="<?=IMAGEPATH?>banner/<?=$banner['image_pc']?>"></div></td>
            <td class="td-image mobile"><div class="image mobile" style="background-image:url('<?=IMAGEPATH?>banner/<?=$banner['image_mobile']?>');"><img src="<?=IMAGEPATH?>banner/<?=$banner['image_mobile']?>"></td>
            <td class="td-regdate">등록일</td>
            <td class="td-btn">
                <a href="javascript:open_banner_manage('<?=$banner['idx']?>')" class="btn btn-default btn-sm">수정</a>
            </td>
        </tr>
        <?
    }
    ?>
    </tbody>
</table>

<a href="javascript:open_banner_manage()" class="btn btn-primary">배너 등록</a>

<div class="modal" id="modal-banner-manage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">배너 관리</div>
            <div class="modal-body">
                <form name="frm-banner-manage" method="post" action="<?=base_url()?>admin/operation/ajax/save_banner_manage"></form>
            </div>
            <div class="modal-footer">
                <a href="javascript:save_banner_manage()" class="btn btn-primary">배너저장</a>
                <a data-dismiss="modal" class="btn btn-default">닫기</a>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>js/jquery.form.js"></script>
<script>
    function open_banner_manage(idx) {
        var modal = $('#modal-banner-manage');

        $.ajax({
            type: 'post',
            url: '<?=base_url()?>admin/operation/ajax/open_banner_manage',
            data: {idx: idx},
            dataType: 'json',
            success: function (res) {
                modal.find('.modal-body>form').html(res.html);
                modal.modal();
                modal.find('.rachel').rachel();
            },
            error: function () {
                alert('error');
            }
        });
    }

    function save_banner_manage(){
        var form = $('form[name="frm-banner-manage"]');
        form.ajaxForm({
            enctype: "multipart/form-data",
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('저장되었습니다');
                    location.reload();
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
                alert('error');
            }
        });

        form.submit();
    }
</script>