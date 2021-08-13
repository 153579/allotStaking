<?php
	$sql = "select * from g5_order as ord left join g5_product as prd on ord.prd_id = prd.prd_id where ord_yn = 'Y' and ord_del_yn = 'N' and mb_id = '{$member['mb_id']}' order by ord_dttm desc";
	$ord = sql_query($sql);
?>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title" data-i18n="PURCHASE:1">구매 내역 </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-section">
                        <div class="kt-section__content table-responsive">
                            <table class="table table-striped table-scroll_m700">
                                <thead>
                                    <tr>
                                        <th class="rico_center" data-i18n="PURCHASE:2">패키지명</th>
                                        <th class="rico_center" data-i18n="PURCHASE:3">구매 일시</th>
										<th class="rico_center" data-i18n="PURCHASE:4">입금 ALT</th>
										<th class="rico_center" data-i18n="PURCHASE:5">이율</th>
										<th class="rico_center" data-i18n="PURCHASE:6">구매당시 단가</th>
										<th class="rico_center" data-i18n="PURCHASE:7">일 수</th>
										<th class="rico_center">TXID</th>
										<th class="rico_center" data-i18n="PURCHASE:8">상태</th>
										<th class="rico_center" data-i18n="PURCHASE:9">기능</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php

										while($row = sql_fetch_array($ord)){	
										
										$sql = "select count(*) as cnt from g5_payment where ord_id = '{$row[ord_id]}'";
										$payment = sql_fetch($sql);

										$is_check = "<p data-i18n='PURCHASE:97' style='margin-top:10px'>대기</p>";
										if($row['ord_txid'] != "" && $row['ord_sc_yn'] == "N") { $is_check = "<p data-i18n='PURCHASE:98' style='margin-top:10px'>검사중</p>";}
										if($row['ord_txid'] != "" && $row['ord_sc_yn'] == "Y") { $is_check = "<p data-i18n='PURCHASE:99' style='margin-top:10px'>구매완료</p>"; }
										if($row['prd_type'] == "DNB2"){
											$row['prd_price'] = round(($row['prd_price'] * 1200) / $row['ord_value'] , 4);
										}

										
									?>
                                    <tr>
                                        <th class="rico_center"><?php echo $row['prd_name']; ?></th>
                                        <th class="rico_center"><?php echo $row['ord_dttm']; ?></th>
										<th class="rico_center"><?php echo $row['prd_price']; ?> ALT</th>
										<th class="rico_center"><?php echo $row['prd_percent']; ?>%</th>
										<th class="rico_center"><?php echo $row['ord_value']; ?></th>
										<th class="rico_center"><?php echo $row['prd_day_count']; ?>DAY</th>
                                        <th class="rico_center"><?php echo $row['ord_txid']; ?></th>
										<th class="rico_center"><?php echo $is_check; ?></th>
										<th class="rico_center">

										<?php if($row['ord_cancel'] == "1") { ?>
											<span data-i18n="PURCHASE:10">철회진행중</span>
										<?php }else if($row['ord_cancel'] == "2") { ?>
											<span data-i18n="PURCHASE:11">철회완료</span>
										<?php }else {?>
											<?php if($row['ord_txid'] != "" && $payment['cnt'] < $row['prd_day_count']) { ?>
											<a href="./content.php?co_id=order_cancel&ord_id=<?php echo $row['ord_id']; ?>"><span data-i18n="PURCHASE:12">청약철회</span></a>
										<?php } } ?>
										</th>
                                    </tr>
									<?php
										}
									?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
