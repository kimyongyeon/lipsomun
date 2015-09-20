<?php
include_once('../../../common.php');

//** �Խ��� �̸��� ��� */
//select bo_table from `g5_board` a left join `g5_group` b on (a.gr_id=b.gr_id) where a.bo_device <> 'mobile'
// order by b.gr_order, a.bo_order select * from g5_board where bo_table = 'KOR'
// �ش� �Խ��� ���� ���
//select * from g5_write_KOR where wr_is_comment = 0 order by wr_num limit 0, 5

$resultArray = array();
$resultListArray = array();

//  �ֽű�
$result = getBoTable($g5['board_table'], $g5['group_table'], $is_admin);

for ($i = 0; $row = sql_fetch_array($result); $i++) {

    $resultArray[$i] = array (
        "bo_table" => $row['bo_table']
    );

    $boardTableRow = getBoardTable($g5['board_table'], $row['bo_table']);

    $resultListArray[$row['bo_table']] = getWriteTable($g5['write_prefix'], $row['bo_table'], $boardTableRow);

}

mylog(json_encode($resultArray)); // board table list
mylog(json_encode($resultListArray)); // board list

function mylog($msg) {
    echo $msg."<br>";
}

function getBoTable($board_table, $group_table, $is_admin) {
    $sql = " select bo_table
            from `{$board_table}` a left join `{$group_table}` b on (a.gr_id=b.gr_id)
            where a.bo_device <> 'mobile' ";
    if (!$is_admin)
        $sql .= " and a.bo_use_cert = '' ";
    $sql .= " order by b.gr_order, a.bo_order ";

    return sql_query($sql);

}

function getBoardTable($g5_board, $bo_table) {

    $sql = " select * from {$g5_board} where bo_table = '{$bo_table}' ";
//    mylog($sql);
    $board = sql_fetch($sql);
    $bo_subject = get_text($board['bo_subject']);

    return [$board, $bo_subject];

}
// �Խ��� ���� ��� �Լ�
function getWriteTable($write_prefix, $bo_table, $boardTableRow) {

    $board = $boardTableRow[0];
    $subject_len=40;
    $currentPageNo = 1; // ������ ��ȣ
    $rowsPerPage = 10; // �������� �Խù� ��
    $startPage = ( $currentPageNo - 1 ) * $rowsPerPage;
    $endPage = $rowsPerPage;
    $tmp_write_table = $write_prefix . $bo_table; // �Խ��� ���̺� ��ü�̸�
    $sql = " select * from {$tmp_write_table} where wr_is_comment = 0 order by wr_num LIMIT  {$startPage}, {$endPage} ";
//    mylog($sql);
    $result = sql_query($sql);

    $resultArray = array();
    for ($i=0; $row = sql_fetch_array($result); $i++) {
        $resultArray[$i] = array (
            "list" => $list[$i] = get_list($row, $board, '', $subject_len)
        );
    }

    return $resultArray;

}

?>
