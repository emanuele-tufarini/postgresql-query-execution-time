# Classe per Eseguire Query su un Database PostgreSQL

Questo progetto contiene una classe PHP per eseguire query su un database PostgreSQL e calcolare il tempo di esecuzione della query.

## Struttura del Progetto

Il progetto è composto dai seguenti file:

- `Connection.php`: Questo file contiene le credenziali per connettersi al database PostgreSQL. Assicurati di inserire correttamente le credenziali di accesso.
- `Query.sql`: Questo file dovrebbe contenere la query SQL che desideri eseguire. Inserisci la tua query SQL prima di eseguire lo script.
- `QueryExecutor.php`: Questo file contiene la classe principale che esegue la query SQL sul database PostgreSQL e calcola il tempo di esecuzione.

## Istruzioni per l'Uso

1. Inserisci le tue credenziali di accesso al database nel file `Connection.php`.
2. Inserisci la tua query SQL nel file `Query.sql`.
3. Esegui il file `QueryExecutor.php` per eseguire la query e calcolare il tempo di esecuzione.

## Requisiti

- PHP
- PostgreSQL