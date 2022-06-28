#Base de données de Cometh

#---------------------------------
# Utilisateurs
#---------------------------------
drop table user;
drop table planning;
CREATE TABLE user(
    id int not null auto_increment,
    admin int default 0, 
    name varchar(30) unique not null,
    pwd varchar(30) not null,
    h_debut1 int default null,
    h_fin1 int default null,
    h_debut2 int default null,
    h_fin2 int default null,
    duree_tv int default 0,
    primary key(id)
);


#---------------------------------
# Planning fichier pdf
#---------------------------------
create table planning(
    plan_id int not null auto_increment,
    plan_name varchar(30) not null,
    primary key(plan_id)
);

#---------------------------------
# Trigger mis à jour horaires
#---------------------------------


#--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
# PEUPLEMENT DE LA BASE DE DONNEES
#--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
insert into user(id,admin,name,pwd,h_debut1,h_fin1,h_debut2,h_fin2)
values 
    (0,1,'nyela','passwordC',NULL,NULL,NULL,NULL,0)
;