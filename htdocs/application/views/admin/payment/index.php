<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    #table-payment-list{margin-top:20px;}
    #table-payment-list tbody>tr{cursor:pointer;}
</style>

<a href="javascript:open_search()" class="btn <?=(@$searchs)?' btn-info ':' btn-default '?>"><span class="fas fa-search"></span> 검색</a>
<?if(@$searchs){?><a href="<?=base_url()?>admin/payment" class="btn btn-default">전체보기</a><?}?>

<table class="table table-v" id="table-payment-list">
    <thead>
    <tr>
        <th class="td-idx">IDX</th>
        <th class="td-status">결제상태</th>
        <th class="td-name">이름</th>
        <th class="td-method">결제수단</th>
        <th class="td-amt">요청금액</th>
        <th class="td-amt">결제금액</th>
        <th class="td-regdate">요청일시</th>
        <th class="td-regdate">결제일시</th>
    </tr>
    </thead>

    <tbody>
    <?
    if(is_array($paymentList) && count($paymentList)>0){
        foreach($paymentList as $pay){
            ?>
            <tr data-idx="<?=$pay['idx']?>">
                <td class="td-idx"><?=$pay['idx']?></td>
                <td class="td-status"><?=(@$pay['status'])?$this->pay_status[$pay['status']]:''?></td>
                <td class="td-name"><?=$pay['user_name']?></td>
                <td class="td-method">
                    <?=($pay['pay_method'])?$this->pay_method[$pay['pay_method']]:''?>
                </td>
                <td class="td-amt"><?=number_format($pay['pay_price'])?>원</td>
                <td class="td-amt"><strong><?=number_format($pay['pay_amt'])?>원</strong></td>
                <td class="td-regdate"><?=($pay['regdate'])?date('Y-m-d H:i:s',$pay['regdate']):''?></td>
                <td class="td-regdate"><?=($pay['paydate'])?date('Y-m-d H:i:s',$pay['paydate']):''?></td>
            </tr>
            <?
        }
    }else{

    }
    ?>

    </tbody>
</table>

<div class="text-center">
    <?=$pagination?>
</div>

<div class="modal" id="modal-payment-view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">결제내역 보기</div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <a data-dismiss="modal" class="btn btn-default">닫기</a>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-search">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">결제내역 검색</div>
            <div class="modal-body">
                <form name="frm-search" action="<?=base_url()?>admin/payment/index/1">
                    <table class="table table-default">
                        <tbody>
                        <tr>
                            <th>결제상태</th>
                            <td>
                                <select name="searchs[status]" class="selectpicker">
                                    <option value="0">전체</option>
                                    <?
                                    foreach($this->pay_status as $key=>$status){
                                        if(!in_array($key,[100,200,999])) continue;
                                        ?>
                                        <option value="<?=$key?>" <?=(@$searchs['status']==$key)?' selected="true" ':''?>><?=$status?></option>
                                        <?
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th>결제수단</th>
                            <td>
                                <select name="searchs[pay_method]" class="selectpicker">
                                    <option value="0">전체</option>
                                    <?
                                    foreach($this->pay_method as $key=>$method){
                                        ?>
                                        <option value="<?=$key?>" <?=(@$searchs['pay_method']==$key)?' selected="true" ':''?>><?=$method?></option>
                                        <?
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th>이름</th>
                            <td>
                                <div class="input-group full">
                                    <input type="text" name="searchs[search_name]" class="form-control" value="<?=@$searchs['search_name']?>">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>결제금액</th>
                            <td>
                                <div><input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;"></div>
                                <div id="slider-range"></div>
                                <input type="hidden" name="searchs[amt][start]">
                                <input type="hidden" name="searchs[amt][end]">
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
<script>
    $(function(){
        $('#table-payment-list>tbody>tr').click(function(){
            view_payment($(this).data('idx'));
        });
    });

    function view_payment(idx){
        var modal = $('#modal-payment-view');

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/payment/ajax/view',
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

    function open_search(){
        var modal = $('#modal-search');
        modal.modal();

        var max_amt = '<?=$max_amt?>';
        var amt_start = '<?=(@$searchs['amt']['start'])?$searchs['amt']['start']:'0'?>';
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

    function do_payment_cancel(idx){
        if(!confirm('결제취소하시겠습니까?')) return;

        $.ajax({
            type:'post',
            url:'<?=base_url()?>admin/payment/ajax/payment_cancel',
            data:{idx:idx},
            dataType:'json',
            success:function(res){
                console.log(res);
                if(res.code==1){
                    alert('정상적으로 결제취소되었습니다');
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