<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type:text/html; charset=utf-8');

// 1. 데이터 받기
$user_name = $_POST['user_name'] ?? '';
$user_tel  = $_POST['user_tel'] ?? '';
$user_mail = $_POST['user_mail'] ?? '';

// 2. DB 연결
$db = mysqli_connect('localhost', 'toma2025', 'PUNX4fSx!H6d3c', 'toma2025');

if (!$db) {
    die("DB 연결 실패: " . mysqli_connect_error());
}

mysqli_query($db, 'set names utf8');

// 3. 데이터 저장 (e-mail을 email로 수정했습니다!)
$sql = "INSERT INTO reserved (name, tel, email) VALUES ('$user_name', '$user_tel', '$user_mail')";

if (mysqli_query($db, $sql)) {
    echo "<script>alert('드디어 저장 성공! 사장님 나이스!');</script>";
} else {
    echo "저장 실패 이유: " . mysqli_error($db);
}

// 4. 목록 출력
echo "<h2>예약 현황 목록</h2>";
$res = mysqli_query($db, "SELECT * FROM reserved ORDER BY no DESC");

echo "<table border='1' cellpadding='8' style='border-collapse: collapse;'>";
echo "<tr bgcolor='#eeeeee'><th>번호</th><th>이름</th><th>전화번호</th><th>이메일</th></tr>";

while($row = mysqli_fetch_array($res)) {
    echo "<tr>";
    echo "<td>{$row['no']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['tel']}</td>";
    echo "<td>{$row['email']}</td>"; // 여기도 email로 수정!
    echo "</tr>";
}
echo "</table>";

mysqli_close($db);
?>