<?php
$sub_menu = '400200';
include_once('./_common.php');

/*
if ($w == "u" || $w == "d")
    check_demo();

if ($w == 'd')
    auth_check($auth[$sub_menu], "d");
else
    auth_check($auth[$sub_menu], "w");

check_admin_token();
*/

$ord_id = isset($_REQUEST['ord_id']) ? $_REQUEST['ord_id'] : "";
$w = isset($_REQUEST['w']) ? $_REQUEST['w'] : "";

if($w == ""){
	
}

if($w == "u" && $prd_id != ""){
	
}

if($w == "d" && $ord_id != ""){

	$ndate = date("Y-m-d h:i:s");
	$sql = "update g5_order set ord_del_yn = 'Y' , ord_del_dttm = '{$ndate}' where ord_id = '{$ord_id}'";

	$result = sql_query($sql);

	alert("삭제되었습니다.", "./order_list.php");
	
}

if($w == "adm_yes" && $ord_id != ""){
	
	$ndate = date("Y-m-d h:i:s");
	$sql = "update g5_order set ord_sc_yn = 'Y' , ord_sc_dttm = '{$ndate}' where ord_id = '{$ord_id}'";

	$result = sql_query($sql);

	alert("승인되었습니다.", "./order_list.php");
}


goto_url("./order_list.php");

?>
