DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Restaurants;

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
    avgClass REAL,
    owner INTEGER REFERENCES Users(rowID),
    PRIMARY KEY(name, address)
);
