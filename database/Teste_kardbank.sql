create database teste_kardbank;

use teste_kardbank;

create table usuarios (
	id int(11) auto_increment primary key,
    cpf varchar(14) unique,
    nome varchar(60),
    telefone varchar(15),
    email varchar(60)
);

select * from usuarios