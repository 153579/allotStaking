<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원가입결과 시작 { -->
<div id="reg_result" class="register">
    <p class="reg_result_p">
        <i class="fa fa-gift" aria-hidden="true"></i><br>
        <strong><?php echo get_text($mb['mb_id']); ?></strong>님의 회원가입을 진심으로 축하합니다.
    </p>
    <p>ALLOT의 다양한 STAKING SERVICE를 이용해보세요</p>
</div>
