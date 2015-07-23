
IF NOT EXISTS (SELECT * FROM information_schema.TABLE_CONSTRAINTS WHERE Constraint_Type = 'FOREIGN KEY' 
	and Constraint_Name = 'FK_Location_UserInformation_UserId')
    DO 
		ALTER TABLE 'Location'
		ADD CONSTRAINT 'FK_Location_UserInformation_UserId'
		FOREIGN KEY ('UserId')
        REFERENCES 'UserInformation' ('UserId');



		
