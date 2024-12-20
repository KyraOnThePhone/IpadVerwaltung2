IF NOT EXISTS (SELECT * FROM sys.databases WHERE name = 'IPadVerwaltung')
BEGIN
    CREATE DATABASE IPadVerwaltung;
END
GO

IF NOT EXISTS (SELECT * FROM sys.databases WHERE name = 'Login')
BEGIN
    CREATE DATABASE Login;
END
GO
USE Login;
GO


IF NOT EXISTS (SELECT * FROM sys.objects WHERE name = 'Accounts' AND type = 'U')
BEGIN
    CREATE TABLE Accounts (
        id INT IDENTITY PRIMARY KEY NOT NULL,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    );
END
GO


IF NOT EXISTS (SELECT * FROM Accounts WHERE username= 'IN23')
BEGIN
INSERT INTO Accounts (username, password)
VALUES ('IN23','$2y$10$MWYm7RKEVJ8Us7S1S4j/n.l4yEDQzytDMH15PCFT0YZvYGc7nqUnC');
END
GO

USE IPadVerwaltung;
GO

IF NOT EXISTS (SELECT * FROM sys.objects WHERE name = 'Schueler' AND type = 'U')
BEGIN
    CREATE TABLE [dbo].[Schueler](
	[PNr] [int] primary key NOT NULL,
	[Klasse] [varchar](20) NULL,
	[Nachname] [varchar](20) NULL,
	[Vorname] [varchar](20) NULL,
	[Geburtsdatum] [date] NULL,
	[Geschlecht] [char](1) NULL,
	[Straße] [varchar](50) NULL,
	[PLZ] [char](5) NULL,
	[Ort] [varchar](50) NULL,
	[KlassenLehrer] [varchar](20) NULL,
	[Jahrgang] [char](4) NULL,
	[Zugang] [date] NULL,
	[VEnde] [date] NULL,
	[Abgang] [date] NULL,
) ON [PRIMARY]
END
GO
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[SchuelerMerge]') AND type in (N'U'))
DROP TABLE [dbo].[SchuelerMerge]
GO
CREATE TABLE [dbo].[SchuelerMerge](
	[PNr] [int] NOT NULL,
	[Klasse] [varchar](20) NULL,
	[Nachname] [varchar](20) NULL,
	[Vorname] [varchar](20) NULL,
	[Geburtsdatum] [date] NULL,
	[Geschlecht] [char](1) NULL,
	[Straße] [varchar](50) NULL,
	[PLZ] [char](5) NULL,
	[Ort] [varchar](50) NULL,
	[KlassenLehrer] [varchar](20) NULL,
	[Jahrgang] [char](4) NULL,
	[Zugang] [date] NULL,
	[VEnde] [date] NULL,
	[Abgang] [date] NULL,
PRIMARY KEY CLUSTERED 
(
	[PNr] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

IF NOT EXISTS (SELECT * FROM sys.objects WHERE name = 'Tablet' AND type = 'U')
BEGIN
    CREATE TABLE [dbo].[Tablet](
	[ItemID] [int] primary key NOT NULL,
	[Modell] [varchar](50) NULL,
	[Zubehoer] [varchar](50) NULL,
	[Notiz] [varchar](100) NULL,
	[Status] [varchar](50) NOT NULL,
	[Zustand] [varchar](50) NOT NULL,
) ON [PRIMARY]
END
GO
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[TabletMerge]') AND type in (N'U'))
DROP TABLE [dbo].[TabletMerge]
GO

CREATE TABLE [dbo].[TabletMerge](
	[ItemID] [int] NOT NULL,
	[Modell] [varchar](50) NULL,
	[Zubehoer] [varchar](50) NULL,
	[Notiz] [varchar](100) NULL,
	[Status] [varchar](50) NOT NULL,
	[Zustand] [varchar](50) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[ItemID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]

GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE name = 'Ausgabe' AND type = 'U')
BEGIN
    CREATE TABLE [dbo].[Ausgabe](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[SchuelerID] [int] NOT NULL,
	[TabletID] [int] NOT NULL,
	[Ausgabe am] [date] NULL,
	[Geplante Abgabe] [date] NULL,
	[Abgabe] [date] NULL,
 CONSTRAINT [PK_Ausgabe] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
END
GO

ALTER TABLE [dbo].[Ausgabe]  WITH CHECK ADD FOREIGN KEY([SchuelerID])
REFERENCES [dbo].[Schueler] ([PNr])
GO

ALTER TABLE [dbo].[Ausgabe]  WITH CHECK ADD FOREIGN KEY([TabletID])
REFERENCES [dbo].[Tablet] ([ItemID])
GO
IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[dbo].[AusgabeMerge]') AND type in (N'U'))
DROP TABLE [dbo].[AusgabeMerge]
GO

CREATE TABLE [dbo].[AusgabeMerge](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[SchuelerID] [int] NOT NULL,
	[TabletID] [int] NOT NULL,
	[Ausgabe am] [date] NULL,
	[Geplante Abgabe] [date] NULL,
	[Abgabe] [date] NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

INSERT INTO SchuelerMerge (PNr, Klasse, Nachname, Vorname, Geburtsdatum, Geschlecht, Straße, PLZ, Ort, Klassenlehrer, Jahrgang) VALUES
(1001, '7A', 'Müller', 'Lena', '2009-04-15', 'w', 'Am Deich 12', 27570, 'Bremerhaven', 'Schmidt', 7),
(1002, '7A', 'Yılmaz', 'Ahmet', '2009-08-02', 'm', 'Barkhausenstraße 3', 27568, 'Bremerhaven', 'Schmidt', 7),
(1003, '7A', 'Nguyen', 'Minh', '2010-02-20', 'm', 'Geestemünder Straße 45', 27570, 'Bremerhaven', 'Schmidt', 7),
(1004, '7A', 'Schmidt', 'Lukas', '2009-10-11', 'm', 'Bürgermeister-Smidt-Straße 7', 27568, 'Bremerhaven', 'Schmidt', 7),
(1005, '7B', 'Garcia', 'Maria', '2009-11-05', 'w', 'Hafenstraße 22', 27576, 'Bremerhaven', 'Keller', 7),
(1006, '7B', 'Kowalski', 'Anna', '2009-06-14', 'w', 'Fährstraße 8', 27568, 'Bremerhaven', 'Keller', 7),
(1007, '7B', 'Hassan', 'Amina', '2010-01-18', 'w', 'Lutherstraße 34', 27576, 'Bremerhaven', 'Keller', 7),
(1008, '7B', 'Takahashi', 'Kaito', '2009-07-29', 'm', 'Friedrich-Ebert-Straße 5', 27568, 'Bremerhaven', 'Keller', 7),
(1009, '8A', 'Rossi', 'Luca', '2008-05-09', 'm', 'Mühlenstraße 11', 27572, 'Bremerhaven', 'Weber', 8),
(1010, '8A', 'Kim', 'Jisoo', '2008-11-13', 'w', 'Columbusstraße 19', 27570, 'Bremerhaven', 'Weber', 8),
(1011, '8A', 'Ivanova', 'Olga', '2008-03-22', 'w', 'Fischereihafenstraße 23', 27572, 'Bremerhaven', 'Weber', 8),
(1012, '8A', 'Ali', 'Yusuf', '2008-09-06', 'm', 'Holzhafenstraße 6', 27576, 'Bremerhaven', 'Weber', 8),
(1013, '8B', 'Schneider', 'Johanna', '2008-01-27', 'w', 'Weserstraße 27', 27570, 'Bremerhaven', 'Krüger', 8),
(1014, '8B', 'Petrov', 'Ivan', '2008-08-15', 'm', 'Kaiserhafenstraße 13', 27572, 'Bremerhaven', 'Krüger', 8),
(1015, '8B', 'Brown', 'Emily', '2008-10-09', 'w', 'Hoebelstraße 42', 27570, 'Bremerhaven', 'Krüger', 8),
(1016, '8B', 'Mohammed', 'Aliyah', '2008-12-30', 'w', 'Elbestraße 37', 27572, 'Bremerhaven', 'Krüger', 8),
(1017, '9A', 'Martinez', 'Diego', '2007-04-17', 'm', 'Hafenstraße 9', 27572, 'Bremerhaven', 'Schulz', 9),
(1018, '9A', 'Wong', 'Mei', '2007-11-08', 'w', 'Leher Straße 5', 27568, 'Bremerhaven', 'Schulz', 9),
(1019, '9A', 'Kumar', 'Rahul', '2007-03-12', 'm', 'Am Alten Hafen 16', 27576, 'Bremerhaven', 'Schulz', 9),
(1020, '9A', 'Becker', 'Paul', '2007-05-25', 'm', 'Gutenbergstraße 7', 27568, 'Bremerhaven', 'Schulz', 9),
(1021, '9B', 'Hernandez', 'Isabella', '2007-07-10', 'w', 'Bismarckstraße 8', 27570, 'Bremerhaven', 'Lange', 9),
(1022, '9B', 'Novak', 'Matej', '2007-02-18', 'm', 'Kistnerstraße 14', 27576, 'Bremerhaven', 'Lange', 9),
(1023, '9B', 'Mansoori', 'Amira', '2007-09-30', 'w', 'Goethestraße 18', 27572, 'Bremerhaven', 'Lange', 9),
(1024, '9B', 'Johnson', 'Daniel', '2007-08-21', 'm', 'Obere Bürger 33', 27570, 'Bremerhaven', 'Lange', 9),
(1025, '10A', 'Zhou', 'Ling', '2006-06-12', 'w', 'Weserstraße 9', 27572, 'Bremerhaven', 'Bauer', 10),
(1026, '10A', 'Weiß', 'Sophie', '2006-01-17', 'w', 'Markusstraße 4', 27576, 'Bremerhaven', 'Bauer', 10),
(1027, '10A', 'Mustafa', 'Karim', '2006-03-02', 'm', 'Schillerstraße 21', 27570, 'Bremerhaven', 'Bauer', 10),
(1028, '10A', 'Ahmed', 'Leyla', '2006-10-02', 'w', 'Altenwalder Chaussee 15', 27568, 'Bremerhaven', 'Bauer', 10),
(1029, '10B', 'Smith', 'Oliver', '2006-09-18', 'm', 'Fichtestraße 29', 27576, 'Bremerhaven', 'Hoffmann', 10),
(1030, '10B', 'Meier', 'Clara', '2006-04-11', 'w', 'Schillerstraße 16', 27568, 'Bremerhaven', 'Hoffmann', 10);

GO

INSERT INTO dbo.TabletMerge (ItemID, Modell, Zubehoer, Notiz, Status, Zustand) VALUES
(1, 'iPad Air', 'Zubehör X', '', 'Verliehen', 'gut'),
(2, 'iPad Pro', 'Zubehör Y', '', 'Im Lager', 'gebraucht'),
(3, 'iPad Mini', 'Zubehör Z', '', 'Verliehen', 'schlecht'),
(4, 'iPad Air', NULL, '', 'Im Lager', 'gut'),
(5, 'iPad Pro', 'Zubehör X', '', 'Verliehen', 'gebraucht'),
(6, 'iPad Mini', 'Zubehör Y', '', 'Im Lager', 'schlecht'),
(7, 'iPad Air', NULL, '', 'Verliehen', 'gut'),
(8, 'iPad Pro', 'Zubehör Z', '', 'Im Lager', 'gebraucht'),
(9, 'iPad Mini', 'Zubehör X', '', 'Verliehen', 'schlecht'),
(10, 'iPad Air', NULL, '', 'Im Lager', 'gut'),
(11, 'iPad Pro', 'Zubehör Y', '', 'Verliehen', 'gebraucht'),
(12, 'iPad Mini', 'Zubehör Z', '', 'Im Lager', 'schlecht'),
(13, 'iPad Air', NULL, '', 'Verliehen', 'gut'),
(14, 'iPad Pro', 'Zubehör X', '', 'Im Lager', 'gebraucht'),
(15, 'iPad Mini', 'Zubehör Y', '', 'Verliehen', 'schlecht'),
(16, 'iPad Air', NULL, '', 'Im Lager', 'gut'),
(17, 'iPad Pro', 'Zubehör Z', '', 'Verliehen', 'gebraucht'),
(18, 'iPad Mini', 'Zubehör X', '', 'Im Lager', 'schlecht'),
(19, 'iPad Air', NULL, '', 'Verliehen', 'gut'),
(20, 'iPad Pro', 'Zubehör Y', '', 'Im Lager', 'gebraucht'),
(21, 'iPad Mini', 'Zubehör Z', '', 'Verliehen', 'schlecht'),
(22, 'iPad Air', 'Zubehör X', '', 'Im Lager', 'gut'),
(23, 'iPad Pro', NULL, '', 'Verliehen', 'gebraucht'),
(24, 'iPad Mini', 'Zubehör Y', '', 'Im Lager', 'schlecht'),
(25, 'iPad Air', 'Zubehör Z', '', 'Verliehen', 'gut'),
(26, 'iPad Pro', NULL, '', 'Im Lager', 'gebraucht'),
(27, 'iPad Mini', 'Zubehör X', '', 'Verliehen', 'schlecht'),
(28, 'iPad Air', 'Zubehör Y', '', 'Im Lager', 'gut'),
(29, 'iPad Pro', 'Zubehör Z', '', 'Verliehen', 'gebraucht'),
(30, 'iPad Mini', NULL, '', 'Im Lager', 'schlecht'),
(31, 'iPad Air', 'Zubehör X', '', 'Verliehen', 'gut'),
(32, 'iPad Pro', 'Zubehör Y', '', 'Im Lager', 'gebraucht'),
(33, 'iPad Mini', 'Zubehör Z', '', 'Verliehen', 'schlecht'),
(34, 'iPad Air', NULL, '', 'Im Lager', 'gut'),
(35, 'iPad Pro', 'Zubehör X', '', 'Verliehen', 'gebraucht'),
(36, 'iPad Mini', 'Zubehör Y', '', 'Im Lager', 'schlecht'),
(37, 'iPad Air', 'Zubehör Z', '', 'Verliehen', 'gut'),
(38, 'iPad Pro', NULL, '', 'Im Lager', 'gebraucht'),
(39, 'iPad Mini', 'Zubehör X', '', 'Verliehen', 'schlecht'),
(40, 'iPad Air', 'Zubehör Y', '', 'Im Lager', 'gut'),
(41, 'iPad Pro', 'Zubehör Z', '', 'Verliehen', 'gebraucht'),
(42, 'iPad Mini', NULL, '', 'Im Lager', 'schlecht'),
(43, 'iPad Air', 'Zubehör X', '', 'Verliehen', 'gut'),
(44, 'iPad Pro', 'Zubehör Y', '', 'Im Lager', 'gebraucht'),
(45, 'iPad Mini', 'Zubehör Z', '', 'Verliehen', 'schlecht'),
(46, 'iPad Air', NULL, '', 'Im Lager', 'gut'),
(47, 'iPad Pro', 'Zubehör X', '', 'Verliehen', 'gebraucht'),
(48, 'iPad Mini', 'Zubehör Y', '', 'Im Lager', 'schlecht'),
(49, 'iPad Air', 'Zubehör Z', '', 'Verliehen', 'gut'),
(50, 'iPad Pro', NULL, '', 'Im Lager', 'gebraucht');

GO

INSERT INTO dbo.AusgabeMerge (SchuelerID, TabletID, [Ausgabe am], [Geplante Abgabe], Abgabe) VALUES
(1001, 5, '2023-01-10', '2023-01-20', '2023-01-22'),
(1002, 7, '2023-02-15', '2023-03-01', '2023-03-05'),
(1003, 9, '2023-03-10', '2023-03-25', '2023-03-28'),
(1004, 12, '2023-04-05', '2023-04-15', '2023-04-18'),
(1005, 14, '2023-05-01', '2023-05-15', '2023-05-18'),
(1006, 16, '2023-06-10', '2023-06-20', '2023-06-23'),
(1007, 18, '2023-07-05', '2023-07-15', '2023-07-18'),
(1008, 20, '2023-08-10', '2023-08-20', NULL),
(1009, 22, '2023-09-01', '2023-09-10', '2023-09-12'),
(1010, 24, '2023-10-05', '2023-10-15', '2023-10-18'),
(1011, 26, '2023-11-01', '2023-11-10', '2023-11-12'),
(1012, 28, '2023-12-01', '2023-12-10', '2023-12-13'),
(1013, 30, '2023-02-05', '2023-02-15', '2023-02-18'),
(1014, 32, '2023-03-15', '2023-03-25', NULL),
(1015, 34, '2023-04-05', '2023-04-15', '2023-04-18'),
(1016, 36, '2023-05-10', '2023-05-20', '2023-05-22'),
(1017, 38, '2023-06-01', '2023-06-10', NULL),
(1018, 40, '2023-07-20', '2023-07-30', '2023-08-02'),
(1019, 42, '2023-08-25', '2023-09-05', '2023-09-08'),
(1020, 44, '2023-09-15', '2023-09-25', '2023-09-28'),
(1021, 46, '2023-10-10', '2023-10-20', NULL),
(1022, 48, '2023-11-05', '2023-11-15', '2023-11-17'),
(1023, 50, '2023-12-01', '2023-12-10', '2023-12-12'),
(1001, 3, '2023-01-12', '2023-01-22', '2023-01-25'),
(1002, 4, '2023-02-10', '2023-02-20', '2023-02-22'),
(1003, 6, '2023-03-18', '2023-03-28', NULL),
(1004, 8, '2023-04-12', '2023-04-22', '2023-04-25'),
(1005, 10, '2023-05-14', '2023-05-24', '2023-05-26'),
(1006, 11, '2023-06-11', '2023-06-21', '2023-06-23'),
(1007, 13, '2023-07-15', '2023-07-25', '2023-07-28'),
(1008, 15, '2023-08-20', '2023-08-30', NULL),
(1009, 17, '2023-09-05', '2023-09-15', '2023-09-18'),
(1010, 19, '2023-10-07', '2023-10-17', '2023-10-20'),
(1011, 21, '2023-11-02', '2023-11-12', '2023-11-15');

GO

CREATE OR ALTER     PROCEDURE [dbo].[Schueler_Merge]
AS
BEGIN
SET NOCOUNT ON
 
MERGE dbo.Schueler AS Target
USING dbo.SchuelerMerge	AS Source
ON Source.PNr = Target.PNr
WHEN NOT MATCHED BY Target THEN
    INSERT (PNr,Klasse, Nachname,Vorname,Geburtsdatum,Geschlecht,Straße,PLZ,Ort,KlassenLehrer,Jahrgang,Zugang,VEnde,Abgang) 
    VALUES (Source.PNr,Source.Klasse,Source.Nachname,Source.Vorname,Source.Geburtsdatum,Source.Geschlecht,Source.Straße,Source.PLZ,Source.Ort,Source.KlassenLehrer,Source.Jahrgang,Source.Zugang,Source.VEnde,Source.Abgang);

END

GO

CREATE OR ALTER     PROCEDURE [dbo].[Tablet_Merge]
AS
BEGIN
SET NOCOUNT ON
 
MERGE dbo.Tablet AS Target
USING dbo.TabletMerge	AS Source
ON Source.ItemID = Target.ItemID
WHEN NOT MATCHED BY Target THEN
    INSERT (ItemID, Modell, Zubehoer, Notiz, Status, Zustand) 
    VALUES (Source.ItemID, Source.Modell, Source.Zubehoer, Source.Notiz, Source.Status, Source.Zustand);

END

GO

CREATE OR ALTER     PROCEDURE [dbo].[Ausgabe_Merge]
AS
BEGIN
SET NOCOUNT ON
 
MERGE dbo.Ausgabe AS Target
USING dbo.AusgabeMerge	AS Source
ON Source.ID = Target.ID
WHEN NOT MATCHED BY Target THEN
    INSERT (SchuelerID, TabletID, [Ausgabe am], [Geplante Abgabe], Abgabe) 
    VALUES (Source.SchuelerID, Source.TabletID, Source.[Ausgabe am], Source.[Geplante Abgabe], Source.Abgabe);

END

GO

exec dbo.Schueler_Merge

GO

exec dbo.Tablet_Merge

GO

exec dbo.Ausgabe_Merge

GO

CREATE OR ALTER     PROCEDURE [dbo].[HistoryS]
(@SID INT, @Date date)
AS
BEGIN
SET NOCOUNT ON
 
SELECT dbo.Schueler.PNr as 'SchülerID', dbo.Schueler.Vorname, dbo.Schueler.Nachname, dbo.Schueler.Straße, dbo.Schueler.PLZ, dbo.Schueler.Ort, dbo.Tablet.ItemID as 'TabletID', dbo.Tablet.Zustand, dbo.Ausgabe.[Ausgabe am] as 'Ausgabe am', dbo.Ausgabe.[Geplante Abgabe] as 'Geplante Abgabe', dbo.Ausgabe.Abgabe
FROM  dbo.Ausgabe INNER JOIN
                         dbo.Schueler ON dbo.Ausgabe.SchuelerID = dbo.Schueler.PNr INNER JOIN
                         dbo.Tablet ON dbo.Ausgabe.TabletID = dbo.Tablet.ItemID

WHERE dbo.Schueler.PNr=@SID AND dbo.Ausgabe.[Ausgabe am]<@Date
 
END


GO

CREATE OR ALTER   PROCEDURE [dbo].[HistoryT]
(@TID INT, @Date date)
AS
BEGIN
SET NOCOUNT ON
 
SELECT dbo.Schueler.PNr as 'SchülerID', dbo.Schueler.Vorname, dbo.Schueler.Nachname, dbo.Schueler.Straße, dbo.Schueler.PLZ, dbo.Schueler.Ort, dbo.Tablet.ItemID as 'TabletID', dbo.Tablet.Zustand, dbo.Ausgabe.[Ausgabe am] as 'Ausgabe am', dbo.Ausgabe.[Geplante Abgabe] as 'Geplante Abgabe', dbo.Ausgabe.Abgabe
FROM  dbo.Ausgabe INNER JOIN
                         dbo.Schueler ON dbo.Ausgabe.SchuelerID = dbo.Schueler.PNr INNER JOIN
                         dbo.Tablet ON dbo.Ausgabe.TabletID = dbo.Tablet.ItemID

WHERE dbo.Tablet.ItemID=@TID AND dbo.Ausgabe.[Ausgabe am]<@Date
 
END

GO

 CREATE OR ALTER   PROCEDURE [dbo].[TabletStatusKlasse]
(@TStatus varchar(50), @Klasse varchar(50))
AS
BEGIN
SET NOCOUNT ON
 
SELECT dbo.Tablet.ItemID as 'TabletID', dbo.Tablet.Modell, dbo.Tablet.Notiz, dbo.Tablet.Zustand, dbo.Tablet.Status, dbo.Tablet.Zubehoer, dbo.Schueler.Klasse
FROM  dbo.Ausgabe INNER JOIN
                         dbo.Schueler ON dbo.Ausgabe.SchuelerID = dbo.Schueler.PNr INNER JOIN
                         dbo.Tablet ON dbo.Ausgabe.TabletID = dbo.Tablet.ItemID

WHERE dbo.Tablet.Status=@TStatus AND dbo.Schueler.Klasse=@Klasse
 
END

GO 

 CREATE OR ALTER   PROCEDURE [dbo].[TabletStatus]
(@TStatus varchar(50))
AS
BEGIN
SET NOCOUNT ON
 
SELECT dbo.Tablet.ItemID as 'TabletID', dbo.Tablet.Modell, dbo.Tablet.Notiz, dbo.Tablet.Zustand, dbo.Tablet.Status, dbo.Tablet.Zubehoer
FROM dbo.Tablet

WHERE dbo.Tablet.Status=@TStatus
 
END

GO 

 CREATE OR ALTER     PROCEDURE [dbo].[TabletZustandKlasse]
(@TZustand varchar(50), @Klasse varchar(50))
AS
BEGIN
SET NOCOUNT ON
 
SELECT dbo.Tablet.ItemID as 'TabletID', dbo.Tablet.Modell, dbo.Tablet.Notiz, dbo.Tablet.Zustand, dbo.Tablet.Status, dbo.Tablet.Zubehoer, dbo.Schueler.Klasse
FROM  dbo.Ausgabe INNER JOIN
                         dbo.Schueler ON dbo.Ausgabe.SchuelerID = dbo.Schueler.PNr INNER JOIN
                         dbo.Tablet ON dbo.Ausgabe.TabletID = dbo.Tablet.ItemID

WHERE dbo.Tablet.Zustand=@TZustand AND dbo.Schueler.Klasse=@Klasse
 
END


GO

 CREATE OR ALTER   PROCEDURE [dbo].[TabletZustand]
(@TZustand varchar(50))
AS
BEGIN
SET NOCOUNT ON
 
SELECT dbo.Tablet.ItemID as 'TabletID', dbo.Tablet.Modell, dbo.Tablet.Notiz, dbo.Tablet.Zustand, dbo.Tablet.Status, dbo.Tablet.Zubehoer
FROM dbo.Tablet

WHERE dbo.Tablet.Zustand=@TZustand
 
END

GO

Create OR ALTER       PROCEDURE [dbo].[TSL]
(@TID int)
AS
BEGIN
SET NOCOUNT ON
 
 UPDATE dbo.Tablet
 SET Status = 'Im Lager'
 Where ItemID = @TID
END

GO

 CREATE OR ALTER         PROCEDURE [dbo].[TSV]
(@TID int)
AS
BEGIN
SET NOCOUNT ON
 
 UPDATE dbo.Tablet
 SET Status = 'Verliehen'
 Where ItemID = @TID
END

GO

Create OR ALTER       PROCEDURE [dbo].[TZG]
(@TID int)
AS
BEGIN
SET NOCOUNT ON
 
 UPDATE dbo.Tablet
 SET Zustand = 'Gut'
 Where ItemID = @TID
END

GO

Create OR ALTER       PROCEDURE [dbo].[TZGB]
(@TID int)
AS
BEGIN
SET NOCOUNT ON
 
 UPDATE dbo.Tablet
 SET Zustand = 'Gebraucht'
 Where ItemID = @TID
END

GO

Create OR ALTER       PROCEDURE [dbo].[TZS]
(@TID int)
AS
BEGIN
SET NOCOUNT ON
 
 UPDATE dbo.Tablet
 SET Zustand = 'Schlecht'
 Where ItemID = @TID
END

GO


Create OR ALTER       PROCEDURE [dbo].[TZV]
(@TID int)
AS
BEGIN
SET NOCOUNT ON
 
 UPDATE dbo.Tablet
 SET Zustand = 'Verloren'
 Where ItemID = @TID
END

GO

 CREATE OR ALTER       PROCEDURE [dbo].[TAusgabe]
(@TID int, @SID int, @SDate date, @EDate date)
AS
BEGIN
SET NOCOUNT ON
 
 Insert Into Ausgabe (SchuelerID, TabletID, [Ausgabe am], [Geplante Abgabe])
 Values (@SID, @TID, @SDate, @EDate)


Exec dbo.TSV @TID

END

GO

 Create OR ALTER     PROCEDURE [dbo].[TRueckgabe]
(@TID int, @SID int, @ADate date)
AS
BEGIN
SET NOCOUNT ON
 
 UPDATE dbo.Ausgabe
 SET Abgabe = @ADate
 Where SchuelerID = @SID and TabletID = @TID and Abgabe IS NULL

Exec dbo.TSL @TID

END

GO

 CREATE OR ALTER     PROCEDURE [dbo].[TabletAnzeige]
AS
BEGIN
SET NOCOUNT ON
 
SELECT dbo.Tablet.ItemID as 'TabletID', dbo.Tablet.Modell, dbo.Tablet.Notiz, dbo.Tablet.Zustand, dbo.Tablet.Zubehoer
FROM  dbo.Tablet 
 
END


GO


 CREATE OR ALTER     PROCEDURE [dbo].[Klassenanzeige]
AS
BEGIN
SET NOCOUNT ON
 
SELECT dbo.Schueler.Klasse AS 'Klasse'
FROM  dbo.Schueler
Group by Klasse
 
END


GO

 CREATE OR ALTER     PROCEDURE [dbo].[TabletID]
AS
BEGIN
SET NOCOUNT ON
 
SELECT dbo.Tablet.ItemID as "TabletID"
FROM  dbo.Tablet
 
END


GO