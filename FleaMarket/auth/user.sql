CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `email` varchar(100) NOT NULL,
 `name` varchar(100) NOT NULL,
 `password` varchar(255) NOT NULL,
 `gender` enum('Female','Male') NOT NULL,
 'verified' BOOLEAN DEFAULT FALSE;
 'university' VARCHAR(255);
 PRIMARY KEY (`id`),
 UNIQUE KEY `username` (`username`),
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_c