
    create table info (
        infoId integer not null auto_increment,
        address varchar(64) not null,
        city varchar(64) not null,
        emailOk bit not null,
        phoneNumber varchar(20) not null,
        phoneOk bit not null,
        textOk bit not null,
        zipcode varchar(5) not null,
        user integer,
        updated_at datetime,
        created_at datetime,
        primary key (infoId)
    ) ENGINE=InnoDB;

    create table license (
        licenseId integer not null auto_increment,
        licenseNumber varchar(32) not null,
        service tinyblob not null,
        user integer,
        updated_at datetime,
        created_at datetime,
        primary key (licenseId)
    ) ENGINE=InnoDB;

    create table location (
        locationId integer not null auto_increment,
        latitude double precision not null,
        longitude double precision not null,
        user integer not null,
        updated_at datetime,
        created_at datetime,
        primary key (locationId)
    ) ENGINE=InnoDB;

    create table service (
        serviceId integer not null auto_increment,
        description varchar(100) not null,
        created_at datetime,
        primary key (serviceId)
    ) ENGINE=InnoDB;

    create table settings (
        settingsId integer not null auto_increment,
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
        updated_at datetime,
        created_at datetime,
        primary key (settingsId)
    ) ENGINE=InnoDB;

    create table user (
        userId integer not null auto_increment,
        email varchar(50) not null,
        info integer,
        settings integer,
        updated_at datetime,
        created_at datetime,
        primary key (userId)
    ) ENGINE=InnoDB;

    alter table license 
        add constraint UK_lvjf835d07i7ocaqt6eokfely  unique (licenseNumber);

    alter table service 
        add constraint UK_njew1c9fl5n5u2fmteo291087  unique (description);

    alter table user 
        add constraint UK_ob8kqyqqgmefl0aco34akdtpe  unique (email);

    alter table info 
        add constraint FK_tlhqa6aw4w6nf3lys7psffx1g 
        foreign key (user) 
        references user (userId);

    alter table license 
        add constraint FK_9gvkruwy6mlddv6y0gbraguwo 
        foreign key (user) 
        references user (userId);

    alter table license 
        add constraint FK_4wd9hhh6chohd0y3b42v3vtcv 
        foreign key (licenseId) 
        references user (userId);

    alter table location 
        add constraint FK_owkc1yyb1330lm9mvakxldg85 
        foreign key (user) 
        references user (userId);

    alter table settings 
        add constraint FK_lnd19kday2o70exm15vyct55w 
        foreign key (user) 
        references user (userId);

    alter table user 
        add constraint FK_bw1t1f0s75tvu7n445abxweme 
        foreign key (info) 
        references info (infoId);

    alter table user 
        add constraint FK_9wplpc8a5gs5yc0q4cqcvigcl 
        foreign key (settings) 
        references settings (settingsId);
