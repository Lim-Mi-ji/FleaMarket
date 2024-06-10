<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>상품 정보</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>등록된 상품 정보</h1>
        <p><strong>상품 이미지:</strong></p>
        <img src="<?php echo htmlspecialchars($target_file); ?>" alt="상품 이미지" style="max-width: 1200px;">
        <p><strong>상품명:</strong> <?php echo htmlspecialchars($product_name); ?></p>
        <p><strong>가격:</strong> <?php echo htmlspecialchars($price); ?> 원</p>
        <p><strong>카테고리:</strong> <?php echo htmlspecialchars($category); ?></p>
        <p><strong>상품상태:</strong> <?php echo htmlspecialchars($condition); ?></p>
        <p><strong>상품설명:</strong> <?php echo nl2br(htmlspecialchars($description)); ?></p>
    </div>

    <a href="index.php" style="margin-right: 30px">목록으로</a>
    <a href="product_upload.html">상품 등록</a>
</body>
</html>
