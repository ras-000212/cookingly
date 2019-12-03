REM Script de creation de table 

PROMPT *** Table User ***
create table User (
	Id_User integer not null AUTO_INCREMENT, 
	login varchar(12) not null, 
	password varchar(9) not null, 
	last_name varchar(30) not null,
	name varchar(30) not null,
	email varchar(50) not null, 
	primary key(Id_User)
);

PROMPT *** Table Food_Definition ***
create table Food_Definition (
	Id_Food integer not null AUTO_INCREMENT,
	name varchar(20) not null, 
	nutriction_fact varchar(50) not null, 
	primary key(Id_Food)
);

PROMPT *** Table Food - User***
create table Food (
	Id_User integer not null, 
	Id_Food integer not null,
	primary key(Id_User,Id_Food)
);

REM Contraintes

alter table Food 
	add constraint FK_Food_User foreign key (Id_User) references User(Id_User) ON DELETE CASCADE;
	add constraint FK_Food_Definition foreign key (Id_Food) references Food_Definition(Id_Food) ON DELETE CASCADE;