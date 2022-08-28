CREATE DATABASE databasephysis;
USE databasephysis;

CREATE TABLE usuario(
    cd INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(150),
    email VARCHAR(150),
    senha VARCHAR(50),
    telefone VARCHAR(11)
);