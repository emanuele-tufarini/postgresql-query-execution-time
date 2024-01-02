# Esecutore di Query PostgreSQL

Questo script PHP contiene una classe per eseguire query su un database PostgreSQL e calcolare il tempo di esecuzione della query.

## Credenziali di Accesso al Database

Assicurati di inserire correttamente le credenziali di accesso al database PostgreSQL nel file `Connection.php`.

## File Query SQL

Inserisci la tua query SQL nel file `Query.sql` prima di eseguire lo script.

## Utilizzo

```php
/** Credenziali di accesso al database PostgreSQL */
require "Connection.php";

/** Inserire la query SQL dentro al file Query.sql */
$query = file_get_contents("Query.sql");

/** Istanzia la classe PostgresQuery */
$pg = new PostgresQuery();

/** Esegui la query e ottieni il risultato */
$result = $pg->Query($query, $host, $port, $dbname, $user, $password);

/** Calcola e stampa il tempo di risposta del server */
$execution_time = $pg->Time($query, $host, $port, $dbname, $user, $password);
echo ("Tempo di risposta: " . $execution_time . " secondi");
