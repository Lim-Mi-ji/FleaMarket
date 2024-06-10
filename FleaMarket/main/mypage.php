<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fleamarket";

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userEmail = $_SESSION['email']; // 로그인된 사용자의 이메일

// SQL 쿼리를 실행
$sql = "SELECT name, verified, university FROM users WHERE email = '$userEmail'";
$result = $conn->query($sql);

// 쿼리 실행 결과 검사
if ($result) {
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $username = $row['name'];
        $verified = $row['verified'];
        $school_name = $row['university'];
    } else {
        echo "사용자 정보를 찾을 수 없습니다.";
        exit();
    }
} else {
    // SQL 쿼리 실행 오류 처리
    echo "쿼리 실행 오류: " . $conn->error;
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>마이페이지</title>
    <link rel="stylesheet" href="html_font.css" />
    <link rel="stylesheet" href="mystyle.css">
    <script>
        function openSchoolAuthPopup() {
            var popup = window.open("school_auth.html", "학교 인증", "width=600,height=400");
        }
    </script>
</head>

<body>
    <header>
        <nav>
            <a href="../product/product_upload.html">새 상품 등록</a>
            <a href="#">판매 상품 관리</a>
            <a href="#">거래 내역 관리</a>
            <a href="#">거래 메시지</a>
        </nav>
    </header>
    <main>
        <div class="profile">
            <img src="profile.png" alt="프로필 이미지" class="profile-img">
            <div class="profile-info">
                <div>
                    <div style="display: flex; margin-bottom: 20px;">
                        <h2 style="margin-right: 50px;"><?php echo htmlspecialchars($username); ?></h2>
                    </div>
                    <span>자기소개 내용 및 판매 상품 관리, 거래 내역 등 정보란</span><br><br>
                    <span>
                        <?php
                        if ($verified) {
                            echo "<p>{$username} 님은 {$school_name} 학생입니다.</p>";
                        } else {
                            echo "<p>현재 학교 인증이 이루어지지 않았습니다.</p>";
                            echo "<button onclick=\"openSchoolAuthPopup()\">학교 인증</button>";
                        }
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
