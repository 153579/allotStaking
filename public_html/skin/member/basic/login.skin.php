<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

$register_action_url = G5_HTTPS_BBS_URL.'/register_form_update.php';
?>

<!-- 로그인 시작 { -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div id="wrapper">
        <div id="background_img_wrapper" style="background-image:url(../../../../img/psxtg0469090.png); background-size:cover; opacity:0.94;">
            <!-- <div id="right_img">
                <img src="<?php echo G5_IMG_URL?>/bg-login-right@3x.png" alt="">
            </div>
            <div id="left_img">
                <img src="<?php echo G5_IMG_URL?>/bg-login-left@3x.png" alt="">
            </div> -->
        </div>
        <div id="cont_wrap">
            <div id="cont">
                <div id="cont_login">
                    <div id="top_cont_login">
                        <div class="top_cont_login_left" style="width:70%; float:left">
                            <div id="cont_wrap_header">
                                <h3 class="text_lgi" data-i18n="A:LOGINTOP"></h3>
                                <img src="<?php echo G5_IMG_URL?>/ic-plus.svg" alt="">
                            </div>
                            <div id="cont_wrap_header1">
                                <p data-i18n="A:fp"></p>
                            </div>
                        </div>
                        <div class="" style="position: absolute;top:10%;right:10%;">
                            <div class="kt-header__topbar-item kt-header__topbar-item--langs"
                                style="width:30px; display:inline-block;">
                                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                    <span class="kt-header__topbar-icon">
                                        <img class="" src="<?php echo G5_IMG_URL?>/094-south-korea.svg" alt="" style="border-radius:5px;">
                                        <img class="nnnnnone" src="<?php echo G5_IMG_URL?>/226-united-states.svg" alt="" style="border-radius:5px;">
                                    </span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim ">
                                    <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                                        <li class="kt-nav__item kt-nav__item--active">
                                            <a href="javascript:void(0);" onclick="changeLang('ko-KR');" class="kt-nav__link koo">
                                                <span class="kt-nav__link-icon"><img
                                                        src="<?php echo G5_IMG_URL?>/094-south-korea.svg" alt=""
                                                        style="width:17px"></span>
                                                <span class="kt-nav__link-text">한국어</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="javascript:void(0);" onclick="changeLang('en-US');" class="kt-nav__link enn">
                                                <span class="kt-nav__link-icon"><img
                                                        src="<?php echo G5_IMG_URL?>/226-united-states.svg" alt=""
                                                        style="width:17px"></span>
                                                <span class="kt-nav__link-text">English</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="<?php echo $login_action_url ?>" method="post">
                        <div class="input_group">
                            <input class="form_control" type="text" name="mb_id" id="id" placeholder="ID">
                        </div>
                        <div class="input_group">
                            <input class="form_control" type="password" name="mb_password" id="password"
                                placeholder="PW">
                        </div>
                        <div id="pw_no">
                            <span data-i18n="A:PWNOT">비밀번호를 잊으셨나요?</span>
                            <a href="<?php echo G5_BBS_URL ?>/password_lost.php" data-i18n="A:PWFIND">비밀번호 찾기</a>
                        </div>
                        <div id="cont-footer">
                            <div id="button_login" style="margin-bottom:15px;">
                                <button type="submit" id="bt1" class="bt_en" data-i18n="A:LOGIN"></button>
                            </div>
                            <div id="button_login" class="click">
                                <button type="button" id="bt1" onclick="void(0);" data-i18n="A:SINEUP"></button>
                            </div>
                            <div id="cont_logo">
                                <img src="<?php echo G5_IMG_URL?>/alt_simbol.png" alt="" style="width:70px; text-align:center;">
                            </div>
                        </div>
                    </form>
                </div>


                <div id="cont_join" style="display: none;">
                    <div id="cont_wrap_header">
                        <h3 data-i18n="A:sineUp">회원가입&nbsp;</h3>
                        <img src="<?php echo G5_IMG_URL?>/ic-plus.svg" alt="">
                    </div>
                    <div id="cont_wrap_header1">
                        <p data-i18n="A:infor">아래 정보를 입력하세요</p>
                    </div>
                    <form id="register_act" action="<?php echo $register_action_url ?>" method="post">
                        <input class="form-control" type="hidden" name="mb_name" id="mb_name" value="디앤비플러스">
                        <div class="input_group">
                            <input class="form_control" type="text" name="mb_id" id="mb_id" placeholder="ID">
                        </div>

                        <div class="input_group">
                            <input class="form_control" type="password" name="mb_password" id="password"
                                placeholder="PASSWARD">
                        </div>

                        <div class="input_group">
                            <input class="form_control" type="password" name="mb_password_re" id="password"
                                placeholder="Confirm Password">
                        </div>

                        <div class="input_group">
                            <select class="select_option same-form" name="mb_hp_country" style="margin-right:20px;">
                                <option value="0">+82</option>
                                <option value="1">+86</option>
                                <option value="2">+81</option>
                                <option value="3">+1</option>
                                <option value="4">+84</option>
                            </select>
                            <input class="form_control1" type="text" placeholder="PHONE NUMBER" name="mb_hp" class="mb_hp">
                        </div>
                        <div class="input_group">
                            <input class="form_control1" id="mb_email" type="text" placeholder="email"
                                name="mb_email">
                            <button type="button" class="btn_1" id="code_send" data-i18n="A:Authenticationcode">인증코드</button>
                        </div>
                        <div class="input_group">
                            <input class="form_control" type="text" name="code" id="code" placeholder="Email Authentication code">
                        </div>
                        <div id="cont-footer" style="margin-top: 45px;">
                            <div id="button_login">
                                <button type="button" id="bt1" onclick="goto_sign();" data-i18n="A:SINEUP">회원가입&nbsp;+</button>
                            </div>
                        </div>
                        <div class="id_no click1">
                            <span data-i18n="A:SUBSCRIPTION">이미 가입한 계정이 있으신가요?</span>
                            <a href="#" data-i18n="A:LOGINTOP">로그인</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var base_url = "http://allot-staking.com";
        var email_check = false;
        var form = $('#register_act');


        function goto_sign() {

            var hp = $('.mb_hp').val();
            console.log(hp);


            if (!email_check) {
                alert("이메일 인증이 필요합니다.");
                return;
            }

            form[0].submit();

        }

        $(document).ready(function () {
            $(".click").click(function () {
                $("#cont_login").fadeOut()
                $("#cont_login").css("display", "none")
                $("#cont_join").fadeIn()
            })
            $(".click1").click(function () {
                $("#cont_login").fadeIn()
                $("#cont_join").fadeOut()
                $("#cont_join").css("display", "none")
            })
        })


        $('#code_send').on('click', function () {
            var p_email = $('#mb_email').val();
            var p_type = "send_code";

            if (p_email == "") {
                alert("이메일을 입력해주세요.");
                return;
            }

            $.ajax({
                type: "post",
                url: base_url + "/bbs/ajax.mail.php",
                data: {
                    email: p_email,
                    type: p_type
                },
                dataType: "json",
                success: function (data) {

                    if (data.result == "00") {
                        alert("인증코드가 발송 되었습니다.");
                    } else if (data.result == "405") {
                        email_check = false;
                        alert("해당 이메일은 존재하는 이메일 입니다..");
                    }
                },
                error: function (xhr, textStaus, errorThrown) {
                    console.log(xhr);
                    console.log(textStaus);
                    console.log(errorThrown);
                }
            });
        });

        $('#code').on("input", function () {

            var p_email = $('#mb_email').val();
            var p_code = $('#code').val();
            var p_type = "code_confirm";

			

            $.ajax({
                type: "post",
                url: base_url + "/bbs/ajax.mail.php",
                data: {
                    email: p_email,
                    type: p_type,
                    code: p_code
                },
                dataType: "json",
                success: function (data) {
                    console.log(p_code);
                    console.log(data);
                    if (data.result == "00") {
                        email_check = true;
                        alert("인증 되었습니다.");
                    } else {
                        email_check = false;
                    }
                },
                error: function (xhr, textStaus, errorThrown) {
                    console.log(xhr);
                    console.log(textStaus);
                    console.log(errorThrown);
                }
            });

        });
    </script>

    <script>
        $(".login_ctr").click(function () {
            var c = $(".login_ctr_lnb").css("display")
            if (c == 'none') {
                $(".login_ctr_lnb").css("display", "block")
            } else {
                $(".login_ctr_lnb").css("display", "none")
            }
        })
    </script>

