<?php
$sub_menu = '400100';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

auth_check($auth[$sub_menu], "w");

$html_title = "관리자";
$g5['title'] = $html_title.' 설정';
$readonly = '';


$html_title .= " 수정";
$readonly = " readonly";

$sql = " select * from g5_master_config";
$co = sql_fetch($sql);


include_once (G5_ADMIN_PATH.'/admin.head.php');
?>

<form name="frmcontentform" action="./admin_setting_update.php" onsubmit="return frmcontentform_check(this);" method="post" enctype="MULTIPART/FORM-DATA" >
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
        <th scope="row"><label for="mc_dnb1">DNBplus</label></th>
        <td>
			<select name="mc_dnb1">
				<option value="on" <?php if($co['mc_dnb1'] == "on") {echo "selected";} ?>>ON</option>
				<option value="off" <?php if($co['mc_dnb1'] == "off") {echo "selected";} ?>>OFF</option>
			</select>
		</td>
    </tr>
	<tr>
        <th scope="row"><label for="mc_dnb2">DNBplus +</label></th>
        <td>
			<select name="mc_dnb2">
				<option value="on" <?php if($co['mc_dnb2'] == "on") {echo "selected";} ?>>ON</option>
				<option value="off" <?php if($co['mc_dnb2'] == "off") {echo "selected";} ?>>OFF</option>
			</select>
		</td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <input type="submit" value="확인" class="btn btn_submit" accesskey="s">
</div>

</form>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
