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
	[PNr] [int] IDENTITY(1,1) NOT NULL,
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
END
GO
IF NOT EXISTS (SELECT * FROM sys.objects WHERE name = 'Tablet' AND type = 'U')
BEGIN
    CREATE TABLE [dbo].[Tablet](
	[ItemID] [int] IDENTITY(1,1) NOT NULL,
	[Modell] [varchar](50) NULL,
	[Zubehoer] [varchar](50) NULL,
	[Notiz] [varchar](100) NULL,
	[Status] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Tablet] PRIMARY KEY CLUSTERED 
(
	[ItemID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
END
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
GO

ALTER TABLE [dbo].[Ausgabe]  WITH CHECK ADD FOREIGN KEY([SchuelerID])
REFERENCES [dbo].[Schueler] ([PNr])
GO

ALTER TABLE [dbo].[Ausgabe]  WITH CHECK ADD FOREIGN KEY([TabletID])
REFERENCES [dbo].[Tablet] ([ItemID])
END
GO
CREATE OR ALTER VIEW [dbo].[Gestohlen Status]
AS
SELECT        TOP (100) PERCENT dbo.Tablet.ItemID, dbo.Tablet.Modell, dbo.Tablet.Status, dbo.Tablet.Zubehoer, dbo.Tablet.Notiz, dbo.Ausgabe.[Ausgabe am], dbo.Schueler.PNr, dbo.Schueler.Nachname, dbo.Schueler.Vorname, 
                         dbo.Schueler.Klasse, dbo.Schueler.Jahrgang
FROM            dbo.Ausgabe INNER JOIN
                         dbo.Schueler ON dbo.Ausgabe.SchuelerID = dbo.Schueler.PNr INNER JOIN
                         dbo.Tablet ON dbo.Ausgabe.TabletID = dbo.Tablet.ItemID
WHERE        (dbo.Tablet.Status = 'Gestohlen')
GO
CREATE OR ALTER VIEW [dbo].[Lager Status]
AS
SELECT        TOP (100) PERCENT dbo.Tablet.ItemID, dbo.Tablet.Modell, dbo.Tablet.Status, dbo.Tablet.Zubehoer, dbo.Tablet.Notiz
FROM            dbo.Ausgabe INNER JOIN
                         dbo.Schueler ON dbo.Ausgabe.SchuelerID = dbo.Schueler.PNr INNER JOIN
                         dbo.Tablet ON dbo.Ausgabe.TabletID = dbo.Tablet.ItemID
WHERE        (dbo.Tablet.Status = 'Lager')
GO
CREATE OR ALTER VIEW [dbo].[Verliehen Status]
AS
SELECT        TOP (100) PERCENT dbo.Tablet.ItemID, dbo.Tablet.Modell, dbo.Tablet.Status, dbo.Tablet.Zubehoer, dbo.Tablet.Notiz, dbo.Ausgabe.[Ausgabe am], dbo.Ausgabe.[Geplante Abgabe], dbo.Schueler.Nachname, 
                         dbo.Schueler.Vorname, dbo.Schueler.Klasse, dbo.Schueler.Jahrgang
FROM            dbo.Ausgabe INNER JOIN
                         dbo.Schueler ON dbo.Ausgabe.SchuelerID = dbo.Schueler.PNr INNER JOIN
                         dbo.Tablet ON dbo.Ausgabe.TabletID = dbo.Tablet.ItemID
WHERE        (dbo.Tablet.Status = 'Verliehen')
GO
CREATE OR ALTER VIEW [dbo].[Verloren Status]
AS
SELECT        TOP (100) PERCENT dbo.Tablet.ItemID, dbo.Tablet.Modell, dbo.Tablet.Status, dbo.Tablet.Zubehoer, dbo.Tablet.Notiz, dbo.Ausgabe.[Ausgabe am], dbo.Schueler.PNr, dbo.Schueler.Nachname, dbo.Schueler.Vorname, 
                         dbo.Schueler.Klasse, dbo.Schueler.Jahrgang
FROM            dbo.Ausgabe INNER JOIN
                         dbo.Schueler ON dbo.Ausgabe.SchuelerID = dbo.Schueler.PNr INNER JOIN
                         dbo.Tablet ON dbo.Ausgabe.TabletID = dbo.Tablet.ItemID
WHERE        (dbo.Tablet.Status = 'Verloren')
GO