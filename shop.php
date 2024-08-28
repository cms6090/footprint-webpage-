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
                color: black;
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
            button:focus {
                border: none;
                outline: none;
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
        
        <?php
            $sql = "select * from product";
            # 쿼리를 MySQL에 전달해서 실행
            $result = $conn->query($sql);
        ?>

        <main>
            <div class="container">
                <div class="container-fluid mt-3">
                    <h1 class="text-center bold">SHOP</h1>
                    <div class="row">
                    <?php
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
        <?php $conn->close();?>
    </body>
</html>
