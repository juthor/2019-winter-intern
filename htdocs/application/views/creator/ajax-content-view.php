<style>
    .cv-row{display:table;width:100%;}
    .cv-row>div{display:table-cell;vertical-align:top;}
    .cv-row>div.creator{width:200px;padding-right:20px;}
    .cv-row>div.creator>strong{font-size:1.4em;font-weight:700;}
    .cv-row>div.creator>strong>small{display:block;margin-bottom:7px;color:#8c8c8c;font-weight:400;font-size:0.5em;}
    .cv-row>div.creator .who{display:table;width:100%;margin-top:60px;position:relative;}
    .cv-row>div.creator .who:before{display:block;position:absolute;content:'BY';left:0;top:-30px;font-weight:700;color:#333;}
    .cv-row>div.creator .who:after{display:block;position:absolute;content:'';left:24px;top:-21px;width:50px;height:2px;background-color:#333;}
    .cv-row>div.creator .who>div{display:table-cell;vertical-align:top;}
    .cv-row>div.creator .who>.image{width:60px;height:60px;background-size:cover;background-position:center;background-repeat:no-repeat;box-shadow:2px 3px 4px rgba(0,0,0,0.3);}
    .cv-row>div.creator .who>.name{padding-left:10px;font-size:1.2em;font-weight:700;color:#333;}
    .cv-row>div.creator .who>.name>small{display:block;margin-top:10px;font-weight:400;color:#8c8c8c;font-size:0.5em;}
    .cv-row>div.contents img{max-width:100%;}
    .cv-row>div.contents .gap{margin-top:40px;}
    .cv-row>div.contents .gap[data-i="0"]{margin-top:0;}
</style>

<div class="cv-row">
    <div class="creator">
        <strong><small><?=$content['year']?></small><?=$content['title']?></strong>

        <div class="who">
            <div class="image" style="background-image:url('<?=IMAGEPATH?>creator/<?=$creator['thumb_image']?>');"></div>
            <div class="name"><?=$creator['name']?><small><?=$creator['first_name']." ".$creator['last_name']?></small></div>
        </div>
    </div>

    <div class="contents">
        <?
        if(is_array($content['list']) && count($content['list'])>0){
            foreach($content['list'] as $i => $data){
                ?>
                <div class="gap" data-i="<?=$i?>"></div>
                <strong><?=$data['title']?></strong>
                <p><?=$data['content']?></p>

                <?
                if($content['type']=='youtube'){
                    ?><div class="youtube-video" data-pe-videoid="<?=$data['youtube_id']?>"></div><?
                }else{
                    ?><img src="<?=IMAGEPATH?>creator/content/<?=$data['image']?>"><?
                }
            }
        }
        ?>
    </div>
</div>

<!--
<table class="table">
    <tbody>
    <?
    foreach($content['list'] as $data){
        ?>
        <tr>
            <th>
                <strong><?=$data['title']?></strong>
                <p><?=$data['content']?></p>
            </th>
            <td>
                <?
                if($content['type']=='youtube'){
                    ?><div class="youtube-video" data-pe-videoid="<?=$data['youtube_id']?>"></div><?
                }else{
                    ?><img src="<?=IMAGEPATH?>creator/content/<?=$data['image']?>"><?
                }
                ?>
            </td>
        </tr>
        <?
    }
    ?>
    </tbody>
</table>
-->

<!--<a href="javascript:tmp_remove_youtube_elem()">remove elem test</a>-->

<script>
    $(function(){
        $('.youtube-video:before').click(function(){
            console.log('before');
        });
        $('.youtube-video').click(function(){
            //alert('tt');
        });

        $('.youtube-video').prettyEmbed({
            useFitVids: true,
            showInfo: false,
            showControls: false,
            showRelated: false,
            loop:true
        });
    });

    function tmp_remove_youtube_elem(){
        $('.youtube-video iframe').contents().find('.ytp-button').empty();
    }
</script>