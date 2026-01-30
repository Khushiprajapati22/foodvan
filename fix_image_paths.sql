-- SQL script to fix image paths by adding .png extension
-- Run this in phpMyAdmin or MySQL command line

UPDATE products SET image_path = CONCAT(image_path, '.png') 
WHERE image_path NOT LIKE '%.png' 
AND image_path NOT LIKE '%.jpg' 
AND image_path NOT LIKE '%.jpeg' 
AND image_path NOT LIKE '%.gif';

-- Verify the changes
SELECT id, title, image_path FROM products;
