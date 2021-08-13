<?php
$sub_menu = '400200';
include_once('./_common.php');


$cnl_id = isset($_REQUEST['cnl_id']) ? $_REQUEST['cnl_id'] : "";
$w = isset($_REQUEST['w']) ? $_REQUEST['w'] : "";

if($w == ""){
	
}

if($w == "u" && $cnl_id != ""){
	
}


if($w == "adm_yes" && $cnl_id != ""){
	
	$ndate = date("Y-m-d h:i:s");

	$sql = "select * from g5_cancel where cnl_id = '{$cnl_id}'";
	$cnl = sql_fetch($sql);

	$sql = "update g5_cancel set cnl_yn = 'Y' , cnl_dttm = '{$ndate}' where cnl_id = '{$cnl_id}'";
	$result = sql_query($sql);

	$sql = "update g5_order set ord_cancel = '2' , ord_cancel_dttm = '{$ndate}' where ord_id = '{$cnl['ord_id']}'";
	$result = sql_query($sql);

	alert("승인되었습니다.", "./cancel_list.php");
}


goto_url("./cancel_list.php");

?>
