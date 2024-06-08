<?php
// 데이터베이스 연결 설정
$db_host = 'main-test-db.cr60wuc6k949.us-east-1.rds.amazonaws.com';
$db_user = 'admin';
$db_pass = 'qlalfqjsgh123';
$db_name = 'web01';

// 데이터베이스에 연결
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// 연결 오류 확인
if (!$con) {
    die("DB 접속 실패: " . mysqli_connect_error());
}

// 안전한 쿼리를 위해 입력 데이터를 이스케이프
$id = mysqli_real_escape_string($con, $_POST['id']);

// SQL 쿼리 실행: id와 일치하는 name을 검색
$query = "SELECT name FROM user WHERE id='$id'";

$result = mysqli_query($con, $query);

// 쿼리 결과 확인 및 출력
if ($row = mysqli_fetch_assoc($result)) {
    // 검색된 이름을 h1 태그로 출력
    echo "<h1>" . htmlspecialchars($row['name']) . "</h1>";
} else {
    echo "<h1>해당 ID의 유저를 찾을 수 없습니다.</h1>";
}

// 데이터베이스 연결 종료
mysqli_close($con);
?>
