<style>
    h2.page-title{margin:0 0 40px 0;font-weight:700;}
    h2.page-title>strong{color:#ec7a8f;}
    .table-default>tbody>tr>th{width:90px;background-color:#f7f7f7;font-weight:700;}

    .headhunt-view>div>.inner{background-color:#fff;padding:10px;}
    .headhunt-view>div.match h3{margin:0 0 20px 0;}

    .player-list>li>div.data.rate{display:none;}
    .player-list>li>div.date{display:none;}
    .player-list>li>div.data.name{display:none;}
</style>


<h2 class="page-title">맞춤 <strong><?=($req['member_type']==1)?'선수':'구단'?></strong> 헤드헌팅</h2>
<div class="row">
    <!-- 의뢰 내용 -->
    <div class="col-sm-4">
        <!-- 구단 정보 -->
        <table class="table table-default">
            <caption>구단 정보</caption>
            <tbody>
            <tr>
                <th><?=($req['member_type']==1)?'선수명':'구단명'?></th>
                <td>
                    <?=($req['member_type']==1)?$req['name']:$req['b_corp_name']?>
                </td>
            </tr>
            <tr>
                <th>연락처</th>
                <td>
                    <?=convert_phone($req['phone'])?>
                </td>
            </tr>
            <tr>
                <th>이메일</th>
                <td>
                    <?=$req['email']?>
                </td>
            </tr>
            </tbody>
        </table>

        <!-- 선수 정보 -->
        <table class="table table-default">
            <caption>선수 정보</caption>
            <tbody>
            <tr>
                <th>성별</th>
                <td>
                    <?
                    switch($req['gender']){
                        case 'm': echo "남성"; break;
                        case 'f': echo "여성"; break;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>나이</th>
                <td>
                    <?
                    switch($req['member_type']){
                        case 1: echo $req['member_age']; break;
                        case 2: echo $this->data_ages[$req['age']]['name']; break;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>주발</th>
                <td>
                    <?=($req['main_foot']==3)?'무관':$this->data_main_foot[$req['main_foot']]?>
                </td>
            </tr>

            <?if($req['member_type']==1){?>
                <tr>
                    <th>국가</th>
                    <td>
                        <?
                        if($req['country']==999){
                            echo "기타 - ".$req['country_etc'];
                        }else{
                            echo $this->data_country[substr($req['country'],0,1)]['list'][$req['country']];
                        }
                        ?>
                    </td>
                </tr>
            <?}?>

            <tr>
                <th>모집포지션</th>
                <td>
                    <div class="box-field">
                        <div class="box p11">
                            <label class="rachel"><input type="checkbox" name="position[]" value="11" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('11',$req['positions']))?' checked="true" ':''?> disabled>LW</label>
                        </div>

                        <div class="box p12">
                            <label class="rachel"><input type="checkbox" name="position[]" value="12" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('12',$req['positions']))?' checked="true" ':''?> disabled>ST</label><br>
                            <label class="rachel"><input type="checkbox" name="position[]" value="13" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('13',$req['positions']))?' checked="true" ':''?> disabled>CF</label><br>
                            <label class="rachel"><input type="checkbox" name="position[]" value="14" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('14',$req['positions']))?' checked="true" ':''?> disabled>SS</label>
                        </div>

                        <div class="box p13">
                            <label class="rachel"><input type="checkbox" name="position[]" value="15" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('15',$req['positions']))?' checked="true" ':''?> disabled>RW</label>
                        </div>

                        <div class="box p21">
                            <label class="rachel"><input type="checkbox" name="position[]" value="21" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('21',$req['positions']))?' checked="true" ':''?> disabled>LM</label>
                        </div>

                        <div class="box p22">
                            <label class="rachel"><input type="checkbox" name="position[]" value="22" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('22',$req['positions']))?' checked="true" ':''?> disabled">CAM</label><br><br>
                            <label class="rachel"><input type="checkbox" name="position[]" value="23" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('23',$req['positions']))?' checked="true" ':''?> disabled">CM</label><br><br>
                            <label class="rachel"><input type="checkbox" name="position[]" value="24" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('24',$req['positions']))?' checked="true" ':''?> disabled">CDM</label>
                        </div>

                        <div class="box p23">
                            <label class="rachel"><input type="checkbox" name="position[]" value="25" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('25',$req['positions']))?' checked="true" ':''?> disabled">RM</label>
                        </div>

                        <div class="box p31">
                            <label class="rachel"><input type="checkbox" name="position[]" value="31" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('31',$req['positions']))?' checked="true" ':''?> disabled">LWB</label><br>
                            <label class="rachel"><input type="checkbox" name="position[]" value="32" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('32',$req['positions']))?' checked="true" ':''?> disabled">LB</label>
                        </div>

                        <div class="box p32">
                            <label class="rachel"><input type="checkbox" name="position[]" value="33" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('33',$req['positions']))?' checked="true" ':''?> disabled">CB</label><br>
                            <label class="rachel"><input type="checkbox" name="position[]" value="34" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('34',$req['positions']))?' checked="true" ':''?> disabled">SW</label><br><br>
                            <label class="rachel"><input type="checkbox" name="position[]" value="41" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('41',$req['positions']))?' checked="true" ':''?> disabled">GK</label>
                        </div>

                        <div class="box p33">
                            <label class="rachel"><input type="checkbox" name="position[]" value="35" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('35',$req['positions']))?' checked="true" ':''?> disabled">RWB</label><br>
                            <label class="rachel"><input type="checkbox" name="position[]" value="36" <?=(is_array($req['positions']) && count($req['positions'])>0 && in_array('36',$req['positions']))?' checked="true" ':''?> disabled">RB</label>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>희망연봉</th>
                <td>
                    <?=($req['salary']>0)?number_format($req['salary']).'원':'협의'?>
                </td>
            </tr>
            <tr>
                <th>모집형태</th>
                <td>
                    <?=$this->data_recruit_type[$req['recruit_type']]?>
                </td>
            </tr>
            <tr>
                <th>병역유무</th>
                <td>
                    <?
                    switch($req['military']){
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
                    <?=($req['career'])?$this->data_career[$req['career']]:'무관'?>
                </td>
            </tr>
            <tr>
                <th>최종학력</th>
                <td>
                    <?=($req['edu'])?$this->data_edu[$req['edu']]:'무관'?>
                </td>
            </tr>
            <tr>
                <th>특기</th>
                <td>
                    <div class="row">
                        <?foreach($this->member_speciality as $code=>$name):?>
                            <div class="col-sm-4">
                                <label class="rachel" style="margin:0;"><input type="checkbox" name="speciality[]" value="<?=$code?>" <?=(count($req['specs'])>0 && in_array($code,$req['specs']))?' checked="true" ':''?>> <?=$name?></label>
                            </div>
                        <?endforeach?>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- 선수 매칭 -->
    <div class="col-sm-8">

        <?
        /*
        switch($req['member_type']){
            case 1:
                ?>
                <!-- 헤드헌팅 의뢰 선수목록 -->
                <table class="table table-v">
                    <thead>
                    <tr>
                        <th class="td-check"></th>
                        <th class="td-name">이름</th>
                        <th class="td-">성별</th>
                        <th class="td-">나이</th>
                        <th class="td-">주발</th>
                        <th class="td-position">포지선</th>
                        <th class="td-">희망연봉</th>
                        <th class="td-">모집형태</th>
                        <th class="td-">병역</th>
                        <th class="td-">최종경력</th>
                        <th class="td-">최종학력</th>
                        <th class="td-">특기</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?
                    if(is_array($teamList) && count($teamList)>0){
                        foreach($teamList as $team){
                            ?>
                            <tr>
                                <td class="td-check"><label class="rachel"><input type="checkbox" name="select_headhunt[]" value="<?=$team['idx']?>"></label></td>
                                <td class="td-name"><?=$player['name']?></td>
                                <td class="td-"><?=$this->data_gender[$player['gender']]?></td>
                                <td class="td-">나이</td>
                                <td class="td-"><?=$this->data_main_foot[$player['main_foot']]?></td>
                                <td class="td-position">
                                    <?
                                    $positions = [];
                                    if(is_array($player['positions']) && count($player['positions'])>0){
                                        foreach($player['positions'] as $pos){
                                            $prefix = substr($pos,0,1);
                                            $positions[] = $this->member_position[$prefix]['list'][$pos];
                                        }
                                    }

                                    echo implode(",",$positions);
                                    ?>
                                </td>
                                <td class="td-"><?=number_format($player['salary'])?>원</td>
                                <td class="td-"><?=$this->data_recruit_type[$player['recruit_type']]?></td>
                                <td class="td-"><?=$this->data_military[$player['military']]?></td>
                                <td class="td-"><?=($player['career'])?$this->data_career[$player['career']]:'무관'?></td>
                                <td class="td-"><?=($player['edu'])?$this->data_edu[$player['edu']]:'무관'?></td>
                                <td class="td-">
                                    <?
                                    $specs = [];
                                    if(is_array($player['specs']) && count($player['specs'])>0){
                                        foreach($player['specs'] as $spec){
                                            $specs[] = $this->member_speciality[$spec];
                                        }
                                    }

                                    echo implode(",",$specs);
                                    ?>
                                </td>
                            </tr>
                            <?
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <?
                break;

            case 2:
                ?>
                <!-- 헤드헌팅 의뢰 선수목록 -->
                <table class="table table-v">
                    <thead>
                    <tr>
                        <th class="td-check"></th>
                        <th class="td-name">이름</th>
                        <th class="td-">성별</th>
                        <th class="td-">나이</th>
                        <th class="td-">주발</th>
                        <th class="td-position">포지선</th>
                        <th class="td-">희망연봉</th>
                        <th class="td-">모집형태</th>
                        <th class="td-">병역</th>
                        <th class="td-">최종경력</th>
                        <th class="td-">최종학력</th>
                        <th class="td-">특기</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?
                    if(is_array($playerList) && count($playerList)>0){
                        foreach($playerList as $player){
                            ?>
                            <tr>
                                <td class="td-check"><label class="rachel"><input type="checkbox" name="select_headhunt[]" value="<?=$player['idx']?>"></label></td>
                                <td class="td-name"><?=$player['name']?></td>
                                <td class="td-"><?=$this->data_gender[$player['gender']]?></td>
                                <td class="td-">나이</td>
                                <td class="td-"><?=$this->data_main_foot[$player['main_foot']]?></td>
                                <td class="td-position">
                                    <?
                                    $positions = [];
                                    if(is_array($player['positions']) && count($player['positions'])>0){
                                        foreach($player['positions'] as $pos){
                                            $prefix = substr($pos,0,1);
                                            $positions[] = $this->member_position[$prefix]['list'][$pos];
                                        }
                                    }

                                    echo implode(",",$positions);
                                    ?>
                                </td>
                                <td class="td-"><?=number_format($player['salary'])?>원</td>
                                <td class="td-"><?=$this->data_recruit_type[$player['recruit_type']]?></td>
                                <td class="td-"><?=$this->data_military[$player['military']]?></td>
                                <td class="td-"><?=($player['career'])?$this->data_career[$player['career']]:'무관'?></td>
                                <td class="td-"><?=($player['edu'])?$this->data_edu[$player['edu']]:'무관'?></td>
                                <td class="td-">
                                    <?
                                    $specs = [];
                                    if(is_array($player['specs']) && count($player['specs'])>0){
                                        foreach($player['specs'] as $spec){
                                            $specs[] = $this->member_speciality[$spec];
                                        }
                                    }

                                    echo implode(",",$specs);
                                    ?>
                                </td>
                            </tr>
                            <?
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <?
                break;
        }
        */
        ?>

        <?
        if($req['status']==300){
            ?><a href="javascript:set_finish_headhunt('<?=$req['idx']?>')" class="btn btn-primary" style="margin-bottom:30px;">종료 처리</a><?
        }

        if(in_array($req['status'],['300','400'])){
            switch($req['member_type']){
                case 1:
                    ?>
                    <table class="table table-v">
                        <thead>
                        <tr>
                            <th class="td-name">구단명</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?foreach($matchList as $match):?>
                            <tr>
                                <td class="td-name"><?=$match['b_corp_name']?></td>
                            </tr>
                        <?endforeach?>
                        </tbody>
                    </table>
                    <?
                    break;

                case 2:
                    echo $this->load->view('player/list',['playerList'=>$matchList],true);
                    break;
            }
        }else{
            ?>
            <form name="frm-match">
                <table class="table table-v">
                    <thead>
                    <tr>
                        <th class="td-check"></th>
                        <th class="td-name"><?=($req['member_type']==1)?'구단명':'선수명'?></th>
                        <th class="td-">성별</th>
                        <th class="td-">나이</th>
                        <th class="td-">주발</th>
                        <th class="td-position">포지선</th>
                        <th class="td-">희망연봉</th>
                        <th class="td-">모집형태</th>
                        <th class="td-">병역</th>
                        <th class="td-">최종경력</th>
                        <th class="td-">최종학력</th>
                        <th class="td-">특기</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?
                    if(is_array($playerList) && count($playerList)>0){
                        foreach($playerList as $player){
                            ?>
                            <tr>
                                <td class="td-check"><label class="rachel"><input type="checkbox" name="matchs[]" value="<?=$player['idx']?>"></label></td>
                                <td class="td-name"><?=($req['member_type']==1)?$player['b_corp_name']:$player['name']?></td>
                                <td class="td-"><?=$this->data_gender[$player['gender']]?></td>
                                <td class="td-"></td>
                                <td class="td-"><?=$this->data_main_foot[$player['main_foot']]?></td>
                                <td class="td-position">
                                    <?
                                    $positions = [];
                                    if(is_array($player['positions']) && count($player['positions'])>0){
                                        foreach($player['positions'] as $pos){
                                            $prefix = substr($pos,0,1);
                                            $positions[] = $this->member_position[$prefix]['list'][$pos];
                                        }
                                    }

                                    echo implode(",",$positions);
                                    ?>
                                </td>
                                <td class="td-"><?=number_format($player['salary'])?>원</td>
                                <td class="td-"><?=$this->data_recruit_type[$player['recruit_type']]?></td>
                                <td class="td-"><?=$this->data_military[$player['military']]?></td>
                                <td class="td-"><?=($player['career'])?$this->data_career[$player['career']]:'무관'?></td>
                                <td class="td-"><?=($player['edu'])?$this->data_edu[$player['edu']]:'무관'?></td>
                                <td class="td-">
                                    <?
                                    $specs = [];
                                    if(is_array($player['specs']) && count($player['specs'])>0){
                                        foreach($player['specs'] as $spec){
                                            $specs[] = $this->member_speciality[$spec];
                                        }
                                    }

                                    echo implode(",",$specs);
                                    ?>
                                </td>
                            </tr>
                            <?
                        }
                    }
                    ?>
                    </tbody>
                </table>

                <input type="hidden" name="type" value="<?=$req['member_type']?>">
                <input type="hidden" name="idx" value="<?=$req['idx']?>">
            </form>

            <div class="text-center">
                <a href="javascript:save_match()" class="btn btn-primary"><?=($req['member_type']==1)?'구단':'선수'?> 매칭</a>
            </div>
            <?
        }
        ?>





    </div>
</div>

<script>
    function save_match(){
        if(!confirm('매칭하시겠습니까?')) return;
        var form = $('form[name="frm-match"]');

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/headhunt/ajax/save_match',
            data:form.serialize(),
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('매칭이 마감처리되었습니다');
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

    function set_finish_headhunt(idx){
        if(!confirm('헤드헌팅을 종료하시겠습니까?')) return;
        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/headhunt/ajax/set_finish_headhunt',
            data:{idx:idx},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('헤드헌팅이 종료되었습니다');
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