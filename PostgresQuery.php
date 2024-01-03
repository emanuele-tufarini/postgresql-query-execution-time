<?php

/**
 * Questo file contiene una classe per eseguire query su un database PostgreSQL.
 * Calcola anche il tempo di esecuzione della query.
 */

/** credenziali di accesso al database postgres */
require "Connection.php";

/** inserire la query sql dentro al file Query.sql */
$query = file_get_contents("Query.sql");

/** classe per testare le query sul database postgres */
class PostgresQuery {
    /**
     * Esegue la query sul database PostgreSQL.
     * 
     * @param string $query La query SQL da eseguire.
     * @param string $host Il nome host del server PostgreSQL.
     * @param int $port Il numero di porta del server PostgreSQL.
     * @param string $dbname Il nome del database PostgreSQL.
     * @param string $user Il nome utente per la connessione al server PostgreSQL.
     * @param string $password La password per la connessione al server PostgreSQL.
     * @return PDOStatement Il risultato dell'esecuzione della query.
     */
    public function query($query, $host, $port, $dbname, $user, $password) {
        $conn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
        $pdo = new PDO($conn);
        $response = $pdo->query($query);
        return $response;
    }
    
    /**
     * Calcola il tempo di esecuzione della query.
     * 
     * @param string $query La query SQL da eseguire.
     * @param string $host Il nome host del server PostgreSQL.
     * @param int $port Il numero di porta del server PostgreSQL.
     * @param string $dbname Il nome del database PostgreSQL.
     * @param string $user Il nome utente per la connessione al server PostgreSQL.
     * @param string $password La password per la connessione al server PostgreSQL.
     * @return float Il tempo di esecuzione della query in secondi.
     */
    public function time($query, $host, $port, $dbname, $user, $password) {
        $timeStart = microtime(true); 
        $pg = $this->query($query, $host, $port, $dbname, $user, $password);
        $timeEnd = microtime(true);
        /** per convertire in minuti dividere per 60 */
        $executionTime = ($timeEnd - $timeStart);
        return $executionTime;        
    }
    
}

/** istanzia la classe */
$pg = new PostgresQuery();

$list = array();
while ($nTest >= 1) {
    $executionTime = $pg->time($query, $host, $port, $dbname, $user, $password); // Assegna il valore restituito dal metodo Time a $executionTime
    $list[] = $executionTime;
    $nTest = $nTest - 1;
}

/** stampa il tempo di risposta del server */
var_dump($list);