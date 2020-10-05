<div class="vh-100" style="background-image: url('<?= IMAGEPATH ?>assets/bg_apply_01.jpg'); background-size: cover">

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--
    <div class="apply-note" id="section-apply-note">
        <div class="inner slogan motion-down">
            <h2 class="font-camelia title-black-center">Join the<br>Celly Story</h2>
        </div>

        <div class="inner infos motion-up">
            <ul>
                <li>
                    <strong style="background-image:url('<?=IMAGEPATH?>assets/icon_apply_info_01.png');"><?=$this->lang->line('apply_intro1_title')?></strong>
                    <p><?=$this->lang->line('apply_intro1_text')?></p>
                </li>

                <li>
                    <strong style="background-image:url('<?=IMAGEPATH?>assets/icon_apply_info_02.png');"><?=$this->lang->line('apply_intro2_title')?></strong>
                    <p><?=$this->lang->line('apply_intro2_text')?></p>
                </li>

                <li class="last">
                    <strong style="background-image:url('<?=IMAGEPATH?>assets/icon_apply_info_03.png');"><?=$this->lang->line('apply_intro3_title')?></strong>
                    <p><?=$this->lang->line('apply_intro3_text')?></p>
                </li>
            </ul>
        </div>
    </div>

    <div class="apply-do event" id="section-apply-do">
        <div class="inner">
            <div class="container">
                <div class="head">
                    <h2 class="motion-down title-black">Creator Apply</h2>
                    <p class="motion-up"><?=$this->lang->line('apply_text_creator_apply')?></p>
                    <a href="javascript:open_apply()" id="btn-open-apply"><?=$this->lang->line('apply_text_btn_apply')?></a>
                </div>

                <div class="note">
                    <p><?=$this->lang->line('apply_note_1')?></p>
                    <p><?=$this->lang->line('apply_note_2')?></p>
                    <p><?=$this->lang->line('apply_note_3')?></p>
                    <p><?=$this->lang->line('apply_note_4')?></p>
                    <p class="last"><?=$this->lang->line('apply_note_5')?></p>
                </div>
            </div>
        </div>
    </div>-->
<script>
    $(function(){
        $('#nav-apply').addClass('active');
    });
</script>