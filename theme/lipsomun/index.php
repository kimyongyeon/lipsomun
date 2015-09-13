<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>

    <table class="sectionWrapper">
        <tr>
            <td>
                <section class="articleWrapper"></section><!--/ section.articleWrapper -->
            </td>
        </tr>
    </table><!--/ table.sectionWrapper > tr > td -->

    <script src="https://fb.me/react-0.13.3.min.js"></script>
    <script src="https://fb.me/JSXTransformer-0.13.3.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="<?php echo G5_JS_URL ?>/jquery.mobile.touch.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="<?php echo G5_JS_URL ?>/jquery.blockUI.js"></script>
    <script>
        var WINDOW_LIMIT_MIN_WIDTH = 768;
        var $navMenu = $("i.navMenu");
        var $lips = $("img.lips");
        var $totalSearch= $("input.totalSearch");
        var $searchIcon= $("i.searchIcon");

        var $menus = $("div.menus");
        var $menusUl = $("div.menus > ul");
        var $menu1 = $("a.sub");

        $navMenu.click(function(){
            if($menus.is(":hidden")){
                $menus.fadeIn();
                $menusUl.animate({"left": "0px"});
                $navMenu.removeClass("fa-bars").addClass("fa-times");
            }else{ //end: if($menus.is(":hidden")){
                $menusUl.animate({"left": "-200px"}, function(){
                    $menus.fadeOut();
                });
                $navMenu.removeClass("fa-times").addClass("fa-bars");
            } //end: }else{ //end: if($menus.is(":hidden")){
        }); //end: $navMenu.click(function(){

        $searchIcon.click(function(){
            if($lips.is(":hidden")){
                $totalSearch.hide();
                $lips.fadeIn();
                $searchIcon.removeClass("silver");
            }else{ //end: if($lips.is(":hidden")){
                $lips.animate({"width": "100px", "height": "100px", "top": "-30px"}, function(){
                    $lips.fadeOut(function(){
                        $totalSearch.val("").show();
                        $lips.css({"width": "40px", "height": "40px", "top": "0px"});
                        $searchIcon.addClass("silver");
                    });
                });
            } //end: }else{ //end: if($lips.is(":hidden")){
        }); //end: $searchIcon.click(function(){

        $(window).resize(function(){
            if(window.innerWidth < WINDOW_LIMIT_MIN_WIDTH){
                $menus.hide();
                $menusUl.animate({"left": "-200px"});
                $navMenu.removeClass("fa-times").addClass("fa-bars");
            }else{
                $menus.show();
            }
        });

        $menu1.click(function(){
            if(window.innerWidth < WINDOW_LIMIT_MIN_WIDTH){
                $menu1.next("ul").hide();
                $(this).next("ul").show();
            }
        });

        var datas = [
            {"url": "http://cfile82.uf.daum.net/image/2434D63955EF01181F7C03", "title": "어떤 구멍을 고를까?", "text": "용연이는 구멍을 고르면서 비비다가 싸고 마는데.."}
            , {"url": "https://40.media.tumblr.com/ba00c551b1345f932aac608644548f42/tumblr_ntr45txhPZ1tkqqero1_500.jpg", "title": "벗겨줘~", "text": "망설이는 용연이를 위해 직접 꼬시기 시작하는데.."}
            , {"url": "https://40.media.tumblr.com/72602715f8748a4e8e2bddbcef43adda/tumblr_nltnsiFZ6D1t2rp9ko7_540.jpg", "title": "드루와~ 드루와~", "text": "두 번 싼 용연이를 죽일 작정인 백마의 음모를 밝혀라."}
            , {"url": "https://40.media.tumblr.com/f3f7ef5b9dcc707103871cec029c68ff/tumblr_npvas9Ckaf1sgaxoyo1_500.jpg", "title": "내 꼭지 보여?", "text": "see through! see through! see through! see through!"}
            , {"url": "https://36.media.tumblr.com/8251c5cddf92bb49b1717e51e6ea8d90/tumblr_nltnsiFZ6D1t2rp9ko3_540.jpg", "title": "넣고 싶어...", "text": "용연이가 바람나서 대주지 않자. 지쳐버린 그녀는.."}
            , {"url": "http://cfile82.uf.daum.net/image/2434D63955EF01181F7C03", "title": "어떤 구멍을 고를까?", "text": "용연이는 구멍을 고르면서 비비다가 싸고 마는데.."}
            , {"url": "https://40.media.tumblr.com/ba00c551b1345f932aac608644548f42/tumblr_ntr45txhPZ1tkqqero1_500.jpg", "title": "벗겨줘~", "text": "망설이는 용연이를 위해 직접 꼬시기 시작하는데.."}
            , {"url": "https://40.media.tumblr.com/72602715f8748a4e8e2bddbcef43adda/tumblr_nltnsiFZ6D1t2rp9ko7_540.jpg", "title": "드루와~ 드루와~", "text": "두 번 싼 용연이를 죽일 작정인 백마의 음모를 밝혀라."}
            , {"url": "https://40.media.tumblr.com/f3f7ef5b9dcc707103871cec029c68ff/tumblr_npvas9Ckaf1sgaxoyo1_500.jpg", "title": "내 꼭지 보여?", "text": "see through! see through! see through! see through!"}
            , {"url": "https://36.media.tumblr.com/8251c5cddf92bb49b1717e51e6ea8d90/tumblr_nltnsiFZ6D1t2rp9ko3_540.jpg", "title": "넣고 싶어...", "text": "용연이가 바람나서 대주지 않자. 지쳐버린 그녀는.."}
        ];

        for(var i = 0; i < datas.length; i++){
            var data = datas[i];
            var tags = "<article>"
                + "<div style='background-image: url(\"" + data.url + "\");'></div>"
                + "<h5>" + data.title + "</h5>"
                + "<p>" + data.text + "</p>"
                + "</article>";
            $("section.articleWrapper").append(tags);
        }
    </script>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>