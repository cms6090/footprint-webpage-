<?php
    session_start();
    include_once('dbconn.php');
    $email = $_SESSION['uid'];
    $name = mysqli_real_escape_string($conn, $_GET['name']);
    $size = $_GET['size'];

    $sql = "delete from cart where email = '$email' and name = '$name' and size = '$size' limit 1";
    if(!$conn->query($sql)) {
        die("장바구니 아이템 삭제 중에 DB 오류가 발생했습니다.");
    }
    else {
        echo "<script>location.href='mypage_cart.php'</script>"; // history.go(-1) : 방문했던 이전 페이지로 돌아감
    }
?>