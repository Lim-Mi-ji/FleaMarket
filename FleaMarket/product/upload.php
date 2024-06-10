<?php
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

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $price = $conn->real_escape_string($_POST['price']);
    $category = $conn->real_escape_string($_POST['category']);
    $condition = $conn->real_escape_string($_POST['condition']);
    $description = $conn->real_escape_string($_POST['description']);

    // 파일 업로드 처리
    $uploadDir = 'uploads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $target_file = $uploadDir . basename($_FILES["product_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // 파일이 이미지인지 확인
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }

    // 파일이 이미 존재하는지 확인
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // 파일 크기 제한 (예: 5MB 이하)
    if ($_FILES["product_image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // 허용되는 파일 형식 확인
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // 오류가 없는 경우 파일 업로드
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    } else {
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO Products (product_image, product_name, price, category, `condition`, description)
            VALUES ('$target_file', '$product_name', '$price', '$category', '$condition', '$description')";

            if ($conn->query($sql) === TRUE) {
                echo "The file ". htmlspecialchars(basename($_FILES["product_image"]["name"])) . " has been uploaded.<br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
            }
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }

    include 'template.php';
}

$conn->close();
?>
