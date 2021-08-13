<?php
	

	$ord_id = isset($_GET['ord_id']) ? $_GET['ord_id'] : "";

	if($ord_id == "") {
		alert("올바른 경로를 이용해주세요." , "./content.php?co_id=Purchase_details");
	}

	$sql  = "select * from g5_order as ord left join g5_product as prd on ord.prd_id = prd.prd_id where ord_id = '{$ord_id}'";
	$rtn = sql_fetch($sql);

	//DNB
	$price = 0;
	if($rtn['prd_type'] == "DNB1"){	

		if($master['mc_value'] > $rtn['ord_value']){
			//현재 시세보다 올랐을경우
			$price = round((($rtn['prd_price'] * $rtn['ord_value']) / 2) / $master['mc_value'], 2);

		}else {
			//같거나 낮을경우
			$price = $rtn['prd_price'] / 2 ;			
		}
	}
	
	//USD
	if($rtn['prd_type'] == "DNB2"){
		$price = round((($rtn['prd_price'] / 2 ) * 1200) / $master['mc_value'] , 2);
	}


?>



<div id="cancel">
    <div class="cancel_wrap">
        <div class="dnbplus_top ttt_wrapper">
            <p class="dnbplus_top_p1" data-i18n="ALT:A"></p>
            <div class="ttt_cancel">
                <p data-i18n="ALT:B"></p>
                <p data-i18n="ALT:C"></p>
                <p data-i18n="ALT:D"></p><br><br>
                <p data-i18n="ALT:E"></p>
                <p data-i18n="ALT:F"></p>
                <p data-i18n="ALT:G"></p>
                <p data-i18n="ALT:H"></p>
                <p data-i18n="ALT:I"></p>
            </div>
        </div>
        <div class="dnbplus_top ttt_wrapper">
            <p class="dnbplus_top_p1" data-i18n="ALT:A1"></p>

            <div class="ttt_cancel">
                <p data-i18n="ALT:1"></p>
                <p data-i18n="ALT:2"></p><br>
                <p data-i18n="ALT:3"></p><br>
                <p data-i18n="ALT:4"></p><br>
            </div>
        </div>
    </div>


    <div class="kt-portlet ttt">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label" style="width:100%;">
                <h3 class="kt-portlet__head-title" style="margin:0 auto" data-i18n="ALT:5">
                    청약철회 신청하기 </h3>
            </div>
        </div>

        <form id="form" class="kt-form kt-form--label-right wdap2" onsubmit="return check()" method="POST"
            action="./cancel_update.php" novalidate="novalidate">
            <input type="hidden" name="ord_id" value="<?php echo $ord_id; ?>">
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label class="col-form-label col-lg-4-1 col-sm-12" data-i18n="ALT:6">출금 주소</label>
                    <div class="col-lg-4-1 col-md-12 col-sm-12">
                        <input type="text" class="form-control" name="addr" value="">
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label class="col-form-label col-lg-4-1 col-sm-12" data-i18n="ALT:7"></label>
                    <div class="col-lg-4-1 col-md-12 col-sm-12">
                        <input type="text" class="form-control" name="price" value="<?php echo $price; ?>" readonly>
                    </div>
                </div>
            </div>

            <input type="checkbox" name="cancel_check" id="cancel_check" style="margin:0 0 8px 0">&nbsp;<label for="" data-i18n="ALT:J"></label>


            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-2">
                            <button type="submit" id="form_submit" class="btn btn-brand" data-i18n="ALT:8"></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function check() {
        if ($("#cancel_check").is(":checked") == false) {

            alert("약정동의 후 구매신청 가능합니다.");
            return false;
        }

        if (!confirm("청약철회는 되돌릴수 없습니다. 진행하시겠습니까?")) {
            return false;
        }

        return true;
    }
</script>