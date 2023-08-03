# Para se conectar ao usuário admin do MySQL

mysql -u root -p

# Para criar um banco de dados MySQL

CREATE DATABASE myproductsdb;

# Para acessar o banco de dados recém-criado

USE myproductsdb;

# Para listar os bancos de dados criados

SHOW DATABASES;

# Para listar as tabelas de um banco de dados criado e que está em acesso pelo comando 'USE'

SHOW tables

# Para listar as colunas de uma tabela recém criada

SHOW COLUMNS FROM products;

# Para remover uma tabela do banco de dados

DROP TABLE products;

# Para remover um banco de dados criado

DROP DATABASE myproductsdb;

# Para adicionar uma coluna numa tabela do banco

ALTER TABLE products ADD COLUMN star_rater INT NOT NULL

# Para remover uma coluna de uma tabela do banco 

ALTER TABLE products DROP COLUMN star_rater

# Para atualizar um registro em uma tabela

UPDATE users SET email = 'pedro@email.com', age = '18' WHERE id = 1;

# Para remover um registro em uma tabela 

DELETE FROM users WHERE id = 1;