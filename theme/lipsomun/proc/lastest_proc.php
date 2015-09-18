<?php
include_once('../../../common.php');

//  최신글
$result = getBoTable($g5['board_table'], $g5['group_table'], $is_admin);

//** 게시판 이름명 출력 */
//select bo_table from `g5_board` a left join `g5_group` b on (a.gr_id=b.gr_id) where a.bo_device <> 'mobile'
// order by b.gr_order, a.bo_order select * from g5_board where bo_table = 'KOR'
// 해당 게시판 내용 출력
//select * from g5_write_KOR where wr_is_comment = 0 order by wr_num limit 0, 5

$resultArray = array();
$resultListArray = array();

for ($i = 0; $row = sql_fetch_array($result); $i++) {

    //mylog( 'table name: '.$row['bo_table'] );

    $resultArray[$i] = array (
        "bo_table" => $row['bo_table']
    );

    $boardTableRow = getBoardTable($row['bo_table']);
    $resultListArray = getWriteTable($row['bo_table'], $boardTableRow);

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

function getBoardTable($bo_table) {

    $sql = " select * from {$g5['board_table']} where bo_table = '{$bo_table}' ";
    $board = sql_fetch($sql);
    $bo_subject = get_text($board['bo_subject']);

    return [$board, $bo_subject];

}
// 게시판 내용 출력 함수
function getWriteTable($bo_table, $boardTableRow) {

    $board = $boardTableRow[0];
    $subject_len=40;
    $rows=10;

    $tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름
    $sql = " select * from {$tmp_write_table} where wr_is_comment = 0 order by wr_num limit 0, {$rows} ";
    $result = sql_query($sql);

    $resultArray = array();
    for ($i=0; $row = sql_fetch_array($result); $i++) {

        //echo $list[$i] = get_list($row, $board, '', $subject_len);

        $resultArray[$i] = array (
            "list" => $list[$i] = get_list($row, $board, '', $subject_len)
        );

    }

    return $resultArray;

}

?>
