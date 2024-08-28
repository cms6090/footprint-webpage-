<?php
# 현재 로그인한 사용자를 member 테이블에서 삭제
session_start();
$email = $_SESSION['uid'];

include_once("dbconn.php");

$sql = "delete from member where email = '$email'";
if($conn->query($sql)) {
    session_destroy();
    echo "<script>alert('회원탈퇴 성공')</script>";
    echo "<script>location.href='index.php'</script>";
} else {
    echo "<script>alert('회원탈퇴 실패')</script>";
    echo "<script>location.href='index.php'</script>";
}
?>