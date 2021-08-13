<?php
	include_once('./_common.php');

	$mb_id = $member['mb_id'];
	$prd_id = $_REQUEST['prd_id'];
	$ord_id = $_REQUEST['ord_id'];
	$txid = trim($_REQUEST['txid']);
	$type = $_REQUEST['type'];
	
	$dnb_size = DNBsize();

	if($mb_id == "" || $type == "" ){

		echo json_encode(array( "result" => "404" , "msg" => "param fail"));
		exit();
	}


	if($type == "w"){

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
			echo json_encode(array( "result" => "404" , "msg" => "fail"));
			exit();
		}


		$sql = "select * from g5_product where prd_id = '{$prd_id}'";
		$prd = sql_fetch($sql);

		$sql = "select * from g5_wallet where mb_id = '{$mb_id}' and wlt_type = '{$prd['prd_type']}'";
		$rtn = sql_query($sql);
			
		if($rtn->num_rows <= 0){
			$sql = "insert into g5_wallet set mb_id = '{$mb_id}' , wlt_type = '{$prd['prd_type']}'";
			$rtn = sql_query($sql);
		}

	
		$sql = "insert into g5_order set prd_id = '{$prd_id}' , mb_id = '{$mb_id}' , ord_value = '{$dnb_size}'";
		$rtn = sql_query($sql);

		$sql = "select * from g5_order where mb_id = '{$mb_id}' and ord_yn = 'Y' and ord_sc_yn = 'N' and ord_del_yn = 'N'";
		$rtn = sql_fetch($sql);

		echo json_encode(array( "result" => "00" , "msg" => "success" , "ord_id" => $rtn['ord_id']));
		exit();
	}

	else if($type == "d"){
		
		$ndate = date("Y-m-d h:i:s");
		$sql = "update g5_order set ord_del_dttm = '{$ndate}' , ord_del_yn = 'Y' where mb_id = '{$mb_id}' and ord_id = '{$ord_id}'";
		$rtn = sql_query($sql);

		echo json_encode(array( "result" => "00" , "msg" => "success"));
		exit();
	}

	else if($type == "txid"){
		
		$ndate = date("Y-m-d h:i:s");

		$sql = "select * from g5_order where ord_txid = '{$txid}'";
		$rtn = sql_query($sql);
		if($rtn->num_rows > 0){
			echo json_encode(array( "result" => "404" , "msg" => "fail"));
			exit();
		}

		$sql = "update g5_order set ord_txid = '{$txid}' where mb_id = '{$mb_id}' and ord_id = '{$ord_id}'";
		$rtn = sql_query($sql);

		echo json_encode(array( "result" => "00" , "msg" => "success"));
		exit();
	}

	else if($type == "product"){
		
		$sql = "select * from g5_order where ord_id = '{$ord_id}'";
		$rtn = sql_fetch($sql);

		$sql = "select * from g5_product where prd_id = '{$rtn['prd_id']}'";
		$rtn = sql_fetch($sql);

		$prd_price = $rtn['prd_price'];
		if($rtn['prd_type'] == "DNB2"){
			$prd_price = round(($prd_price * 1200) / $ord['ord_value'], 4);
		}

		echo json_encode(array( "result" => "00" , "msg" => "success", "prd_price" => $prd_price , "prd_name" => $rtn['prd_name']));
		exit();
	}

	else if($type == "is_order"){
		
		$ord_id = "";
		$prd_price = "";
		$ord_txid = "";

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
		
		
		$sql = "select * from g5_order where ord_id = '{$ord_id}'";
		$ord = sql_fetch($sql);
		if($ord_id != ""){
			$sql = "select * from g5_product where prd_id = '{$ord['prd_id']}'";
			$rtn = sql_fetch($sql);

			$prd_price = $rtn['prd_price'];
			if($rtn['prd_type'] == "DNB2"){
				$prd_price = round(($prd_price * 1200) / $ord['ord_value']);
			}
		}
		
		echo json_encode(array( "result" => "00" , "msg" => "success", "ord_id" => $ord_id, "prd_price" => $prd_price , "price" => $rtn['prd_price'] ,"ord_txid" => $ord_txid , "prd_name" => $rtn['prd_name']));
		exit();
	}
	
?>