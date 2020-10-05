<style>
    #hit-status .panel-body{font-size:3em;font-weight:700;}
</style>

<div class="row" id="hit-status">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">하루 유입수</div>
            <div class="panel-body"><?=$hits['daily']?></div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">주간 유입수</div>
            <div class="panel-body"><?=$hits['weekly']?></div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">월간 유입수</div>
            <div class="panel-body"><?=$hits['monthly']?></div>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">가장많은 링크클릭</div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                    <?
                    if(is_array($rank_click) && count($rank_click)>0){
                        $rank_crit = 0;
                        foreach($rank_click as $i => $rank){
                            if($i==0){
                                $rank_crit = $rank['cnt'];
                            }

                            $percent = ($rank['cnt']/$rank_crit)*100;
                            ?>
                            <tr>
                                <th><?=$rank['first_name']." ".$rank['last_name']?></th>
                                <td class="graph-bar">
                                    <div class="progress">
                                        <div class="progress-bar" aria-valuenow="<?=$percent?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$percent?>%;"></div>
                                    </div>
                                </td>
                                <td class="td-num">
                                    <?=$rank['cnt']?>
                                </td>
                            </tr>
                            <?
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">가장많은 후원수</div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                    <?
                    if(is_array($rank_payment) && count($rank_payment)>0){
                        $rank_crit = 0;
                        foreach($rank_payment as $i => $rank){
                            if($i==0){
                                $rank_crit = $rank['cnt'];
                            }

                            $percent = ($rank['cnt']/$rank_crit)*100;
                            ?>
                            <tr>
                                <th><?=$rank['first_name']." ".$rank['last_name']?></th>
                                <td class="graph-bar">
                                    <div class="progress">
                                        <div class="progress-bar" aria-valuenow="<?=$percent?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$percent?>%;"></div>
                                    </div>
                                </td>
                                <td class="td-num">
                                    <?=$rank['cnt']?>
                                </td>
                            </tr>
                            <?
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
