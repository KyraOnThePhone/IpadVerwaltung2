# IpadVerwaltung2
Gruppenarbeit Sören, Larissa, Mischa, Kyra IN23 für Herr Trimkowski

Links zu Hilfen und Doku:

Wie setzt man das Projekt auf:
https://1drv.ms/w/c/eef3a3deb2781862/ETaA5KX1KKhApoJaCT64jOQBlDRwmghd0m05cJAsn-8TBA?e=CJiA2z

Doku:

Container aufbauen (Docker muss installiert sein):
1. gehe in den Pfad, in dem die Datei compose.yaml liegt. (cd <Pfad>)
2. gebe folgenden Befehl an: sudo docker compose up -d


SQL Code:
Bitte auch in init.sql übernehmen

An der Datenbank kann durch das VSCode DB Extension gearbeitet werden

Git Commands:
git pull - Aktuelles Repository ziehen

Ergebnisse hochladen:

git add <Dateiname> oder . für alles
git commit -m "<Änderungen>"
git push


Datenbank aufrufen (Dockercontainer muss dafür aktiv sein):
1. Database Client JDBC Extension in VS Code herunterladen
2. Auf das Datenbanken Symbol links in der Leiste klicken (wird bei ssh Verbindungen in VS Code häufig nicht angezeigt)
3. folgende Dinge angeben:
                            oben bei Server Type SQL Server auswählen
                            Hostname: localhost
                            Auth type: SQL Server Authentication
                            Username: sa
                            Database: master
                            Port: 1433
                            Passwort: BratwurstIN23!


To Do:

- Datenbank:



- UI:           - Login Seite mit Form
                - Login Script
                -            


- Sonstiges:
                - ein ERM bauen:
                                das aktuelle ist kein ERM sondern ein relationales Datenbankmodell Ein ERM beschreibt die Beziehungen zwischen einzelnen Objekten OHNE sich dabei über die Tabellenstruktur gedanken zu machen. Dort findet man nur Entitäten, Attribute, Beziehungstypen und Kardinalitäten und dementsprechend KEINE Tabellen und Foreign Keys. Das relationale Datenbankmodell baut auf dem ERM
                                auf und stellt die physische Struktur der Daten, innerhalb einer relationalen Datenbank dar. Die Elemente hierbei sind Tabellen, Spalten & Beziehungen durch Fremdschlüssel
                                Bitte überarbeiten. Nur weil in Draw.io steht, dass die Symbole für ein ERM sind heißt es nicht dass es stimmt!
