CREATE DATABASE `ecoline`;

ALTER DATABASE `ecoline` CHARSET=utf8;

-- Création de la table `Produits`
CREATE TABLE `Produits` (
  `product_id` INTEGER PRIMARY KEY,
  `supplier_id` INTEGER,
  `category_id` INTEGER,
  `product_unit` VARCHAR(50),
  `product_price` VARCHAR(50)
);

-- Création de la table `Stocks` après avoir vérifié que `Produits` existe
CREATE TABLE `Stocks` (
  `stock_id` INTEGER PRIMARY KEY,
  `stock_quantity` INTEGER,
  `stock_name` VARCHAR(255),
  `product_id` INTEGER,
  `date_ajout` DATE,
  FOREIGN KEY (`product_id`) REFERENCES `Produits` (`product_id`)
);

-- Création de la table `Fournisseurs`
CREATE TABLE `Fournisseurs` (
  `supplier_id` INTEGER PRIMARY KEY,
  `supplier_name` VARCHAR(255),
  `supplier_contact` VARCHAR(255),
  `supplier_address` VARCHAR(255),
  `supplier_city` VARCHAR(100),
  `supplier_postal` VARCHAR(10),
  `supplier_phone` VARCHAR(15)
);

-- Création de la table `Categories`
CREATE TABLE `Categories` (
  `category_id` INTEGER PRIMARY KEY,
  `category_name` VARCHAR(255),
  `category_description` VARCHAR(255)
);

-- Assurez-vous que la table `Produits` a déjà été créée
ALTER TABLE `Produits` ADD FOREIGN KEY (`supplier_id`) REFERENCES `Fournisseurs` (`supplier_id`);
ALTER TABLE `Produits` ADD FOREIGN KEY (`category_id`) REFERENCES `Categories` (`category_id`);

-- Création de la table `Expediteurs`
CREATE TABLE `Expediteurs` (
  `expeditor_id` INTEGER PRIMARY KEY,
  `expeditor_name` VARCHAR(255),
  `expeditor_phone` VARCHAR(15),
  `fournisseur_id` INTEGER,
  FOREIGN KEY (`fournisseur_id`) REFERENCES `Fournisseurs` (`supplier_id`)
);

-- Création de la table `Commandes`
CREATE TABLE `Commandes` (
  `order_id` INTEGER PRIMARY KEY,
  `client_ad` INTEGER,
  `employe_ad` INTEGER,
  `order_date` DATE,
  `sender_id` INTEGER,
  FOREIGN KEY (`sender_id`) REFERENCES `Expediteurs` (`expeditor_id`)
);

-- Assurez-vous que la table `Stocks` a déjà été créée
CREATE TABLE `Prets` (
  `borrow_id` INTEGER PRIMARY KEY,
  `stock_id` INTEGER,
  `client_ad` INTEGER,
  `employe_ad` INTEGER,
  `borrow_date` DATE,
  `back_date` DATE,
  `state_back` VARCHAR(100),
  FOREIGN KEY (`stock_id`) REFERENCES `Stocks` (`stock_id`)
);

CREATE TABLE `Entree` (
  `enter_id` INTEGER PRIMARY KEY,
  `enter_date` DATE,
  `stock_id` INTEGER,
  FOREIGN KEY (`stock_id`) REFERENCES `Stocks` (`stock_id`)
);

CREATE TABLE `Consommable` (
  `consumable_id` INTEGER PRIMARY KEY,
  `consumable_quantity` INTEGER,
  `stock_id` INTEGER,
  FOREIGN KEY (`stock_id`) REFERENCES `Stocks` (`stock_id`)
);

CREATE TABLE `Intermediaire` (
  `inter_id` INTEGER PRIMARY KEY,
  `pret_quantity` INTEGER,
  `stock_id` INTEGER,
  `retour_stock` VARCHAR(100),
  FOREIGN KEY (`stock_id`) REFERENCES `Stocks` (`stock_id`)
);

CREATE TABLE Reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    client_name VARCHAR(255),
    start_date DATE,
    end_date DATE,
    date_reserved TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES Produits(product_id)
);

CREATE TABLE Utilisateurs (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    noms VARCHAR(255) NOT NULL,
    mdp TEXT NOT NULL,
    roles INT NOT NULL
);


