pasw2015-child 0.6
==============

In questo tema child sono state apportate le seguenti modifiche:

1. cambiata la header, i dati inerenti alla scuola sono posti sulla DX
2. creato un nuovo template home-child, in questo template è stata aggiunta una nuova sidebar per gestire gli articoli in evidenza
3. creato nuovo template page special, questo template gestisce la pagina con i widget, nel template sono previste tre sidebar
4. attivato un nuovo widget per la gestione degli articoli in evidenza (funzione nativa di wp)


create le seguenti sidebar

1. special page (sx): utilizzata nel template page-special-widget
2. special page (cx): utilizzata nel template page-special-widget
3. special page (dx): utilizzata nel template page-special-widget
4. sidebar sticky: utilizzata nel template home-page-child

File function.php

a. Funzione: changing default wordpress email settings

questa funzione permette di cambiare i setting di default delle email spedite

es.
 - impostare il default address: no-replay@miodominio.it
 - impostare il nome dell'istituto: Istituco Comprensivo XXXXX

b. Funzione: remove_wordpress_version

questa funzione rimuove la versione di wordpress

c. Funzione: my_login_messages($error)

questa funzione imposta un messaggio generico di errore login, di default l'errore identifica il problema 

es.
 - La password inserita per il nome utente XXXXX non è corretta.
 - ERRORE: Nome utente non valido.
