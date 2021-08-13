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

$wdw_id = isset($_REQUEST['wdw_id']) ? $_REQUEST['wdw_id'] : "";
$w = isset($_REQUEST['w']) ? $_REQUEST['w'] : "";

if($w == ""){
	
}

if($w == "u" && $wdw_id != ""){
	
}

if($w == "d" && $wdw_id != ""){

	$ndate = date("Y-m-d h:i:s");
	$sql = "update g5_withdraw set wdw_del_yn = 'Y' , wdw_del_dttm = '{$ndate}' where wdw_id = '{$wdw_id}'";

	$result = sql_query($sql);

	alert("삭제되었습니다.", "./draw_list.php");
	
}

if($w == "adm_yes" && $wdw_id != ""){
	
	$ndate = date("Y-m-d h:i:s");
	$sql = "update g5_withdraw set wdw_sc_yn = 'Y' , wdw_sc_dttm = '{$ndate}' where wdw_id = '{$wdw_id}'";

	$result = sql_query($sql);

	alert("승인되었습니다.", "./draw_list.php");
}


goto_url("./draw_list.php");

?>
