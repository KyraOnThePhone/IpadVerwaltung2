# IpadVerwaltung2
Gruppenarbeit Sören, Larissa, Mischa, Kyra IN23 für Herr Trimkowski

Links zu Hilfen und Doku:

Wie setzt man das Projekt auf:
[https://1drv.ms/w/c/eef3a3deb2781862/ETaA5KX1KKhApoJaCT64jOQBlDRwmghd0m05cJAsn-8TBA?e=CJiA2z](https://1drv.ms/w/c/eef3a3deb2781862/ETaA5KX1KKhApoJaCT64jOQBO-B_1N-vXAVfdr88vMwXFw?e=b3poXe)

Doku:
[https://1drv.ms/w/c/eef3a3deb2781862/EZ97EDrJ_kJJo12gtWMzGH0BwQK0Zr289wlcBTUIgQgAFg?e=QQEZtg](https://1drv.ms/w/c/eef3a3deb2781862/EZ97EDrJ_kJJo12gtWMzGH0BaKifGllANSAsSZg7MYI8Cw?e=PoXyW4)

Präsi:
[https://1drv.ms/p/c/eef3a3deb2781862/EadeZjHbn_xFrqos5hpUkXEBq6SHR824xhKAcLPuu_StUw?e=GCBZPb](https://1drv.ms/p/c/eef3a3deb2781862/AadeZjHbn_xFrqos5hpUkXE?e=JpxdYP)

Infomaterial:
Docker: 
[https://1drv.ms/w/c/eef3a3deb2781862/Eb-Rsdfj-ERBhZc6rqjmBJcBK_Pemm3sQXHcoT-7pnnseg?e=0hrbDh](https://1drv.ms/w/c/eef3a3deb2781862/Eb-Rsdfj-ERBhZc6rqjmBJcBIRv8FSxCrOEkIOZgqiOc4A?e=RAqQ3k)

Container aufbauen (Docker muss installiert sein):
1. gehe in den Pfad, in dem die Datei compose.yaml liegt. (cd <Pfad>)
2. gebe folgenden Befehl an: sudo docker compose up -d

Troubleshoot sqlsrv & php :
nano /etc/php83/php.ini
folgendes einfügen:
extension_dir = "/usr/local/lib/php/extensions/no-debug-non-zts-20230831"
schließen mit strg+s und strg+x
cp /usr/local/etc/php/conf.d/docker-php-ext-pdo_sqlsrv.ini /etc/php83/conf.d
cp /usr/local/etc/php/conf.d/docker-php-ext-sqlsrv.ini /etc/php83/conf.d
httpd -k restart

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

