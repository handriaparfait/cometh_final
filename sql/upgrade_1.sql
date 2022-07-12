#Base de données de Cometh

#---------------------------------
# Utilisateurs
#---------------------------------
drop table users;
drop table planning;
drop table planning_users;
drop table planning_steps;
drop table tasks;
drop table task_users;

#---------------------------------
# Planning fichier pdf
#---------------------------------
CREATE TABLE planning(
    plan_id int not null auto_increment,
    plan_ref varchar(50) default null,
    plan_name varchar(50) not null,
    plan_adresse varchar(50) default null,
    plan_date date default null,
    plan_start TIMESTAMP  default 0,
    plan_end TIMESTAMP  default 0,
    pdf1 longblob default null,
    pdf2 longblob default null,
    pdf3 longblob default null,
    pdf1_name varchar(50) default '',
    pdf2_name varchar(50) default '',
    pdf3_name varchar(50) default '',
    ispaused int default 0,
    isended int default 0,
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
    total_hour time not null,
    foreign key (plan_id) references planning(plan_id),
    foreign key (id) references users(id)
);

CREATE TABLE planning_steps(
    plan_id int not null,
    step_start time default 0,
    step_end time default 0,
    foreign key (plan_id) references planning(plan_id)
);

CREATE TABLE tasks(
    task_id int not null auto_increment,
    task_name varchar(50) default NULL,
    task_level varchar(50) default "LB",
    isdone int default 0,
    primary key(task_id)
);

CREATE TABLE task_users(
    task_id int not null,
    user_id int not null,
    foreign key (task_id) references tasks(task_id),
    foreign key (user_id) references users(id)
);




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
    (NULL,'planningTEST1','TORCY','2022-06-01',0,0,NULL,NULL,NULL),
    (NULL,'planningTEST2','PARIS','2022-06-01',0,0,NULL,NULL,NULL),
    (NULL,'planningTEST3','BORDEAUX','2022-07-01',0,0,NULL,NULL,NULL),
    (NULL,'planningTEST4','NICE','2022-08-01',0,0,NULL,NULL,NULL),
    (NULL,'planningTEST5','NICE','2022-08-01',0,0,NULL,NULL,NULL)
;

insert into planning_users(plan_id,id,total_hour)
values 
    (1,1,0), (2,1,0), (3,1,0), (4,1,0), (5,1,0)
;

insert into tasks(task_name,task_level)
values 
    ('dessiner un pic pour le 06/22','PR'),
    ('changer de e-mail','PR'),
    ('changer de profil','PR'),
    ('ajouter dépense 2022','PR'),
    ('test test test test ','PR'),
    ('telecharger une nouvelle facture','PR')
;

insert into task_users(task_id,user_id)
values 
    (1,1), (2,1), (3,1), (4,1), (5,1),(6,1)
;



