CREATE database IPadVerwaltung;

CREATE database Login;

CREATE TABLE Accounts (
    id INT IDENTITY PRIMARY KEY NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO Accounts (username, password)
VALUES ('IN23','$2y$10$MWYm7RKEVJ8Us7S1S4j/n.l4yEDQzytDMH15PCFT0YZvYGc7nqUnC');