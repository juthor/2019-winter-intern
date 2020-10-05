<table class="table table-v">
    <thead>
    <tr>
        <th class="td-num"></th>
        <th class="td-type">구분</th>
        <th class="td-name">구단명</th>
        <th class="td-title">제목</th>
        <th class="td-cnt">요청수</th>
        <th class="td-date">등록일</th>
    </tr>
    </thead>

    <tbody>
    <?
    if(is_array($joinList) && count($joinList)>0){
        foreach($joinList as $join){
            ?>
            <tr>
                <td class="td-num"></td>
                <td class="td-type">
                    <?
                    switch($join['type']){
                        case 1: echo "선수모집"; break;
                        case 2: echo "입단테스트"; break;
                    }
                    ?>
                </td>
                <td class="td-name"><?=$join['b_corp_name']?></td>
                <td class="td-title"><a href="<?=base_url()?>admin/join/view/<?=$join['idx']?>"><?=$join['title']?></a></td>
                <td class="td-cnt"><?=$join['request_cnt']?></td>
                <td class="td-date"><?=date('Y-m-d',$join['regdate'])?></td>
            </tr>
            <?
        }
    }else{
        ?><tr><td colspan="5" class="text-center">데이터가 없습니다</td></tr><?
    }
    ?>
    </tbody>
</table>