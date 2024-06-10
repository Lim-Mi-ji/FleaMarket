CREATE DATABASE IF NOT EXISTS FleaMarket;
USE FleaMarket;

CREATE TABLE IF NOT EXISTS Products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_image VARCHAR(255) NOT NULL,
    product_name VARCHAR(40) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    category ENUM('여성의류', '남성의류', '신발', '전자기기', '예술품', '미용용품', '식품', '기타') NOT NULL,
    `condition` ENUM('새 상품', '사용감 없음', '사용감 적음', '사용감 많음', '파손 상품') NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 예시로 상품 데이터를 삽입하는 쿼리 (테스트용)
INSERT INTO Products (product_image, product_name, price, category, `condition`, description)
VALUES ('image1.png', '여성 원피스', 50000, '여성의류', '새 상품', '한 번도 입지 않은 새 원피스입니다.'),
       ('image2.png', '남성 구두', 75000, '남성의류', '사용감 적음', '몇 번 신지 않은 상태 좋은 구두입니다.');
