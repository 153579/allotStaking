<?php
	include_once('./_common.php');

	$mb_id = isset($_REQUEST['mb_id']) ? $_REQUEST['mb_id'] : "";
	$prd_id = 7;

	$sql = "select * from g5_product where prd_id = '{$prd_id}'";
	$prd = sql_fetch($sql);

	// 지갑 확인
	$sql = "select * from g5_wallet where mb_id = '{$mb_id}' and wlt_type = '{$prd['prd_type']}'";
	$rtn = sql_query($sql);
		
	if($rtn->num_rows <= 0){
		$sql = "insert into g5_wallet set mb_id = '{$mb_id}' , wlt_type = '{$prd['prd_type']}'";
		$rtn = sql_query($sql);
	}

	$dnb_size = $master['mc_value'];

	$sql = "insert into g5_order set prd_id = '{$prd_id}' , mb_id = '{$mb_id}' , ord_sc_yn = 'Y', ord_sc_dttm = '{$ndate}' , ord_value = '{$dnb_size}' , ord_txid = 'hidden'";
	$rtn = sql_query($sql);

	$sql = "update g5_member set mb_1 = 'hidden' where mb_id = '{$mb_id}'";
	$rtn = sql_query($sql);

	alert("신청 완료 하였습니다." , "./member_list.php");
?>