CREATE DATABASE db_etacarinae;
USE db_etacarinae;

CREATE TABLE usuario(
    cd INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(150),
    email VARCHAR(150),
    senha VARCHAR(50),
    telefone VARCHAR(11),
    data_nasc DATE,
    adm BIT
);

CREATE TABLE materia(
    cd INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(100)
);

CREATE TABLE atividade(
    cd INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    titulo VARCHAR(100),
    descricao VARCHAR(400),
    data_vencimento DATE,
    status_atividade BIT, 
    id_materia INT,
    FOREIGN KEY (id_materia) REFERENCES materia(cd)
);

