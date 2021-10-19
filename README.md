# BANCO DO PROJETO

CREATE DATABASE IF NOT EXISTS bd_vector_academy;

use bd_vector_academy;

CREATE TABLE IF NOT EXISTS video_aulas(
id_video int(11) auto_increment primary key, 
titulo varchar(70) not null,
url varchar(15) not null, 
jogo varchar(3) not null
) default charset utf8;

CREATE TABLE IF NOT EXISTS users(
id_jogador int(11) auto_increment primary key, 
nome varchar(30) not null, 
idade int(11) not null, 
senha varchar(32) not null, 
email varchar(100) not null, 
nick varchar(30) not null, 
genero varchar(10) not null,
adm boolean not null
)default charset utf8;

insert into users values (default,"Rafas",17, md5(5678), "fael890@gmail.com", "fael890", "masculino", true);
