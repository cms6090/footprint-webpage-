<?php
session_start(); // 이 PHP 페이지에서 세션 데이터 처리
# 데이터베이스 접속 해제하기
include_once("dbconn.php"); // dbconn.php 파일의 내용을 읽어옴, 중복 방지
# 로그인 정보를 읽어오기
$email = $_GET['email'];
$pwd = $_GET['pwd'];

# SELECT SQL문 작성
$sql = "select * from member where email = '$email' and pwd = '$pwd'";
# 쿼리를 MySQL에 전달해서 실행
$result = $conn->query($sql);
//var_dump($result);
if($result->num_rows > 0) { // 검색된 레코드가 있으면
    $row = $result->fetch_assoc(); // 레코드 하나를 건네준다.
    //var_dump($row);
    # 세션 배열에 로그인 정보 저장, 다른 페이지로 이동해도 저장되어 있음
    $_SESSION['uid'] = $row['email']; // uid는 그냥 내가 정한 변수, 현재 레코드의 email 컬럼 값을 세션에 저장
    $_SESSION['uname'] = $row['name'];
    echo "<script>alert('로그인 성공')</script>";
    echo "<script>location.href='index.php'</script>";
} else { // SQL 실행 실패한 경우
    echo "<script>alert('로그인 실패')</script>";
    echo "<script>location.href='signin.html'</script>";
}
?>