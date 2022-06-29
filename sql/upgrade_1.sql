#Base de données de Cometh

#---------------------------------
# Utilisateurs
#---------------------------------
drop table users;
drop table planning;

#---------------------------------
# Planning fichier pdf
#---------------------------------
CREATE TABLE planning(
    plan_id int not null auto_increment,
    plan_ref varchar(50) default null,
    plan_name varchar(50) not null,
    plan_adresse varchar(50) default null,
    plan_date date default null,
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




#---------------------------------
# Trigger mis à jour horaires
#---------------------------------


#--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
# PEUPLEMENT DE LA BASE DE DONNEES
#--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
insert into users(admin,name,pwd,h_debut1,h_fin1,h_debut2,h_fin2,duree_tv,email)
values 
    (1,'nyela','password',NULL,NULL,NULL,NULL,0,'ralantonisainananyela@gmail.com'),
    (1,'ralantonisainana','password',NULL,NULL,NULL,NULL,0,'ralantonisainananyela@gmail.com')
;


insert into planning(plan_ref,plan_name,plan_adresse,plan_date)
values 
    (NULL,'planningTEST','TORCY','2022-06-01')
;