<?php

	include_once('./_common.php');


	$mc_dnb1 = isset($_REQUEST['mc_dnb1']) ? $_REQUEST['mc_dnb1'] : "";
	$mc_dnb2 = isset($_REQUEST['mc_dnb2']) ? $_REQUEST['mc_dnb2'] : "";	
	

	$sql = "update g5_master_config set mc_dnb1 = '{$mc_dnb1}' , mc_dnb2 = '{$mc_dnb2}'";
	$rtn = sql_query($sql);


	goto_url("./admin_setting.php");
?>