<?php

$sql = "select * from g5_payment where mb_id = '{$member['mb_id']}' and pmt_del_yn = 'N' order by pmt_dttm desc";
$rtn = sql_query($sql);

$sql = "select sum(pmt_price) as pmt_price from g5_payment where mb_id = '{$member['mb_id']}' and pmt_type = 'DNB1' and pmt_del_yn = 'N' order by pmt_dttm desc";
$DNB1 = sql_fetch($sql);

$sql = "select sum(pmt_price) as pmt_price from g5_payment where mb_id = '{$member['mb_id']}' and pmt_type = 'DNB2' and pmt_del_yn = 'N' order by pmt_dttm desc";
$DNB2 = sql_fetch($sql);



?>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="container-title">
        <span class="container-title-content" data-i18n="sidebar:total">전체 보너스</span>
    </div>
    <div class="row">
        <div class="col-lg-4 order-xl-1">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-widget14 container-relative">
                    <div class="rico_float_right rico_right">
                        <p class="rico_bold" data-i18n="sidebar:ALT">ALT STAKING</p>
                        <p class="rico_mb0 rico_font30">
                             <?php echo round($DNB1['pmt_price'] ,2); ?> ALT</p>
                    </div>
                    <div class="rico_float_left">
                        <img class="flaticon_img" src="<?php echo G5_IMG_URL?>/ic_asset_daily.svg">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-xl-1">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-widget14 container-relative">
                    <div class="rico_float_right rico_right">
                        <p class="rico_bold" data-i18n="sidebar:USD">USD STAKING</p>
                        <p class="rico_mb0 rico_font30">
                             <?php echo round($DNB2['pmt_price'] , 2); ?> USD</p>
                    </div>
                    <div class="rico_float_left">
                        <img class="flaticon_img" src="<?php echo G5_IMG_URL?>/ic_asset_grade.svg">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">

            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title container-card-title"  data-i18n="BONUSALL:breakdown">
                            내역 </h3>
                    </div>
                    <form class="kt-form kt-form--label-right" method="GET" action="/myoffice/point_list_all.php">
                        <div class="row align-items-center form_content_right">
                            <div class="order-2 ">
							<!--
                                <div class="tool--right row align-items-center justify-content-right"
                                    style="margin:10px;">
                                    <div class="item rico_right rico_left_m767">
                                        <div class="kt-form__group kt-form__group--inline rico_width100">
                                            <div class="kt-form__label">
                                                <label>합산</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="input-group">
                                            <input type="text" value="0.00" class="form-control" readonly="">
                                        </div>
                                    </div>
                                </div>
								-->
                            </div>
                        </div>
                    </form>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-section">
                        <div class="kt-section__content table-responsive">
                            <table class="table table-striped table-scroll_m700">
                                <thead>
                                    <tr>
                                        <th class="rico_center" data-i18n="BONUSALL:DATE">일시</th>
                                        <th class="rico_center" data-i18n="BONUSALL:CONTENT">내용</th>
                                        <th class="rico_center" data-i18n="BONUSALL:BONUS">보너스</th>
                                        <th class="rico_center" data-i18n="BONUSALL:Remaining">잔여</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
									
									while($row = sql_fetch_array($rtn)){
										
										$won = ($row['pmt_type'] == "DNB1") ? "ALT" : "USD";
										$row['pmt_type'] = ($row['pmt_type'] == "DNB1") ? "ALLOT" : "USD";
								?>
                                    <tr>
                                        <th class="rico_center"><?php echo $row['pmt_dttm']; ?></th>
											<th class="rico_center"><?php echo $row['pmt_type'];?> STAKING <span data-i18n="BONUSALL:Allowance">수당</span></th>
											<th class="rico_center"><?php echo $row['pmt_price']." ".$won; ?></th>
											<th class="rico_center"><?php echo $row['pmt_price']+$row['pmt_bf_price']." ".$won;?></th>
                                    </tr>
								<?php
									}	
								?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div style="align-self: center">
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>