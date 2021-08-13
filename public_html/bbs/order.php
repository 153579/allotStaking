<?php
include_once('./_common.php');

$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : "";
$ord_id = isset($_REQUEST['ord_id']) ? $_REQUEST['ord_id'] : "";
$prd_id = isset($_REQUEST['prd_id']) ? $_REQUEST['prd_id'] : "";
$co_id = isset($_REQUEST['co_id']) ? $_REQUEST['co_id'] : "";
$txid = isset($_REQUEST['txid']) ? $_REQUEST['txid'] : "";
$mb_id = isset($member['mb_id']) ? $member['mb_id'] : "";


$ndate = date("Y-m-d h:i:s");

if($type == "cancel"){
	
	$sql = "update g5_order set ord_cancel = '1' , ord_cancel_dttm = '{$ndate}' where ord_id = '{$ord_id}'";
	$rtn = sql_query($sql);

	alert("청약철회가 신청 되었습니다.", "./content.php?co_id=Purchase_details");
}

if($type == "d"){

	$sql = "update g5_order set ord_del_dttm = '{$ndate}' , ord_del_yn = 'Y' where ord_id = '{$ord_id}'";
	$rtn = sql_query($sql);

	alert("취소 되었습니다." , "./content.php?co_id=".$co_id);
}

if($type == "w"){

	$msg = "";
	// txid를 안넣은 내가 주문하게 있는지 
		$sql = "select * from g5_order where mb_id = '{$mb_id}' and ord_yn = 'Y' and ord_sc_yn = 'N' and ord_del_yn = 'N' and ord_txid is null";
		$my_rtn = sql_fetch($sql);
		
		if( ! isset($my_rtn['ord_id'])) {
			// txid는 넣었는데 승인이 안난게 있는지
			$sql = "select * from g5_order where mb_id = '{$mb_id}' and ord_yn = 'Y' and ord_sc_yn = 'N' and ord_del_yn = 'N' and ord_txid is not null";
			$my_rtn2 = sql_fetch($sql);

			if(isset($my_rtn2['ord_id'])){

				$ord_id = $my_rtn2['ord_id'];
				$ord_txid = $my_rtn2['ord_txid'];
			}

		}else {
			$ord_id = $my_rtn['ord_id'];
		}
		
		if($ord_id != ""){
			alert("확인중인 TXID가 있습니다." , "./content.php?co_id=".$co_id);
		}


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

		$sql = "insert into g5_order set prd_id = '{$prd_id}' , mb_id = '{$mb_id}' , ord_value = '{$dnb_size}'";
		$rtn = sql_query($sql);

		$sql = "select * from g5_order where mb_id = '{$mb_id}' and ord_yn = 'Y' and ord_sc_yn = 'N' and ord_del_yn = 'N'";
		$rtn = sql_fetch($sql);

		$prd_price = 50000;
		if($prd['prd_type'] == "DNB2"){
			$prd_price = round(($prd['prd_price'] * 1200) / $rtn['ord_value']);
		}
		
		$result = miriSms("[ALLOT] \n패키지 신청완료 되었습니다.\n", "01058311333");
		$result = miriSms("[ALLOT] \n패키지 신청완료 되었습니다.\n", "01036149297");


		alert("신청 완료 하였습니다." , "./content.php?co_id=".$co_id);
}

if($type == "txid"){
	
	$sql = "select * from g5_order where ord_txid = '{$txid}'";
	$rtn = sql_query($sql);
	if($rtn->num_rows > 0){
		alert("사용할수 없는 TXID 입니다." , "./content.php?co_id=".$co_id);
	}

	$sql = "update g5_order set ord_txid = '{$txid}' where mb_id = '{$mb_id}' and ord_id = '{$ord_id}'";
	$rtn = sql_query($sql);

	alert("TXID등록 완료 하였습니다." , "./content.php?co_id=".$co_id);
}



?>