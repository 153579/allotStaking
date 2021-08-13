<?php
$sub_menu = '400200';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '주문관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

/*
$sql_common = " from g5_order as ord left join g5_product as prd on ord.prd_id = prd.prd_id where ord_del_yn = 'N'";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "select * $sql_common order by ord_dttm desc limit $from_record, {$config['cf_page_rows']} ";
$result = sql_query($sql);
*/

$sql_common = " from g5_order as ord left join g5_product as prd on ord.prd_id = prd.prd_id";

$sql_search = " where ord_del_yn = 'N' ";
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
    $sst = "ord_dttm";
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
        <th scope="col">구매상품</th>
		<th scope="col">TXID</th>
        <th scope="col">진행일수</th>
        <th scope="col">이율</th>
		<th scope="col"><?php echo subject_sort_link('ord_sc_yn') ?>승인여부</a></th>
		<th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
		if($row['ord_sc_yn'] == 'Y') {
			$row['ord_sc_yn'] = "승인완료";
		}else {
			$row['ord_sc_yn'] = '<a href="./order_form_update.php?w=adm_yes&ord_id='.$row['ord_id'].'" class="btn btn_03">강제승인</a>';
		}
    ?>
    <tr class="<?php echo $bg; ?>">
        <td class="td_id"><?php echo $row['mb_id']; ?> <?php if($row['ord_cancel'] == "2") { echo "(청약철회)"; } ?></td>
        <td class="td_left"><?php echo $row['prd_name']; ?></td>
		<td class="td_left"><?php echo $row['ord_txid']; ?></td>
        <td class="td_left"><?php echo $row['prd_day_count']; ?></td>
        <td class="td_left"><?php echo $row['prd_percent']; ?></td>
		<td class="td_left"><?php echo $row['ord_sc_yn']; ?></td>
        <td class="td_mng td_mng_l">
            <a href="./order_form_update.php?w=d&amp;ord_id=<?php echo $row['ord_id']; ?>" class="btn btn_02">삭제</a>
        </td>
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
