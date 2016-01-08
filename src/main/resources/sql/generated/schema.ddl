
    create table info (
        infoId integer not null,
        businessName varchar(64),
        address varchar(64) not null,
        city varchar(64) not null,
        emailOk bit not null,
        phoneNumber varchar(20) not null,
        phoneOk bit not null,
        textOk bit not null,
        zipcode varchar(5) not null,
        user integer,
        updated_at datetime on update CURRENT_TIMESTAMP,
        created_at datetime default CURRENT_TIMESTAMP,
        primary key (infoId)
    ) ENGINE=InnoDB;

    create table license (
        licenseId integer not null,
        licenseNumber varchar(32) not null,
        service integer,
        user integer,
        updated_at datetime on update CURRENT_TIMESTAMP,
        created_at datetime default CURRENT_TIMESTAMP,
        primary key (licenseId)
    ) ENGINE=InnoDB;

    create table location (
        locationId integer not null,
        latitude double precision not null,
        longitude double precision not null,
        user integer not null,
        updated_at datetime on update CURRENT_TIMESTAMP,
        created_at datetime default CURRENT_TIMESTAMP,
        primary key (locationId)
    ) ENGINE=InnoDB;

    create table service (
        serviceId integer not null,
        description varchar(100) not null,
        created_at datetime default CURRENT_TIMESTAMP,
        primary key (serviceId)
    ) ENGINE=InnoDB;

    create table settings (
        settingsId integer not null,
        fridayEnd time,
        fridayStart time,
        mondayEnd time,
        mondayStart time,
        saturdayEnd time,
        saturdayStart time,
        sundayEnd time,
        sundayStart time,
        thursdayEnd time,
        thursdayStart time,
        tuesdayEnd time,
        tuesdayStart time,
        wednesdayEnd time,
        wednesdayStart time,
        user integer,
        updated_at datetime on update CURRENT_TIMESTAMP,
        created_at datetime default CURRENT_TIMESTAMP,
        primary key (settingsId)
    ) ENGINE=InnoDB;

    create table user (
        userId integer not null,
        email varchar(50) not null,
        firstName varchar(20) not null,
        lastName varchar(20) not null,
        isProvider tinyint(1) default 0,
        info integer,
        settings integer,
        updated_at datetime on update CURRENT_TIMESTAMP,
        created_at datetime default CURRENT_TIMESTAMP,
        primary key (userId)
    ) ENGINE=InnoDB;

    alter table license 
        add constraint UK_licenseNumber  unique (licenseNumber, user);

    alter table service 
        add constraint UK_serviceDescription  unique (description);

    alter table user 
        add constraint UK_email  unique (email);

    alter table info 
        add constraint FK_info_user 
        foreign key (user) 
        references user (userId);

    alter table license 
        add constraint FK_license_user 
        foreign key (user) 
        references user (userId);

    alter table location 
        add constraint FK_location_user
        foreign key (user) 
        references user (userId);

    alter table settings 
        add constraint FK_settings_user
        foreign key (user) 
        references user (userId);

    alter table user 
        add constraint FK_user_info 
        foreign key (info) 
        references info (infoId);

    alter table user 
        add constraint FK_user_settings
        foreign key (settings) 
        references settings (settingsId);
