<style>

</style>

<form name="frm-cfg" method="post">
    <table class="table table-v">
        <thead>
        <tr>
            <th>항목명</th>
            <th>값</th>
        </tr>
        </thead>

        <tbody>
        <?
        foreach($cfgList as $cfg){
            ?>
            <tr>
                <td><?=$cfg['title']?></td>
                <td>
                    <?
                    switch($cfg['cfg_key']){
                        case 'og_image':
                            if($cfg['cfg_value']){
                                ?><img src="<?=IMAGEPATH?>cfg/<?=$cfg['cfg_value']?>" style="max-width:200px;margin-bottom:10px;"><?
                            }
                            ?>
                            <div class="input-group full">
                                <input type="file" name="cfg[<?=$cfg['cfg_key']?>]" class="form-control" value="<?=$cfg['cfg_value']?>">
                            </div>
                            <?
                            break;

                        case 'logo_color':
                            if($cfg['cfg_value']){
                                ?><img src="<?=IMAGEPATH?>cfg/<?=$cfg['cfg_value']?>" style="max-width:200px;margin-bottom:10px;"><?
                            }
                            ?>
                            <div class="input-group full">
                                <input type="file" name="cfg[<?=$cfg['cfg_key']?>]" class="form-control" value="<?=$cfg['cfg_value']?>">
                            </div>
                            <small>로고사이즈 : 200 * 72, 투명배경의 png파일</small>
                            <?
                            break;

                        case 'logo_white':
                            if($cfg['cfg_value']){
                                ?><div style="background-color:#000;"><img src="<?=IMAGEPATH?>cfg/<?=$cfg['cfg_value']?>" style="max-width:200px;margin-bottom:10px;"></div><?
                            }
                            ?>
                            <div class="input-group full">
                                <input type="file" name="cfg[<?=$cfg['cfg_key']?>]" class="form-control" value="<?=$cfg['cfg_value']?>">
                            </div>
                            <small>로고사이즈 : 200 * 72, 투명배경의 png파일</small>
                            <?
                            break;

                        default:
                            if($cfg['input_type']=='textarea'){
                                ?>
                                <div class="input-group full">
                                    <textarea name="cfg[<?=$cfg['cfg_key']?>]" class="form-control"><?=$cfg['cfg_value']?></textarea>
                                </div>
                                <?
                            }else{
                                ?>
                                <div class="input-group full">
                                    <input type="text" name="cfg[<?=$cfg['cfg_key']?>]" class="form-control" value="<?=$cfg['cfg_value']?>">
                                </div>
                                <?
                            }
                    }
                    ?>
                </td>
            </tr>
            <?
        }
        ?>
        </tbody>
    </table>

    <input type="hidden" name="submit_go" value="1">
</form>

<div class="text-center">
    <a href="javascript:save()" class="btn btn-primary">저장</a>
</div>

<script src="<?=base_url()?>js/jquery.form.js"></script>
<script>
    function save(){
        var form = $('form[name="frm-cfg"]');

        form.ajaxForm({
            enctype: "multipart/form-data",
            success:function(res){
                alert('저장되었습니다');
                //location.reload();
            },
            error:function(){
                alert('error');
            }
        });

        form.submit();
    }
</script>