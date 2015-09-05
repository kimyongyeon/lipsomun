<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>


        <div class="contents">
            contents...
        </div><!--/ div.contents -->
    </div><!--/ div.wrapper -->

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
    </script>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>