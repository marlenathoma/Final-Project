CREATE DATABASE resturant_reservations;

USE resturant_reservations;

CREATE TABLE Customers (
	customerID INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerName VARCHAR(45) NOT NULL,
    contactInfo VARCHAR(200),
    PRIMARY KEY (customerID)
);

CREATE TABLE Reservations (
	reservationId INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerId INT NOT NULL,
    reservationTime DATETIME NOT NULL,
    numberOfGuests INT NOT NULL,
    specialRequests VARCHAR(200),
    PRIMARY KEY (reservationId),
    FOREIGN KEY (customerId) REFERENCES Customers(customerId)
 );
 
CREATE TABLE DiningPreferences (
	preferenceId INT NOT NULL UNIQUE AUTO_INCREMENT,
    customerId INT NOT NULL, 
    favoriteTable varchar(45),
    dietaryRestrictions varchar(200),
    PRIMARY KEY (preferenceID),
    FOREIGN KEY (customerID) REFERENCES Customers(customerID)
);


 
