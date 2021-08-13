<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 원하는 길이의 랜덤 문자열 추출
function GenerateString($length)  
{  
    $characters  = "0123456789";  
    //$characters .= "abcdefghijklmnopqrstuvwxyz";  
    //$characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";  
    //$characters .= "_";  
      
    $string_generated = "";  
      
    $nmr_loops = $length;  
    while ($nmr_loops--)  
    {  
        $string_generated .= $characters[mt_rand(0, strlen($characters) - 1)];  
    }  
      
    return $string_generated;  
}  


//이더 금액 가져오기
function EtherScan_Addrress($con_addr, $addr) {
	
	$param = array(
		'module' => 'account',
		'action' => 'tokenbalance',
		'contractaddress' => $con_addr,
		'address' => $addr,
		'tag' => 'latest',
		'apikey' => '46QMKN5JNAIJZ85M97FKPWR8DUGXKGW3G4'
	);

	$param = http_build_query($param);

	$url = "https://api.etherscan.io/api?" . $param;
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	$ch = curl_init();                                 //curl 초기화
    curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함
    
	$data = curl_exec($ch);

	if (curl_error($ch)){ 
		exit('CURL Error('.curl_errno( $ch ).') '.curl_error($ch));
    }
    
    curl_close($ch);
	
	$data = trim($data); 
    $data = json_decode($data,true);	
	
	$ether = $data['result'] * 0.0001;
	
	return $ether;

}


//이더 금액 가져오기
function TokenInfo($con_addr) {

	$param = array(
		'module' => 'account',
		'action' => 'tokentx',
		'address' => $con_addr,
		'startblock' => '0',
		'endblock' => '99999999',
		'sort' => 'asc',
		'apikey' => '46QMKN5JNAIJZ85M97FKPWR8DUGXKGW3G4'
	);

	$param = http_build_query($param);

	$url = "https://api.etherscan.io/api?" . $param;
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	$ch = curl_init();                                 //curl 초기화
    curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함
    
	$data = curl_exec($ch);

	if (curl_error($ch)){ 
		exit('CURL Error('.curl_errno( $ch ).') '.curl_error($ch));
    }
    
    curl_close($ch);
	
	$data = trim($data); 
    $data = json_decode($data,true);	
	
	return $data;

}

//이더 금액 가져오기
function DNBsize() {
	
	$params = array(
            "market_id" => "ALT-KRW");

    $url = "https://api.probit.com/api/exchange/v1/order_book";
    $response = json_decode(request($url, "GET" ,$params), true);

    $list = $response['data'];

    $sellList = array();
    $buyList = array();

    foreach ($list as $k => $v)
    {
        if($list[$k]['side'] == "sell") { $sellList[] = $list[$k]; }
        if($list[$k]['side'] == "buy") { $buyList[] = $list[$k]; }
    }

    //정렬
    array_multisort($sellList, SORT_ASC , $sellList);
    array_multisort($buyList, SORT_DESC , $buyList);

    return $buyList[0]['price'];

}


function miriSms($text, $number){

		$postData = array(
			'callback' => '15227968',
			'contents' => $text,
			'receiverTelNo' => $number,
			'userKey' => $number.'|'.mktime(date("Y-m-d H:i:s")).'|'.mt_rand(1, 10000)
		);

		//$url = "https://api-dev.wideshot.co.kr";
		$url = "https://api.wideshot.co.kr";

		$url .= "/api/v1/message/sms";

		$request_headers = array();
		$request_headers[] = 'sejongApiKey: QjA1bGVXUnA5ZzNyeHZ3ZzVzb0F2elJUVW5hKzFMS2hxa1ZOdHVzczdCdFkza245NGw1ZHNqYkNXaFIzNWtLZUdDcHFDNzRPYkRiaFJIOWRFVFVIelE9PQ==';


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
		curl_setopt($ch, CURLOPT_POST, true);

		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
}

function request($url, $method="GET" , $params = NULL , $headers=NULL)
{

    $ch = curl_init();

    if($method == "GET" && $params != NULL)
    {
        $url = $url.'?'.http_build_query($params, '', '&');
    }

    curl_setopt($ch , CURLOPT_URL , $url);

    curl_setopt($ch , CURLOPT_RETURNTRANSFER , 1);

    if(stripos($url , 'https://') == TRUE)
    {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION,3);
    }

    if($method=="POST")
    {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    }

    if($headers != NULL)
    {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    if( !$response = curl_exec($ch) )
    {
        $response = curl_error($ch);
    }

    curl_close($ch);

    return $response;
}


function echo2($str)
{
    echo $str."<br>";
}

?>