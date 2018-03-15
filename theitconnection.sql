CREATE TABLE admins (
    adminID int NOT NULL,
    adminUsername varchar (20) NOT NULL,
    firstName varchar (20) NOT NULL,
    lastName varchar (20) NOT NULL,
    email varchar (50) NOT NULL,
    passwordhash varchar(40) NOT NULL,
    loggedin tinyint(1) NOT NULL
);

CREATE TABLE customers (
    customerID int NOT NULL,
    firstName varchar (20) NOT NULL,
    lastName varchar (20) NOT NULL,
    email varchar (50) NOT NULL,
    phonenum int NOT NULL,
    passwordhash varchar(40) NOT NULL
);

INSERT INTO admins VALUES
(0,"theitconnectionadmin","TheITConnection","Admin", "mossderek88@gmail.com", "7f43896d19f328ad782b8d0076154d81634557c4");
