CREATE DATABASE `ecoline`;

CREATE TABLE `Stocks` (
  `stock_id` INTEGER PRIMARY KEY,
  `stock_quantity` INTEGER,
  `stock_name` VARCHAR(255),
  `product_id` INTEGER
);

CREATE TABLE `Produits` (
  `product_id` INTEGER PRIMARY KEY,
  `supplier_id` INTEGER,
  `category_id` INTEGER,
  `product_unit` VARCHAR(50),
  `product_price` VARCHAR(50),
  `commandes_id` INTEGER
);

CREATE TABLE `Commandes` (
  `order_id` INTEGER PRIMARY KEY,
  `client_ad` INTEGER,
  `employe_ad` INTEGER,
  `order_date` INTEGER,
  `sender_id` INTEGER
);

CREATE TABLE `Fournisseurs` (
  `supplier_id` INTEGER PRIMARY KEY,
  `supplier_name` VARCHAR(255),
  `supplier_contact` VARCHAR(255),
  `supplier_address` VARCHAR(255),
  `supplier_city` VARCHAR(100),
  `supplier_postal` INTEGER,
  `supplier_phone` INTEGER
);

CREATE TABLE `Categories` (
  `category_id` INTEGER PRIMARY KEY,
  `category_name` VARCHAR(255),
  `category_description` VARCHAR(255)
);

CREATE TABLE `Expediteurs` (
  `expeditor_id` INTEGER PRIMARY KEY,
  `expeditor_name` VARCHAR(255),
  `expeditor_phone` INTEGER,
  `fournisseur_id` INTEGER,
  `commandes_id` INTEGER
);

CREATE TABLE `Prets` (
  `borrow_id` INTEGER PRIMARY KEY,
  `stock_id` INTEGER,
  `client_ad` INTEGER,
  `employe_ad` INTEGER,
  `borrow_date` INTEGER,
  `back_date` INTEGER,
  `state_back` VARCHAR(100)
);

CREATE TABLE `Entree` (
  `enter_id` INTEGER PRIMARY KEY,
  `enter_date` INTEGER,
  `stock_id` INTEGER
);

CREATE TABLE `Consommable` (
  `consumable_id` INTEGER PRIMARY KEY,
  `consumable_quantity` INTEGER,
  `stock_id` INTEGER
);

CREATE TABLE `Intermediaire` (
  `inter_id` INTEGER PRIMARY KEY,
  `pret_quantity` INTEGER,
  `stock_id` INTEGER,
  `retour_stock` VARCHAR(100)
);

ALTER TABLE `Stocks` ADD FOREIGN KEY (`product_id`) REFERENCES `Produits` (`product_id`);

ALTER TABLE `Produits` ADD FOREIGN KEY (`supplier_id`) REFERENCES `Fournisseurs` (`supplier_id`);

ALTER TABLE `Produits` ADD FOREIGN KEY (`category_id`) REFERENCES `Categories` (`category_id`);

ALTER TABLE `Produits` ADD FOREIGN KEY (`commandes_id`) REFERENCES `Commandes` (`order_id`);

ALTER TABLE `Commandes` ADD FOREIGN KEY (`sender_id`) REFERENCES `Expediteurs` (`expeditor_id`);

ALTER TABLE `Expediteurs` ADD FOREIGN KEY (`fournisseur_id`) REFERENCES `Fournisseurs` (`supplier_id`);

ALTER TABLE `Expediteurs` ADD FOREIGN KEY (`commandes_id`) REFERENCES `Commandes` (`order_id`);

ALTER TABLE `Prets` ADD FOREIGN KEY (`stock_id`) REFERENCES `Stocks` (`stock_id`);

ALTER TABLE `Entree` ADD FOREIGN KEY (`stock_id`) REFERENCES `Stocks` (`stock_id`);

ALTER TABLE `Consommable` ADD FOREIGN KEY (`stock_id`) REFERENCES `Stocks` (`stock_id`);

ALTER TABLE `Intermediaire` ADD FOREIGN KEY (`stock_id`) REFERENCES `Stocks` (`stock_id`);