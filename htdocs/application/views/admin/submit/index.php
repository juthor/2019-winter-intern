<style>
    .table-v{color:#646464;border-top:1px solid #ddd;}
    .table-v>thead>tr>th{background-color:#f9f9f9;border:1px solid #ddd;border-bottom:1px solid #ddd;font-weight:700;vertical-align:middle;text-align:center;}
    .table-v>tbody>tr>td{background-color:#fff;border-right:1px solid #efefef;border-bottom:1px solid #efefef;text-align:center;vertical-align:middle;}
    .table-v>tbody>tr>td.text-left,
    .table-v>tbody>tr>td.td-title{text-align:left!important;}
    .table-v>tbody>tr>td:first-child{border-left:1px solid #efefef;}
    .table-v:not(.table-rowspan)>tbody>tr:nth-child(even)>td{background-color:#fafafa;}
    .table-v>tbody>tr.even>td{background-color:#fafafa;}
    .table-v td.td-title{text-align:left!important;}
</style>

<a href="<?=base_url()?>admin/submit/xls_export" class="btn btn-primary">엑셀파일 내보내기</a>

<table class="table table-v" style="margin-top:20px;">
    <thead>
    <tr>
        <th class="td-num"></th>
        <th class="td-name">회사명</th>
        <th class="td-name">부서</th>
        <th class="td-name">직위</th>
        <th class="td-name">이름</th>
        <th class="td-num">전화번호</th>
        <th class="td-num">이메일</th>
        <th class="td-num">예약상품</th>
        <th class="td-num">요청사항</th>
        <th class="td-num">등록일</th>
    </tr>
    </thead>

    <tbody>
    <?foreach($submitList as $submit):?>
    <tr>
        <td class="td-num"><?=$display_num--?></td>
        <td class="td-name"><?=$submit['corp_name']?></td>
        <td class="td-name"><?=$submit['corp_dept']?></td>
        <td class="td-name"><?=$submit['corp_position']?></td>
        <td class="td-name"><?=$submit['name']?></td>
        <td class="td-num"><?=$submit['phone']?></td>
        <td class="td-num"><?=$submit['email']?></td>
        <td class="td-num">
            <?
            $item_code = json_decode($submit['item_code']);
            if(is_array($item_code) && count($item_code)>0){
                foreach($item_code as $code){
                    echo '<p>'.$this->data_item[$code].'</p>';
                }
            }
            ?>
        </td>
        <td class="td-num"><?=nl2br($submit['content'])?></td>
        <td class="td-num"><?=date('Y-m-d H:i',$submit['regdate'])?></td>
    </tr>
    <?endforeach?>
    </tbody>
</table>

<div class="text-center"><?=$pagination?></div>