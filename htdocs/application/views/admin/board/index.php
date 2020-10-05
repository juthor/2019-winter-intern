<style>
    h2.board-title{margin:0 0 30px 0;}
    .board-list{border-top:2px solid #ec7a8f;margin-bottom:30px;}
    .board-list>li>a{display:table;width:100%;background-color:#fff;padding:20px 15px;border-bottom:1px solid #e1e1e1;}
    .board-list>li>a>div{display:table-cell;vertial-align:middle;}
    .board-list>li>a>div.name{width:100px;}
    .board-list>li>a>div.date{width:100px;}
    .board-list>li>a>div.reply{width:70px;}
    .board-list>li>a>div.hit{width:70px;}

    .pagination{margin:0;}

    @media screen and (max-width:767px){
        .board-list>li>a{display:block;}
        .board-list>li>a:after{display:block;content:'';clear:both;}
        .board-list>li>a>div{display:block;float:left;width:auto!important;font-size:0.85em;color:#888;margin-right:10px;}
        .board-list>li>a>div.title{width:100%!important;font-weight:700;font-size:1em;color:#555;margin-right:0;margin-bottom:8px;}
    }
</style>

<h2 class="board-title"><?=$board['name']?></h2>

<ul class="board-list">
    <?
    if(is_array($articleList) && count($articleList)>0){
        foreach($articleList as $article){
            ?>
            <li>
                <a href="<?=base_url()?>admin/board/<?=$board['id']?>/view/<?=$article['idx']?>">
                    <div class="title"><?=$article['title']?></div>
                    <div class="name"><?=($article['admin_idx'])?'<strong style="color:#ec7a8f;">관리자</strong>':$article['name']?></div>
                    <div class="date"><?=date('Y.m.d',$article['regdate'])?></div>
                    <div class="reply"><small>댓글</small> <strong><?=$article['reply_cnt']?></strong></div>
                    <div class="hit"><small>조회수</small> <strong><?=$article['hit']?></strong></div>
                </a>
            </li>
            <?
        }
    }
    ?>
</ul>

<div class="row">
    <div class="col-sm-3">
        <a href="<?=base_url()?>admin/board/<?=$board['id']?>/manage" class="btn btn-primary">글 작성</a>
    </div>
    <div class="col-sm-6 text-center"><?=$pagination?></div>
</div>