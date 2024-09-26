# IpadVerwaltung2
Gruppenarbeit Sören, Larissa, Mischa, Kyra IN23 für Herr Trimkowski

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


Datenbank aufrufen:
1. Database Client JDBC Extension in VS Code herunterladen
2. Auf das Datenbanken Symbol links in der Leiste klicken (wird bei ssh Verbindungen in VS Code häufig nicht angezeigt)
3. folgende Dinge angeben:
                            oben bei Server Type SQL Server auswählen
                            Hostname: localhost
                            Auth t_ype SQL Server Authentication
                            Username: sa
                            Database: master
                            Port: 1433
                            Passwort: BratwurstIN23!