# GOSBot Client
In dieser Datei geben wir dir ein paar Informationen darüber, was die einzelnen Dateien bzw. Ordner auf deinem Server machen. Zusätzlich geben wir dir ein paar Grundlegende Informationen.

## Ordner
### Plugin, Instance

Um die funktionsfähigkeit von GOSBot zu gewährleisten, solltest du diesen Ordner nicht bearbeiten, löschen oder Dateien hinzufügen. Wenn diese Dateien bearbeitet werden, werden folgende Funktionen stark beeinträchtigt oder funktionsunfähig.

 - Bot erstellen
 - Musik importieren
 - Musik löschen
 - Bot löschen
 - Und weitere

### bots
In diesem Ordner werden die einzelnen Konfigurationsdateien der Bots, welche du erstellt hast, gespeichert. Wir empfehlen, diese Dateien nur mit dem gosbot.de/cp - ControlPanel zu verwalten.
Wenn dir allerdings bewusst ist, wie diese Dateien bearbeitet werden, dann kannst du dies dort machen. Beachte nur, dass es zu Synchronisationsfehlern zwischen deinen Bots und den GOSBot Servern kommen kann. 

### media
Hier werden deine Musikdateien, welche du im GOSBot ControlPanel importiert hast, in form von MP3-Dateien gespeichert. Wenn du beispielsweise deinen GOSBot umziehen und du deine Musik nicht verlieren möchtest, dann musst du dir diesen Ordner sichern, und auf deinem neuen Server wieder in dem Ordner /opt/gosbot kopieren bzw. verschieben.

### dotnet
Diesen Ordner kannst du normalerweise wieder entfernen. Er diente nur dazu, denn GOSBot-Client ordnungsgemäß zu installieren.

### playlists
Wir werden bald ein Playlist System bei GOSBot anbieten können, wobei diese Ordner dann von nöten ist.

### m3i
Dieser Ordner dient dazu, Songs erfolgreich auf deinem Server zu importieren.


## Dateien
### config.json
Die Datei in dem Ordner config, sollte stehts privat gehalten werden. 
Sorge dafür, dass der Inhalt dieser Datei nicht öffentlich sichtbar wird (Bsp. YouTube Video oder Bilder). Wenn Nutzer an deinen Token kommen, dann haben diese die Möglichkeit, deinen Bot zu verwalten.