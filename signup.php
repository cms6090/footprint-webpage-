<?php
# 데이터베이스 접속하기
# SQL 실행하기
# 데이터베이스 접속 해제하기
include_once("dbconn.php"); // dbconn.php 파일의 내용을 읽어옴, 중복 방지
# 회원정보를 입력양식에서 읽어오기
$email = $_GET['email'];
$name = $_GET['uname'];
$pwd = $_GET['pwd'];
$telno = $_GET['telno'];
$today = date('Y/m/d'); // 시스템 날짜를 년/월/일 형식으로 가져옴(현재 날짜)

$sql = "SELECT COUNT(*) as cnt FROM member WHERE email = '$email'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
if($row['cnt'] > 0) {    
    echo "<script>alert('이미 등록된 회원입니다.')</script>";
    echo "<script>location.href='signin.html'</script>";
}

if ($email == NULL or $name == NULL or $pwd == NULL or $telno == NULL) {
    echo "<script>alert('내용을 입력하세요')</script>";
    echo "<script>location.href='signup.html'</script>";
}
else {
    # INSERT sql 문 작성
    $sql = "insert into member values('$email', '$name', '$pwd', '$telno', '$today')";

    # sql 문 실행
    if($conn->query($sql)) { // SQL 실행 성공한 경우
        /*echo "회원가입 성공";
        header("location: index.html"); // 페이지 이동, 앞의 echo 출력 */
        echo "<script>alert('회원가입 성공')</script>";
        echo "<script>location.href='index.php'</script>";
    } else { // SQL 실행 실패한 경우
        echo "<script>alert('회원가입 실패')</script>";
        echo "<script>location.href='signup.html'</script>";
    }
}

$conn->close(); // 접속 종료
?>