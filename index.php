<?php
    session_start();
    include_once("dbconn.php"); // dbconn.php 파일의 내용을 읽어옴, 중복 방지
    $isLogged = false;
    if(isset($_SESSION['uid'])) {// isset(): 괄호 안에 있는게 만들어져 있는지 확인
        $isLogged = true;   // 로그인된 것을 체크해 둠
        $uname = $_SESSION['uname'];
        $email = $_SESSION['uid'];
    }
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
            .inter{
                font-family: "Inter", sans-serif;
                font-optical-sizing: auto;
                font-style: normal;
                font-variation-settings:
                    "slnt" -10;
            }
            .inter-no{
                font-family: "Inter", sans-serif;
                font-optical-sizing: auto;
                font-weight: 700;
                font-style: normal;
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
                font-size: 20px;
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
            .nav-item {
                margin-left: 20px;
                margin-right: 20px;
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
            footer {
                position: relative;
                bottom: 0;
                left: 0;
                width: 100%;
                z-index: 1000;
                background-color: white;
                flex-shrink: 0;
            }
            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                margin: 0;
            }
            main {
                flex-grow: 1;
                padding-top: 100px;

            }
            .carousel-container {
                margin-left: calc(50% - 50vw);
                width: 100vw;
                height: 30%;
                position: relative;
            }
            .carouselExampleDark {
                display: flex;
            }
            .img-item {
                width: 30%;
                margin-right: auto;
                margin-left: auto;
            }
            .carousel-item img {
                height: 300px; /* 원하는 높이로 변경 */
                width: 80%; /* 가로 길이를 80%로 줄임 */
                object-fit: cover; /* 이미지를 전체 영역에 맞추면서 비율 유지 */
                margin: 0 auto; /* 이미지를 가운데 정렬 */
            }
            .carousel-item {
                transition: transform 0.3s ease; /* 이미지 전환 시간 단축 */
            }
            .carousel-caption {
                position: absolute;
                top: 25px; /* 원하는 높이로 조절 */
                left: 50%;
                transform: translateX(-50%);
            }
            .about-container {
                margin: 2% 0;
            }
            .about-content {
                padding: 0 2%;
            }
            .popular-container {
                margin: 2%;
            }
            .popular-title {
                font-weight: 900;
                font-size: 25px;
                margin-bottom: 2%;
            }
            .card-img {
                width: 100%;
                height: 100%;
                background-color: rgba(235, 239, 242, 1);
                border: 1px solid none;
                border-radius: 2ch;
            }
            .card {
                border: none;
            }
            .text-center {
                margin-bottom: 5%;
            }
            .card-detail-title {
                margin-bottom: 10px;
            }
            .card-detail-text {
                font-weight: 600;
                margin-bottom: 5px;
            }
            .card-detail-sub-text {
                font-weight: 300;
                color: #6c757d;
                font-size: 0.9em;
            }
            .card-detail-price {
                font-weight: bold;
                font-size: 1.2em;
            }
            .card-detail-cart {
                color: #6c757d;
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
            <div class="container">
                <div class="carousel-container" style="background-color: rgba(235, 239, 242, 1);">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" style="padding-bottom: 50px;">
                        <div class="carousel-indicators" style="margin-top: 10px;" >   
                            <?php
                                $sql = "select * from product";
                                $result = $conn->query($sql);
                                $no = 0; 
                                if($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                            ?>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?=$no?>" <?=($no == 0 ? 'class = "active"' : '')?> <?=($no == 0 ? 'aria-current = "true"' : '')?> aria-label="Slide <?=++$no?>"></button>
                            <?php }}?>
                        </div>
                        <div class="carousel-inner">
                            <?php
                                $sql = "select * from product";
                                $result = $conn->query($sql);
                                $no = 0;
                                if($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                            ?>
                            <a href="product.php?name=<?=$row['name']?>">
                                <div class="carousel-item <?=($no == 0 ? 'active' : '')?>" data-bs-interval="3500" style="position: relative;">
                                    <div class="img-item">
                                        <img src="<?=$row['images']?>" class="d-block w-100" />
                                    </div>
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="margin-bottom: 0;"><?=$row['brand']?></p>
                                        <p style="font-weight: bold; font-size: 1.2em; color: gray;"><?=$row['name']?></p>
                                    </div>
                                </div>
                                <?php $no++; }}?>
                            </a>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="popular-container">
                    <div class="popular-title">Most Popular</div>
                    <div class="popular-content row">
                        <?php
                            $sql = "select * from product order by purcnt desc limit 6";
                            # 쿼리를 MySQL에 전달해서 실행
                            $result = $conn->query($sql);

                            if($result->num_rows > 0) { // 검색된 레코드가 있으면
                                while($row = $result->fetch_assoc()) { // 레코드 하나를 건네준다.
                        ?>
                            <div class="col-sm-4" style="margin-bottom: 25px;">
                                <form action="product.php" method="get">
                                    <button style="border:none; background-color: transparent; width: 100%">
                                        <div class="card">
                                            <img src="<?=$row['images']?>" class="card-img-top card-img" />
                                            <div class="card-body" style="text-align:left;">
                                                <input type="hidden" name="name" value="<?=$row['name']?>"><p class="card-detail-text"><?=$row['name']?></p>
                                                <p class="card-detail-sub-text"><?=$row['text']?></p>
                                                <p class="card-detail-price"><?=$row['price']?></p>
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            </div>
                            <?php }?>
                        <?php }?>
                    </div>
                </div>
                <div class="about-container" style="margin-top: 5%;">
                    <div class="row">
                        <div class="col-sm-7 about-content">
                            <div class="inter-no" style="margin-bottom: 2%; font-weight: bolder; font-size: 40px;">About</div>
                            <div style="margin-top: 10%; font-size: 17px; font-weight: 700;">
                                <p style="margin-bottom: 5%;">Footprint는 고객 여러분의 발걸음을 위한 최고의 신발을 제공하는 온라인 쇼핑몰입니다.</p>
                                <p>프론트엔드와 PHP를 활용하여 개발된 이 웹페이지는 사용자 친화적인 인터페이스와 편리한 기능들로 구성되어 있습니다.</p>
                                <p style="margin-bottom: 5%;">이 웹페이지에서는 다양한 스타일의 신발들을 만나보실 수 있습니다.</p>
                                <p>편안한 착화감, 뛰어난 내구성, 그리고 트렌디한 디자인까지 갖춘 Footprint의 제품들은 고객 여러분의 발걸음을 책임질 것입니다.</p>
                                <p>간편한 회원가입과 장바구니 기능을 통해 고객 여러분께서는 편리하고 신뢰할 수 있는 쇼핑 경험을 누리실 수 있습니다.</p>
                                <p style="margin-bottom: 5%;">Footprint 웹페이지는 대학교 과제로 개발되었지만, 앞으로도 지속적인 업데이트와 개선을 통해 고객 만족도를 높일 것입니다.</p>
                                <p>고객 여러분의 관심과 사랑을 기다리겠습니다.</p>
                            </div>
                        </div>
                        <div class="col-sm-5" style="padding: 0;">
                            <img src="images/introduction.jpg" style="border-radius: 2ch; width: 100%;"  >
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
</html>
