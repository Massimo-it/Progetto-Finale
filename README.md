# Progetto-Finale
Siti WEB per immobili in affitto breve
# Progetto-Finale
## Siti WEB per immobili in affitto breve

Per accedere alla pagina statica utilizzare il file index.html da cui si può accedere a tutti e tre i progetti standard.

***

## ISTRUZIONI PER L'APPLICAZIONE DELLA GESTIONE PRENOTAZIONI REALIZZATA IN PHP E MYSQL

per far fuzionare la parte di MySQL è necessario creare un data base con il nome "gestioneprenotazioni" composto da 4 tabelle:

### TABELLA 1 - NOME: clienti

* ID      4     int       A.I.
* nome    50    varchar   null
* email   50    varchar   null
* note    255   varchar   null

### TABELLA 2 - NOME: prenotazioni

* ID        4     int       A.I.
* cliente   50    varchar   null
* camera    30    varchar   null
* dataDa    20    DATE      null
* dataA     20    DATE      null

### TABELLA 3 - NOME: utenti

* ID        4     int       A.I.
* username  20    varchar   null
* password  255   varchar   null

### TABELLA 4 - NOME: utentiloggati

* sessionid   255   varchar   null
* idlogged    4     varchar   null

***

dopo aver creato il DB e le 4 tabelle richiamare il file: Gestione-prenotazioni/gestione-utenti/nuovoutente.php

creare un utente

richiamare il file Gestione-prenotazioni/login.php e accedere con le credenziali dell'utente creato.

Ora l'utente può gestire le sue prenotazioni.
