<?php
include_once('../../../common.php');

header('Content-Type: application/json');

$ini=$_GET;

foreach($ini as $key=>$val){
    $param[$key] = addslashes($val);
}
$currentPageNo = $param['currentPageNo']; // ������ ��ȣ
$rowsPerPage = $param['rowsPerPage']; // �������� �Խù� ��

$board_table = $g5['board_table'];
$group_table = $g5['group_table'];
$write_prefix = $g5['write_prefix'];
$bo_table = $row['bo_table'];

if ($currentPageNo == "") {
    $currentPageNo = 1;
}

if ($rowsPerPage == "") {
    $rowsPerPage = 10;
}

//** �Խ��� �̸��� ��� */
//select bo_table from `g5_board` a left join `g5_group` b on (a.gr_id=b.gr_id) where a.bo_device <> 'mobile'
// order by b.gr_order, a.bo_order select * from g5_board where bo_table = 'KOR'
// �ش� �Խ��� ���� ���
//select * from g5_write_KOR where wr_is_comment = 0 order by wr_num limit 0, 5

$resultArray = array();
$resultListArray = array();

if($is_admin != "super") {
    return;
}

//  �ֽű�
$result = getBoTable($is_admin);

for ($i = 0; $row = sql_fetch_array($result); $i++) {

    $resultArray[$i] = array (
        "bo_table" => $row['bo_table']
    );

    $boardTableRow = getBoardTable($row['bo_table']);

    $resultListArray[$row['bo_table']] = getWriteTable($row['bo_table'], $boardTableRow);

}

$resultJson = array (
    "board_table_list" => $resultArray,
    "board_list" => $resultListArray,
);

echo urldecode(json_encode($resultJson)); // board table list

function mylog($msg) {
    echo $msg."<br>";
}

function getBoTable($is_admin) {

    GLOBAL $board_table, $group_table;

    $sql = " select bo_table
            from `{$board_table}` a left join `{$group_table}` b on (a.gr_id=b.gr_id)
            where a.bo_device <> 'mobile' ";
    if (!$is_admin)
        $sql .= " and a.bo_use_cert = '' ";
    $sql .= " order by b.gr_order, a.bo_order ";

    return sql_query($sql);

}

function getBoardTable($bo_table) {

    GLOBAL $g5_board;

    $sql = " select * from {$g5_board} where bo_table = '{$bo_table}' ";
    $board = sql_fetch($sql);
    $bo_subject = get_text($board['bo_subject']);

    return [$board, $bo_subject];

}
// �Խ��� ���� ��� �Լ�
function getWriteTable($bo_table, $boardTableRow) {

    GLOBAL $currentPageNo, $rowsPerPage, $write_prefix;

    $board = $boardTableRow[0];
    $subject_len=40;
    $startPage = ( $currentPageNo - 1 ) * $rowsPerPage;
    $endPage = $rowsPerPage;
    $tmp_write_table = $write_prefix . $bo_table; // �Խ��� ���̺� ��ü�̸�

    $sql = " select * from {$tmp_write_table} where wr_is_comment = 0 order by wr_num LIMIT  {$startPage}, {$endPage} ";
    $result = sql_query($sql);

    $resultArray = array();
    for ($i=0; $row = sql_fetch_array($result); $i++) {
        $resultArray[$row['wr_id']] = get_list($row, $board, '', $subject_len);
    }

    if(count($resultArray) == 0) {
        $resultArray["status_msg"] = "list no length";
        $resultArray["status_code"] = "-2";
    } else {
        $resultArray["status_msg"] = "success";
        $resultArray["status_code"] = "0";
    }

    return $resultArray;

}

?>
