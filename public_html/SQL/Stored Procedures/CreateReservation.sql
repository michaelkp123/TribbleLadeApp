-- Active: 1669103706084@@mysql98.unoeuro.com@3306@frederikemilolsen_dk_db_tribble

-- Create Reservation [Stored Procedure] --
DELIMITER //
DROP PROCEDURE IF EXISTS CreateReservation;
CREATE PROCEDURE CreateReservation (
	IN varChargerID int,
	IN varUserID int,
	IN varStartTime DATETIME,
	IN varDuration float
)
BEGIN

DECLARE EXIT HANDLER FOR SQLEXCEPTION, SQLWARNING
BEGIN
	ROLLBACK;
SELECT 'Rollback, an error has occured' ErrorMessage;
END;

START TRANSACTION;  
	SET @price := (SELECT varDuration * 250);
    SET @endtime := (DATE_ADD(varStartTime, INTERVAL (varDuration * 60) MINUTE));

	-- Creates a new Reservation in the database:
	INSERT INTO Reservations (chargerID, userID, start_time, end_time, price)
	VALUES (varChargerID, varUserID, varStartTime, @endtime, @price);

COMMIT;

END //
DELIMITER ;


CALL CreateReservation(1, 30, REPLACE("2022-12-14 10:13:00", '/', '-'), 2);
select * from `Reservations`;