INSERT INTO `Fournisseurs` (supplier_id, supplier_name, supplier_contact, supplier_address, supplier_city, supplier_postal, supplier_phone)
VALUES
(1, 'Alpha Fournitures', 'John Doe', '123 Rue de l’Industrie', 'Paris', '75001', '0123456789'),
(2, 'Beta Équipement', 'Jane Smith', '456 Avenue du Commerce', 'Lyon', '69000', '0234567890'),
(3, 'Gamma Technologies', 'Jim Beam', '789 Boulevard Tech', 'Marseille', '13000', '0345678901');

INSERT INTO `Categories` (category_id, category_name, category_description)
VALUES
(1, 'Papeterie', 'Articles de bureau et fournitures scolaires'),
(2, 'Électronique', 'Matériel électronique pour l’éducation'),
(3, 'Sport', 'Équipements et vêtements sportifs');

INSERT INTO `Produits` (product_id, supplier_id, category_id, product_unit, product_price)
VALUES
(1, 1, 1, 'Pack de 10', '20€'),
(2, 1, 1, 'Pack de 50', '75€'),
(3, 2, 2, 'Unité', '300€');

INSERT INTO `Expediteurs` (expeditor_id, expeditor_name, expeditor_phone, fournisseur_id)
VALUES
(1, 'RapidEx', '0987654321', 1),
(2, 'SendFast', '0987654322', 2);

INSERT INTO `Commandes` (order_id, client_ad, employe_ad, order_date, sender_id)
VALUES
(1, 10, 100, '2023-09-01', 1),
(2, 11, 101, '2023-09-02', 2);

INSERT INTO `Stocks` (stock_id, stock_quantity, stock_name, product_id)
VALUES
(1, 100, 'Stylos bleus', '2023-09-01', 1),
(2, 200, 'Cahiers A4', '2023-09-01', 2),
(3, 150, 'Tablettes éducatives', '2023-09-01', 3);

-- Prêts
INSERT INTO `Prets` (borrow_id, stock_id, client_ad, employe_ad, borrow_date, back_date, state_back)
VALUES
(1, 1, 10, 100, '2023-09-05', '2023-12-05', 'Returned');

-- Entree
INSERT INTO `Entree` (enter_id, enter_date, stock_id)
VALUES
(1, '2023-09-01', 1);

-- Consommable
INSERT INTO `Consommable` (consumable_id, consumable_quantity, stock_id)
VALUES
(1, 50, 1);

-- Intermediaire
INSERT INTO `Intermediaire` (inter_id, pret_quantity, stock_id, retour_stock)
VALUES
(1, 5, 1, 'OK');

INSERT INTO `utilisateur` (`user_id`, `first_name`, `last_name`, `username`, `account_type`, `email`, `phone`, `password`) VALUES
(1, 'Jean', 'Michel', 'michmich', 'pare', 'michel@gmail.com', '0641121213', 'azerty'),
(2, 'Jean', 'Michel', 'michmich', 'pare', 'michel@gmail.com', '0641121213', 'azerty'),
(3, 'Jean', 'Michel', 'michmich', 'pare', 'michel@gmail.com', '0641121213', 'azerty'),
(5, 'test', 'sans id pour voir', 'test.user', 'pare', 'hello@outlook.com', '0906050441', 'iyugzsredfiuhfzeouhiuhiozfeuhiozfe'),
(6, 'test', 'javascript', 'timetorefresh', 'enseignant', 'java@gmail.com', '0102030405', 'pîohjrfgvea zpiojn,zerfg,opzerf,pôzef'),
(7, 'test', 'javascript', 'timetorefresh', 'enseignant', 'java@gmail.com', '0102030405', 'pîohjrfgvea zpiojn,zerfg,opzerf,pôzef'),
(8, 'test', 'javascript', 'timetorefresh', 'enseignant', 'java@gmail.com', '0102030405', 'pîohjrfgvea zpiojn,zerfg,opzerf,pôzef'),
(9, 'test', 'javascript', 'timetorefresh', 'enseignant', 'java@gmail.com', '0102030405', 'pîohjrfgvea zpiojn,zerfg,opzerf,pôzef'),
(10, 'test', 'javascript', 'timetorefresh', 'enseignant', 'java@gmail.com', '0102030405', 'pîohjrfgvea zpiojn,zerfg,opzerf,pôzef');

