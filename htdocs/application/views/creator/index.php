<style>
    #body{}
    .search-box{display:table;width:100%;height:calc(100vh);background-image:url('<?=IMAGEPATH?>assets/bg_creator_search.jpg');background-size:cover;background-position:center bottom;}
    .search-box>.inner{display:table-cell;vertical-align:middle;}
    .search-box p{font-size:1.1em;line-height:30px;color:#878787;margin-bottom:30px;}
    .search-box .input-group{border:0;margin-bottom:30px;position:relative;}
    .search-box .input-group>.icon-search{position:absolute;left:0;top:0;width:46px;height:46px;z-index:100;background-image:url('<?=IMAGEPATH?>assets/icon_search.png');background-size:14px;background-position:center;background-repeat:no-repeat;}
    .search-box .input-group input{position:relative;padding:12px 12px 12px 46px;height:46px;border-radius:4px!important;box-shadow:inset 0 0 7px #d9d9d9;}
    .search-box .input-group input::placeholder{color:red;}
    .search-box .input-group input:-ms-input-placeholder{color:red;}
    .search-box .input-group input:after{display:block;content:'';position:absolute;left:0;top:0;width:46px;height:46px;background-color:blue;}
    .search-box .input-group .input-group-btn{padding-left:15px;}
    .search-box .input-group .input-group-btn>.btn{border:1px solid #000;border-radius:4px;padding:12px 40px;}
    .search-box .input-group .input-group-btn>.btn:hover{background-color:#000;color:#fff;}
    .search-box .hashtag{}
    .search-box .hashtag>span{font-weight:700;}
    .search-box .hashtag>a{display:inline-block;margin:0 5px;opacity:0.6;transition:opacity 0.3s;}
    .search-box .hashtag>a:hover{opacity:1;}

    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 5px; white-space: nowrap; overflow: hidden; cursor: pointer; }
    .autocomplete-selected { background: #efefef; color: #555; }
    .autocomplete-suggestions strong { font-weight: bold; color: orange; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }

    .creator-box{}
    .creator-box .creator-list{margin-left:0;margin-right:0;}
    .creator-box .creator-list>div{padding-left:0;padding-right:0;}
    .creator-box .creator-list>div>a{display:table;position:relative;width:100%;height:calc(50vh);}
    .creator-box .creator-list>div>a:after{display:block;content:'';position:absolute;left:0;top:0;width:100%;height:100%;z-index:100;background-image:url('<?=IMAGEPATH?>assets/bg_creator_gradient.png');background-size:cover;background-position:center;opacity:0;}
    .creator-box .creator-list>div>a>.data{display:table-cell;vertical-align:middle;opacity:0;width:100%;text-align:center;color:#fff;transition:opacity 0.3s;font-size:1.4em;font-weight:700;text-shadow:0 2px 5px #222;z-index:200;}
    .creator-box .creator-list>div .image{position:absolute;left:0;top:0;width:100%;height:100%;background-size:cover;background-position:center;transition:opacity 1s;z-index:-1;transition:opacity 0.3s;}
    .creator-box .creator-list>div .image.off{opacity:0;}
    .creator-box .creator-list>div .image.on{opacity:1;}
    .creator-box .creator-list>div:hover .data{opacity:1;}
    .creator-box .creator-list>div:hover .image.off{opacity:1;}
    .creator-box .creator-list>div:hover .image.on{opacity:0;}
    .creator-box .creator-list>div:hover>a:after{opacity:1;}
    .creator-box #btn-more-creator{display:inline-block;padding:12px 40px;font-size:1.2em;border:1px solid #000;border-radius:4px;margin-top:50px;}

    @media screen and (max-width:767px){
        .search-box .input-group>.input-group-btn{padding-left:10px;}
    }
</style>

<div id="body">
    <div style="height: 75px;"></div>
    <div class="search-box" id="section-searchbox">
        <div class="inner">
            <div class="container">
                <h2 class="motion-down font-camelia title-black">Creator</h2>
                <p class="motion-up"><?=$this->lang->line('apply_text1')?></p>

                <form name="frm-creator-search">
                    <div class="input-group">
                        <div class="icon-search"></div>
                        <input type="text" name="search_keyword" class="form-control" id="input-creator-search" value="<?=@$this->input->get('search_keyword')?>">
                        <span class="input-group-btn"><a href="javascript:do_creator_search()" class="btn">검색</a></span>
                    </div>
                    <input type="hidden" name="no_init_scroll" value="1">
                </form>

                <div class="hashtag">
                    <span><?=$this->lang->line('apply_text2')?> : </span>
                    <?
                    if(is_array($popular_keyword) && count($popular_keyword)>0){
                        foreach($popular_keyword as $keyword){
                            ?>
                            <a href="<?=base_url()?>creator?search_keyword=<?=$keyword['hashtag']?>&no_init_scroll=1"><?=$keyword['hashtag']?></a>
                            <?
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="creator-box">
        <div class="row creator-list">
        </div>

        <div class="text-center">
            <a href="javascript:get_list()" id="btn-more-creator"><?=$this->lang->line('apply_text3')?></a>
        </div>
    </div>
</div>

<script src="<?=base_url()?>js/jquery.autocomplete.min.js"></script>
<script>
    var search_keyword = '<?=@$this->input->get('search_keyword')?>';

    $(function(){
        initAutoComplete();

        $('form[name="frm-creator-search"]').keypress(function(e){
            if(e.keyCode == 13){
                e.preventDefault();
                do_creator_search();
            }
        });

        get_list();
    });

    $(window).load(function(){
        //if(search_keyword) $("html, body").animate({ scrollTop: $('.creator-list').offset().top }, 600);
    });

    var list_page = 1;
    function get_list(){
        var keyword = '<?=addslashes($this->input->get('search_keyword'))?>';
        $.ajax({
            type:'post',
            url:'<?=base_url()?>creator/ajax/get_list',
            data:{page:list_page,keyword:keyword},
            dataType:'json',
            success:function(res){
                if(res.code==1){

                    if(res.total_rows==0){
                        var s_input = $('form[name="frm-creator-search"]').find('input[name="search_keyword"]');
                        s_input.attr('placeholder','<?=$this->lang->line('apply_text4')?>');
                        s_input.addClass('no-result');
                        s_input.val('');
                    }

                    list_page++;
                    $('.creator-list').append(res.html);

                    if(res.is_last_page==1) $('#btn-more-creator').addClass('hide');
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
                alert('List Load Error');
            }
        });
    }

    var offset_section_searchbox = $('#section-searchbox').offset().top;

    $(window).scroll(function(){
        var cur_offset = $(window).scrollTop();

        if(cur_offset>=offset_section_searchbox - ($(window).height()/2)){
            if($('#section-searchbox').hasClass('event')){
                $('#section-searchbox').removeClass('event');
            }
        }
    });

    function initAutoComplete(){
        $.ajax({
            type:'post',
            url:'<?=base_url()?>creator/ajax/getSearchAutoComplete',
            dataType:'json',
            success:function(keywords){
                $('#input-creator-search').autocomplete({
                    lookup: keywords,
                    triggerSelectOnValidInput:false,
                    onSelect: function (suggestion) {
                        $(this).off("focus");
                        $('form[name="frm-header-search"]').find('input[name="match"]').val(suggestion.data);
                        do_creator_search();
                    }
                });
            },
            error:function(){

            }
        });
    }

    function do_creator_search(){
        var form = $('form[name="frm-creator-search"]');

        var i_keyword = form.find('input[name="search_keyword"]');
        if(!i_keyword.val()){
            alert('<?=$this->lang->line('apply_text5')?>');
            i_keyword.focus();
            return;
        }
        form.submit();
    }
</script>