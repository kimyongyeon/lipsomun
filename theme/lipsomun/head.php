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
            <?php
            $sql = " select *
                        from {$g5['menu_table']}
                        where me_use = '1'
                          and length(me_code) = '2'
                        order by me_order, me_id ";
            $result = sql_query($sql, false);
            $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

            for ($i=0; $row=sql_fetch_array($result); $i++) {
            ?>
             <li style="z-index:<?php echo $gnb_zindex--; ?>">
             <a class="sub" href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da">
                        <?php

                          if ( $row['me_name'] == "Movie") {
                                echo '<i class="fa fa-video-camera">';
                          } else if ( $row['me_name'] == "Photo") {
                                echo '<i class="fa fa-camera">';
                          } else if ( $row['me_name'] == "TV") {
                                echo '<i class="fa fa-tv">';
                          } else if ( $row['me_name'] == "글 남기기") {
                                echo '<i class="fa fa-commenting">';
                          } else {
                                echo '<i class="fa '.$row['me_icon'].'">';
                          }

                        ?>
                        <?php echo $row['me_name'] ?></i></a>
                <?php
                $sql2 = " select *
                            from {$g5['menu_table']}
                            where me_use = '1'
                              and length(me_code) = '4'
                              and substring(me_code, 1, 2) = '{$row['me_code']}'
                            order by me_order, me_id ";
                $result2 = sql_query($sql2);

                for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                    if($k == 0)
                        echo '<ul>'.PHP_EOL;
                ?>
                    <li><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
                <?php
                }

                if($k > 0)
                    echo '</ul>'.PHP_EOL;
                ?>
            </li>
            <?php
            }

            if ($i == 0) {  ?>
                <li>메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
            <?php } ?>


            <!--            <ul>-->
            <!--                    <li><a href="bbs/board.php?bo_table=KOREA_YADONG">한국 야동</a></li>-->
            <!--                    <li><a href="#">일본/중국 야동</a></li>-->
            <!--                    <li><a href="#">서양 야동</a></li>-->
            <!--                    <li><a href="#">한국 영화</a></li>-->
            <!--                    <li><a href="#">외국 영화</a></li>-->
            <!--                </ul>-->
            <!--            </li>-->
            <!--            <li>-->
            <!--                <a class="sub" href="#"><i class="fa fa-camera"></i>Photo</a>-->
            <!--                <ul>-->
            <!--                    <li><a href="#">여자 사진</a></li>-->
            <!--                    <li><a href="#">남자 사진</a></li>-->
            <!--                </ul>-->
            <!--            </li>-->
            <!--            <li>-->
            <!--                <a class="sub" href="#"><i class="fa fa-tv"></i>TV</a>-->
            <!--                <ul>-->
            <!--                    <li><a href="#">한국 드라마</a></li>-->
            <!--                    <li><a href="#">미/영 드라마</a></li>-->
            <!--                    <li><a href="#">코미디</a></li>-->
            <!--                </ul>-->
            <!--            </li>-->
            <!--            <li>-->
            <!--                <a class="sub" href="#"><i class="fa fa-commenting"></i>글 남기기</a>-->
            <!--                <ul>-->
            <!--                    <li><a href="#">출석부</a></li>-->
            <!--                    <li><a href="#">운영자에게</a></li>-->
            <!--                </ul>-->
            <!--            </li>-->

            <li>
                <a class="sub" href="#"><i class="fa fa-lock"></i>Admin</a>
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
    <div class="contents">
