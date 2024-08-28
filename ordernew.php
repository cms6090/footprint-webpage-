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
            .content-product {
                text-align: left;
                background-color: white;
                padding: 2%;    
            }
            .profile-item {
                padding: 2%;
            }
            .profile-detail {
                font-size: 0.9em;
                font-weight: bold;
                text-align: left;
            }
            .content-other {
                text-align: left;
                background-color: white;
                padding: 2%;    
            }
            form input {
                border: none;
                min-width: 100%;
                border-bottom: 1px solid #e0e0e0;
                padding: 10px 0;
            }
            .content-fee {
                text-align: left;
                background-color: white;
                padding: 2%;    
            }
            .purchase-button {
                background-color: rgb(239, 98, 83);
                font-size: 1.1em;
                color: white;
                font-weight: bold;
                padding: 1% 0;
                width: 100%;
                border: none;
                border-radius: 1ch;
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
            $name = mysqli_real_escape_string($conn, $_GET['name']);
            $size = $_GET['size'];
            $sql = "select * from product where name = '$name'";
            # 쿼리를 MySQL에 전달해서 실행
            $result = $conn->query($sql);

            if($result->num_rows > 0) { // 검색된 레코드가 있으면
                while($row = $result->fetch_assoc()) { // 레코드 하나를 건네준다.
                    $name = $row['name'];
                    $text = $row['text'];
                    $image = $row['images'];
                    $price = $row['price'];
                    $brand = $row['brand'];
                }
            }
        ?>
        <main>
            <div class="container">
                <div class="container-fluid">
                    <h4 class="text-center bold" style="margin-bottom: 2%;"><?php echo $name;?></h4>
                </div>
            </div>
            <div style="background-color: #F2F2F2; ">
                <div class="container" style="padding-top: 2%;">
                    <div class="content-product row">
                        <div class="col-sm-2"><img src="<?=$image?>" style="width: 100%; height: 100%; border-radius: 1ch; background-color: rgba(235, 239, 242, 1);"></div>
                        <div class="col-sm-10">
                            <h5 class="title"><?=$brand?></h5>
                            <p class="name" style="margin-bottom: 0;"><?=$name?></p>
                            <p style="font-size: 0.9em; color:gray;"><?=$text?></p>
                            <p class="size mt-3 bold"><?=$size?></p>
                        </div>
                    </div>
                    <div class="content-fee" style="margin-top: 5%;">
                        <form action="ordernewproc.php" method="get" style="padding: 2%;" class="row" id="purchase">
                            <div class="profile-item col-sm-6">
                                <div style="font-size:1.2em; font-weight: bold;">배송 주소</div>
                                <div class="profile-detail" style="margin-top: 2%;">
                                    <div class="row">
                                        <div class="col-sm-4" style="margin-top: auto; margin-bottom: auto; width: 100%; font-weight: 500;">받는분</div>
                                        <div class="col-sm-8">
                                            <div style="border: none; min-width: 100%; border-bottom: 1px solid #e0e0e0; padding: 10px 0;"><?=$email?></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4" style="margin-top: auto; margin-bottom: auto; width: 100%; font-weight: 500;">배송비</div>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="brand" value="<?=$brand?>">
                                            <input type="hidden" name="email" value="<?=$email?>">
                                            <input type="hidden" name="delivery" value="3000원">
                                            <input type="hidden" name="image" value="<?=$image?>">
                                            <input type="hidden" name="name" value="<?=$name?>">
                                            <input type="hidden" name="size" value="<?=$size?>">
                                            <input type="hidden" name="price" value="<?=$price?>">
                                            <?php
                                                $real_price = intval(preg_replace('/[^0-9]/', '', $price));
                                                $total = $real_price+3000;
                                                $price_str = number_format($total) . '원';
                                            ?>
                                            <div style="border: none; min-width: 100%; border-bottom: 1px solid #e0e0e0; padding: 10px 0;">3,000원</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4" style="margin-top: auto; margin-bottom: auto; width: 100%; font-weight: 500;">배송지</div>
                                        <div class="col-sm-8">
                                            <input type="text" name="address" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-item col-sm-6" style="padding: 2%; text-align: right;">
                                <div style="font-size:1.2em; font-weight: bold;">총 금액</div>
                                <div class="profile-detail" style="margin-top: 2%;">
                                    <div class="row">
                                        <div class="col-sm-8" style="margin-top: auto; margin-bottom: auto; width: 100%; text-align: right;">상품 금액</div>
                                        <div class="col-sm-4">
                                            <!--<input type="text" style="width: 100%;" name="price" value="<?=$price?>" readonly />-->
                                            <div style="border: none; min-width: 100%; border-bottom: 1px solid #e0e0e0; padding: 10px 0;"><?=$price?></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8" style="margin-top: auto; margin-bottom: auto; width: 100%; text-align: right;">배송비</div>
                                        <div class="col-sm-4">
                                            <!--<input type="text" style="width: 100%;" value="3000원" readonly />-->
                                            <div style="border: none; min-width: 100%; border-bottom: 1px solid #e0e0e0; padding: 10px 0;">3,000원</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8" style="margin-top: auto; margin-bottom: auto; width: 100%; text-align: right;">합계</div>
                                        <div class="col-sm-4">
                                            <input type="hidden"name="total" value="<?=$price_str?>">
                                            <div style="border: none; min-width: 100%; border-bottom: 1px solid #e0e0e0; padding: 10px 0;"><?=$price_str?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input class="purchase-button" type="submit" value="결제">
                        </form>
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
