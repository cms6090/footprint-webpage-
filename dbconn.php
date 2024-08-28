<?php
# pizzamall 데이터베이스 접속하기
$server = "localhost";
$user = "root";
$pwd = "";
$dbname = "footprint"; # 데이터베이스 이름

# $conn 변수는 객체변수, mysqli 클래스
$conn = new mysqli($server, $user, $pwd, $dbname);
if($conn->connect_error) {
    echo "DB 접속 오류<br>";
}
# else echo "DB 접속 성공<br>";
?>