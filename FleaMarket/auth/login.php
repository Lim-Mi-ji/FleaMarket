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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // 사용자 인증
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            echo "<script>alert('로그인 성공!'); location.href='../main/mypage.php';</script>";
        } else {
            echo "<script>alert('비밀번호가 잘못되었습니다.'); history.back();</script>";
        }
    } else {
        echo "<script>alert('존재하지 않는 사용자입니다.'); history.back();</script>";
    }
}

$conn->close();
?>
