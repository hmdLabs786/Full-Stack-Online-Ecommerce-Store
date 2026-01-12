-- Database setup for product rating system

-- 1. Create product_ratings table
CREATE TABLE IF NOT EXISTS `product_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `rating` int(1) NOT NULL CHECK (rating >= 1 AND rating <= 5),
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_product_rating` (`product_id`, `user_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  KEY `rating` (`rating`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Add rating columns to products table (if they don't exist)
ALTER TABLE `products` 
ADD COLUMN IF NOT EXISTS `avg_rating` DECIMAL(3,2) DEFAULT 0.00,
ADD COLUMN IF NOT EXISTS `total_ratings` INT DEFAULT 0;

-- 3. Create index for better performance
CREATE INDEX IF NOT EXISTS `idx_product_ratings_product_id` ON `product_ratings` (`product_id`);
CREATE INDEX IF NOT EXISTS `idx_product_ratings_user_id` ON `product_ratings` (`user_id`);

-- 4. Sample data (optional - for testing)
-- INSERT INTO `product_ratings` (`product_id`, `user_id`, `rating`) VALUES 
-- (1, 'guest_123', 5),
-- (1, 'guest_456', 4),
-- (2, 'guest_789', 3);

-- 5. Update existing products with default values
UPDATE `products` SET `avg_rating` = 0.00, `total_ratings` = 0 WHERE `avg_rating` IS NULL OR `total_ratings` IS NULL;
