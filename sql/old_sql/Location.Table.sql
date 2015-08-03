CREATE TABLE Location
(
	LocationId int auto_increment PRIMARY KEY,
    UserName varchar(20) NOT NULL,
	Longitude double,
    Latitude double,
    ChangedAt datetime
);

CREATE PROCEDURE sp_InsertLocation
(
    UserName varchar(20) NOT NULL,
	Longitude double,
    Latitude double
)

    INSERT INTO Location
    (
		Latitude,
        Longitude,
        ChangedAt
	)
    VALUES
    (
        UserId,
		Latitude,
        Longitude,
        NOW()
	); 

CREATE PROCEDURE sp_GetLastLocation 
(
    UserId int  
)
