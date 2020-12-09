# treeview
add your tree to the map


### http login
Die Nutzerzugänge werden in einem unabhängigen Datenbankprogramm gepflegt.

Login:
1. Der Nutzer gibt seine Logindaten in die Textfelder 'name' und 'passwort' ein.
2. Der Nutzer staret den Event 'login'.
3. Das PHP Skript 'connect.php' erstellt einen kurzzeitig gültigen Salt.
4. Die Nutzereingabe wird mit 'cryptico' verschlüsselt.(immer gleich eigentlich keine zusätzliche Sicherheit)
5. Das durch 'cryptico' umgeformte Password wird mit dem vom server erhaltenen Salt verschlüsselt.
6. Das Passwort wird über 'http POST' an ein 'php' Skript zum Sever übermittelt.
7. Das Passwort und der Nutzername werden mit dem eben erstellten Salt entschlüsselt.
8. Das Passwort zum erhaltenen Nutzername wird über die Datenbank abgefragt.
9. Die Freigabe für die erweiterete Nutzung wird erteilt.
