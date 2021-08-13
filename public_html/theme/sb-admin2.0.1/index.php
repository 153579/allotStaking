<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

if(defined('_INDEX_')) { // index에서만 실행
	include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
}


if(empty($member['mb_id'])){
	goto_url(G5_BBS_URL."/login.php");
}

$mb_id = $member['mb_id'];


/* 위 컨텐츠 */
/* DNB1 */
$sql = "select * from g5_order as ord left join g5_product as prd on ord.prd_id = prd.prd_id where prd.prd_type = 'DNB1' and ord_yn = 'Y' and ord_sc_yn = 'Y' and ord_del_yn = 'N' and mb_id = '{$mb_id}' order by ord_id desc limit 1";
$DNB1 = sql_fetch($sql);

$sql = "select count(*) as cnt from g5_payment where mb_id = '{$mb_id}' and ord_id = '{$DNB1['ord_id']}'";
$DNB1_CNT = sql_fetch($sql);

$sql = "select * from g5_wallet where mb_id = '{$mb_id}' and wlt_type = 'DNB1'";
$DNB1_WLT = sql_fetch($sql);

/* DNB2 */
$sql = "select * from g5_order as ord left join g5_product as prd on ord.prd_id = prd.prd_id where prd.prd_type = 'DNB2' and ord_yn = 'Y' and ord_sc_yn = 'Y' and ord_del_yn = 'N' and mb_id = '{$mb_id}' order by ord_id desc limit 1";

$DNB2 = sql_fetch($sql);

$sql = "select count(*) as cnt from g5_payment where mb_id = '{$mb_id}' and ord_id = '{$DNB2['ord_id']}'";
$DNB2_CNT = sql_fetch($sql);

$sql = "select * from g5_wallet where mb_id = '{$mb_id}' and wlt_type = 'DNB2'";
$DNB2_WLT = sql_fetch($sql);


//나의 누적 보상
$sql = "select * from g5_order as ord left join g5_product as prd on ord.prd_id = prd.prd_id where ord_yn = 'Y' and ord_sc_yn = 'Y' and ord_del_yn = 'N' and mb_id = '{$mb_id}' order by ord_id desc";
$rtn = sql_query($sql);

$DNB_PRICE = array();
$TODAY_PRICE = array();
$ndate = date("Y-m-d");
while($row = sql_fetch_array($rtn)){
	

	// 나의 누적보상
	$sql = "select * from g5_payment where ord_id = '{$row['ord_id']}' and pmt_del_yn = 'N'";
	$pay_rtn = sql_query($sql);

	while($pay_row = sql_fetch_array($pay_rtn)){

		$DNB_PRICE[$row['prd_type']] = $DNB_PRICE[$row['prd_type']] + $pay_row['pmt_price'];
		$DNB_PRICE['total_price'][$row['prd_type']] = $DNB_PRICE['total_price'][$row['prd_type']] + $pay_row['pmt_price'];
	}

	// 나의 누적보상
	$sql = "select * from g5_payment where ord_id = '{$row['ord_id']}' and pmt_del_yn = 'N' and LEFT(pmt_dttm, 10) = '{$ndate}'";
	$pay_rtn = sql_query($sql);

	while($pay_row = sql_fetch_array($pay_rtn)){

		$TODAY_PRICE[$row['prd_type']] = $TODAY_PRICE[$row['prd_type']] + $pay_row['pmt_price'];
		$TODAY_PRICE['total_price'][$row['prd_type']] = $TODAY_PRICE['total_price'][$row['prd_type']] + $pay_row['pmt_price'];
	}
}





?>


