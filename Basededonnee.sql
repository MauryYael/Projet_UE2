CREATE TABLE restaurateur(
   id_restaurateur INT AUTO_INCREMENT,
   nom_utilisateur VARCHAR(50) NOT NULL,
   mail VARCHAR(50) NOT NULL,
   password VARCHAR(255) NOT NULL,
   PRIMARY KEY(id_restaurateur),
   UNIQUE(mail)
);

CREATE TABLE Articles(
   id_article INT AUTO_INCREMENT,
   nom_ingredient VARCHAR(50),
   type VARCHAR(50),
   stock_actuel DECIMAL(15,2),
   seuil_alerte DECIMAL(15,2),
   unite VARCHAR(50),
   id_restaurateur INT NOT NULL,
   PRIMARY KEY(id_article),
   FOREIGN KEY(id_restaurateur) REFERENCES restaurateur(id_restaurateur)
);

CREATE TABLE Plats(
   id_plat INT AUTO_INCREMENT,
   nom VARCHAR(50),
   prix_vente DECIMAL(10,2),
   description VARCHAR(200),
   id_restaurateur INT NOT NULL,
   PRIMARY KEY(id_plat),
   FOREIGN KEY(id_restaurateur) REFERENCES restaurateur(id_restaurateur)
);

CREATE TABLE commande(
   id_commande INT AUTO_INCREMENT,
   date_commande DATETIME NOT NULL,
   statut VARCHAR(50),
   id_restaurateur INT NOT NULL,
   PRIMARY KEY(id_commande),
   FOREIGN KEY(id_restaurateur) REFERENCES restaurateur(id_restaurateur)
);

CREATE TABLE Ligne_Commande(
   id_lignecommande INT AUTO_INCREMENT,
   quantité INT NOT NULL,
   id_commande INT NOT NULL,
   id_plat INT NOT NULL,
   PRIMARY KEY(id_lignecommande),
   FOREIGN KEY(id_commande) REFERENCES commande(id_commande),
   FOREIGN KEY(id_plat) REFERENCES Plats(id_plat)
);

CREATE TABLE composition(
   id_composition INT AUTO_INCREMENT,
   quantité DECIMAL(15,2),
   id_plat INT NOT NULL,
   id_article INT NOT NULL,
   PRIMARY KEY(id_composition),
   FOREIGN KEY(id_plat) REFERENCES Plats(id_plat),
   FOREIGN KEY(id_article) REFERENCES Articles(id_article)
);