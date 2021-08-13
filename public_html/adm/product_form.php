<?php
$sub_menu = '400100';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

auth_check($auth[$sub_menu], "w");

$html_title = "상품";
$g5['title'] = $html_title.' 관리';
$readonly = '';

if ($w == "u")
{
    $html_title .= " 수정";
    $readonly = " readonly";

    $sql = " select * from g5_product where prd_id = '$prd_id' ";
    $co = sql_fetch($sql);
    if (!$co['prd_id'])
        alert('등록된 자료가 없습니다.');
}
else
{
    $html_title .= ' 입력';
}

include_once (G5_ADMIN_PATH.'/admin.head.php');
?>

<form name="frmcontentform" action="./product_form_update.php" onsubmit="return frmcontentform_check(this);" method="post" enctype="MULTIPART/FORM-DATA" >
<input type="hidden" name="w" value="<?php echo $w; ?>">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="prd_name">상품이름</label></th>
        <td><input type="text" name="prd_name" value="<?php echo $co['prd_name']; ?>" id="prd_name" required class="frm_input required"></td>
    </tr>
    <tr>
        <th scope="row"><label for="prd_type">상품타입</label></th>
        <td>
			<select name="prd_type">
				<option value="DNB1">DNB1 (개수로만)</option>
				<option value="DNB2">DNB2 (USD계산)</option>
			</select>
		</td>
    </tr>
	<tr>
        <th scope="row"><label for="prd_price">상품금액</label></th>
        <td><input type="text" name="prd_price" value="<?php echo $co['prd_price']; ?>" id="prd_price" required class="frm_input required" placeholder="개수 OR 금액"></td>
    </tr>
	<tr>
        <th scope="row"><label for="prd_day_count">상품진행일수</label></th>
        <td><input type="text" name="prd_day_count" value="<?php echo $co['prd_day_count']; ?>" id="prd_day_count" required class="frm_input required" placeholder=""></td>
    </tr>
	<tr>
        <th scope="row"><label for="prd_percent">상품이율</label></th>
        <td><input type="text" name="prd_percent" value="<?php echo $co['prd_percent']; ?>" id="prd_percent" required class="frm_input required" placeholder=""> %</td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./product_list.php" class="btn btn_02">목록</a>
    <input type="submit" value="확인" class="btn btn_submit" accesskey="s">
</div>

</form>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
