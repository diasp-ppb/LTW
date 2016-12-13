/* User insert */

INSERT INTO Users (usr,pass,email) VALUES ('Abel','Andorinhas','FFFF@lalala.com');
INSERT INTO Users (usr,pass,email) VALUES ('Mario','Andorinhas1','FrFF@lalala.com');
INSERT INTO Users (usr,pass,email) VALUES ('Justo','Andorinhas2','FrFDF@lalala.com');

INSERT INTO Restaurants (name, address, type, city, district, country,description, avgClass) VALUES('Hard Rock Cafe', 'Rua Doutor Artur Magalhães Basto 38', 'Americano', 'Porto', 'Porto', 'Portugal','Rede de restaurantes com tema rock’n’roll e ambiente vibrante que serve hambúrgueres e clássicos americanos.', 4.9);
INSERT INTO Restaurants (name, address, type, city, district, country,description, avgClass) VALUES('Hamburgueria DeGema', ' Rua do Almada 253', 'Portugues', 'Porto', 'Porto', 'Portugal','A DeGema, fundada em 2013, está agora preparada para crescer em regime de franchising. Nas suas unidades próprias, a marca testou devidamente um bom negócio para todos os envolvidos. Um negócio diferenciado, único, inovador, comprovado pela experiência e sucesso das unidades já em funcionamento.
O franchisado tem a possibilidade de abrir na sua zona territorial um negócio testado de hamburgueria artesanal, beneficiando de um formato empresarial completo.', 4.7);
INSERT INTO Restaurants (name, address, type, city, district, country,description, avgClass) VALUES('33 Alameda', 'Alameda de Basílio Teles 29 ', 'Portugues', 'Porto', 'Porto', 'Portugal',NULL, 4.8);
INSERT INTO Restaurants (name, address, type, city, district, country,description, avgClass) VALUES('Da Mattia Pizzeria Italiana', 'Rua do Monte Alegre 113', 'Italiana', 'Porto', 'Porto', 'Portugal','Na emblemática cidade Invicta, encontra a Da Mattia Pizzeria Italiana, que abriu portas em Março de 2016.
Com um interior acolhedor e onde a simplicidade marca presença, este é o sítio indicado para quem pretende desfrutar dos grandes sabores italianos em ambiente descontraído.', 4.8);




INSERT INTO Reviews (userID, restaurant, title, opinion, classification) VALUES (1, 2, 'Title 2/1', 'So this is just a test with a random opinion about restaurant 2', 4);
INSERT INTO Reviews (userID, restaurant, title, opinion, classification) VALUES (2, 2, 'Title 2/2', 'So this is just a test 2 with a random opinion about restaurant 2', 3);
INSERT INTO Reviews (userID, restaurant, title, opinion, classification) VALUES (3, 1, 'Title 1/1', 'So this is just a test with a random opinion about restaurant 1', 5);
