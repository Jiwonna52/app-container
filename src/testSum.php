<?php
// 데이터베이스 연결 설정
$servername = "product-db.cr60wuc6k949.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "qlalfqjsgh123";
$dbname = "DATE";

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// id가 1인 year와 id가 2인 year 값을 가져오는 쿼리
$sql1 = "SELECT year FROM buyDate WHERE id = 1";
$sql2 = "SELECT year FROM buyDate WHERE id = 2";

$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2);

if ($result1->num_rows > 0 && $result2->num_rows > 0) {
    // 결과를 배열로 변환
    $row1 = $result1->fetch_assoc();
    $row2 = $result2->fetch_assoc();
    
    // year 값을 더함
    $sum = $row1['year'] + $row2['year'];
    
    // 결과 출력
    echo "The sum of year values for id 1 and id 2 is: " . $sum;
} else {
    echo "No records found";
}

// 연결 종료
$conn->close();
?>
