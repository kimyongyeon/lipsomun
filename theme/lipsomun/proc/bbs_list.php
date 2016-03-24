<?php
header('Content-Type: application/json; charset=utf-8');
include_once('../../../common.php');

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

$startPage = ( $currentPageNo - 1 ) * $rowsPerPage;
$endPage = $rowsPerPage;

$sql = " select * from $board LIMIT  {$startPage}, {$endPage} ";
$result = sql_query($sql);
$subject_len =40;

for ($i=0; $row = sql_fetch_array($result); $i++) {
    $resultArray[$i] = $row;
}

echo json_encode($resultArray); // board table list

?>
