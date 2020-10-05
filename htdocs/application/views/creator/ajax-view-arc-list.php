<?
if(is_array($contents) && count($contents)>0){
    foreach($contents as $content){
        $arc_code = 0;
        switch($content['type']){
            case 'insfa': $arc_code = 1; break;
            case 'nblog': $arc_code = 2; break;
            case 'youtube': $arc_code = 3; break;
        }
        ?>
        <div class="arc" data-type="<?=$arc_code?>">
            <a href="javascript:open_content_view('<?=$content['idx']?>')">
                <div class="image" style="background-image:url('<?=IMAGEPATH?>creator/content/<?=$content['image']?>');"></div>
                <div class="data">
                    <p><?=$content['title']?><small><?=$content['year']?></small></p>
                </div>
            </a>
        </div>
        <?
    }
}