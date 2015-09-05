<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH . '/head.php');
    return;
}

include_once(G5_THEME_PATH . '/head.sub.php');
include_once(G5_LIB_PATH . '/latest.lib.php');
include_once(G5_LIB_PATH . '/outlogin.lib.php');
include_once(G5_LIB_PATH . '/poll.lib.php');
include_once(G5_LIB_PATH . '/visit.lib.php');
include_once(G5_LIB_PATH . '/connect.lib.php');
include_once(G5_LIB_PATH . '/popular.lib.php');
?>

<!-- 상단 시작 { -->

<nav class="navbar navbar-fixed-top">
    <table>
        <colgroup>
            <col style="width: 50px;"/>
            <col style="width: *;"/>
            <col style="width: 50px;"/>
        </colgroup>
        <tr>
            <td>
                <i class="navMenu fa fa-bars f30px visible-xs-block"></i>
            </td>
            <td>
                <div class="container">
                    <img class="lips" src="<?php echo G5_THEME_IMG_URL; ?>/lips.png" onclick="location='/';"/>
                    <input type="text" class="totalSearch" name="search" placeholder="Search Sexy!"/>
                </div>
            </td>
            <td>
                <i class="searchIcon fa fa-search f30px"></i>
            </td>
        </tr>
    </table>
</nav><!--/ nav.navbar -->

<div class="wrapper">
    <div class="menus">
        <ul>
            <li>
                <a class="sub" href="#"><i class="fa fa-video-camera"></i>Movie</a>
                <ul>
                    <li><a href="bbs/board.php?bo_table=KOREA_YADONG">한국 야동</a></li>
                    <li><a href="#">일본/중국 야동</a></li>
                    <li><a href="#">서양 야동</a></li>
                    <li><a href="#">한국 영화</a></li>
                    <li><a href="#">외국 영화</a></li>
                </ul>
            </li>
            <li>
                <a class="sub" href="#"><i class="fa fa-camera"></i>Photo</a>
                <ul>
                    <li><a href="#">여자 사진</a></li>
                    <li><a href="#">남자 사진</a></li>
                </ul>
            </li>
            <li>
                <a class="sub" href="#"><i class="fa fa-tv"></i>TV</a>
                <ul>
                    <li><a href="#">한국 드라마</a></li>
                    <li><a href="#">미/영 드라마</a></li>
                    <li><a href="#">코미디</a></li>
                </ul>
            </li>
            <li>
                <a class="sub" href="#"><i class="fa fa-commenting"></i>글 남기기</a>
                <ul>
                    <li><a href="#">출석부</a></li>
                    <li><a href="#">운영자에게</a></li>
                </ul>
            </li>

            <li>
                <a class="sub" href="#"><i class="fa fa-commenting"></i>관리자 메뉴</a>
                <ul>
                    <?php if ($is_member) { ?>
                        <?php if ($is_admin) { ?>
                            <li><a href="<?php echo G5_ADMIN_URL ?>"><b>관리자</b></a></li>
                        <?php } ?>
                        <li>
                            <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">정보수정</a>
                        </li>
                        <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/login.php"><b>로그인</b></a></li>
                    <?php } ?>
                    <li><a href="<?php echo G5_BBS_URL ?>/faq.php">FAQ</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/qalist.php">1:1문의</a></li>
                    <li>
                        <a href="<?php echo G5_BBS_URL ?>/current_connect.php">접속자 <?php echo connect('theme/basic'); // 현재 접속자수, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?></a>
                    </li>
                    <li><a href="<?php echo G5_BBS_URL ?>/new.php">새글</a></li>
                </ul>

            </li>
        </ul>
    </div>
    <!--/ div.menus -->


    <!-- 콘텐츠 시작 { -->

