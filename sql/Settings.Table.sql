CREATE TABLE Settings
(
	SettingId int auto_increment PRIMARY KEY,
    LicenseNumber varchar(20) NOT NULL,
    MondayStart int NOT NULL,  
    MondayEnd int NOT NULL,
    TuesdayStart int NOT NULL,  
    TuesdayEnd int NOT NULL,
    WednesdayStart int NOT NULL,  
    WednesdayEnd int NOT NULL,
    ThursdayStart int NOT NULL,  
    ThursdayEnd int NOT NULL,
    FridayStart int NOT NULL,  
    FridayEnd int NOT NULL,
    SaturdayStart int NOT NULL,  
    SaturdayEnd int NOT NULL,
    SundayStart int NOT NULL,  
    SundayEnd int NOT NULL,
    PhoneOk bit NOT NULL,
    TextOk bit NOT NULL,
    EmailOk bit NOT NULL,
    ChangedAt datetime
);

CREATE PROCEDURE sp_InsertSettings
(
    LicenseNumber varchar(20),
    MondayStart int ,  
    MondayEnd int,
    TuesdayStart int,
    TuesdayEnd int,
    WednesdayStart int,
    WednesdayEnd int,
    ThursdayStart int,
    ThursdayEnd int,
    FridayStart int,
    FridayEnd int,
    SaturdayStart int,
    SaturdayEnd int,
    SundayStart int,
    SundayEnd int,
    PhoneOk bit,
    TextOk bit,
    EmailOk bit
)

    INSERT INTO Settings
    (
		LicenseNumber,
		MondayStart, 
		MondayEnd,
		TuesdayStart,
		TuesdayEnd,
		WednesdayStart,
		WednesdayEnd,
		ThursdayStart,
		ThursdayEnd,
		FridayStart,
		FridayEnd,
		SaturdayStart,
		SaturdayEnd,
		SundayStart,
		SundayEnd,
		PhoneOk,
		TextOk,
		EmailOk,
        ChangedAt
	)
    VALUES
    (
		LicenseNumber,
		MondayStart, 
		MondayEnd,
		TuesdayStart,
		TuesdayEnd,
		WednesdayStart,
		WednesdayEnd ,
		ThursdayStart,
		ThursdayEnd,
		FridayStart,
		FridayEnd,
		SaturdayStart,
		SaturdayEnd,
		SundayStart,
		SundayEnd,
		PhoneOk,
		TextOk,
		EmailOk,
        NOW()
	); 
