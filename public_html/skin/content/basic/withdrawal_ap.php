<?php
	
	$sql = "select * from g5_wallet where wlt_type = 'DNB1' and mb_id = '{$member['mb_id']}'";
	$DNB1 = sql_fetch($sql);

	$sql = "select * from g5_wallet where wlt_type = 'DNB2' and mb_id = '{$member['mb_id']}'";
	$DNB2 = sql_fetch($sql);

	$fees_val = round(12000/$master['mc_value'] , 4);
?> 
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet">
        <div class="kt-portlet__head" style="width:100%;">
            <div class="kt-portlet__head-label" style="width:100%; margin:25px 0">
                <h3 class="kt-portlet__head-title1" style="margin:0 auto;">
                    <a href="#" class="wtda_ap_btn1 c1" data-i18n="WITHDRAWAL:1"></a>
                    <a href="#" class="wtda_ap_btn2 c2" data-i18n="WITHDRAWAL:2"></a>
                </h3>
            </div>
        </div>

        <form id="form" class="kt-form kt-form--label-right wdap1" method="POST" action="./draw_update.php"
            novalidate="novalidate">
			<input type="hidden" name="mb_id" value="<?php echo $member['mb_id']; ?>">
			<input type="hidden" name="wlt_dnb1" id="wlt_dnb1" value="<?php echo $DNB1['wlt_price']; ?>">
			<input type="hidden" name="wlt_dnb2" id="wlt_dnb2" value="<?php echo $DNB2['wlt_price']; ?>">
			<input type="hidden" name="wlt_type" id="wlt_type" value="DNB1" >
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label class="col-form-label col-lg-4-1 col-sm-12" data-i18n="WITHDRAWAL:3">출금가능</label>
                    <div class="col-lg-4-1 col-md-12 col-sm-12">

                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="" name="now_money" id ="now_money" value="<?php echo $DNB1['wlt_price']; ?>" readonly="">
                            <div class="input-group-append"><span class="input-group-text won">ALT</span></div>
                        </div>
                    </div>
                </div>
  
                <div class="form-group row">
                    <label class="col-form-label col-lg-4-1 col-sm-12" data-i18n="WITHDRAWAL:6">출금신청</label>
                    <div class="col-lg-4-1 col-md-12 col-sm-12">
                        <div class="input-group">
                            <input type="text" class="form-control out_cash" placeholder="" name="out_money" id="out_money"  value="">
                            <div class="input-group-append"><span class="input-group-text max">MAX</span></div>
                        </div>
						<span class="form-text" style="color:#5867dd; font-size:13px; margin-top:10px;"><b
                                style="vertical-align:-3px; font-size:16px;">* </b><span data-i18n="WITHDRAWAL:4">최소 출금 금액</span> <span class="limit_txt">10 ALT</span></span>
                    </div>
                </div>

				<div class="form-group row">
                    <label class="col-form-label col-lg-4-1 col-sm-12" data-i18n="WITHDRAWAL:5">출금 수수료</label>
                    <div class="col-lg-4-1 col-md-12 col-sm-12">

                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="" id="fees_val" name="fees_val" value="5,000" readonly="">
                            <div class="input-group-append"><span class="input-group-text won">ALT</span></div>
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-form-label col-lg-4-1 col-sm-12" data-i18n="WITHDRAWAL:7">최종 출금</label>
                    <div class="col-lg-4-1 col-md-12 col-sm-12">

                        <div class="input-group">
                            <input type="text" class="form-control real_money" placeholder=""  name="real_money" id="real_money" value="" readonly="">
                            <div class="input-group-append"><span class="input-group-text won">ALT</span></div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-4-1 col-sm-12" data-i18n="WITHDRAWAL:8">출금 주소</label>
                    <div class="col-lg-4-1 col-md-12 col-sm-12">
                        <input type="text" class="form-control" name="addr" value="">
                    </div>
                </div>
            </div>

            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-2" style="text-align:center">
                            <button type="submit" id="form_submit" class="btn btn-brand" data-i18n="WITHDRAWAL:9">출금신청</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>


<script>

	var dnb_value = "<?php echo $master['mc_value']; ?>";

	var dnb_type =  $("#wlt_type").val();

	var wlt_dnb1 = $("#wlt_dnb1").val();
	var wlt_dnb2 = $("#wlt_dnb2").val();
	var dnb1_limit = 5000;
	var dnb2_limit = 100;

	var fees_val = "<?php echo $fees_val; ?>";
	$("#fees_val").val(fees_val);

    $(".c1").click(function(){
	
		$(".won").html("ALT");

		$("#real_money").val("");
		$("#out_money").val("");

		fees_val = Math.round((12000/dnb_value) * 10000) / 10000;
		dnb_type = "DNB1";
		$("#wlt_type").val("DNB1");

        $(".c1").css("background-color","#2a2c39")
        $(".c2").css("background-color","#fff")
        $(".wtda_ap_btn1").css("color","#fff")
        $(".wtda_ap_btn2").css("color","#2a2c39")

		$("#fees_val").val(fees_val);
		$(".limit_txt").html("10 ALT");
		$("#now_money").val(wlt_dnb1);
    });

    $(".c2").click(function(){
		
		$(".won").html("USD");

		$("#real_money").val("");
		$("#out_money").val("");


		dnb_type = "DNB2";
		$("#wlt_type").val("DNB2");
		fees_val = 10;

        $(".c2").css("background-color","#2a2c39")
        $(".c1").css("background-color","#fff")
        $(".wtda_ap_btn2").css("color","#fff")
        $(".wtda_ap_btn1").css("color","#2a2c39")

		$("#fees_val").val(fees_val);
		$(".limit_txt").html("100 $");
		$("#now_money").val(wlt_dnb2);
    });


	$("#out_money").bind("change", function() {
		
		var out_money = $("#out_money").val();

		if(dnb_type == "DNB1"){
			var total_price = Number(out_money) + Number(fees_val);
			if(wlt_dnb1 >= total_price){
				$("#real_money").val(total_price);
			}else {
				$("#out_money").val("");
				alert("잔액이 출금금액 보다 적습니다.");

			}
			
		}

		if(dnb_type == "DNB2"){
			var total_price = Number(out_money) + Number(fees_val);
			if(wlt_dnb2 >= total_price){
				$("#real_money").val(total_price);
			}else {
				$("#out_money").val("");
				alert("잔액이 출금금액 보다 적습니다.");			
			}
		}

		
	});

	$(".max").click(function(){
		var fees = Number($("#fees_val").val());
		var now_money = Number($("#now_money").val());
		$("#out_money").val(now_money-fees);

		var out_money = Number($("#out_money").val());

		if(dnb_type == "DNB1"){
			var total_price = Number(out_money) + Number(fees_val);
			if(wlt_dnb1 >= total_price){
				$("#real_money").val(total_price);
			}else {
				$("#out_money").val("");
				alert("잔액이 출금금액 보다 적습니다.");

			}
			
		}

		if(dnb_type == "DNB2"){
			var total_price = Number(out_money) + Number(fees_val);
			if(wlt_dnb2 >= total_price){
				$("#real_money").val(total_price);
			}else {
				$("#out_money").val("");
				alert("잔액이 출금금액 보다 적습니다.");			
			}
		}
	});





</script>