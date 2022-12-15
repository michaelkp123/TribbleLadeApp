-- Active: 1669103706084@@mysql98.unoeuro.com@3306@frederikemilolsen_dk_db_tribble

-- Create Location [Stored Procedure] --
DELIMITER //
DROP PROCEDURE IF EXISTS CreateLocation;
CREATE PROCEDURE CreateUser (
	IN varEmail varchar(55),
	IN varHashedpassword nvarchar(60),
	IN varFullName nvarchar(100),
	IN varAddress nvarchar(100),
	IN varZipcode int(4),
	IN varImage longblob,
	IN varPaymentType nvarchar(30)
)
BEGIN

DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING
BEGIN
	ROLLBACK;
SELECT 'Rollback, an error has occured' ErrorMessage;
END;

START TRANSACTION;

	-- Creates a new User in the database:
	INSERT INTO Users (full_name, user_address, zip, user_image, payment_type)
	VALUES (varFullName, varAddress, varZipcode, varImage, varPaymentType);

	-- Adds User credentials
	SET @userID := (SELECT ID FROM Users ORDER BY ID DESC LIMIT 1);
	INSERT INTO Credentials (userID, user_email, user_password)
	VALUES (@userID , varEmail, varHashedpassword);

COMMIT;

END //
DELIMITER ;

-- Call CreateUser('frederikolsen@gmail.com', '$2y$10$uf7Ey0mIeubw6Gh4zWNnJujWdkDMSGtrsUbAEom3wVw98Jhui76Hk', 'Frederik Emil Olsen', 'Skt. Nicolaus Gade 3.2-9', '8000', 'default_image_male', 'manual');
