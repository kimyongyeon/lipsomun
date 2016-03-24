<?php
include_once('../../../common.php');

header('Content-Type: application/json');

$resultArray = array();

$ini=$_GET;

foreach($ini as $key=>$val){
    $param[$key] = addslashes($val);
}
$board = $param['board'];
$currentPageNo = $param['currentPageNo']; // ������ ��ȣ
$rowsPerPage = $param['rowsPerPage']; // �������� �Խù� ��

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
$tmp_write_table = $g5['write_prefix'] . $bo_table; // �Խ��� ���̺� ��ü�̸�

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
