-- Fix image paths by adding proper file extensions
-- Run this SQL script in phpMyAdmin or MySQL command line

UPDATE `products` SET `image_path` = 'assets/images/dish/Dish-2.png' WHERE `id` = 1;
UPDATE `products` SET `image_path` = 'assets/images/dish/Dish-3.png' WHERE `id` = 2;
UPDATE `products` SET `image_path` = 'assets/images/dish/Dish-4.png' WHERE `id` = 3;
UPDATE `products` SET `image_path` = 'assets/images/dish/bev-1.png' WHERE `id` = 4;
UPDATE `products` SET `image_path` = 'assets/images/dish/bev-2.png' WHERE `id` = 5;
UPDATE `products` SET `image_path` = 'assets/images/dish/bev-3.png' WHERE `id` = 6;
UPDATE `products` SET `image_path` = 'assets/images/dish/4.png' WHERE `id` = 7;
UPDATE `products` SET `image_path` = 'assets/images/dish/Dish-5.png' WHERE `id` = 8;
UPDATE `products` SET `image_path` = 'assets/images/dish/spicy-noodles-black.png' WHERE `id` = 9;
UPDATE `products` SET `image_path` = 'assets/images/dish/spicy-noodles-black.png' WHERE `id` = 10;
UPDATE `products` SET `image_path` = 'assets/images/dish/Dish-5.png' WHERE `id` = 11;
UPDATE `products` SET `image_path` = 'assets/images/dish/4.png' WHERE `id` = 12;
-- ID 20 (Fish) already has the correct extension

-- Verify the changes
SELECT id, title, image_path FROM products ORDER BY id;
