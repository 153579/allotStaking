<?php
$sub_menu = '400400';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '출금관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

/*
$sql_common = " from g5_withdraw where wdw_del_yn = 'N'";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "select * $sql_common order by wdw_dttm desc limit $from_record, {$config['cf_page_rows']} ";
$result = sql_query($sql);
*/

$sql_common = " from g5_withdraw ";

$sql_search = " where wdw_del_yn = 'N' ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_id' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "wdw_dttm";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

?>

<div class="local_ov01 local_ov">
    <?php if ($page > 1) {?><a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">처음으로</a><?php } ?>
    <span class="btn_ov01"><span class="ov_txt">전체 내용</span><span class="ov_num"> <?php echo $total_count; ?>건</span></span>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="btn_fixed_top">

</div>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col"><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
		<th scope="col"><?php echo subject_sort_link('wdw_dttm') ?>신청일시</a></th>
        <th scope="col"><?php echo subject_sort_link('wdw_addr') ?>주소</a></th>
		<th scope="col"><?php echo subject_sort_link('wdw_krw') ?>단가</a></th>
        <th scope="col"><?php echo subject_sort_link('wdw_out_money') ?>신청금액</a></th>
		<th scope="col"><?php echo subject_sort_link('wdw_fees') ?>수수료</a></th>
		<th scope="col"><?php echo subject_sort_link('wdw_price') ?>총액</a></th>
		<th scope="col"><?php echo subject_sort_link('wlt_price') ?>잔액</a></th>
		<th scope="col">ALT환산</a></th>
		<th scope="col"><?php echo subject_sort_link('wdw_sc_yn') ?>출금여부</a></th>
    </tr>
    </thead>
    <tbody>
    <?php for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
		
		$dnb_price = $row['wdw_out_money'];
		if($row['wdw_type'] == "DNB2") {
			$dnb_price = round(($row['wdw_out_money'] * 1200) / $row['wdw_krw']);
		}
		
		$wdw_btn = "출금완료";
		if($row['wdw_sc_yn'] == "N"){
			$wdw_btn = '<a href="./draw_form_update.php?w=adm_yes&wdw_id='.$row['wdw_id'].'" class="btn btn_03">출금승인</a>';
		}
    ?>
    <tr class="<?php echo $bg; ?>">
        <td class="td_id"><?php echo $row['mb_id']; ?></td>
        <td class="td_center"><?php echo $row['wdw_dttm']; ?></td>
		<td class="td_left"><?php echo $row['wdw_addr']; ?></td>
        <td class="td_center"><?php echo $row['wdw_krw']; ?></td>
        <td class="td_center"><?php echo $row['wdw_out_money']; ?></td>
		<td class="td_center"><?php echo $row['wdw_fees']; ?></td>
		<td class="td_center"><?php echo $row['wdw_price']; ?></td>
		<td class="td_center"><?php echo $row['wlt_price']; ?></td>
		<td class="td_center"><?php echo number_format($dnb_price); ?></td>
		<td class="td_center"><?php echo $wdw_btn; ?></td>
    </tr>
    <?php
    }
    if ($i == 0) {
        echo '<tr><td colspan="3" class="empty_table">자료가 한건도 없습니다.</td></tr>';
    }
    ?>
    </tbody>
    </table>
</div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
