<?php
// PHP 에러 디버깅 설정 활성화
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 데이터베이스 연결 정보
$server = "localhost";
$username = "root";
$password = "";
$dbname = "fleamarket";

// 데이터베이스 연결 생성
$conn = new mysqli($server, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 폼이 제출되었는지 확인
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 입력된 데이터 받기
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // 비밀번호 해시화
    $gender = $_POST['gender'];

    // SQL 쿼리 준비 및 실행
    $sql = "INSERT INTO users (email, name, password, gender)
            VALUES ('$email', '$name', '$password', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('회원가입이 완료되었습니다.'); window.location.href='login.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="html_font.css" />
    <link rel="stylesheet" href="login_style.css" />
    <link rel="stylesheet" href="sign_up.css" />
    <title>회원가입</title>
</head>

<body>
    <div class="signup">
        <h1 class="signup-title">회원가입</h1>
        <form method="POST">
            <label>이메일</label>
            <input id="email" name="email" type="email" placeholder="이메일을 입력해주세요." required />
            <label>이름</label>
            <input id="name" name="name" type="text" placeholder="이름을 입력해주세요. (3~8자리)" required />
            <label>비밀번호</label>
            <input id="pw" name="password" type="password" placeholder="비밀번호를 입력해주세요. (영문·숫자·특수문자 포함 4~20자리)" required />
            <label>성별</label>
            <div class="gender" style="height: 60px;">
                <ul class="gender_list" id="listIdentifyGender">
                    <li>
                        <input type="radio" name="gender" id="female" value="female">
                        <label for="female">여성</label>
                    </li>
                    <li>
                        <input type="radio" name="gender" id="male" value="male">
                        <label for="male">남성</label>
                    </li>
                </ul>
            </div>
            <button type="submit">가입하기</button>
        </form>
    </div>
</body>

</html>