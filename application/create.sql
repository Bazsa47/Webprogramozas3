CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password TEXT NOT NULL,
    address VARCHAR(255) NOT NULL,
    roleId TINYINT(1) NOT NULL,

    CONSTRAINT PK_Users PRIMARY KEY(id),
    CONSTRAINT UQ_Users_Username UNIQUE(username)
);
INSERT INTO `users`( `username`, `password`, `address`, `roleId`) VALUES ("TestUser1","password1","Eger",0);
INSERT INTO `users`( `username`, `password`, `address`, `roleId`) VALUES ("TestUser2","password2","Eger",0);
INSERT INTO `users`( `username`, `password`, `address`, `roleId`) VALUES ("Admin","admin","Eger",1);

CREATE TABLE roles(
    roleId INT NOT NULL,
    roleName VARCHAR(30) NOT NULL,

    CONSTRAINT PK_Roles PRIMARY KEY(roleId)
);
INSERT INTO `roles`(`roleId`, `roleName`) VALUES (0,"user");
INSERT INTO `roles`(`roleId`, `roleName`) VALUES (1,"admin");

CREATE TABLE products(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(250) NOT NULL,
    price INT NOT NULL,
    desc TEXT NOT NULL,
    picture VARCHAR(255) NULL,
    typeId TINYINT(1) NOT NULL
);
INSERT INTO `products`(`name`, `price`, `description`, `picture`, `typeId`) VALUES ("TestProduct",19999,'This is a test product',null,1)
INSERT INTO `products`(`name`, `price`, `description`, `picture`, `typeId`) VALUES ("TestProduct2",7999,'This is also a test product',null,2)

CREATE TABLE types(
    typeId INT PRIMARY KEY,
    typeName VARCHAR(255) NOT NULL
);
INSERT INTO `types`(`typeId`, `typeName`) VALUES (0,"RPG");
INSERT INTO `types`(`typeId`, `typeName`) VALUES (1,"Shooter");
INSERT INTO `types`(`typeId`, `typeName`) VALUES (2,"MOBA");
INSERT INTO `types`(`typeId`, `typeName`) VALUES (3,"FPS");

CREATE TABLE orders(
    orderId INT AUTO_INCREMENT PRIMARY KEY,
    productId INT NOT NULL,
    userId INT NOT NULL
);



