<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원정보 찾기 시작 { -->

<div id="wrapper">
    <div id="background_img_wrapper"
        style="background-image:url(../../../../img/psxtg0469090.png); background-size:cover; opacity:0.94;">
        <div id="find_info" class="new_win"
            style="width:100%; max-width:800px; margin:0 auto; background-color:#fff; position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);">
            <h1 id="win_title" data-i18n="L:01">회원정보 찾기</h1>

            <div class="" style="position: absolute;top:3%;right:3%;">
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

            <div class="new_win_con">
                <form name="fpasswordlost" action="<?php echo $action_url ?>"
                    onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
                    <fieldset id="info_fs">
                        <p data-i18n="L:1">회원가입 시 등록하신 이메일 주소를 입력해 주세요.</p>
                        <p data-i18n="L:2">해당 이메일로 아이디와 비밀번호 정보를 보내드립니다.</p>
                        <p data-i18n="L:2-1">자동등록방지 숫자를 순서대로 입력하세요.</p>
                        <label for="mb_email" class="sound_only">E-mail address<strong class="sound_only"></strong></label>
                        <input type="text" name="mb_email" id="mb_email" required
                            class="required frm_input full_input email" size="30" placeholder="E-mail 주소">
                    </fieldset>
                    <?php echo captcha_html();  ?>

                    <div class="win_btn">
                        <button type="submit" class="btn_submit">OK</button>
                        <button type="button" onclick="location.href='http://allot-staking.com/bbs/login.php'" class="btn_close">CLOSE</button> 
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    function fpasswordlost_submit(f) {
        <
        ?
        php echo chk_captcha_js(); ? >

        return true;
    }

    $(function () {
        var sw = screen.width;
        var sh = screen.height;
        var cw = document.body.clientWidth;
        var ch = document.body.clientHeight;
        var top = sh / 2 - ch / 2 - 100;
        var left = sw / 2 - cw / 2;
        moveTo(left, top);
    });
</script>
<!-- } 회원정보 찾기 끝 -->