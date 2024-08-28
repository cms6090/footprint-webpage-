<?php
    session_start();
    include_once("dbconn.php"); // dbconn.php 파일의 내용을 읽어옴, 중복 방지
    $isLogged = false;
    if(isset($_SESSION['uid'])) {// isset(): 괄호 안에 있는게 만들어져 있는지 확인
        $isLogged = true;   // 로그인된 것을 체크해 둠
        $uname = $_SESSION['uname'];
        $email = $_SESSION['uid'];
    }else {
        echo "<script>alert('로그인을 해야 합니다.')</script>";
        echo "<script>location.href='signin.html'</script>";
    }
    
    $currentDate = date('Y-m-d');
    $twoMonthsAgo = date('Y-m-d', strtotime('-2 months'));
    $fourMonthsAgo = date('Y-m-d', strtotime('-4 months'));
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Footprint</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet"> <!-- 웹사이트 폰트 -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            .inter {
                font-family: "Inter", sans-serif;
                font-optical-sizing: auto;
                font-weight: 900;
                font-style: normal;
                font-variation-settings:
                    "slnt" -10;
            }
            header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 1000;
                background-color: white;
            }
            .container {
                width: 70%;
                margin-left: auto;
                margin-right: auto;
            }
            .navbar {
                padding: 0;
            }
            .navbar-brand {
                font-weight: bold;
            }
            .nav-link {
                font-weight: bold;
            }
            .footer {
                background-color: #f8f9fa;
                padding: 20px 0;
            }
            .footer-text {
                font-size: 14px;
                color: #6c757d;
            }
            .bold {
                font-weight: bold;
            }
            .mypage-side-details {
                line-height: 2.5em;
            }
            .mypage-side-more-details {
                color: #6c757d;
            }
            .sidebar {
                border-right: 2px solid #e0e0e0;
            }
            .nav-link {
                color: black;
                font-size: 20px;
            }
            .nav-item {
                margin-left: 20px;
                margin-right: 20px;
            }
            .nav-link {
                color: black;
            }
            a {
                text-decoration: none;
                color: inherit;
            }
            a:hover {
                text-decoration: none;
                color: inherit;
                font-weight: bold;
            }
            .active {
                color: rgba(0, 0, 0, 0.7);
                font-weight: bold;
            }
            .mypage-sidebar-detail-title {
                width: 90%;
                margin-left: auto;
                margin-right: auto;
            }
            .wish-border {
                border-bottom: 1px solid rgba(217, 217, 217, 1);
                padding: 10px;
            }
            .purchase-container {
                margin-top: 10px;
                margin-bottom: 10px;
                padding: 5px 10px;
                text-align: center;
            }
            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                margin: 0;
            }
            footer {
                flex-shrink: 0;
            }
            main {
                flex-grow: 1;
                padding-top: 100px;
            }
            .button {
                border: 1px solid rgba(217, 217, 217, 1); 
                border-radius: 1ch;
                background-color: white;
                padding: 1% 2%;
                color: gray;
            }
            .ord-right {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            .orddetail {
                font-size: 0.9em;
            }
            .ord-content {
                flex: 1;
            }
            .check {
                display: flex;
                background-color: #F5F5F5; 
                justify-content: space-evenly;
            }
            .check-content {
                margin: 2%;
            }
            .check-button {
                border-radius: 1ch;
                border: 1px solid #DFDFDF;
                padding: 5px 10px;
                background-color: white;
                color: black;
                height: 35.6px;
            }
        </style>
    </head>
    <body>
    <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand inter" href="index.php" style="font-size: 60px; font-weight: 900;"><i>Footprint</i></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- 화면 크기가 줄어들었을 때 햄버거로 바꿈 -->
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="shop.php">SHOP</a>
                            </li>
                            <?php
                                if($isLogged) {
                            ?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="mypage_cart.php">CART</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="mypage_main.php">MYPAGE</a>
                            </li>
                            <?php }?>
                            <?php
                                if(!$isLogged) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="signin.html">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="signup.html">SignUp</a>
                                </li>
                            <?php } else {
                            ?>  <li class="nav-item">
                                    <a class="nav-link" href="signout.php">Logout</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <div class="container my-3">
                <div class="row">
                    <div class="col-md-2 sidebar">
                        <h3 class="bold" style="margin-bottom: 30px"><a href="mypage_main.php">마이 페이지</a></h3>
                        <ul class="list-unstyled mypage-side-details">
                            <div class="shop" style="margin-bottom: 50px">
                                <h5 class="bold">쇼핑 정보</h5>
                                <ul class="list-unstyled mypage-side-more-details">
                                    <li><a href="mypage_purchase.php" class="active">구매 내역</a></li>
                                    <li><a href="mypage_cart.php">장바구니</a></li>
                                </ul>
                            </div>
                            <div class="my">
                                <h5 class="bold">내 정보</h5>
                                <ul class="list-unstyled mypage-side-more-details">
                                    <li><a href="mypage_main.php">회원 정보</a></li>
                                    <li><a href="signdel.php" style="color: red;">회원 탈퇴</a></li>
                                </ul>
                            </div>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <div class="mypage-sidebar-detail-title">
                            <h3 class="bold" style="padding-bottom: 10px; border-bottom: 3px solid black;">구매 내역</h3>
                            <div class="check">
                                <form action="mypage_purchase.php" class="check-content" method="get">
                                    <a class="check-button" href="mypage_purchase.php?start=<?=$twoMonthsAgo?>&end=<?=$currentDate?>">최근 2개월</a>
                                    <a class="check-button" href="mypage_purchase.php?start=<?=$fourMonthsAgo?>&end=<?=$currentDate?>">최근 4개월</a>
                                    <input type="date" name="start" class="check-button"> ~ <input type="date" name="end" class="check-button">
                                    <input type="submit" class="check-button" style="background-color: black; color: white;" value="조회"></button>
                                </form>
                            </div>
                            <?php 
                                if(isset($_GET['start'])) {
                                    $start = $_GET['start'];
                                    $end = $_GET['end'];
                                ?>
                                <ul class="wish-list" style="list-style-type: none; padding: 0; ">
                                    <?php
                                        $sql = "select * from orders where email = '$email' and orddate between '$start' and '$end' order by orddate desc, ordno desc";
                                        # 쿼리를 MySQL에 전달해서 실행
                                        $result = $conn->query($sql);

                                        if($result->num_rows > 0) { // 검색된 레코드가 있으면
                                            while($row = $result->fetch_assoc()) { // 레코드 하나를 건네준다.
                                                $name = $row['name'];
                                                $size = $row['size'];
                                                $image = $row['image'];
                                                $price = $row['price'];
                                                $brand = $row['brand'];
                                    ?>
                                    <li class="wish-border">
                                        <div class="wish-item row" style="text-align: left; height: 100%">
                                            <div class="col-sm-2"><img src="<?=$image?>" style="width: 100%; height: 100%; background-color: rgba(235, 239, 242, 1); border-radius: 1ch;"></div>
                                            <div class="col-sm-8">
                                                <h5 class="title bold"><?=$row['brand']?></h5>
                                                <p class="name"><?=$name?></p>
                                                <p class="size mt-3"><?=$size?></p>
                                            </div>
                                            <div class="col-sm-2 ord-right">
                                                <div class="orddetail" style="margin-bottom: 2%;">
                                                    <p class="ord-content" style="margin-bottom: 2%; font-weight: 550;"><span>구매일</span></p>
                                                    <p class="ord-content" style="color: gray; margin-bottom: 2%;"><span><?=$row['orddate']?></span></p>
                                                </div>
                                                <div class="orddetail">
                                                    <p class="ord-content" style="margin-bottom: 2%; font-weight: 550;"><span>주문번호</span></p>
                                                    <p class="ord-content" style="color: gray; margin-bottom: 2%;"><span><?=$row['ordno']?></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php }?>
                                <?php }?>
                                </ul>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <p class="inter" style="font-size: 30px; font-weight: 900;"><i>Footprint</i></p>
                        <p class="footer-text">&copy; 2024 Footprint. All rights reserved.</p>
                        <a href="#" class="footer-text mr-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="footer-text mr-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="footer-text mr-3"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="footer-text"><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="col-md-4 text-md-right bold" style="display: flex; justify-content: flex-end; align-items: center">
                        <div class="footer-sub-text">
                            <p>고객지원</p>
                            <p>공지사항</p>
                            <p>스토어 안내</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
    <script>
    </script>
</html>
