<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>

</style>

<h2 class="page-title">포인트 내역</h2>

<a href="javascript:open_search()" class="btn <?=(@$searchs)?' btn-info ':' btn-default '?>"><span class="fas fa-search"></span> 검색</a>
<?if(@$searchs){?><a href="<?=base_url()?>admin/payment/point" class="btn btn-default">전체보기</a><?}?>

<h3 class="text-right">가용 포인트 : <?=number_format($total_point)?>포인트</h3>

<table class="table table-v">
    <thead>
    <tr>
        <th class="td-num"></th>
        <th class="td-num">회원구분</th>
        <th class="td-num">회원명</th>
        <th class="td-num">휴대폰번호</th>
        <th class="td-num">내역</th>
        <th class="td-num">포인트</th>
        <th class="td-num">일시</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <?foreach($pointList as $point):?>
    <tr>
        <td class="td-num"><?=$display_num--?></td>
        <td class="td-num"><?=$this->member_type[$point['member_type']]?></td>
        <td class="td-num"><?=$point['name']?></td>
        <td class="td-num"><?=convert_phone($point['phone'])?></td>
        <td class="td-num"><?=$point['remarks']?></td>
        <td class="td-num"><?=number_format($point['point'])?></td>
        <td class="td-num"><?=date('Y-m-d H:i:s',$point['regdate'])?></td>
        <td>
            <a href="<?=base_url()?>admin/member/view/<?=$point['member_idx']?>" class="btn btn-default btn-sm">회원정보</a>
        </td>
    </tr>
    <?endforeach?>
    </tbody>
</table>

<div class="text-center">
    <?=$pagination?>
</div>

<div class="modal" id="modal-search">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">결제내역 검색</div>
            <div class="modal-body">
                <form name="frm-search" action="<?=base_url()?>admin/payment/point/1">
                    <table class="table table-default">
                        <tbody>
                        <tr>
                            <th>구분</th>
                            <td>
                                <select name="searchs[point_amt_type]" class="selectpicker">
                                    <option value="0">전체</option>
                                    <option value="m">사용</option>
                                    <option value="p">충전</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th>이름/닉네임</th>
                            <td>
                                <div class="input-group full">
                                    <input type="text" name="searchs[search_name]" class="form-control" value="<?=@$searchs['search_name']?>">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>연락처</th>
                            <td>
                                <div class="input-group full">
                                    <input type="text" name="searchs[search_phone]" class="form-control" value="<?=@$searchs['search_phone']?>">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>아이디</th>
                            <td>
                                <div class="input-group full">
                                    <input type="text" name="searchs[search_id]" class="form-control" value="<?=@$searchs['search_id']?>">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>기간 설정</th>
                            <td>
                                <div class="input-group full">
                                    <input type="text" name="searchs[payment_point_date_range]" class="form-control" value="<?=(@$searchs['payment_point_date_range'])?$searchs['payment_point_date_range']:date('Y-m-d',strtotime(date('Y-m-d') . ' - 90 days')).' - '.date('Y-m-d')?>">
                                </div>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:do_search()" class="btn btn-primary">검색</a>
                <a data-dismiss="modal" class="btn btn-default">닫기</a>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(function(){
        $('input[name="searchs[payment_point_date_range]"]').daterangepicker({
            locale: {
                cancelLabel: '초기화'
            }
        });
    });

    function open_search(){
        var modal = $('#modal-search');
        modal.modal();

        var max_amt = '<?=$max_amt?>';
        var min_amt = '<?=$min_amt?>';
        var amt_start = '<?=(@$searchs['amt']['start'])?$searchs['amt']['start']:$min_amt?>';
        var amt_end = '<?=(@$searchs['amt']['end'])?$searchs['amt']['end']:$max_amt?>';

        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: max_amt,
            values: [ amt_start, amt_end ],
            slide: function( event, ui ) {
                $('input[name="searchs[amt][start]').val(ui.values[ 0 ]);
                $('input[name="searchs[amt][end]').val(ui.values[ 1 ]);
                $( "#amount" ).val(ui.values[ 0 ]+'원' + " ~ " + ui.values[ 1 ]+'원');
            }
        });
        $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 )+'원 ~ '+$( "#slider-range" ).slider( "values", 1 )+'원');
        $('input[name="searchs[amt][start]').val($( "#slider-range" ).slider( "values", 0 ));
        $('input[name="searchs[amt][end]').val($( "#slider-range" ).slider( "values", 1 ));

        modal.find('.selectpicker').selectpicker();
    }

    function do_search(){
        var form = $('form[name="frm-search"]');
        form.submit();
    }
</script>