/* User insert */

INSERT INTO Users (usr,pass,email) VALUES ('Abel','Andorinhas','FFFF@lalala.com');
INSERT INTO Users (usr,pass,email) VALUES ('Mario','Andorinhas1','FrFF@lalala.com');
INSERT INTO Users (usr,pass,email) VALUES ('Justo','Andorinhas2','FrFDF@lalala.com');

INSERT INTO Restaurants (name, address, type, city, district, country, avgClass, owner) VALUES('Restaurante 1', 'Rua 1', 'Italian', 'Montijo', 'Setubal', 'Portugal', 4.9, NULL);
INSERT INTO Restaurants (name, address, type, city, district, country, avgClass, owner) VALUES('Restaurante 2', 'Rua 2', 'Portuguese', 'Porto', 'Porto', 'Portugal', 4.7, NULL);
INSERT INTO Restaurants (name, address, type, city, district, country, avgClass, owner) VALUES('Restaurante 3', 'Rua 3', 'Indian', 'Marco de Canaveses', 'Porto', 'Portugal', 4.8, NULL);

INSERT INTO Reviews (userID, restaurant, title, opinion, classification) VALUES (1, 2, 'Title 2/1', 'So this is just a test with a random opinion about restaurant 2', 4);
INSERT INTO Reviews (userID, restaurant, title, opinion, classification) VALUES (2, 2, 'Title 2/2', 'So this is just a test 2 with a random opinion about restaurant 2', 3);
INSERT INTO Reviews (userID, restaurant, title, opinion, classification) VALUES (3, 1, 'Title 1/1', 'So this is just a test with a random opinion about restaurant 1', 5);
