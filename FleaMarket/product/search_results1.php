<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>쇼핑몰</title>
    <link rel="stylesheet" href="indexstyle.css">
</head>

<body>
    <header>
        <form action="../main/search_results.php" method="GET" class="search-form">
            <input type="text" id="search-bar" name="query" placeholder="상품명을 입력하세요" required>
            <button type="submit" class="search-button">🔍</button>
        </form>
        <a href="../main/mypage.php">마이페이지</a>
    </header>
    <aside>
        <h2>카테고리</h2>
        <ul>
            <li>여성 의류</li>
            <li>남성 의류</li>
            <li>신발</li>
            <li>디지털</li>
            <li>예술/수집품</li>
            <li>뷰티/미용</li>
            <li>식품</li>
        </ul>
    </aside>
    <main>
        <section class="promo-banner">
            <h2>특가 상품</h2>
        </section>
        <section class="product-grid">
            <?php
            // 데이터베이스 연결
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "FleaMarket";

            // 연결 생성
            $conn = new mysqli($servername, $username, $password, $dbname);

            // 연결 확인
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // 사용자가 입력한 검색어
            $search_query = $_GET['query'];

            // 상품 데이터 가져오기
            $sql = "SELECT product_image, product_name, price FROM Products WHERE (product_name LIKE '%$search_query%') OR (category LIKE '%$search_query%')";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // 출력 데이터
                while ($row = $result->fetch_assoc()) {
                    echo '<article class="product-item">';
                    echo '<img src="' . $row["product_image"] . '" alt="' . $row["product_name"] . '">';
                    echo '<h3>' . $row["product_name"] . '</h3>';
                    echo '<p>₩' . number_format($row["price"]) . '</p>';
                    echo '</article>';
                }
            } else {
                echo "검색 결과가 없습니다.";
            }
            $conn->close();
            ?>
        </section>
    </main>
</body>

</html>