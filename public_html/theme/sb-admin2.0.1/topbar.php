<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="z-index:99">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none mr-3">
        <!--class="rounded-circle" 빠짐-->
        <i class="fa fa-bars"></i>
    </button>

    <!-- <div id="mobile_logo">
        <img src="<?php echo G5_IMG_URL?>/alt_simbol.png" alt="" style="max-width:100px">
    </div> -->


    <li class="nav-item dropdown no-arrow user_box">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <img class="kt-header__topbar-welcome" src="<?php echo G5_IMG_URL?>/ic_user_small@3x.png"
                style="height: 15px; margin-bottom:55px;">
            <span class="font_id"><?php echo $member['mb_id']; ?></span>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <?php if ($is_admin) { ?>
            <a class="dropdown-item" href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">
                <!-- <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> -->
                Settings
            </a>
            <?php } else {
					echo outlogin('theme/basic');
				} ?>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <!-- <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> -->
                Logout
            </a>
        </div>
    </li>
    <!-- <div class="user_box">
			<img class="kt-header__topbar-welcome" src="<?php echo G5_IMG_URL?>/ic_user_small@3x.png" style="height: 15px;">
			<span class="font_id"><?php echo $member['mb_id']; ?></span>
		</div> -->


    <div id="label_img">
        <img src="<?php echo G5_IMG_URL?>/label_s0@2x.png">
    </div>

    <div class="" style="position: absolute;top:23%;right:10%;">
        <div class="kt-header__topbar-item kt-header__topbar-item--langs" style="width:30px;">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-header__topbar-icon">
                    <img class="" src="<?php echo G5_IMG_URL?>/094-south-korea.svg" alt="" style="border-radius:5px;">
                    <img class="nnnnnone" src="<?php echo G5_IMG_URL?>/226-united-states.svg" alt=""
                        style="border-radius:5px;">
                </span>
            </div>
            <div style="position:absolute; right:170px !important">
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim">
                    <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                        <li class="kt-nav__item kt-nav__item--active">
                            <a href="javascript:void(0);" onclick="changeLang('ko-KR');" class="kt-nav__link koo">
                                <span class="kt-nav__link-icon"><img src="<?php echo G5_IMG_URL?>/094-south-korea.svg"
                                        alt="" style="width:17px"></span>
                                <span class="kt-nav__link-text">한국어</span>
                            </a>
                        </li>
                        <li class="kt-nav__item">
                            <a href="javascript:void(0);" onclick="changeLang('en-US');" class="kt-nav__link enn">
                                <span class="kt-nav__link-icon"><img src="<?php echo G5_IMG_URL?>/226-united-states.svg"
                                        alt="" style="width:17px"></span>
                                <span class="kt-nav__link-text">English</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- <?php if ($member['mb_id']) { ?>
        Nav Item - Messages
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                Counter - Messages
                <span
                    class="badge badge-danger badge-counter"><?php if ($memo_count['_cnt']) { echo number_format($memo_count['_cnt']); } ?></span>
            </a>
            Dropdown - Messages
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Message Center
                </h6>
                <?php for ($i=0; $memo_list = sql_fetch_array($memo_list_result); $i++) { ?>
        
                <a class="dropdown-item d-flex align-items-center"
                    href="<?php echo G5_BBS_URL; ?>/memo_view.php?me_id=<?php echo $memo_list['me_id']; ?>&kind=recv">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="<?php echo G5_IMG_URL; ?>/no_profile.gif" alt="">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate"><?php echo cut_str(get_text($memo_list['me_memo']), 15); ?></div>
                        <div class="small text-gray-500"><?php echo $memo_list['me_send_mb_id']; ?></div>
                    </div>
                </a>
                <?php } ?>
                <?php if ($i == 0) { ?>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        &nbsp;
        
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">수신된 메시지가 없습니다.</div>
                        <div class="small text-gray-500">&nbsp;</div>
                    </div>
                </a>
                <?php } ?>
        
                <a class="dropdown-item text-center small text-gray-500" href="<?php echo G5_BBS_URL; ?>/memo.php">Read
                    More Messages</a>
            </div>
        </li> -->

        <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

        <!-- Nav Item - User Information -->
        <!-- <li class="nav-item dropdown no-arrow user_box">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="kt-header__topbar-welcome" src="<?php echo G5_IMG_URL?>/ic_user_small@3x.png" style="height: 15px;">
        			<span class="font_id"><?php echo $member['mb_id']; ?></span>
            </a>
            Dropdown - User Information
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <?php if ($is_admin) { ?>
                <a class="dropdown-item" href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <?php } else {
        					echo outlogin('theme/basic');
        				} ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li> -->
        <?php } else {
				echo outlogin('theme/basic');
			} ?>
        <!-- <button class="topbar_bt" onclick="site_copy('<?php echo $member['mb_id']; ?>');">추천하기</button> -->
    </ul>
</nav>
<!-- End of Topbar -->

<!-- <script>
	function site_copy(mb_id) {

		var site_url = "https://dnbplus.com?like="+mb_id;
		alert(site_url);
	}
</script> -->

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