-- Active: 1669103706084@@mysql98.unoeuro.com@3306@frederikemilolsen_dk_db_tribble

-- Users --
DROP TABLE IF EXISTS Users;
CREATE TABLE Users (
	ID int AUTO_INCREMENT primary key,
	full_name nvarchar(100),
    user_address nvarchar(100),
    zip int(4),
	user_image nvarchar (60),
	payment_type nvarchar(30)
) COLLATE=latin1_danish_ci;
INSERT INTO Users (full_name, user_address, zip, user_image, payment_type)
VALUES
('Anders Jensen', 'Kærvej 82,', 8722, '!default_profile.png', 'subscription'),
('Merete Dirchsen Vesterlund', 'Søndre Havnevej 93', 8330, '!default_profile.png', 'subscription'),
('Kirsten Møller Hansen', 'Mejlgade 32', 8000, '!default_profile.png', 'manual');


-- Credentials --
DROP TABLE IF EXISTS Credentials;
CREATE TABLE Credentials (
	ID int AUTO_INCREMENT primary key,
	userID int,
	user_email nvarchar(55),
	user_password varchar(60),
	user_password_lenght int
) COLLATE=latin1_danish_ci;	
INSERT INTO Credentials (userID, user_email, user_password, user_password_lenght)
VALUES
(1, 'andersjensen1983@gmail.com', '$2y$10$uf7Ey0mIeubw6Gh4zWNnJujWdkDMSGtrsUbAEom3wVwrdYZRDHWKu', 5),
(2, 'mdv@vesterlundefterskole.dk', '$2y$10$uf7Ey0mIeubw6Gh4zWNnJujWdkDMSGtrsUbAEom3wVwKihTioJopH', 6),
(3, 'kmoller1998@hotmail.dk', '$2y$10$uf7Ey0mIeubw6Gh4zWNnJujWdkDMSGtrsUbAEom3wVwnHyugT5Fty', 8);


-- Locations --
DROP TABLE IF EXISTS Locations;
CREATE TABLE Locations (
	ID int AUTO_INCREMENT primary key,
	location_name nvarchar(60),
	longitude nvarchar(25),
	latitude nvarchar(25),
	location_address nvarchar(60),
	location_zip int(4),
	location_image longblob,
	location_description nvarchar(500)
) COLLATE=latin1_danish_ci;	
INSERT INTO Locations (location_name, longitude, latitude, location_address, location_zip, location_image, location_description)
VALUES
('Clever Charging Station', '56.15752678475239', '10.191450852164543', 'Cirkle K, Silkeborgvej 4', 8000, 'cirkle_k_silkeborgvej', ''),
('Clever Charging Station', '56.15392618320063', '10.197901910194195', 'Aros Allé 2 ARoS Aarhus Kunstmuseum', 8000, 'aros_alle_aros_kunstmuseum', 'Etage 0, Den danske Strygerkonkurrence'),
('Clever Charging Station', '56.16106375794381', '10.22179503344429', 'Sverigesgade', 8000, 'sverigesgade', '');


-- Chargers --
DROP TABLE IF EXISTS Chargers;
CREATE TABLE Chargers (
	ID int AUTO_INCREMENT primary key,
	locationID int,
	charging_type nvarchar(60)
) COLLATE = latin1_danish_ci;	
INSERT INTO Chargers (locationID, charging_type)
VALUES
(1, 'CCS (50kW)'),
(1, 'Type 2 (22kW)'),
(2, 'Type 2 (22kW)'),
(2, 'Type 2 (22kW)'),
(2, 'Type 2 (22kW)'),
(2, 'Type 2 (22kW)'),
(3, 'CHAdeMO (50kW)'),
(3, 'CCS (50kW)'),
(3, 'Type 2 (43kW)');

-- Reservations --
DROP TABLE IF EXISTS Reservations;
CREATE TABLE Reservations (
	ID int AUTO_INCREMENT primary key,
	chargerID int,
	userID int,
	start_time DATETIME,
	end_time DATETIME,
	price float(10)
) COLLATE=latin1_danish_ci;	
INSERT INTO Reservations (chargerID, userID, start_time, end_time, price)
VALUES
(1, 2, '2022-12-14 18:00:00', '2022-12-14 18:30:00', 250),
(1, 2, '2022-12-14 09:00:00', '2022-12-14 10:30:00', 250),
(3, 2, '2022-12-12 09:00:00', '2022-12-12 10:30:00', 250),
(1, 1, '2022-12-09 20:00:00', '2022-12-09 22:30:00', 150),
(1, 28, '2022-11-22 14:00:00', '2022-11-22 14:30:00', 150),
(1, 28, '2022-12-14 18:00:00', '2022-12-14 18:30:00', 250),
(1, 28, '2022-12-14 09:00:00', '2022-12-14 10:30:00', 250),
(3, 28, '2022-12-12 09:00:00', '2022-12-12 10:30:00', 250),
(1, 28, '2022-12-09 20:00:00', '2022-12-09 22:30:00', 150),
(1, 30, '2022-11-22 14:00:00', '2022-11-22 14:30:00', 150),
(1, 30, '2022-11-22 14:00:00', '2022-11-22 14:30:00', 150),
(1, 30, '2022-12-14 18:00:00', '2022-12-14 18:30:00', 250),
(1, 30, '2022-12-14 09:00:00', '2022-12-14 10:30:00', 250),
(3, 30, '2022-12-12 09:00:00', '2022-12-12 10:30:00', 250),
(1, 30, '2022-12-09 20:00:00', '2022-12-09 22:30:00', 150),
(1, 30, '2022-11-22 14:00:00', '2022-11-22 14:30:00', 150);

Select * from Users;
Select * from Credentials;
Select * from Chargers;
Select * from Locations;
Select * from Reservations;
