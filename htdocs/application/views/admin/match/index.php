<style>
    #table-match-list{}
    #table-match-list .td-uniform>p{margin:0;}
    #table-match-list .td-type strong{font-weight:700;color:#058f45;}

    #modal-match-view .table-default>tbody>tr>th{width:140px;background-color:#f7f7f7;}
</style>

<div class="table-responsive">
    <table class="table table-v" id="table-match-list">
        <thead>
        <tr>
            <th class="td-num"></th>
            <th class="td-type"></th>
            <th class="td-status">상태</th>
            <th class="td-name">구단명</th>
            <th class="td-stadium">구장</th>
            <th class="td-date">일시</th>
            <th class="td-age">연령</th>
            <th class="td-uniform">유니폼색상</th>
            <th class="td-date">등록일</th>
            <th class="td-btn"></th>
        </tr>
        </thead>

        <tbody>
        <?foreach($matchList as $match):?>
            <tr>
                <td class="td-num"><?=$display_num--?></td>
                <td class="td-type">
                    <?
                    switch($match['type']){
                        case 1: echo "매치 등록"; break;
                        case 2: echo "<strong>매치 헌팅</strong>"; break;
                    }
                    ?>
                </td>
                <td class="td-status"><?=$this->match_status[$match['status']]?></td>
                <td class="td-name"><?=$match['team_name']?></td>
                <td class="td-stadium"><?=($match['stadium'])?$match['stadium']:'협의'?></td>
                <td class="td-date"><?=($match['matchdate'])?date('y-m-d H:i',$match['matchdate']):'협의'?></td>
                <td class="td-age"><?=$this->data_ages[$match['age']]['name']?></td>
                <td class="td-uniform">
                    <p><small>상의:</small> <?=$match['uniform_top']?></p>
                    <p><small>하의:</small> <?=$match['uniform_bottom']?></p>
                </td>
                <td class="td-date"><?=date('Y-m-d',$match['regdate'])?></td>
                <td class="td-btn">
                    <a href="javascript:view_match('<?=$match['idx']?>')" class="btn btn-primary btn-sm">보기</a>
                </td>
            </tr>
        <?endforeach?>
        </tbody>

    </table>
</div>

<div class="modal" id="modal-match-view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">매칭서비스 상세보기</div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
<!--                <a href="javascript:accept_request()" class="btn btn-primary" id="btn-accept-request">선택요청 수락</a>-->
                <a data-dismiss="modal" class="btn btn-default">닫기</a>
            </div>
        </div>
    </div>
</div>

<script>
    function view_match(idx){
        var modal = $('#modal-match-view');

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/match/ajax/view_match',
            data:{idx:idx},
            dataType:'json',
            success:function(res){
                modal.find('.modal-body').html(res.html);
                modal.modal();
            },
            error:function(){
                alert('error');
            }
        });
    }

    function set_match_hunt_result(idx,status){
        if(!confirm('매칭헌팅의 결과를 적용하고 매칭을 종료하시겠습니까?')) return;
        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/match/ajax/set_match_hunt_result',
            data:{idx:idx,status:status},
            dataType:'json',
            success:function(res){
                if(res.code==1){
                    alert('정상적으로 처리되었습니다');
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