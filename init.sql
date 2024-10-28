IF NOT EXISTS (SELECT * FROM sys.databases WHERE name = 'IPadVerwaltung')
BEGIN
    CREATE DATABASE IPadVerwaltung;
END

IF NOT EXISTS (SELECT * FROM sys.databases WHERE name = 'Login')
BEGIN
    CREATE DATABASE Login;
END

USE Login;


IF NOT EXISTS (SELECT * FROM sys.objects WHERE name = 'Accounts' AND type = 'U')
BEGIN
    CREATE TABLE Accounts (
        id INT IDENTITY PRIMARY KEY NOT NULL,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    );
END


IF NOT EXISTS (SELECT * FROM Accounts WHERE username= 'IN23')
BEGIN
INSERT INTO Accounts (username, password)
VALUES ('IN23','$2y$10$MWYm7RKEVJ8Us7S1S4j/n.l4yEDQzytDMH15PCFT0YZvYGc7nqUnC');
END

USE IPadVerwaltung;