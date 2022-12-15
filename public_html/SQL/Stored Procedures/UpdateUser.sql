-- Active: 1669103706084@@mysql98.unoeuro.com@3306@frederikemilolsen_dk_db_tribble

-- Update User [Stored Procedure] --
DELIMITER //
DROP PROCEDURE IF EXISTS UpdateUser;
CREATE PROCEDURE UpdateUser (
    IN varUserID int,
	IN varEmail varchar(55),
	IN varHashedpassword nvarchar(60),
	IN varPasswordLenght int,
	IN varFullName nvarchar(100),
	IN varAddress nvarchar(100),
	IN varZipcode int(4),
	IN varImage nvarchar(60),
	IN varPaymentType nvarchar(30)
)
BEGIN

DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING
BEGIN
	ROLLBACK;
SELECT 'Rollback, an error has occured' ErrorMessage;
END;

START TRANSACTION;

	-- Update User in the database
    UPDATE Users SET 
    full_name = varFullName,
    user_address = varAddress,
    zip = varZipcode,
    user_image = varImage,
    payment_type = varPaymentType
    WHERE ID = varUserID;

    -- Update Credentials in the database
    UPDATE Credentials SET
    user_email = varEmail,
    user_password = varHashedpassword,
    user_password_lenght = varPasswordLenght
    WHERE userID = varUserID;

COMMIT;

END //
DELIMITER ;
