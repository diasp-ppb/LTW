DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Restaurants;
DROP TABLE IF EXISTS Reviews;
DROP TABLE IF EXISTS Owners;
DROP TABLE IF EXISTS Images;
DROP TRIGGER IF EXISTS UpdateAVGclass;

CREATE TABLE Users (
    usr VARCHAR(32) NOT NULL,
    pass VARCHAR(32) NOT NULL ,
    email VARCHAR(60) NOT NULL ,
    UNIQUE(email),
    UNIQUE(usr)
);

CREATE TABLE Restaurants (
    name VARCHAR(32) NOT NULL,
    address VARCHAR(32) NOT NULL,
    type VARCHAR(16) NOT NULL,
    city VARCHAR(32) NOT NULL,
    district VARCHAR(32) NOT NULL,
    country VARCHAR(32) NOT NULL,
    description VARCHAR(1024) ,
    avgClass REAL,
    PRIMARY KEY(name, address)
);


CREATE TABLE Reviews (
    userID INTEGER REFERENCES Users(rowID),
    restaurant INTEGER REFERENCES Restaurants(rowID),
    title VARCHAR(64),
    opinion VARCHAR(512),
    classification INTEGER
);



CREATE TABLE Owners (
    owner INTEGER REFERENCES Users(rowID),
    restaurant INTEGER REFERENCES Restaurants(rowID),
    PRIMARY KEY (owner, restaurant)
);


CREATE TABLE Images (
    restaurant INTEGER REFERENCES Restaurants(rowID),
    name VARCHAR(256) NOT NULL,
    PRIMARY KEY (name)
);


CREATE TABLE ReviewComments (
    review INTEGER REFERENCES Reviews(rowID),
    opinion VARCHAR(512) NOT NULL,
    PRIMARY KEY (review)
);


CREATE TRIGGER UpdateAVGclass
AFTER INSERT ON Reviews
  FOR EACH ROW
  BEGIN
        UPDATE Restaurants
        SET avgClass =  ( SELECT AVG(classification) FROM Reviews
                          WHERE (Restaurants.rowID = Reviews.restaurant)
                        );
  END;
