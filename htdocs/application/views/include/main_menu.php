<link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/menubar.css"/>
<script>
    var showFlag=false;
    function toggleMenu() {
        if(!showFlag) {
            showFlag=true;
            $('#menu_item_mobile').show();
        }else{
            showFlag=false;
            $('#menu_item_mobile').hide();
        }
    }
</script>

<header>
    <div class="Full_Menu">
        <div class="menu_logo"><a href="<?= base_url() ?>"><img
                        style="width: 50px; max-height: 100%; object-fit: contain;"
                        src="<?= IMAGEPATH ?>assets/logo.png" alt="CellyStory"></a></div>
        <nav>
            <ul class="menu_item">
                <!--<li><a href="<?= base_url() ?>about"><span>About</span></a></li>-->
                <li><a href="<?= base_url() ?>creator"><span>Creator</span></a></li>
                <li><a href="<?= base_url() ?>creator/apply"><span>Apply</span></a></li>
                <li><a href="<?= base_url() ?>contact"><span>Contact</span></a></li>
                <li><a href="https://smartstore.naver.com/cellyshop" target="_blank"><span>Celly Shop</span></a></li>
                <li><a href="javascript:change_user_lang('<?=$this->lang->line('title')?>')"><span><?=$this->lang->line('title')?></span></a></li>
                <!--<li><a id="btn-search" class="btn btn--search"
                   style="display:block;width:33px;height:33px;background-image:url('<?= IMAGEPATH ?>assets/btn-search.png');background-size:contain;background-position:center;background-repeat:no-repeat;z-index:300;"></a></li>-->
            </ul>
        </nav>
        <div class="menu_mobile"><a href="javascript:toggleMenu();"><img
                    style="width: 20px; max-height: 100%; object-fit: contain;"
                    src="<?= IMAGEPATH ?>assets/menu.png"></a></div>
        </div>
    </div>

    <ul class="menu_item_mobile" id="menu_item_mobile" style="display: none">
        <!--<li><a href="<?= base_url() ?>about"><span>About</span></a></li>-->
        <li><a href="<?= base_url() ?>creator"><span>Creator</span></a></li>
        <li><a href="<?= base_url() ?>creator/apply"><span>Apply</span></a></li>
        <li><a href="<?= base_url() ?>contact"><span>Contact</span></a></li>
        <li><a href="https://smartstore.naver.com/cellyshop" target="_blank"><span>Celly Shop</span></a></li>
        <li><a href="javascript:change_user_lang('<?=$this->lang->line('title')?>')"><span><?=$this->lang->line('title')?></span></a></li>
    </ul>
</header>
