<?php
include_once('../../../common.php');

header('Content-Type: application/json');

$resultArray = array();

$ini=$_GET;

foreach($ini as $key=>$val){
    $param[$key] = addslashes($val);
}
$board = $param['board'];
$currentPageNo = $param['currentPageNo']; // 페이지 번호
$rowsPerPage = $param['rowsPerPage']; // 페이지당 게시물 수

if ($board == "") {
    $resultArray["status_msg"] = "error";
    $resultArray["status_code"] = "-1";
    echo json_encode($resultArray); // board table list
    return;
}

if ($currentPageNo == "") {
    $currentPageNo = 1;
}

if ($rowsPerPage == "") {
    $rowsPerPage = 10;
}

$subject_len=40;
$startPage = ( $currentPageNo - 1 ) * $rowsPerPage;
$endPage = $rowsPerPage;
$tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름

$sql = " select * from {$tmp_write_table} where wr_is_comment = 0 order by wr_num LIMIT  {$startPage}, {$endPage} ";
$result = sql_query($sql);

for ($i=0; $row = sql_fetch_array($result); $i++) {
    $resultArray[$i] = array (
        "list" => $list[$i] = get_list($row, $board, '', $subject_len)
    );
}

echo (json_encode($resultArray)); // board table list

function mylog($msg) {
    echo $msg."<br>";
}

?>
