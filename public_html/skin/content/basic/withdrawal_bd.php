<?php

$sql = "select * from g5_withdraw where wdw_del_yn = 'N' and mb_id = '{$member['mb_id']}'";
$wdw = sql_query($sql);

?> 

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-xl-12">

                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title" data-i18n="WITHDRAWALBD:1">
                             </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-section">
                            <div class="kt-section__content table-responsive">
                                <table class="table table-striped table-scroll_m700">
                                    <thead>
                                        <tr>
                                            <th>NUM</th>
                                            <th data-i18n="PURCHASE:3"></th>
                                            <th data-i18n="WITHDRAWAL:8"></th>
                                            <th data-i18n="WITHDRAWAL:6"></th>
                                            <th data-i18n="WITHDRAWAL:5"></th>
                                            <th data-i18n="WITHDRAWALBD:2"></th>
                                            <th data-i18n="WITHDRAWALBD:3"></th>
                                            <th class="rico_center" data-i18n="WITHDRAWALBD:4"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											$num = 0;
											while($row = sql_fetch_array($wdw)) {

											if($row['wdw_type'] == "DNB1"){
												$won = "ALT";
											}else {
												$won = "USD";
											}
										?>
                                        <tr>
                                            <th><?php echo ++$num; ?></th>
                                            <th><?php echo $row['wdw_dttm']; ?></th>
                                            <th><?php echo $row['wdw_addr']; ?></th>
                                            <th><?php echo $row['wdw_out_money']; ?> <?php echo $won; ?></th>
                                            <th><?php echo $row['wdw_fees']; ?> <?php echo $won; ?></th>
                                            <th><?php echo $row['wdw_krw']; ?></th>
											<th><?php if($row['wdw_type'] == "DNB1") { echo $row['wdw_out_money'];}else { echo round(($row['wdw_out_money']*1200)/$row['wdw_krw']); }?> ALT</th>
                                            <th class="rico_center">
												<?php if($row['wdw_sc_yn'] == 'Y') {?>
                                                <span class="btn btn-bold btn-sm btn-font-sm  btn-label-success" data-i18n="WITHDRAWALBD:5">승인</span>
												<?php }else {?>
												<span class="btn btn-bold btn-sm btn-font-sm  btn-label-fail" data-i18n="WITHDRAWALBD:6">대기</span>
												<?php }?>
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
