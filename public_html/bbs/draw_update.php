<?php

	include_once('./_common.php');
	
	$wlt_type = isset($wlt_type) ? $wlt_type : ""; //출금수수료
	$fees_val = isset($fees_val) ? $fees_val : ""; //출금수수료
	$out_money = isset($out_money) ? $out_money : ""; //신청금액
	$real_money = isset($real_money) ? $real_money : ""; // 합산총액
	$addr = isset($addr) ? $addr : ""; //출금주소
	

	if($fees_val =="" || $out_money =="" || $real_money =="" || $addr == "" || $wlt_type == ""){
		alert("모두 입력후 출금신청 부탁드립니다.", "./content.php?co_id=withdrawal_ap");
	}

	if($wlt_type == "DNB1" && (1000 > $real_money)){
		alert("최소 출금액은 1000ALT 입니다.", "./content.php?co_id=withdrawal_ap");
	}

	if($wlt_type == "DNB2" && (100 > $real_money)){
		alert("최소 출금액은 100USD 입니다.", "./content.php?co_id=withdrawal_ap");
	}

	$sql = "select * from g5_wallet where mb_id = '{$member['mb_id']}' and wlt_type = '{$wlt_type}'";
	$wlt = sql_fetch($sql);
	
	if($wlt['wlt_price'] >= $real_money){
		
		$now_price = $wlt['wlt_price'] - $real_money;
		$sql = "update g5_wallet set wlt_price = '{$now_price}'where mb_id = '{$member['mb_id']}' and wlt_type = '{$wlt_type}'";
		$rtn = sql_query($sql);

		$sql = "insert into g5_withdraw set mb_id = '{$member['mb_id']}' , wdw_price = '{$real_money}', wdw_krw = '{$master['mc_value']}' , wdw_fees = '{$fees_val}' , wdw_out_money = '{$out_money}' ,
		wlt_price = '{$now_price}' , wdw_addr = '{$addr}' , wdw_type = '{$wlt_type}'";
		$rtn = sql_query($sql);

		if($wlt_type == "DNB2"){
			$out_money = round(($out_money * 1200) / $master['mc_value']);
		}

		$result = miriSms("[ALLOT] \n출금신청이 완료 되었습니다 .\n받으실DNB : ".number_format($out_money)."개", str_replace("-","",$member['mb_hp']));
		$result = miriSms("[ALLOT] \n출금신청이 접수되었습니다.\n아이디 : ".$member['mb_id']."\n출금ALT : ".number_format($out_money)."개", "01036149297");

		alert("신청이 완료 되었습니다.", "./content.php?co_id=withdrawal_bd");

	}else {
		alert("잔액이 부족합니다.", "./content.php?co_id=withdrawal_ap");
	}

?>