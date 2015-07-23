CREATE TABLE Location
(
	LocationId int auto_increment PRIMARY KEY,
	Longitude point,
    Latitude point,
    ChangedAt datetime
);

CREATE PROCEDURE sp_InsertLocation
(
	Longitude point,
    Latitude point
)

    INSERT INTO Location
    (
		Latitude,
        Longitude,
        ChangedAt
	)
    VALUES
    (
		Latitude,
        Longitude,
        NOW()
	); 
