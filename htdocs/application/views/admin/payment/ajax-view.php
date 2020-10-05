<table class="table table-default">
    <tbody>
    <tr>
        <th>결제상태</th>
        <td><?=$this->pay_status[$payment['status']]?></td>
    </tr>

    <tr>
        <th>요청일시</th>
        <td><?=($payment['regdate'])?date('Y-m-d H:i:s',$payment['regdate']):''?></td>
    </tr>

    <tr>
        <th>결제일시</th>
        <td><?=($payment['paydate'])?date('Y-m-d H:i:s',$payment['paydate']):''?></td>
    </tr>

    <tr>
        <th>결제수단</th>
        <td><?=$this->pay_method[$payment['pay_method']]?></td>
    </tr>

    <tr>
        <th>요청금액</th>
        <td><?=number_format($payment['pay_price'])?>원</td>
    </tr>

    <tr>
        <th>결제금액</th>
        <td><?=number_format($payment['pay_amt'])?>원</td>
    </tr>

    <?
    switch($payment['pay_method']){
        case 'card':
            ?>
            <tr>
                <th>카드명</th>
                <td><?=$pay['data']['payment_data']['card_name']?></td>
            </tr>

            <tr>
                <th>카드번호</th>
                <td><?=$pay['data']['payment_data']['card_no']?></td>
            </tr>

            <tr>
                <th>할부개월</th>
                <td><?=$pay['data']['payment_data']['card_quota']?></td>
            </tr>

            <tr>
                <th>승인번호</th>
                <td><?=$pay['data']['payment_data']['card_auth_no']?></td>
            </tr>
            <?
            break;

        case 'vbank':
            ?>
            <tr>
                <th>입금은행</th>
                <td><?=$pay['data']['payment_data']['bankname']?></td>
            </tr>

            <tr>
                <th>계좌번호</th>
                <td><?=$pay['data']['payment_data']['account']?></td>
            </tr>

            <tr>
                <th>입금자명</th>
                <td><?=$pay['data']['payment_data']['username']?></td>
            </tr>

            <tr>
                <th>계좌만료일시</th>
                <td><?=$pay['data']['payment_data']['expiredate']?></td>
            </tr>
            <?
            break;
    }
    ?>
    </tbody>
</table>

<?if($payment['pay_method']=='card' && $payment['status']==200){?>
<a href="javascript:do_payment_cancel('<?=$payment['idx']?>')" class="btn btn-default btn-sm">결제 취소</a>
<?}?>