<!-- Begin Page Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">



    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="section-title" data-aos="zoom-out">
            <h2>Staking</h2>
            <p>ALLOT Staking</p><span data-i18n="INDEX:4-1"></span>
        </div>
        <div class="noww">
            <div class="alt_wrapper">
                <h2>ALT STAKING</h2>
                <div class="alt_cont_wrap">
                    <h2>3,000 ALT / <span class="day_sp">60Day</span></h2>
                    <p>Rate : 15%</p>
                    <p>REWARD ALL : 45 ALT</p>
                    <p>REWARD DAY : 0.75 ALT</p>
                    <p>Comming soon</p>
                </div>
                <a href="http://allot-staking.com/bbs/content.php?co_id=altstaking" class="buy_btn_click">BUY NOW</a>
            </div>

            <div class="alt_wrapper">
                <h2>ALT STAKING</h2>
                <div class="alt_cont_wrap">
                    <h2>6,000 ALT / <span class="day_sp">60Day</span></h2>
                    <p>Rate : 20%</p>
                    <p>REWARD ALL : 120 ALT</p>
                    <p>REWARD DAY : 2 ALT</p>
                    <p>Comming soon</p>
                </div>
                <a href="http://allot-staking.com/bbs/content.php?co_id=altstaking" class="buy_btn_click">BUY NOW</a>
            </div>

            <div class="alt_wrapper">
                <h2>ALT STAKING</h2>
                <div class="alt_cont_wrap">
                    <h2>12,000 ALT / <span class="day_sp">120Day</span></h2>
                    <p>Rate :40%</p>
                    <p>REWARD ALL : 480 ALT</p>
                    <p>REWARD DAY : 4 ALT</p>
                    <p>Comming soon</p>
                </div>
                <a href="http://allot-staking.com/bbs/content.php?co_id=altstaking" class="buy_btn_click">BUY NOW</a>
            </div>

            <div class="alt_wrapper">
                <h2>ALT STAKING</h2>
                <div class="alt_cont_wrap">
                    <h2>24,000 ALT / <span class="day_sp">120Day</span></h2>
                    <p>Rate : 50%</p>
                    <p>REWARD ALL : 1200 ALT</p>
                    <p>REWARD DAY : 10 ALT</p>
                    <p>Comming soon</p>
                </div>
                <a href="http://allot-staking.com/bbs/content.php?co_id=altstaking" class="buy_btn_click">BUY NOW</a>
            </div>
        </div>
        <br>
        <div class="container-title">
            <span class="container-title-content">MY ALT STAKING</span>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-6 order-lg-2 order-xl-1">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-widget14 container-relative">
                        <div class="rico_float_left">
                            <img class="flaticon_img" src="<?php echo G5_IMG_URL?>/ic_package@3x.png">
                        </div>
                        <div class="rico_float_right rico_right">
                            <p class="rico_bold" data-i18n="INDEX:MYPACKAGE">나의 패키지
                                <!-- <span class="plus" onclick="showPopup('myPackage');">+</span> -->
                            </p>
                            <p class="rico_mb0 rico_font30"><?php echo number_format($DNB1['prd_price']); ?> ALT</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 order-lg-2 order-xl-1">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-widget14 container-relative">
                        <div class="rico_float_left">
                            <img class="flaticon_img" src="<?php echo G5_IMG_URL?>/ic_daily@3x.png">
                        </div>
                        <div class="rico_float_right rico_right">
                            <p class="rico_bold" data-i18n="INDEX:myrateofreturn">나의 수익률</p>
                            <p class="rico_mb0 rico_font30"><?php echo number_format($DNB1['prd_percent']); ?> %</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 order-lg-2 order-xl-1">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-widget14 container-relative">
                        <div class="rico_float_left">
                            <img class="flaticon_img" src="<?php echo G5_IMG_URL?>/ic_d-day@3x.png">
                        </div>
                        <div class="rico_float_right rico_right">
                            <p class="rico_bold" data-i18n="INDEX:PACKAGEDDAY">패키지 D-day</p>
                            <div>
                                <span class="rico_mb0 rico_font30"><?php echo $DNB1_CNT['cnt']; ?></span>
                                <span
                                    style="font-weight: 300; font-size: 20px; align-items: center; margin-left: 4px; margin-right: 4px;">/</span>
                                <span class="rico_mb0 rico_font30"><?php echo $DNB1['prd_day_count']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 order-lg-2 order-xl-1">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-widget14 container-relative">
                        <div class="rico_float_left">
                            <img class="flaticon_img" src="<?php echo G5_IMG_URL?>/ic_wallet@3x.png">
                        </div>
                        <div class="rico_float_right rico_right">
                            <p class="rico_bold" data-i18n="INDEX:availableassets">사용 가능 자산</p>
                            <p class="rico_mb0 rico_font30">ALT <?php echo number_format($DNB1_WLT['wlt_price']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="kt-line"></div>
        <br>
        <div class="section-title" data-aos="zoom-out">
            <h2>Staking</h2>
            <p>USD Staking</p><span data-i18n="INDEX:4-1"></span>
        </div>
        <div class="noww">
            <div class="alt_wrapper">
                <h2>USD STAKING</h2>
                <div class="alt_cont_wrap">
                    <h2>5,000 USD / <span class="day_sp">60Day</span></h2>
                    <p>Rate : 6%</p>
                    <p>REWARD ALL : 300 USD</p>
                    <p>REWARD DAY : 5 USD</p>
                    <p>Comming soon</p>
                </div>
                <a href="http://allot-staking.com/bbs/content.php?co_id=usdstaking" class="buy_btn_click">BUY NOW</a>
            </div>

            <div class="alt_wrapper">
                <h2>USD STAKING</h2>
                <div class="alt_cont_wrap">
                    <h2>10,000 USD / <span class="day_sp">60Day</span></h2>
                    <p>Rate : 9%</p>
                    <p>REWARD ALL : 900 USD</p>
                    <p>REWARD DAY : 15 USD</p>
                    <p>Comming soon</p>
                </div>
                <a href="http://allot-staking.com/bbs/content.php?co_id=usdstaking" class="buy_btn_click">BUY NOW</a>
            </div>

            <div class="alt_wrapper">
                <h2>USD STAKING</h2>
                <div class="alt_cont_wrap">
                    <h2>20,000 USD / <span class="day_sp">120Day</span></h2>
                    <p>Rate : 21%</p>
                    <p>REWARD ALL : 4200 USD</p>
                    <p>REWARD DAY : 35 USD</p>
                    <p>Comming soon</p>
                </div>
                <a href="http://allot-staking.com/bbs/content.php?co_id=usdstaking" class="buy_btn_click">BUY NOW</a>
            </div>

            <div class="alt_wrapper">
                <h2>USD STAKING</h2>
                <div class="alt_cont_wrap">
                    <h2>40,000 USD / <span class="day_sp">120Day</span></h2>
                    <p>Rate : 24%</p>
                    <p>REWARD ALL : 9600 USD</p>
                    <p>REWARD DAY : 80 USD</p>
                    <p>Comming soon</p>
                </div>
                <a href="http://allot-staking.com/bbs/content.php?co_id=usdstaking" class="buy_btn_click">BUY NOW</a>
            </div>
        </div>
        <br>
        <div class="container-title">
            <span class="container-title-content">MY USD STAKING</span>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-6 order-lg-2 order-xl-1">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-widget14 container-relative">
                        <div class="rico_float_left">
                            <img class="flaticon_img" src="<?php echo G5_IMG_URL?>/ic_package@3x.png">
                        </div>
                        <div class="rico_float_right rico_right">
                            <p class="rico_bold" data-i18n="INDEX:MYPACKAGE">나의 패키지
                                <!-- <span class="plus" onclick="showPopup('myPackage');">+</span> -->
                            </p>
                            <p class="rico_mb0 rico_font30"><?php echo number_format($DNB2['prd_price']); ?> USD</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 order-lg-2 order-xl-1">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-widget14 container-relative">
                        <div class="rico_float_left">
                            <img class="flaticon_img" src="<?php echo G5_IMG_URL?>/ic_daily@3x.png">
                        </div>
                        <div class="rico_float_right rico_right">
                            <p class="rico_bold" data-i18n="INDEX:myrateofreturn">나의 수익률</p>
                            <p class="rico_mb0 rico_font30"><?php echo number_format($DNB2['prd_percent']); ?> %</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 order-lg-2 order-xl-1">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-widget14 container-relative">
                        <div class="rico_float_left">
                            <img class="flaticon_img" src="<?php echo G5_IMG_URL?>/ic_d-day@3x.png">
                        </div>
                        <div class="rico_float_right rico_right">
                            <p class="rico_bold" data-i18n="INDEX:PACKAGEDDAY">패키지 D-day</p>
                            <div>
                                <span class="rico_mb0 rico_font30"><?php echo $DNB2_CNT['cnt']; ?></span>
                                <span
                                    style="font-weight: 300; font-size: 20px; align-items: center; margin-left: 4px; margin-right: 4px;">/</span>
                                <span class="rico_mb0 rico_font30"><?php echo $DNB2['prd_day_count']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 order-lg-2 order-xl-1">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-widget14 container-relative">
                        <div class="rico_float_left">
                            <img class="flaticon_img" src="<?php echo G5_IMG_URL?>/ic_wallet@3x.png">
                        </div>
                        <div class="rico_float_right rico_right">
                            <p class="rico_bold" data-i18n="INDEX:availableassets">사용 가능 자산</p>
                            <p class="rico_mb0 rico_font30">USD <?php echo $DNB2_WLT['wlt_price']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="kt-line"></div>
        <br>


        <div class="section-title" data-aos="zoom-out">
            <h2>Staking</h2>
            <p data-i18n="INDEX:myreward"></p>
        </div>
        <br>
        <div class="row">
            <div class="col-xl-6 col-lg-6 order-lg-1 order-xl-1" style="margin-bottom:20px;">
                <div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder today-bonus">
                    <div style="display: grid; grid-template-rows: auto 1fr auto; grid-template-columns: 100%;">
                        <div class="today-bonus-title">
                            <h3 class="container-title-content" data-i18n="INDEX:mycumulativecompensation">나의 누적 보상</h3>
                        </div>
                        <div>
                            <div class="kt-card">
                                <div class="today-card-bonus">
                                    <span class="bonus-label"><img class="ic_dash_bonus"
                                            src="<?php echo G5_IMG_URL?>/ic_asset_circle.svg" style="width: 29px;"><span
                                            data-i18n="INDEX:cumulativecompensationamount">누적
                                            보상액</span></span>
                                    <div class="bonus-value1" style="text-align:right">
                                        <span class="dollar">
                                            <? echo $DNB_PRICE['DNB1']." ALT <br> ".$DNB_PRICE['DNB2']." USD"; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="today-bonus-graph">
                                <div class="kt-card" style="height:89px;">
                                    <span class="today-bonus-graph-title" data-i18n="INDEX:compensationratio">누적 보상
                                        비율</span>
                                    <div class="graph-bg">
                                        <div class="graph-bar" id="todayBonusDaily" style="width: 50%;"></div>
                                        <div class="graph-bar" id="todayBonusMatching" style="width: 100%;"></div>
                                    </div>
                                </div>
                                <ul class="today-bonus-graph-supplement">
                                    <li><i></i>ALT STAKING</li>
                                    <li><i></i>USD STAKING</li>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-line"></div>
                    </div>
                    <div>
                        <div class="today-bonus-title">
                            <h4 data-i18n="INDEX:compensationlist">누적 보상 리스트</h4>
                        </div>
                        <div class="bonus-value-list">
                            <div class="bonus-value-list-row">
                                <img class="ic_dash_bonus" src="<?php echo G5_IMG_URL?>/ic_asset_daily_dashboard.svg">
                                <span>ALT STAKING</span>
                                <span class="value">ALT <?php echo ($DNB_PRICE['DNB1']); ?></span>
                            </div>
                            <div class="bonus-value-list-row">
                                <img class="ic_dash_bonus" src="<?php echo G5_IMG_URL?>/ic_dash_today_daily.svg">
                                <span>USD STAKING</span>
                                <span class="value">USD <?php echo ($DNB_PRICE['DNB2']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 order-lg-1 order-xl-1" style="margin-bottom:20px;">
                <div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder"
                    style="display: grid; height: 100%; grid-template-rows: 323fr 289fr">
                    <div class="kt-portlet__head kt-portlet__space-x"
                        style="display: grid; grid-template-rows: auto 1fr auto 1px; grid-template-columns: 1fr;">
                        <div style="width: 100%; padding: 25px 0;">
                            <h3 class="container-title-content" data-i18n="INDEX:compensationofthedays">
                                오늘의 보상 </h3>
                        </div>
                        <div
                            style="height:178px; box-shadow: 0 3px 20px 0 #f2f3f8; background-color: #f0f2f8; display: grid; padding: 24px; border-radius: 10px; grid-template-rows: auto 1fr auto; grid-template-columns: 100%;">
                            <div>
                                <div
                                    style="align-self: center; display: grid; grid-template-rows: 100%; grid-template-columns: auto 1fr;">
                                    <img class="flaticon_img" src="img/ic_dash_bonus.svg"
                                        style="width: 18px; height: auto;">
                                    <span
                                        style="color: #848c8e;font-size: 13px; font-weight: bold; align-content: center; display: grid; margin-left: 7px;"
                                        data-i18n="INDEX:thetotalamountofcompensationfortoday">오늘의
                                        총 보상액</span>
                                </div>
                            </div>
                            <div style="margin: auto 0 15px auto;">
                                <div
                                    style="align-self: center; font-size: 34px; font-weight: 500;color: #645b5b; text-align: end;">
                                    <span>
                                        <? echo $TODAY_PRICE['total_price']['DNB1']." ALT <br> ".$TODAY_PRICE['total_price']['DNB2']." USD"; ?>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <div style="font-size: 12px; color: #818181; text-align: end;">
                                    <span style="font-weight: 300; ">Last updated</span>
                                    <span style="font-weight: 500; ">&nbsp;<?php echo G5_TIME_YMD?></span>
                                </div>
                            </div>


                        </div>

                        <div style="padding: 25px 0; font-size: 10px; color: #818181; text-align: center;">
                        </div>
                        <div class="kt-line"></div>
                    </div>
                    <div style="padding:0 20px;">
                        <div class="today-bonus-title">
                            <h4><?php echo G5_TIME_YMD?> <span data-i18n="INDEX:rwd">보상</span></h4>
                        </div>
                        <div class="bonus-value-list">
                            <div class="bonus-value-list-row">
                                <img class="ic_dash_bonus" src="<?php echo G5_IMG_URL?>/ic_asset_daily_dashboard.svg">
                                <span>ALT STAKING</span>
                                <span class="value">ALT
                                    <? echo $TODAY_PRICE['DNB1']; ?></span>
                            </div>
                            <div class="bonus-value-list-row">
                                <img class="ic_dash_bonus" src="<?php echo G5_IMG_URL?>/ic_dash_today_daily.svg">
                                <span>USD STAKING</span>
                                <span class="value">USD
                                    <? echo $TODAY_PRICE['DNB2']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-space-20"></div>
        </div>
    </div>


    <div class="popup-base" style="display: none;">
        <div class="popup-container" id="myPackage" style="display: none;">
            <div class="popup-contents">
                <div class="popup-top">
                    <h1>나의 패키지</h1>
                </div>
                <div class="popup-center">
                    <div class="popup-center-head" style="align-items: end; padding-bottom: 14px;">
                        <div style="opacity: 0.5">패키지</div>
                        <div style="opacity: 0.5">수량</div>
                    </div>

                    <div class="popup-center-body">
                        <?php
											while($row = sql_fetch_array($prd)) {

										?>
                        <div class="popup-center-body-row">
                            <div><?php echo $row['prd_name']; ?></div>
                            <div>0</div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="popup-bottom">
                    <div class="btn-list">
                        <a href="javascript:closePopup('myPackage');" class="close">닫기</a>
                        <a href="./product_pricing.php" class="more">더 구매하기</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //팝업 닫기
        function closePopup(popup_id) {
            // 회색 배경 닫기
            $(".popup-base").eq(0).css("display", "none");

            // 나의 패키지 팝업 닫기
            $("#" + popup_id).css("display", "none");
        }

        //팝업 열기
        function showPopup(popup_id) {
            // 회색 배경 열기
            $(".popup-base").eq(0).css("display", "block");

            // 나의 패키지 팝업 열기
            $("#" + popup_id).css("display", "grid");
        }
    </script>
    <!-- /.container-fluid -->

    <?php
include_once(G5_THEME_PATH.'/tail.php');
?>