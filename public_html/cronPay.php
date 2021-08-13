<?php

	include_once('/home/altstking/public_html/common.php');
	
	for($i=0; $i<59; $i++){

		$sql = "select * from g5_order as ord left join g5_product as prd on ord.prd_id = prd.prd_id where ord_yn = 'Y' and ord_sc_yn = 'Y' and ord_del_yn = 'N' and ord_cancel = '0'";
		$rtn = sql_query($sql);

		$DONATE = $master['mc_donate'];
		$FEES = $master['mc_fees'];
		$ME = $master['mc_me'];
		
		$temp = 0;
		$DONE_PRICE = 0;
		$FEES_PRICE = 0;

		while($row = sql_fetch_array($rtn)){
			
			//일수 확인
			$sql = "select count(*) as cnt from g5_payment where ord_id = '{$row['ord_id']}'";
			$cnt = sql_fetch($sql);

			$sql = "select * from g5_wallet where mb_id = '{$row['mb_id']}' and wlt_type = '{$row['prd_type']}'";
			$wallet = sql_fetch($sql);
			
			if( ($cnt['cnt']+1) > $row['prd_day_count']){
				continue;		
			}else if( ($cnt['cnt']+1) == $row['prd_day_count']){

				// 갯수를 나눠준다
				$DNB_PRICE = $row['prd_price'];
				$ADD_PRICE = ($DNB_PRICE * (0.01 * $row['prd_percent']));

				$DAY_PRICE = round($ADD_PRICE / $row['prd_day_count'], 2);

				$MY_PRICE = round($DAY_PRICE,2) + $row['prd_price'];
				$TOTAL_PRICE = $MY_PRICE + $wallet['wlt_price'];

				$TOTAL_PRICE = $row['prd_price'] + $wallet['wlt_price'];

				// 지급내역 추가
				$sql = "insert into g5_payment set ord_id = '{$row['ord_id']}' , mb_id = '{$row['mb_id']}', pmt_price = '{$MY_PRICE}' , pmt_bf_price = '{$wallet['wlt_price']}' , pmt_donate = '{$DONE_PRICE}'
				, pmt_fees = '{$FEES_PRICE}' , pmt_type = '{$row['prd_type']}'";
				$pmt_upt = sql_query($sql);


				// 지갑에 돈 추가
				$sql = "update g5_wallet set wlt_price = '{$TOTAL_PRICE}' where mb_id = '{$row['mb_id']}' and wlt_type = '{$row['prd_type']}'";
				$wlt_upt = sql_query($sql);

				continue;
			}


			$temp++;

			// 갯수를 나눠준다
			$DNB_PRICE = $row['prd_price'];
			$ADD_PRICE = ($DNB_PRICE * (0.01 * $row['prd_percent']));

			$DAY_PRICE = round($ADD_PRICE / $row['prd_day_count'], 2);

			$MY_PRICE = round($DAY_PRICE,2);
			$TOTAL_PRICE = $MY_PRICE + $wallet['wlt_price'];

			// 지급내역 추가
			$sql = "insert into g5_payment set ord_id = '{$row['ord_id']}' , mb_id = '{$row['mb_id']}', pmt_price = '{$MY_PRICE}' , pmt_bf_price = '{$wallet['wlt_price']}' , pmt_donate = '{$DONE_PRICE}'
			, pmt_fees = '{$FEES_PRICE}' , pmt_type = '{$row['prd_type']}'";
			$pmt_upt = sql_query($sql);

			// 지갑에 돈 추가
			$sql = "update g5_wallet set wlt_price = '{$TOTAL_PRICE}' where mb_id = '{$row['mb_id']}' and wlt_type = '{$row['prd_type']}'";
			$wlt_upt = sql_query($sql);

		}
		
		$sql = "insert into g5_crontab set crn_msg = 'PAYMENT_CHECK (".$temp.")'";
		$rtn = sql_query($sql);
		
		echo "check success";

	}

?>