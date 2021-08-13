<?php	
	if($master['mc_dnb1'] == "off" && $member['mb_id'] != "admin"){
		alert("지금은 참여 기간이 아닙니다." , "http://allot-staking.com/");
	}

	$sql = "select * from g5_product where prd_del_yn = 'N' and prd_type = 'DNB1'";
	$rtn = sql_query($sql);
	
	// txid를 안넣은 내가 주문하게 있는지 
	$sql = "select * from g5_order as ord left join g5_product as prd on ord.prd_id = prd.prd_id where mb_id = '{$member['mb_id']}' and ord_yn = 'Y' and ord_sc_yn = 'N' and ord_del_yn = 'N' and ord_txid is null";
	$my_rtn = sql_fetch($sql);

?>

<div id="dnbpluswrap">
    <div class="dnbplus_top">
        <p class="dnbplus_top_p1" data-i18n="ALT:A"></p>

        <p data-i18n="ALT:B"></p>
        <p data-i18n="ALT:C"></p>
        <p data-i18n="ALT:D"></p><br><br>
        <p data-i18n="ALT:E"></p>
        <p data-i18n="ALT:F"></p>
        <p data-i18n="ALT:G"></p>
        <p data-i18n="ALT:H"></p>
        <p data-i18n="ALT:I"></p><br><br>
        <p data-i18n="ALT:I-i" style="color:red; text-align:center;"></p>
        <form action="" style="width:100%; text-align:center">
            <input type="checkbox" name="buy_check" id="buy_check" style="margin:0 0 8px 0">&nbsp;<label for=""
                data-i18n="ALT:J">위 약정에 동의하십니까?</label>
        </form>
    </div>

    <div class="dnbplus_top" style="margin-top:25px; padding:0 10px; word-break:break-all">
        <p style="margin-top:15px; color:#0080f3;" data-i18n="ALT:kk">◆ 예치하신 ALT는 선택하신 플랜의 마지막날 출금이 가능하며 리워드는
            매일 오전 정산 지급되고 출금 또한 가능합니다. ◆</p>
    </div>

    <div id="pack01_wrapper">
        <div class="pack_wrap">
            <div id="pack_bottom">
                <?php 
				while($row = sql_fetch_array($rtn)){

					$REWARD_ALL = $row['prd_price'] * (0.01 * $row['prd_percent']);
					$REWARD_DAY = ($row['prd_price'] * (0.01 * $row['prd_percent'])) / $row['prd_day_count'];
			?>
                <div class="pack_cont">
                    <div class="pack_cont_text" style="padding:15px">
                        <div class="img_wrap ct_plus">
                            <img src="<?php echo G5_IMG_URL?>/ic_daily@3x.png">
                        </div>
                        <ul class="ct_plus">
                            <li class="mg_plus1"><?php echo number_format($row['prd_name']); ?> ALT</li>
                            <li class="mg_plus"><?php echo $row['prd_percent']; ?>%</li>
                            <li class="mg_plus"><?php echo $row['prd_day_count']; ?>DAY</li>
                            <li class="mg_plus"><?php echo number_format($row['prd_price']); ?>ALT</li>
                            <br>
                            <li class="mg_plus">REWARD ALL : <?=$REWARD_ALL ?> ALT</li>
                            <li class="mg_plus">REWARD DAY : <?=$REWARD_DAY ?> ALT</li>
                        </ul>
                    </div>
                    <button class="pack_btn" type="button" onclick="order_click('<?php echo $row['prd_id']; ?>');"
                        data-i18n="ALT:K">구매하기</button>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <? if($my_rtn['mb_id'] != "") { 

		$prd_price = $my_rtn['prd_price'];
		if($my_rtn['prd_type'] == "DNB2"){
			$prd_price = round(($prd_price * 1200) / $my_rtn['ord_value']);
		}
		
	?>
    <div class="over_bg"></div>
    <div class="tx_box">
        <div id="pack_popup">
            <h3><img src="<?php echo G5_IMG_URL?>/ic_daily@3x.png">&nbsp; <span
                    class="prd_name"><?php echo number_format($my_rtn['prd_price']); ?></span> PLAN</h3>
            <div id="pack_popup_top">
                <p class="p_nth1">
                    <span class="weight_font" style="margin:15px 0;" data-i18n="ALT:L">지갑 주소</span><br><br>
                    <span id="text1" class="ether_addr bd_pu"><?php echo $master['mc_wallet2'] ?></span><br>
                    <button class="bt_copy bt_margin_top" onclick="copyToClipboard('text1')"
                        data-i18n="ALT:M">주소복사</button><br>
                    <p class="p_nth2 bold_text"><span data-i18n="ALT:N">입금하실 ALT :</span> <span
                            class="ether_price"><?php echo number_format($prd_price); ?></span>&nbsp;ALT </p>
                    <p style="font-weight:700" data-i18n="ALT:1234">2시간 이내에 입금하여 주십시오.</p>
                </p>
                <form id="popup_form">
                    <div class="txid">
                        <p data-i18n="ALT:O">전송 후 TXID주소를 입력하여 주세요</p>
                        <input type="text" class="popup_ip ord_txid">
                    </div>
                    <div id="popup_btn_wrap">
                        <button type="button" class="popup_btn popclose"
                            onclick="order_cancel('<?php echo $my_rtn['ord_id']; ?>' , 'dnbplusplus');"
                            data-i18n="ALT:P">취소</button>
                        <button type="button" class="popup_btn ok_order"
                            onclick="txid_send('<?php echo $my_rtn['ord_id']; ?>');" data-i18n="ALT:Q">확인</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php  } ?>
</div>
<!--
	cont addr , addr , txid
-->

<script>
    function order_click(prd_id) {

        var co_id = "altstaking";

        if ($("#buy_check").is(":checked") == false) {

            alert("약정동의 후 구매신청 가능합니다.");
            return false;
        }

        var url = "http://allot-staking.com/bbs/order.php";
        var form = $('<form></form>');
        form.attr('action', url);
        form.attr('method', 'post');
        form.appendTo('body');
        var type = $("<input type='hidden' value='w' name='type'>");
        var co_id = $("<input type='hidden' value=" + co_id + " name='co_id'>");
        var prd_id = $("<input type='hidden' value=" + prd_id + " name='prd_id'>");
        form.append(type);
        form.append(co_id);
        form.append(prd_id);
        form.submit();
    }

    function order_cancel(ord_id) {

        var co_id = "altstaking";

        var url = "http://allot-staking.com/bbs/order.php";
        var form = $('<form></form>');
        form.attr('action', url);
        form.attr('method', 'post');
        form.appendTo('body');
        var type = $("<input type='hidden' value='d' name='type'>");
        var co_id = $("<input type='hidden' value=" + co_id + " name='co_id'>");
        var ord_id = $("<input type='hidden' value=" + ord_id + " name='ord_id'>");
        form.append(type);
        form.append(co_id);
        form.append(ord_id);
        form.submit();

    }


    function txid_send(ord_id) {

        var type = "txid";
        var txid = $('.ord_txid').val();
        var co_id = "altstaking";

        if (txid == "") {
            alert("TXID를 입력해주세요.");
            return false;
        }

        var url = "http://allot-staking.com/bbs/order.php";
        var form = $('<form></form>');
        form.attr('action', url);
        form.attr('method', 'post');
        form.appendTo('body');
        var type = $("<input type='hidden' value='txid' name='type'>");
        var co_id = $("<input type='hidden' value=" + co_id + " name='co_id'>");
        var ord_id = $("<input type='hidden' value=" + ord_id + " name='ord_id'>");
        var txid = $("<input type='hidden' value=" + txid + " name='txid'>");
        form.append(type);
        form.append(co_id);
        form.append(ord_id);
        form.append(txid);
        form.submit();
    }


    function copyToClipboard(elementId) {

        // 글을 쓸 수 있는 란을 만든다.
        var aux = document.createElement("input");

        // 지정된 요소의 값을 할당 한다.
        aux.setAttribute("value", document.getElementById(elementId).innerHTML);

        // bdy에 추가한다.
        document.body.appendChild(aux);

        // 지정된 내용을 강조한다.
        aux.select();

        // 텍스트를 카피 하는 변수를 생성
        document.execCommand("copy");

        // body 로 부터 다시 반환 한다.
        document.body.removeChild(aux);

        alert("복사 되었습니다.");

    }

    function comma(num) {
        var len, point, str;

        num = num + "";
        point = num.length % 3;
        len = num.length;

        str = num.substring(0, point);
        while (point < len) {
            if (str != "") str += ",";
            str += num.substring(point, point + 3);
            point += 3;
        }

        return str;

    }
</script>