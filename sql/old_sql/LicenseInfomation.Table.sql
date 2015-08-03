CREATE TABLE LicenseInformation
(
	LicenseId int auto_increment PRIMARY KEY,
    LicenseNumber varchar(20) NOT NULL,
    TypeId int NOT NULL,  
    ChangedAt datetime
);

CREATE PROCEDURE sp_InsertLicenseInformation
(
    LicenseNumber varchar(20),
    TypeId int  
)

    INSERT INTO LicenseInformation
    (
		LicenseNumber,
        TypeId,
        ChangedAt
	)
    VALUES
    (
		LicenseNumber,
        TypeId,
        NOW()
	); 
