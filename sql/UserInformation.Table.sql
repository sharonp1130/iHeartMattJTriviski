CREATE TABLE UserInformation
(
	UserInformationId int auto_increment PRIMARY KEY,
    UserName varchar(20) NOT NULL,
    IsProvider bit NOT NULL,
    Prefix varchar(5),
    FirstName varchar(20) NOT NULL,
    LastName varchar(20) NOT NULL,
    Suffix varchar(5),
    Address varchar (50),
    PhoneNumber varchar(20),
    Email varchar(50),    
    ChangedAt datetime
);

CREATE PROCEDURE sp_InsertUserInformation
(
	UserName varchar(20),
    IsProvider bit,
    Prefix varchar(5),
    FirstName varchar(20),
    LastName varchar(20),
    Suffix varchar(5),
    Address varchar (50),
    PhoneNumber varchar(20),
    Email varchar(50)
)

    INSERT INTO UserInformation
    (
		UserName,
		IsProvider,
		Prefix,
		FirstName,
		LastName,
		Suffix,
		Address,
		PhoneNumber,
		Email, 
        ChangedAt
	)
    VALUES
    (
		UserName,
		UserType,
		Prefix,
		FirstName,
		LastName,
		Suffix,
		Address,
		PhoneNumber,
		Email, 
        NOW()
	); 
