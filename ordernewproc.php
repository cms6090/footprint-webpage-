<?php
    include_once('dbconn.php');
    $conn->autocommit(false); // autocommit 설정을 해제

    $sql = 'select max(ordno) from orders';
    $result = $conn->query($sql);
    if(!$result) { // 주문이 하나도 없을 때
        $no = 1;
        $ordno = date('Y').date('m').date('d')."-".$no;
    } else { // 마지막 주문을 가져왔을 때
        $row = $result->fetch_row();
        $today = date('Y').date('m').date('d');
        $ymd = substr($row[0], 0, strpos($row[0], "-"));

        if($today == $ymd) { // 마지막 주문이 오늘 날짜와 같을 때, 순번증가
            $no = substr($row[0], strpos($row[0], "-")+1, 2);
            $no++;
            $ordno = $today."-".$no;
        } else { // 오늘 날짜와 다를 때, 오늘 첫 주문
            $no = 1;
            $ordno = $today."-".$no;
        }
    }

    $email = $_GET['email'];
    $orddate = date('Y/m/d');
    $address = $_GET['address'];
    $name = mysqli_real_escape_string($conn, $_GET['name']);
    $size = $_GET['size'];
    $price = $_GET['price'];
    $delivery = $_GET['delivery'];
    $total = $_GET['total'];
    $image = $_GET['image'];
    $brand = $_GET['brand'];
    
    $sql = "insert into orders values('$ordno', '$email', '$orddate', '$address', '$name', $size, '$price', '$delivery', '$total', '$image', '$brand')";

    if($conn->query($sql)) {
        $sql = "delete from cart where email = '$email' and name = '$name' and size = $size";
        if($conn->query($sql)) {

            $sql2 = "UPDATE product SET purcnt = purcnt + 1 WHERE name = '$name'";
            if($conn->query($sql2)) {      
                $conn->commit(); // 지금까지 수행한 연산을 모두 확정
                echo "<script>alert('주문 완료'); location.href='mypage_cart.php';</script>";
            } else { 
                die('구매 횟수 수정 중에 오류 발생');
            }
        } else {
            die('장바구니 내역 삭제 중에 오류 발생');
        }
    } else {
        die('주문상세내역 저장 중에 오류 발생');
    }

    $sql2 = "UPDATE product SET purcnt = purcnt + 1 WHERE name = $name";
    if($conn->query($sql)) {
        $conn->commit(); // 지금까지 수행한 연산을 모두 확정
    } else {
        die('구매횟수 갱신 중에 오류 발생');
    }

    $conn->autocommit(true);

    $conn->close();
?>