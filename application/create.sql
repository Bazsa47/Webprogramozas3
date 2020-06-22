CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password TEXT NOT NULL,
    address VARCHAR(255) NOT NULL,
    role TINYINT(1) NOT NULL,

    CONSTRAINT PK_Users PRIMARY KEY(id),
    CONSTRAINT UQ_Users_Username UNIQUE(username)
);

