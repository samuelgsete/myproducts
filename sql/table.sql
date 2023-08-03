CREATE TABLE products (
    id SMALLINT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(128) NOT NULL,
    brand VARCHAR(64) NOT NULL,
    price FLOAT NOT NULL,
    stock INT NOT NULL,
    warranty INT NOT NULL,
    is_active BOOLEAN NOT NULL DEFAULT 1
);