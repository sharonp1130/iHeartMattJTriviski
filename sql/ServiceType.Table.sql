

CREATE TABLE ServiceType
(
	TypeId int auto_increment PRIMARY KEY,
    TypeDescription varchar(100) NOT NULL,
    ChangedAt datetime
);

CREATE PROCEDURE sp_InsertServiceType
(
	TypeDescription varchar(100)
)

    INSERT INTO ServiceType
    (
		TypeDescription,
        ChangedAt
	)
    VALUES
    (
		TypeDescription,
        NOW()
	); 

        
    
    