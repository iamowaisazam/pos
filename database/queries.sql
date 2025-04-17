ALTER TABLE `product_categories` ADD `is_featured` INT NULL DEFAULT '0' AFTER `is_enable`;





INSERT INTO `settings` (`id`, `field`, `value`, `type`, `sort`, `grouping`) 
VALUES (NULL, 'site_currency', 'Erha Wear', 'text', '5', 'site_settings');

ALTER TABLE `menu_items` ADD CONSTRAINT `menu_parent_id_relation` 
FOREIGN KEY (`menu_id`) REFERENCES `menus`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `menus` ADD `slug` VARCHAR(255) NULL DEFAULT NULL AFTER `title`;

INSERT INTO `settings` (`id`, `field`, `value`, `type`, `sort`, `grouping`) 
VALUES (NULL, 'topbar_title', 'Welcome To Irha wears', 'text', '1', 'site_settings');

INSERT INTO `settings` (`id`, `field`, `value`, `type`, `sort`, `grouping`) 
VALUES (NULL, 'site_short_details', 'Irha Wears', 'text', '1', 'site_settings');


INSERT INTO `settings` (`id`, `field`, `value`, `type`, `sort`, `grouping`) 
VALUES (NULL, 'home_page_banner', '', 'image', '1', 'site_settings');


ALTER TABLE `filemanager` ADD `grouping` TEXT NOT NULL DEFAULT 'others' AFTER `updated_at`;
ALTER TABLE `settings` ADD `section_sorting` INT NULL DEFAULT '0';
ALTER TABLE `settings` ADD `section` text NULL DEFAULT 'others';

------------------------
ALTER TABLE `settings` ADD `group_sorting` INT NOT NULL DEFAULT '0' AFTER `section_sorting`;

INSERT INTO `settings` (`id`, `field`, `value`, `type`, `sort`, `grouping`, `section`, `section_sorting`, `group_sorting`) VALUES (NULL, 'cash_on_delivery_message', '21', 'textarea', '1', 'payment_method', 'payment_method', '1', '0');

INSERT INTO `settings` (`id`, `field`, `value`, `type`, `sort`, `grouping`, `section`, `section_sorting`, `group_sorting`) VALUES (NULL, 'bank_transfer_message', '21', 'textarea', '1', 'payment_method', 'payment_method', '1', '0');

ALTER TABLE users ADD profile_image text NULL;
ALTER TABLE users ADD email_token text NULL;

INSERT INTO `settings` (`id`, `field`, `value`, `type`, `sort`, `grouping`, `section_sorting`, `group_sorting`, `section`) VALUES (NULL, 'delivery_charges', '100', 'text', '5', 'shop_settings', '0', '0', 'shop');



INSERT INTO `settings` (`id`, `field`, `value`, `type`, `sort`, `grouping`, `section_sorting`, `group_sorting`, `section`) 
VALUES (NULL, 'delivery_charges', '100', 'text', '5', 'shop_settings', '0', '0', 'shop');
ALTER TABLE `orders` ADD `delivery_charges` DOUBLE NULL DEFAULT '0' AFTER `subtotal`;
ALTER TABLE `orders` ADD `customer_notes` text NULL ;