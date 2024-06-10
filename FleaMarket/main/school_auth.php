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
    $domain = substr(strrchr($email, "@"), 1);

    $sql = "SELECT school_name FROM university_info WHERE email_domain = '$domain'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $school_name = $row['school_name'];

        $userEmail = $_SESSION['email']; // 로그인된 사용자의 이메일
        $updateSql = "UPDATE users SET verified = TRUE, university = '$school_name' WHERE email = '$userEmail'";

        if ($conn->query($updateSql) === TRUE) {
            echo "<script>alert('$school_name 학생으로 인증되었습니다.'); window.close();</script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "<script>alert('일치하는 대학교가 없습니다.'); window.close();</script>";
    }
}

$conn->close();
?>
