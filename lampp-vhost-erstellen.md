# Virtuellen Host in XAMPP (LAMPP) einrichten

1. In `/opt/lampp/etc/httpd.conf` sicherstellen, dass diese Include-Zeile aktiv ist (kein `#` davor):

   ```apache
   Include etc/extra/httpd-vhosts.conf
   ```

2. Den VHost in `/opt/lampp/etc/extra/httpd-vhosts.conf` eintragen. Projektpfade und Hostnamen bei Bedarf anpassen:

   ```apache
   <VirtualHost *:80>
       ServerName phpmvc.localhost
       DocumentRoot "/home/sevo/dev/php/learn/write_a_mvc_framework/"

       <Directory "/home/sevo/dev/php/learn/write_a_mvc_framework/">
           Require all granted
           AllowOverride All
       </Directory>
   </VirtualHost>
   ```

3. In `/etc/hosts` ergänzen, falls der Eintrag noch fehlt:

   ```text
   127.0.0.1 phpmvc.localhost
   ```

4. Apache-Konfiguration prüfen und LAMPP neu starten:

   ```bash
   sudo /opt/lampp/bin/httpd -t
   sudo /opt/lampp/lampp restart
   ```

   Die Prüfung sollte `Syntax OK` ausgeben.

5. Im Browser `http://phpmvc.localhost/` öffnen. Im Projektordner muss eine Startdatei wie `index.php` liegen.

Ein ProFTPD-Fehler beim LAMPP-Neustart ist unabhängig vom Apache-VHost; laut Neustart-Ausgabe kann Apache trotzdem erfolgreich starten.