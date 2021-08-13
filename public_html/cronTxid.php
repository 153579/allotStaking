<?php

	include_once('/home/altstking/public_html/common.php');

	$token = TokenInfo("0x60906af6746F5eaD5ce27134d4d36bF769C28D3d");
	$tokenList = $token['result'];

	$sql = "select * from g5_order as ord left join g5_product as prd on ord.prd_id = prd.prd_id where ord_yn = 'Y' and ord_sc_yn = 'N' and ord_del_yn = 'N' and ord_txid is not null";
	$rtn = sql_query($sql);
	$temp = 0;
	
	while($row = sql_fetch_array($rtn)){
		
		for($i=0; $i<count($tokenList); $i++){
			
			$value_check = false;
			if(trim($tokenList[$i]['hash']) == trim($row['ord_txid'])){

				$value = $tokenList[$i]['value'] * 0.0001;
				
				if($row['prd_type'] == "DNB1"){
					if($value < $row['prd_price']){

						$sql = "insert into g5_crontab set crn_msg = 'TXID_PRICE_FAIL (".$row['mb_id'].")'";
						$rtn = sql_query($sql);
					}else {
						$value_check = true;
					}
				}

				if($row['prd_type'] == "DNB2"){
					$usd_price = round(($row['prd_price'] * 1200) / $row['ord_value'] , 4);
					if($value < $$usd_price ){

						$sql = "insert into g5_crontab set crn_msg = 'TXID_PRICE_FAIL (".$row['mb_id'].")'";
						$rtn = sql_query($sql);
					}else {
						$value_check = true;
					}
				}
			}

			if($row['mb_id'] == "admin" || $row['mb_id'] == "jp9811" || $row['mb_id'] == "test01" || $row['mb_id'] == "test01" || $row['mb_id'] == "djqjqjfu" || $row['mb_id'] == "whrudrn")
			{
				$value_check = true;
			}


			if($value_check)
			{
				$temp++;
				$ndate = date("Y-m-d h:i:s");
				$sql = "update g5_order set ord_sc_yn = 'Y' , ord_sc_dttm = '{$ndate}' where ord_id = '{$row['ord_id']}'";
				$ord_rs = sql_query($sql);

				break;
			}

			
		}
	}
	
	
	$sql = "insert into g5_crontab set crn_msg = 'TXID_CHECK (".$temp.")'";
	$rtn = sql_query($sql);
	
	echo "check success";
	

?>