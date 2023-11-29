create database financas;
use financas;

create table tipo_lancamento(
    id_tipo integer not null primary key auto_increment,
    categoria varchar(100)
);

create table lancamentos(
    id_lancamento integer not null primary key auto_increment,
    descricao varchar(100),
    valor float,
    data_venc date,
    id_tipo integer,
    CONSTRAINT id_tipo FOREIGN KEY (id_tipo) REFERENCES tipo_lancamento (id_tipo),
    id_usuario integer,
    CONSTRAINT id_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
);


create table usuarios(
 id_usuario integer not null primary key auto_increment,
 nome varchar(100),
 email varchar(40),
 senha varchar(8)
);

INSERT INTO financas.tipo_lancamento (categoria)
VALUES
    ('Receitas'),
    ('Despesas');
   
INSERT INTO usuarios (nome,email,senha)
VALUES ('Gisele','gi@gmail.com', '12345678');
   
INSERT INTO financas.lancamentos
(descricao, valor, data_venc, id_tipo,id_usuario)
VALUES ('Salario',1500,'2023-11-01', 1,1);

INSERT INTO financas.lancamentos
(descricao, valor, data_venc, id_tipo,id_usuario)
VALUES ('Aluguel',850,'2023-11-15', 2,1);
   


