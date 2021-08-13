<?php
$sub_menu = '300600';
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

if($w == "u" || $w == "d") $prd_id = isset($_REQUEST['prd_id']) ? $_REQUEST['prd_id'] : "";

$prd_name = isset($_POST['prd_name']) ? $_POST['prd_name'] : "";
$prd_type = isset($_POST['prd_type']) ? $_POST['prd_type'] : "";
$prd_price = isset($_POST['prd_price']) ? $_POST['prd_price'] : "";
$prd_day_count = isset($_POST['prd_day_count']) ? $_POST['prd_day_count'] : "";
$prd_percent = isset($_POST['prd_percent']) ? $_POST['prd_percent'] : "";

if($w == ""){
	$sql = "insert into g5_product set prd_name = '{$prd_name}' , prd_type = '{$prd_type}' , prd_price = '{$prd_price}' , prd_day_count = '{$prd_day_count}' , prd_percent = '{$prd_percent}'";
	$result = sql_query($sql);
}

if($w == "u" && $prd_id != ""){
	$sql = "update g5_product set prd_name = '{$prd_name}' , prd_type = '{$prd_type}' , prd_price = '{$prd_price}' , prd_day_count = '{$prd_day_count}' , prd_percent = '{$prd_percent}' 
	where prd_id = '{$prd_id}'";
	$result = sql_query($sql);
}

if($w == "d" && $prd_id != ""){
	
	$ndate = date("Y-m-d h:i:s");
	$sql = "update g5_product set prd_del_yn = 'Y' , prd_del_dttm = '{$ndate}' where prd_id = '{$prd_id}'";
	$result = sql_query($sql);
}


goto_url("./product_list.php");

?>
