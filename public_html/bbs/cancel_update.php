<?php
	include_once('./_common.php');

	$ord_id = isset($_POST['ord_id']) ? $_POST['ord_id'] : "";
	$addr = isset($_POST['addr']) ? $_POST['addr'] : "";
	$price = isset($_POST['price']) ? $_POST['price'] : "";

	if($ord_id != "" && $addr != "" && $price != "") {

		$ndate = date("Y-m-d h:i:s");
		$sql = "insert into g5_cancel set ord_id = '{$ord_id}' , cnl_addr = '{$addr}' , cnl_price = '{$price}' , mb_id = '{$member['mb_id']}'";
		$rtn = sql_query($sql);

		$sql = "update g5_order set ord_cancel_dttm = '{$ndate}' , ord_cancel = '1' where ord_id = '{$ord_id}'";
		$rtn = sql_query($sql);

		alert("정상적으로 신청 되었습니다.");
	}
?>