$(function () {
    $.fn.datepicker.dates['kr'] = {
        days: ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일", "일요일"],
        daysShort: ["일", "월", "화", "수", "목", "금", "토", "일"],
        daysMin: ["일", "월", "화", "수", "목", "금", "토", "일"],
        months: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        monthsShort: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"]
    };
    var foloderPageName = location.pathname;
    $(".kt-menu__link").each(function () {
        var is_break = false;
        var href = $(this).attr("href");
        if (href) {
            console.log(href);
            var href_new = "";
            var href_arr = href.split("/");
            if (href_arr[0]) {
                href_new = "/" + href_arr[3] + "/" + href_arr[4];
                if (foloderPageName == href_new) {
                    $(this).parents(".kt-menu__item").addClass("kt-menu__item--open");
                    return false;
                }
            }
        }
    });
    $(".copy_btn").click(function () {
        var dataAlert = $(this).attr("data-alert");
        var dataTarget = $(this).attr("data-target");
        $(dataTarget).select()
        document.execCommand("copy")
        alert(dataAlert);
        $(dataTarget).blur();
    });
});

function formEnterEvent(ele, callback) {
    ele.keyup(function (e) {
        if (e.keyCode == "13") {
            callback();
        }
    });
}

function formValidate(ele, messageObjTemp) {
    var rulesObj = {};
    var messageObj = {};
    $.each(messageObjTemp, function (index, item) {
        rulesObj[index] = {
            required: true
        }
        messageObj[index] = {
            required: item
        }
    })
    ele.validate({
        onfocusout: false,
        onkeyup: false,
        rules: rulesObj,
        messages: messageObj,
        showErrors: function (errorMap, errorList) {
            if (this.numberOfInvalids()) {
                alert(errorList[0].message);
            }
        }
    });
}

function formSubmitCheck(ele, complete) {
    var is_complete = false;
    var form = ele.closest('form');
    var dataTarget = ele.attr("data-target");
    if (dataTarget)
        form = $(dataTarget);
    var url = form.attr("action");
    ele.click(function (e) {
        e.preventDefault();
        if (!form.valid()) {
            return;
        }
        if (complete) {
            is_complete = complete(form[0]);
            if (is_complete == undefined) {
                alert("오류 발생 : return 명시되지 않음");
            }
        } else {
            is_complete = true;
        }
        if (is_complete) {
            ele.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
            form.ajaxSubmit({
                url: url,
                success: function (response, status, xhr, $form) {
                    try {
                        var obj = $.parseJSON(response);
                    } catch (e) {
                        var obj = {};
                    }
                    if (obj["alert"] != "" && obj["alert"] != undefined) {
                        alert(obj["alert"]);
                        ele.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                        if (obj["link"]) {
                            location.href = obj["link"];
                        }
                    } else {
                        if (obj["link"])
                            location.href = obj["link"];
                    }
                }
            });
        }
    });
}


