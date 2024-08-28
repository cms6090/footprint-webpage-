<?php
    session_start();
    include_once("dbconn.php"); // dbconn.php 파일의 내용을 읽어옴, 중복 방지
    $isLogged = false;
    if(isset($_SESSION['uid'])) {// isset(): 괄호 안에 있는게 만들어져 있는지 확인
        $isLogged = true;   // 로그인된 것을 체크해 둠
        $uname = $_SESSION['uname'];
        $email = $_SESSION['uid'];
    }

    $product_name = mysqli_real_escape_string($conn, $_GET['name']);
    
    $sql = "select * from product where name = '$product_name'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row['name'];
        $product_images = $row['images'];
        $product_brand = $row['brand'];
        $product_text = $row['text'];
        $product_price = $row['price'];
    }
?>
<!DOCTYPE html>
<html>
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
                position: sticky;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 1;
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
                font-size: 300px;
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
                font-size: 20px;
                color: #6c757d;
            }
            .bold {
                font-weight: bold;
            }
            .nav-link {
                color: black;
                font-size: 20px;
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
                color: rgba(0, 0, 0, 0.9);
                font-weight: bold;
            }
            .login-container {
                margin-top: 80px;
                width: 20%;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
            }
            .login-detail {
                font-size: 13px;
                font-weight: bold;
                text-align: left;
            }
            .login-item {
                padding: 10px;
            }
            form input {
                border: none;
                min-width: 100%;
                border-bottom: 1px solid #e0e0e0;
                padding: 10px 0;
            }
            .signup-button {
                margin-top: 15px;
                border-radius: 1.2ch;
                color: gray;
            }
            .signup-button:hover {
                font-weight: bold;
            }
            .size-table-border {
                border: 1px solid rgba(217, 217, 217, 1);
                border-radius: 1ch;
                margin-top: 2%;
                text-align: center;
                margin-bottom: 5%;
            }
            .size-table {
                width: 90%;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                border-collapse: collapse;
            }
            .size-table tr {
                border-bottom: 1px solid rgba(217, 217, 217, 1);
            }
            .size-table th, td {
                padding: 10px;
            }
            .size-table td {
                font-weight: 500;
            }
            caption {
                color: black;
                font-size: 1.1em;
                caption-side: top;
            }
            .add-cart-button {
                margin-top: 2%;
                background-color: black;
                color: white;
                border-radius: 1ch;
            }
            .size-select {
                width: 100%;
                padding: 10px 0;
                color: gray;
                border: 1px solid #E4E4E4;
                font-size: large;
                border-radius: 1ch;
            }
            select option[value=""][disabled] {
                display: none;
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
            <div class="container product-detail">
                <div class="row">
                    <div class="col-sm-6" style="border-right: 1px solid rgba(217, 217, 217, 1); position: relative;">
                        <img src="<?=$product_images?>" style="position: sticky; top: 100px; width: 90%; margin-left: auto; margin-right: auto; background-color: rgba(235, 239, 242, 1); " />
                    </div>
                    <div class="col-sm-6 pl-5">                       
                        <h3 class="mb-4 bold"><?=$product_price?></h3>
                        <h5><?=$product_name?></h5>
                        <p style="color: gray;"><?=$product_text?></p>
                        <form action="addcartproc.php" method="post">
                            <input type="hidden" name="name" value="<?=$product_name?>">
                            <input type="hidden" name="brand" value="<?=$product_brand?>">
                            <input type="hidden" name="price" value="<?=$product_price?>">
                            <input type="hidden" name="text" value="<?=$product_text?>">
                            <input type="hidden" name="images" value="<?=$product_images?>">
                            <select name="size" class="size-select" required>
                                <option value="" disabled selected>Select..</option>
                                <option value="220">220</option>
                                <option value="230">230</option>
                                <option value="240">240</option>
                                <option value="250">250</option>
                                <option value="260">260</option>
                                <option value="270">270</option>
                                <option value="280">280</option>
                                <option value="290">290</option>
                            </select>
                            <input class="add-cart-button" type="submit" value="Add to cart" />
                        </form>
                        <div class="size-table-border">
                            <table class="size-table">
                                <caption class="bold">
                                    사이즈 정보
                                </caption>
                                <tr style="color: #828282">
                                    <th style="padding-top: 0">KR</th>
                                    <th style="padding-top: 0">US(M)</th>
                                    <th style="padding-top: 0">US(W)</th>
                                    <th style="padding-top: 0">UK</th>
                                    <th style="padding-top: 0">JP</th>
                                    <th style="padding-top: 0">EU</th>
                                </tr>
                                <tr>
                                    <td>230</td>
                                    <td>4</td>
                                    <td>5.5</td>
                                    <td>3.5</td>
                                    <td>23</td>
                                    <td>36</td>
                                </tr>
                                <tr>
                                    <td>240</td>
                                    <td>5.5</td>
                                    <td>7</td>
                                    <td>5</td>
                                    <td>24</td>
                                    <td>38</td>
                                </tr>
                                <tr>
                                    <td>250</td>
                                    <td>7</td>
                                    <td>8.5</td>
                                    <td>6</td>
                                    <td>25</td>
                                    <td>40</td>
                                </tr>
                                <tr>
                                    <td>260</td>
                                    <td>8</td>
                                    <td>9.5</td>
                                    <td>7</td>
                                    <td>26</td>
                                    <td>41</td>
                                </tr>
                                <tr>
                                    <td>270</td>
                                    <td>9</td>
                                    <td>10.5</td>
                                    <td>8</td>
                                    <td>27</td>
                                    <td>42.5</td>
                                </tr>
                                <tr>
                                    <td>280</td>
                                    <td>10</td>
                                    <td>11.5</td>
                                    <td>9</td>
                                    <td>28</td>
                                    <td>44</td>
                                </tr>
                                <tr style="border: none">
                                    <td>290</td>
                                    <td>11</td>
                                    <td>12.5</td>
                                    <td>10</td>
                                    <td>29</td>
                                    <td>45</td>
                                </tr>
                            </table>
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
