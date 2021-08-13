<?php

	include_once('/home/altstking/public_html/common.php');
	
	$data = DNBsize();

	$sql = "update g5_master_config set mc_value = '{$data}'";
	$rtn = sql_query($sql);

	$sql = "insert into g5_crontab set crn_msg = 'SIZE_CHECK (".$data.")'";
	$rtn = sql_query($sql);

?>