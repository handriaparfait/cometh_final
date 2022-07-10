#Base de données de Cometh

#---------------------------------
# Utilisateurs
#---------------------------------
drop table users;
drop table planning;
drop table planning_users;

#---------------------------------
# Planning fichier pdf
#---------------------------------
CREATE TABLE planning(
    plan_id int not null auto_increment,
    plan_ref varchar(50) default null,
    plan_name varchar(50) not null,
    plan_adresse varchar(50) default null,
    plan_date date default null,
    plan_start time default 0,
    plan_end time default 0,
    pdf1 longblob default null,
    pdf2 longblob default null,
    pdf3 longblob default null,
    pdf1_name varchar(50) default '',
    pdf2_name varchar(50) default '',
    pdf3_name varchar(50) default '',
    primary key(plan_id)
);

CREATE TABLE users(
    id int not null auto_increment,
    admin int default 0, 
    name varchar(30) unique not null,
    pwd varchar(30) not null,
    h_debut1 int default null,
    h_fin1 int default null,
    h_debut2 int default null,
    h_fin2 int default null,
    duree_tv int default 0,
    email varchar(50) default null,
    current_plan int default null,
    primary key(id),
    foreign key (current_plan) references planning(plan_id)
);

CREATE TABLE planning_users(
    plan_id int not null,
    id int not null,
    total_hour int not null,
    foreign key (plan_id) references planning(plan_id),
    foreign key (id) references users(id)
);



#---------------------------------
# Trigger mis à jour horaires
#---------------------------------

create trigger update_hour_p 
    after update on planning for each row
            update planning_users set total_hour = TIMEDIFF(NEW.plan_end,NEW.plan_start);

#--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
# PEUPLEMENT DE LA BASE DE DONNEES
#--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
insert into users(admin,name,pwd,h_debut1,h_fin1,h_debut2,h_fin2,duree_tv,email)
values 
    (1,'nyela','password',NULL,NULL,NULL,NULL,0,'ralantonisainananyela@gmail.com'),
    (2,'ralantonisainana','password',NULL,NULL,NULL,NULL,0,'ralantonisainananyela@gmail.com')
;

insert into planning(plan_ref,plan_name,plan_adresse,plan_date,plan_start,plan_end,pdf1,pdf2,pdf3)
values 
    (NULL,'planningTEST','TORCY','2022-06-01',0,0,NULL,NULL,NULL),
    (NULL,'planningTEST2','PARIS','2022-06-01',0,0,NULL,NULL,NULL),
    (NULL,'planningTEST3','BORDEAUX','2022-07-01',0,0,NULL,NULL,NULL),
    (NULL,'planningTEST4','NICE','2022-08-01',0,0,NULL,NULL,NULL)
;


insert into planning_users(plan_id,id,total_hour)
values 
    (1,1,0),
    (2,1,0),
    (3,1,0),
    (4,1,0)
;

