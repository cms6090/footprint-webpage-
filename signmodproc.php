<?php
session_start();
# 데이터베이스 접속하기
# SQL 실행하기
# 데이터베이스 접속 해제하기
include_once("dbconn.php"); // dbconn.php 파일의 내용을 읽어옴, 중복 방지
# 회원정보를 입력양식에서 읽어오기
$email = $_GET['email'];
$name = $_GET['uname'];
$pwd = $_GET['pwd'];
$telno = $_GET['telno'];

# UPDATE sql 문 작성
$sql = "update member set name = '$name', pwd = '$pwd', telno = '$telno'
        where email = '$email'";

# sql 문 실행
if($conn->query($sql)) { // SQL 실행 성공한 경우
    $_SESSION['uname'] = $name;
    echo "<script>alert('회원정보 수정 성공')</script>";
    echo "<script>location.href='mypage_main.php'</script>";
} else { // SQL 실행 실패한 경우
    echo "<script>alert('회원정보 수정 실패')</script>";
    echo "<script>location.href='mypage_main.php'</script>";
}

$conn->close(); // 접속 종료
?>