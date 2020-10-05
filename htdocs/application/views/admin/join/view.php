<style>
    h2.join-title{margin:0 0 40px 0;text-align:center;}
    h2.join-title>small{display:block;margin-top:20px;font-size:0.5em;}

    .join-wrap{}
    .join-wrap>.inner{background-color:#fff;padding:10px;}
    .join-wrap .table>caption{font-size:1.6em;font-weight:700;}
    .join-wrap .table-default>tbody>tr>th{width:100px;background-color:#f7f7f7;}
</style>

<h2 class="join-title"><?=$join['title']?><small><?=$join['b_corp_name']?>, <?=date('Y-m-d',$join['regdate'])?></small></h2>

<div class="row">
    <div class="col-sm-6 join-wrap">
        <div class="inner">
            <table class="table table-default not-responsive">
                <caption>구단 정보</caption>
                <tbody>
                <tr>
                    <th>구단명</th>
                    <td>
                        <?=$join['b_corp_name']?>
                    </td>
                </tr>
                <tr>
                    <th>연락처</th>
                    <td>
                        <?=convert_phone($join['phone'])?>
                    </td>
                </tr>
                <tr>
                    <th>이메일</th>
                    <td>
                        <?=$join['email']?>
                    </td>
                </tr>
                </tbody>
            </table>

            <!-- 선수 정보 -->
            <table class="table table-default not-responsive">
                <caption>선수 정보</caption>
                <tbody>
                <tr>
                    <th>성별</th>
                    <td>
                        <?
                        switch($join['gender']){
                            case 'm': echo "남성"; break;
                            case 'f': echo "여성"; break;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>나이</th>
                    <td><?=($join['age'])?$this->data_ages[$join['age']]['name']:'무관'?></td>
                </tr>
                <tr>
                    <th>체형</th>
                    <td><?=($join['body'])?$this->data_body_height[$join['body']]['name']:'무관'?></td>
                </tr>
                <tr>
                    <th>국가</th>
                    <td><?=($join['country'])?$this->data_country[substr($join['country'],0,1)]['list'][$join['country']]:'무관'?></td>
                </tr>
                <tr>
                    <th>주발</th>
                    <td>
                        <?=($join['main_foot']==3)?'무관':$this->data_main_foot[$join['main_foot']]?>
                    </td>
                </tr>

                <tr>
                    <th>연봉</th>
                    <td>
                        <?=number_format($join['salary'])?>원
                    </td>
                </tr>
                <tr>
                    <th>모집형태</th>
                    <td>
                        <?=$this->data_recruit_type[$join['recruit_type']]?>
                    </td>
                </tr>
                <tr>
                    <th>병역유무</th>
                    <td>
                        <?
                        switch($join['military']){
                            case 1: echo "필"; break;
                            case 2: echo "미필"; break;
                            default: echo "무관";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>최종경력</th>
                    <td>
                        <?=($join['career'])?$this->data_career[$join['career']]:'무관'?>
                    </td>
                </tr>
                <tr>
                    <th>최종학력</th>
                    <td>
                        <?=($join['edu'])?$this->data_edu[$join['edu']]:'무관'?>
                    </td>
                </tr>
                </tbody>
            </table>

            <table class="table table-default">
                <tbody>
                <tr>
                    <th>모집포지션</th>
                    <td>
                        <div class="box-field">
                            <div class="box p11">
                                <label class="rachel"><input type="checkbox" name="position[]" value="11" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('11',$join['positions']))?' checked="true" ':''?> disabled>LW</label>
                            </div>

                            <div class="box p12">
                                <label class="rachel"><input type="checkbox" name="position[]" value="12" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('12',$join['positions']))?' checked="true" ':''?> disabled>ST</label><br>
                                <label class="rachel"><input type="checkbox" name="position[]" value="13" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('13',$join['positions']))?' checked="true" ':''?> disabled>CF</label><br>
                                <label class="rachel"><input type="checkbox" name="position[]" value="14" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('14',$join['positions']))?' checked="true" ':''?> disabled>SS</label>
                            </div>

                            <div class="box p13">
                                <label class="rachel"><input type="checkbox" name="position[]" value="15" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('15',$join['positions']))?' checked="true" ':''?> disabled>RW</label>
                            </div>

                            <div class="box p21">
                                <label class="rachel"><input type="checkbox" name="position[]" value="21" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('21',$join['positions']))?' checked="true" ':''?> disabled>LM</label>
                            </div>

                            <div class="box p22">
                                <label class="rachel"><input type="checkbox" name="position[]" value="22" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('22',$join['positions']))?' checked="true" ':''?> disabled>CAM</label><br><br>
                                <label class="rachel"><input type="checkbox" name="position[]" value="23" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('23',$join['positions']))?' checked="true" ':''?> disabled>CM</label><br><br>
                                <label class="rachel"><input type="checkbox" name="position[]" value="24" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('24',$join['positions']))?' checked="true" ':''?> disabled>CDM</label>
                            </div>

                            <div class="box p23">
                                <label class="rachel"><input type="checkbox" name="position[]" value="25" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('25',$join['positions']))?' checked="true" ':''?> disabled>RM</label>
                            </div>

                            <div class="box p31">
                                <label class="rachel"><input type="checkbox" name="position[]" value="31" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('31',$join['positions']))?' checked="true" ':''?> disabled>LWB</label><br>
                                <label class="rachel"><input type="checkbox" name="position[]" value="32" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('32',$join['positions']))?' checked="true" ':''?> disabled>LB</label>
                            </div>

                            <div class="box p32">
                                <label class="rachel"><input type="checkbox" name="position[]" value="33" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('33',$join['positions']))?' checked="true" ':''?> disabled>CB</label><br>
                                <label class="rachel"><input type="checkbox" name="position[]" value="34" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('34',$join['positions']))?' checked="true" ':''?> disabled>SW</label><br><br>
                                <label class="rachel"><input type="checkbox" name="position[]" value="41" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('41',$join['positions']))?' checked="true" ':''?> disabled>GK</label>
                            </div>

                            <div class="box p33">
                                <label class="rachel"><input type="checkbox" name="position[]" value="35" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('35',$join['positions']))?' checked="true" ':''?> disabled>RWB</label><br>
                                <label class="rachel"><input type="checkbox" name="position[]" value="36" <?=(is_array($join['positions']) && count($join['positions'])>0 && in_array('36',$join['positions']))?' checked="true" ':''?> disabled>RB</label>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-sm-6 join-wrap">
        <div class="inner">
            <table class="table table-v not-responsive">
                <caption>요청 목록</caption>
                <thead>
                <tr>
                    <th>상태</th>
                    <th>선수명</th>
                    <th>연락처</th>
                    <th>요청일</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <?foreach($requests as $req):?>
                <tr>
                    <td>
                        <?
                        switch($req['status']){
                            case 1: echo "실패"; break;
                            case 2: echo "성공"; break;
                            default: echo "대기";
                        }
                        ?>
                    </td>
                    <td><?=$req['name']?></td>
                    <td><?=convert_phone($req['phone'])?></td>
                    <td><?=date('Y-m-d',$req['regdate'])?></td>
                    <td>
                        <a href="<?=base_url()?>admin/member/view/<?=$req['member_idx']?>" class="btn btn-default btn-sm">선수정보</a>
                        <?if($req['status']==0){?>
                            <a href="javascript:request_complete('<?=$req['idx']?>','2')" class="btn btn-primary btn-sm">성공</a>
                            <a href="javascript:request_complete('<?=$req['idx']?>','1')" class="btn btn-danger btn-sm">실패</a>
                        <?}?>
                    </td>
                </tr>
                <?endforeach?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function request_complete(req_idx,value){
        if(!confirm('요청을 종료하시겠습니까?')) return;
        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/join/ajax/request_complete',
            data:{req_idx:req_idx,value:value},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('정상처리되었습니다');
                    location.reload();
                }else{
                    alert(res.msg);
                }
            },
            error:function(){
                alert('error');
            }
        });
    }
</script>