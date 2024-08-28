<h1>footprint 웹페이지(신발 판매 웹사이트)</h1>

필요 프로그램 : sqlyog, xampp

<ol>
  <li>sqlyog, xampp 설치</li>
  <li>xampp control panel을 실행시켜 Apache, MySQL을 Start</li>
  <li>
    sqlyog를 실행, query 창에
    
      create database footprint;<br>
      use footprint; 
    
    입력 후 실행
  </li>
  <li>
    <div>
      <p>카트 테이블 생성(장바구니 데이터)</p>
      <div>
        DROP TABLE IF EXISTS `cart`;<br>
    
        CREATE TABLE `cart` (
          `email` varchar(30) NOT NULL,
          `name` varchar(50) NOT NULL,
          `brand` varchar(20) NOT NULL,
          `price` varchar(10) NOT NULL,
          `size` int(3) NOT NULL,
          `images` varchar(20) NOT NULL,
          `text` varchar(50) NOT NULL,
          PRIMARY KEY (`email`,`name`,`size`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
      </div>
    </div>
  </li>
  <li>
    <div>
      <p>멤버 테이블 생성(회원 데이터)</p>
      
      <div>
        DROP TABLE IF EXISTS `member`;<br>
    
        CREATE TABLE `member` (
          `email` varchar(30) NOT NULL,
          `name` varchar(5) NOT NULL,
          `pwd` varchar(20) NOT NULL,
          `telno` varchar(13) NOT NULL,
          `regdate` date NOT NULL,
          PRIMARY KEY (`email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;<br>
      </div>
    </div>
  </li>
  <li>
    <div>
      <p>주문 테이블 생성(주문 데이터)</p>
      
      <div>
        DROP TABLE IF EXISTS `orders`;<br>
    
        CREATE TABLE `orders` (
          `ordno` varchar(10) NOT NULL,
          `email` varchar(30) NOT NULL,
          `orddate` date NOT NULL,
          `address` varchar(50) NOT NULL,
          `name` varchar(50) NOT NULL,
          `size` int(3) NOT NULL,
          `price` varchar(10) NOT NULL,
          `delivery` varchar(10) NOT NULL,
          `total` varchar(10) NOT NULL,
          `image` varchar(20) NOT NULL,
          `brand` varchar(20) NOT NULL,
          PRIMARY KEY (`ordno`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
      </div>
    </div>
  </li>
  <li>
    <div>
      <p>제품 테이블 생성(제품 데이터)</p>
      
      <div>
        DROP TABLE IF EXISTS `product`;<br>
  
        CREATE TABLE `product` (
          `name` varchar(50) NOT NULL,
          `brand` varchar(20) NOT NULL,
          `text` varchar(50) NOT NULL,
          `price` varchar(10) NOT NULL,
          `images` varchar(20) NOT NULL,
          `purcnt` int(5) DEFAULT NULL,
          PRIMARY KEY (`name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
      </div>
    </div>
</li>
<li>
  <div>
      <p>제품 데이터 입력</p>
    
      <div>
        insert  into `product`(`name`,`brand`,`text`,`price`,`images`,`purcnt`) values 
        ('(W) Jordan 1 x Travis Scott Retro Low OG SP Canary','Jordan','(W) 조던 1 x 트래비스 스캇 레트로 로우 OG SP 카나리','380,000원','images/top1.jpg',0),
        ('Asics Gel-Kayano 14 Cream Black','Asics','아식스 젤 카야노 14 크림 블랙','265,000원','images/top9.jpg',1),
        ('Asics Unlimited Gel-Kayano 14 Carrier Grey Black','Asics','아식스 언리미티드 젤 카야노 14 캐리어 그레이 블랙','218,000원','images/top7.jpg',0),
        ('Birkenstock Boston Soft Footbed Taupe - Regular','Birkenstock','버켄스탁 보스턴 소프트 풋베드 토프 - 레귤러','243,000원','images/top5.jpg',0),
        ('New Balance 1906R Harbor Grey Silver Metalic','New Balance','뉴발란스 1906R 하버 그레이 실버 메탈릭','184,000원','images/top6.jpg',1),
        ('New Balance 530 Steel Grey','New Balance','뉴발란스 530 스틸 그레이','116,000원','images/top8.jpg',0),
        ('New Balance 530 White Silver','New Balance','뉴발란스 530 화이트 실버','109,000원','images/top12.jpg',0),
        ('Nike Air Force 1 07 Low White','Nike','나이키 에어포스 1 07 로우 화이트','115,000원','images/top4.jpg',4),
        ('Nike Air Force 1 07 WB Flax','Nike','나이키 에어포스 1 07 WB 플랙스','145,000원','images/top2.jpg',6),
        ('Nike V2K Run Pure Platinum Wolf Grey','Nike','나이키 V2K 런 퓨어 플래티넘 울프 그레이','116,000원','images/top3.jpg',3),
        ('Nike V2K Run Summit White Metallic Silver','Nike','나이키 V2K 런 서밋 화이트 메탈릭 실버','96,000원','images/top10.jpg',0),
        ('Nike x Bode Astrograbber SP Black and Coconut Milk','Nike','나이키 x 보디 아스트로그래버 SP 블랙 앤 코코넛 밀크','649,000원','images/top11.jpg',0);
      </div>
    </div>
  </li>
</ol>
