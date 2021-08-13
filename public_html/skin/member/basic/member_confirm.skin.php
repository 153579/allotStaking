<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원 비밀번호 확인 시작 { -->

<div id="wrapper">
    <div id="background_img_wrapper"
        style="background-image:url(../../../../img/psxtg0469090.png); background-size:cover; opacity:0.94;">
        <div id="mb_confirm" class="mbskin"
            style="width:100%; max-width:600px; margin:0 auto; background-color:#fff; position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);">

            <div class="" style="position: absolute;top:5%;right:5%;">
                <div class="kt-header__topbar-item kt-header__topbar-item--langs"
                    style="width:30px; display:inline-block;">
                    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                        <span class="kt-header__topbar-icon">
                            <img class="" src="<?php echo G5_IMG_URL?>/094-south-korea.svg" alt=""
                                style="border-radius:5px;">
                            <img class="nnnnnone" src="<?php echo G5_IMG_URL?>/226-united-states.svg" alt=""
                                style="border-radius:5px;">
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

            <h1 data-i18n="L:3">회원 비밀번호 확인</h1>

            <p><strong data-i18n="L:4">비밀번호를 한번 더 입력해주세요.</strong></p>
            <?php if ($url == 'member_leave.php') { ?>
            <p data-i18n="L:5">비밀번호를 입력하시면 회원탈퇴가 완료됩니다.</p>
            <?php }else{ ?>
            <p data-i18n="L:6">회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다.</p>
            <?php }  ?>

            <form name="fmemberconfirm" action="<?php echo $url ?>" onsubmit="return fmemberconfirm_submit(this);"
                method="post">
                <input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
                <input type="hidden" name="w" value="u">

                <fieldset>
                    <span class="confirm_id">ID</span>
                    <span id="mb_confirm_id"><?php echo $member['mb_id'] ?></span>
                    <label for="confirm_mb_password" class="sound_only">PASSWORD<strong>ESSENTIAL</strong></label>
                    <input type="password" name="mb_password" id="confirm_mb_password" required
                        class="required frm_input" size="15" maxLength="20" placeholder="PW">
                    <input type="submit" value="OK" id="btn_submit" class="btn_submit">
                </fieldset>

            </form>

        </div>

    </div>
</div>

<script>
    function fmemberconfirm_submit(f) {
        document.getElementById("btn_submit").disabled = true;

        return true;
    }
</script>
<!-- } 회원 비밀번호 확인 끝 -->