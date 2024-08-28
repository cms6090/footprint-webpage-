<?php
    session_start();
    include_once("dbconn.php"); // dbconn.php 파일의 내용을 읽어옴, 중복 방지
    $isLogged = false;
    if(isset($_SESSION['uid'])) {// isset(): 괄호 안에 있는게 만들어져 있는지 확인
        $isLogged = true;   // 로그인된 것을 체크해 둠
        $uname = $_SESSION['uname'];
        $email = $_SESSION['uid'];
    }
    if(!$isLogged) {
        echo "<script>alert('로그인을 해야 합니다.')</script>";
        echo "<script>location.href='signin.html'</script>";
    }
    else {
        $email = $_SESSION['uid'];
        $product_name = mysqli_real_escape_string($conn, $_POST['name']);

        $product_brand = $_POST['brand'];
        $product_price = $_POST['price'];
        $product_text = mysqli_real_escape_string($conn, $_POST['text']);
        $product_size = $_POST['size'];
        $product_image = $_POST['images'];

        $sql = "insert into cart values('$email', '$product_name', '$product_brand', '$product_price', $product_size, '$product_image', '$product_text')";
        # sql 문 실행
        if($conn->query($sql)) { // SQL 실행 성공한 경우
            echo "<script>alert('장바구니 담기 성공')</script>";
            echo "<script>location.href='shop.php'</script>";
        } else { // SQL 실행 실패한 경우
            echo "<script>alert('장바구니 담기 실패')</script>";
            echo "<script>location.href='product.php'</script>";
        }
    }
?>
