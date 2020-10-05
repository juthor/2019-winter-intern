<?
if(is_array($creatorList) && count($creatorList)>0){
    foreach($creatorList as $creator){
        ?>
        <div class="col-sm-3 col-xs-6 creator">
            <a href="<?= base_url() ?>creator/view/<?= $creator['idx'] ?>">
                <div class="data"><?= $creator['first_name'] . " " . $creator['last_name'] ?></div>
            </a>
            <div class="image off" style="background-image:url('<?=IMAGEPATH?>creator/<?=$creator['thumb_image']?>');"></div>
            <div class="image on" style="background-image:url('<?=IMAGEPATH?>creator/grayscale/<?=$creator['thumb_image']?>');"></div>
        </div>
        <?
    }
}
?>