<?php

/**
 * Questo file contiene una classe per l'esecuzione di query su un database PostgreSQL.
 * Calcola anche il tempo di esecuzione della query.
 */

/** Credenziali di accesso al database per PostgreSQL */
require "Connection.php";

/** Leggi la query SQL dal file Query.sql */
$query = file_get_contents("Query.sql");

/** Classe per il test delle query su database PostgreSQL */
class PostgresQuery {
    /**
     * Esegue la query sul database PostgreSQL.
     * 
     * @param string $query La query SQL da eseguire.
     * @param string $host L'hostname del server PostgreSQL.
     * @param int $port Il numero di porta del server PostgreSQL.
     * @param string $dbname Il nome del database PostgreSQL.
     * @param string $user Il nome utente per la connessione al server PostgreSQL.
     * @param string $password La password per la connessione al server PostgreSQL.
     * @return PDOStatement Il risultato dell'esecuzione della query.
     */
    public function query($query, $host, $port, $dbname, $user, $password) {
        $conn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
        $pdo = new PDO($conn);
        return $pdo->query($query);
    }
    
    /**
     * Calcola il tempo di esecuzione della query.
     * 
     * @param string $query La query SQL da eseguire.
     * @param string $host L'hostname del server PostgreSQL.
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
        $executionTime = $timeEnd - $timeStart;
        return $executionTime;        
    }
    
}

/** Istanziare la classe */
$pg = new PostgresQuery();

$list = [];
while ($nTest >= 1) {
    $executionTime = $pg->time($query, $host, $port, $dbname, $user, $password);
    $list[] = $executionTime;
    $nTest--;
}

/** Stampa il tempo di risposta del server */
var_dump($list);