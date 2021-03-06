CREATE DATABASE sistema_votacao COLLATE 'utf8_unicode_ci';

CREATE TABLE paises(
	id_pais INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome varchar(255) NOT NULL,
	sigla varchar(10)
);

CREATE TABLE presidentes(
	id_presidente INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_pais INT,
	nome varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	senha varchar(255) NOT NULL
);

CREATE TABLE deputados(
	id_deputado INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_pais INT,
	nome varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	senha varchar(255) NOT NULL
);

CREATE TABLE projetos(
	id_projeto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_deputado INT,
	id_pais INT,
	data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
	status int DEFAULT 0,
	titulo varchar(255) NOT NULL,
	descricao TEXT NOT NULL,
	data_resultado DATETIME,
	id_presidente INT
);

CREATE TABLE votos(
	id_voto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_projeto INT,
	id_deputado INT,
	aprovado INT
);

CREATE TABLE comentarios(
	id_comentario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_deputado INT,
	id_presidente INT,
	id_projeto INT,
	comentario varchar(255) NOT NULL,
	data_comentario DATETIME DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE presidentes ADD FOREIGN KEY (id_pais) REFERENCES paises(id_pais);
ALTER TABLE deputados ADD FOREIGN KEY (id_pais) REFERENCES paises(id_pais);
ALTER TABLE projetos ADD FOREIGN KEY (id_deputado) REFERENCES deputados(id_deputado);
ALTER TABLE projetos ADD FOREIGN KEY (id_pais) REFERENCES paises(id_pais);
ALTER TABLE projetos ADD FOREIGN KEY (id_presidente) REFERENCES presidentes(id_presidente);
ALTER TABLE votos ADD FOREIGN KEY (id_projeto) REFERENCES projetos(id_projeto);
ALTER TABLE votos ADD FOREIGN KEY (id_deputado) REFERENCES deputados(id_deputado);
ALTER TABLE comentarios ADD FOREIGN KEY (id_deputado) REFERENCES deputados(id_deputado);
ALTER TABLE comentarios ADD FOREIGN KEY (id_presidente) REFERENCES presidentes(id_presidente);
ALTER TABLE comentarios ADD FOREIGN KEY (id_projeto) REFERENCES projetos(id_projeto);
