ALTER TABLE `lc_products_options_values`
DROP INDEX `product_option_value`,
ADD UNIQUE INDEX `product_option_value` (`product_id`, `group_id`, `value_id`, `custom_value`);
-- --------------------------------------------------------
ALTER TABLE `lc_attribute_groups`
ADD COLUMN `sort` ENUM('alphabetical','priority') NOT NULL DEFAULT 'alphabetical' AFTER `code`;
-- --------------------------------------------------------
UPDATE `lc_settings` SET `function` = 'zone("store_country_code")' WHERE `key` = 'store_zone_code';
-- --------------------------------------------------------
UPDATE `lc_settings` SET `function` = 'zone("store_country_code")' WHERE `key` = 'default_zone_code';
